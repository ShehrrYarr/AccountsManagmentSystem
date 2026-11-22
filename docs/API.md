# AMS Mobile API — v1

The JSON API for the AMS React Native app. It sits next to the website and uses the **same
business rules** (the services in `app/Services`), so the app and the website always agree.

- **Base URL:** `http://23.230.253.206/ams/api/v1` (local: `http://127.0.0.1:8000/api/v1`)
- **Format:** JSON in, JSON out. Send `Accept: application/json`. Use `multipart/form-data` when
  attaching a picture or receipt.
- **Users:** the admin and agents, same logins as the website. Each sees what their role allows.
  Admin-only endpoints answer **403** to agents.
- Code: `routes/api.php`, `app/Http/Controllers/Api/V1`, `app/Http/Resources/Api`. Tests:
  `tests/Feature/Api/ApiTest.php`.

---

## 1. Conventions

| Thing | Format |
|---|---|
| Money | string with 2 decimals: `"1500.00"` (send numbers or strings; never floats for display) |
| Dates | `"2026-11-18"` |
| Times | ISO 8601: `"2026-11-18T10:15:00+00:00"` |
| Related records | `{ "id": 3, "name": "Al-Noor Traders" }` (or `null`) |
| Accounts | `{ "id", "name" (with holder), "short_name", "type": "cash"|"bank", "holder": "admin"|"company"|"agent" }` |
| No company | the admin's **cash in hand belongs to no company**: cash payments, cash expenses etc. have `"company": null`. Filters take `company_id=none` for that part. |
| Lists | paginated: `{ data: [...], links: {...}, meta: { current_page, last_page, per_page, total } }` — `?page=2&per_page=50` (max 100). A few small lists (companies, departments, users…) return everything in `data`. |
| Common filters | `from`, `to` (dates), `company_id` (id or `none`), `search`, `include_inactive=1` |

### Errors

| Status | Meaning | Body |
|---|---|---|
| 401 | not signed in / token revoked / user deactivated | `{ "message": "..." }` → send the user to the sign-in screen |
| 403 | not allowed for this role / record | `{ "message": "..." }` |
| 404 | not found (or not yours) | `{ "message": "..." }` |
| 409 | the same Idempotency-Key is still being saved | `{ "message": "..." }` → retry shortly |
| 422 | invalid input **or a broken accounting rule** (not enough money, duplicate cheque, overpaying…) | `{ "message": "...", "errors": { "field": ["..."] } }` |
| 429 | too many requests | — |

Batch errors name the row: `errors["rows.2.cheque_number"]` or `errors["rows.2"]`.

---

## 2. Sign in and devices

Each sign-in is a **device**. Its token never expires; it ends when the device logs out, the admin
signs that device out, or the user is deactivated (all devices).

```
POST /auth/login            { email, password, device_name: "Bilal's Pixel 8" }
→ 201 { token, token_type: "Bearer", device_id, user }
```
Then send `Authorization: Bearer <token>` on every request. Store the token in secure storage.

| Method | Path | |
|---|---|---|
| GET | `/auth/me` | the signed-in user (`role`, `is_admin`, `is_agent`…) |
| POST | `/auth/logout` | sign this device out |
| GET | `/auth/devices` | my devices (`current: true` marks this one) |
| DELETE | `/auth/devices/{id}` | sign one of my devices out |

Login is limited to 10 tries a minute; other calls to 240 a minute.

---

## 3. Offline queue and Idempotency-Key

Every create / change can be queued on the phone while offline and sent later.

1. Give each queued entry a unique key once (e.g. a UUID) and send it as the header
   **`Idempotency-Key: <key>`** with that request, every time it is (re)sent.
2. The first **successful** answer for a key is stored. Sending the same key again returns that same
   answer (with header `Idempotent-Replayed: true`) and **saves nothing again**.
3. A failed attempt (422 etc.) is **not** stored: show the reason, let the user fix the entry, and
   resend it with the **same key**.
4. 409 means the first send of that key is still running — wait and retry.
5. When syncing, send queued entries **one by one**: the good ones save, failed ones stay in the
   queue with their error ("save the rest, flag that one").
6. A key belongs to one request (method + path); reusing it for another request gives 422.

For cheques entered offline, send `deposited_on` (the day it was really deposited; not in the future).

Keep `/lookups` cached on the phone for the offline pickers.

---

## 4. Lookups, dashboard, bell

| Method | Path | Who | |
|---|---|---|---|
| GET | `/lookups` | all | everything for the pickers in one call: `companies` (agents also get `you_hold` per company), `departments`, `suppliers`, `expense_categories` (admin), `accounts` (admin cash + company banks; balances for admin only), `my_accounts` (agent), `agent_accounts` + `agents` (admin), `payment_methods` (agents: bank transfer only), `transaction_types`, `statement_kinds`, `me`, `server_time` |
| GET | `/dashboard` | all | **admin:** `money {cash, bank, total, moved}`, `with_agents`, `owed_to_agents`, `cheques_this_month`, `departments_owe`, `held_for_departments`, `owed_to_suppliers`, `profit_this_month`, `approvals_pending` — `?company_id=` for one company (then `money.moved` = what it moved into the cash). **agent:** `you_hold`, `by_company[]`, `accounts[]`, `cheques_this_month`, `payments_this_month`, `waiting_for_admin` |
| GET | `/notifications` | all | the bell: admin `approvals_pending {cheque_requests, payment_requests, returns, total}`; agent `waiting_for_admin {...}` + `decided_last_7_days {...}` |

---

## 5. Govt cheques

Entering a cheque **deposits it** into the same company's bank (one step). Agents see only the
cheques they received.

| Method | Path | |
|---|---|---|
| GET | `/cheques` | filters: `search` (number / slip / notes), `company_id`, `department_id`, `account_id`, `from`, `to`, `pending_request=1`, admin: `received_by` (user id) |
| GET | `/cheques/{id}` | |
| POST | `/cheques` | deposit one — multipart if `picture` |
| POST | `/cheques/batch` | `rows[]` — **all-or-nothing** (the Deposit Cheque page's table), up to 100 |
| PATCH / POST | `/cheques/{id}` | change (send only what changes; `picture` replaces it). **Admin:** applied → 200. **Agent:** becomes a request → **202** `{data: request}`; body may add `reason` |
| DELETE | `/cheques/{id}` | **admin:** deletes. **agent:** asks the admin → **202**; body `{reason}` optional |
| DELETE | `/cheque-requests/{id}` | agent withdraws their pending request |

Use **POST** (not PATCH) for changes that attach a file — PHP can't read multipart PUT/PATCH.

**Fields:** `cheque_date`*, `company_id`*, `deposit_account_id`* (that company's bank),
`department_id`*, `cheque_number`* (unique), `amount`*, `bank_charges`, `issuing_branch`,
`notes`, `deposit_reference`, `picture` (jpg/png/pdf ≤ 5 MB), `deposited_on` (default today).
Rules: cheque date not in the future and not after the deposit date; expired cheques (deposit more
than 6 months after the cheque date) are refused; charges < amount.

**Cheque object:** `id, cheque_number, cheque_date, deposited_on, valid_until, company, department,
deposit_account, issuing_branch, amount, bank_charges, net_deposit, deposit_reference, notes,
has_picture, picture_url, received_by, pending_request, latest_request, created_at, updated_at`.

**Request object** (cheque or payment): `id, for: "cheque"|"payment", record_id, action:
"edit"|"delete", changes {field: new value}, picture_url, reason, status:
"pending"|"approved"|"rejected", requested_by, decided_by, decided_at, decision_note, created_at`.

---

## 6. Department payments (Pay Department)

| Method | Path | |
|---|---|---|
| GET | `/payments` | filters: `method`, `company_id` (id or `none`), `department_id`, `supplier_id`, `account_id`, `search`, `from`, `to`, `pending_request=1` |
| GET | `/payments/{id}` | |
| POST | `/payments` | one payment — multipart if `receipt` |
| POST | `/payments/batch` | `rows[]` — **all-or-nothing**, up to 100. A total-level problem (e.g. not enough cash for all rows) comes back as `errors.amount` |
| PATCH / POST | `/payments/{id}` | admin: applied; agent: request → 202 |
| DELETE | `/payments/{id}` | admin: deletes; agent: request → 202 |
| DELETE | `/payment-requests/{id}` | agent withdraws their pending request |

**Fields:** `date`*, `method`* (`cash` | `bank_transfer` | `goods`), `department_id`*, `amount`*,
`description`, `reference`, `received_by`, `notes`, `receipt` (file), and by method:

| method | admin | agent |
|---|---|---|
| `cash` | no company, no account: paid from the admin's cash in hand | not allowed |
| `bank_transfer` | `company_id`* + `account_id`* (that company's bank) | `company_id`* (the company it's for) + `account_id`* (**their own bank**). `method` may be left out |
| `goods` | `company_id`*, `supplier_id`*, `description`* (what was bought), `on_credit` (true → no account; false → `account_id`* that company's bank), optional `quantity` (up to 3 decimals) + `unit_price` (both or neither; the app fills `amount` with quantity × price, which may still be changed, e.g. a discount) | not allowed |

An agent's payment counts straight away and lowers what they hold of that company's money; paying
more than they hold is allowed (the company then owes the agent).

**Payment object:** `id, date, method, method_label, company (null = cash), department, account,
supplier, on_credit, amount, description, quantity (goods, e.g. "2.5", or null), unit_price (or null), reference, received_by, notes, summary, has_receipt,
receipt_url, paid_by_agent, created_by, pending_request, latest_request, created_at, updated_at`.

---

## 7. Transfers, advances and returns

| Method | Path | Who | |
|---|---|---|---|
| GET | `/transfers` | all | admin: `status` (default `posted`; or `pending` / `rejected`), `type` (`own` / `intercompany` / `agent`), `company_id`, `account_id`, `from`, `to`. Agent: every transfer touching their accounts, any status |
| GET | `/transfers/{id}` | all | |
| POST | `/transfers` | admin | `from_account_id`*, `to_account_id`*, `amount`*, `date`*, `reference`, `notes`, `from_company_id` (only for an advance/return through the **cash**: which company it is for) |
| PATCH | `/transfers/{id}` | admin | |
| DELETE | `/transfers/{id}` | admin: delete · agent: withdraw their pending return | |
| POST | `/transfers/returns` | agent | `from_account_id`* (theirs), `from_company_id`* (whose money), `to_account_id`* (company bank or admin cash), `amount`*, `date`*, `reference`, `notes` → **pending** until the admin approves |

What a transfer is follows from the accounts: bank ↔ admin cash (cash & bank move — moving money
into the cash takes it out of the company), bank A → bank B (between companies: B owes A), → agent
account (advance), agent account → (return; can't exceed what they owe that company).

**Transfer object:** `id, date, kind, type: own|intercompany|advance|return, status, amount,
from_account, to_account, from_company, to_company, agent, reference, notes, summary, created_by,
decided_by, decided_at, decision_note, created_at`.

---

## 8. Approvals (admin)

| Method | Path | |
|---|---|---|
| GET | `/approvals` | `cheque_requests[]` (each with the current `cheque`), `payment_requests[]` (with `payment`), `returns[]`, `recently_decided {…}` |
| POST | `/approvals/{kind}/{id}/approve` | kind: `cheque-requests` · `payment-requests` · `returns`; body `{note}` optional |
| POST | `/approvals/{kind}/{id}/reject` | body `{note}` optional (shown to the agent) |

If an approved change no longer fits the rules (e.g. money already spent), approve answers 422 and
the request stays pending.

---

## 9. Money out (admin)

| Path | Fields |
|---|---|
| `/supplier-payments` (GET, POST, GET/PATCH/DELETE `/{id}`) | `supplier_id`*, `account_id`* (company bank → that company's debt; admin cash → no company), `amount`*, `date`*, `reference`, `notes`. Filters: `supplier_id`, `company_id`, `from`, `to`, `search` |
| `/expenses` (GET, POST, GET/PATCH/POST/DELETE `/{id}`) | `expense_category_id`*, `account_id`*, `amount`*, `date`*, `description`*, `reference`, `notes`, `receipt` (file). Filters: `category_id`, `company_id`, `from`, `to`, `search` |

The company is never sent: it follows from the account.

---

## 10. Setup

| Path | Who | Notes |
|---|---|---|
| `/companies` (apiResource) | admin | list adds `bank_balance`, `moved_to_cash`; show adds `summary {...}` and `bank_accounts[]`. Fields: `name`*, `ntn`, `registration_no`, `phone`, `email`, `address`, `notes`, `is_active`. Delete only without transactions |
| `/accounts` (apiResource) | admin: all · agent: own | filters `holder` (admin/company/agent), `company_id`, `agent_id`, `type`, `include_inactive`. Admin creates a company bank (`company_id`, `name`*, `bank_name`*, `branch`, `account_title`, `account_number`, `iban`, `opening_balance`, `opening_date`) or an agent account (`agent_id`). Agents create their own banks (`name`*, `bank_name`*…). `can_edit` says what the user may change: agents can't change accounts the admin added, nor their cash in hand; nobody edits the admin cash |
| `/agents`, `/agents/{id}` | admin (agent: own id) | what each agent owes, per company (`owes < 0` = the company owes the agent), their accounts; list `meta {with_agents, owed_to_agents}` |
| `/departments`, `/suppliers`, `/expense-categories` (GET, POST, GET/PATCH/DELETE `/{id}`) | admin | lists add balances (`spent/received/balance`; `purchased/paid/owed`), `?company_id=` (id or `none`); show adds `by_company[]` (company `null` = no company). Delete of something with history **deactivates** it (`result: "deactivated"`) |
| `/opening-balances` (GET, POST, PATCH/DELETE `/{id}`) | admin | `party`*: `cash` (admin cash, no company, one only) · `department` (`company_id`, `department_id`; amount > 0 owes you, < 0 you hold) · `supplier` (`company_id`, `supplier_id`) · `agent` (`company_id`, `account_id` agent's account). `amount`*, `date`*, `notes` |
| `/deal-closings` (GET, POST, PATCH/DELETE `/{id}`) | admin | `company_id`* (or `none`), `department_id`*, `date`*, `notes` — the department's leftover balance becomes profit / loss |
| `/users` (GET, POST, GET/PATCH `/{id}`) | admin | `name`*, `email`*, `phone`, `role`* (`admin`/`agent`), `is_active`, `password` + `password_confirmation` (new users; optional when editing). `is_active=false` deactivates and signs out every device. Nobody can demote / deactivate themselves |
| `/users/{id}/devices`, DELETE `/users/{id}/devices/{deviceId}` | admin | see and sign out a user's devices |

---

## 11. Reports

| Method | Path | Who | |
|---|---|---|---|
| GET | `/statements/{kind}/{id}` | admin: all · agent: `agent/{own id}` and own `account/{id}` | kind: `account` · `department` · `supplier` · `company` · `agent`. `from`, `to`, `company_id` (id or `none`). Returns `title, name, company, labels {debit, credit, balance}, note, opening, totals, closing, rows[] {transaction_id, date, type, type_label, description, reference, notes, company, amount, debit, credit, balance}, pdf_url` |
| GET | `/statements/{kind}/{id}/pdf` | same | the website's PDF (download / share) — send the Bearer token |
| GET | `/transactions` | admin | the journal: `type`, `status` (`posted` default / `void` / `all`), `company_id`, `account_id`, `department_id`, `search`, `from`, `to`, `with_lines=1` |
| GET | `/transactions/{id}` | admin | with its debit / credit `lines[]` |
| GET | `/audit-log` | admin | `user_id`, `type` (e.g. `cheque`), `event`, `from`, `to` |

## 12. Pictures and receipts

`GET /files/{type}/{id}` with the Bearer token — type: `cheque`, `payment`, `expense`,
`cheque-request`, `payment-request`. The objects give ready-made `picture_url` / `receipt_url`.
Agents can open only their own.

---

## 13. Examples

Sign in:
```bash
curl -X POST http://23.230.253.206/ams/api/v1/auth/login \
  -H "Accept: application/json" -H "Content-Type: application/json" \
  -d '{"email":"agent@example.com","password":"…","device_name":"Pixel 8"}'
```

An agent's department payment, queued offline and sent with its key:
```bash
curl -X POST http://23.230.253.206/ams/api/v1/payments \
  -H "Authorization: Bearer $TOKEN" -H "Accept: application/json" \
  -H "Idempotency-Key: 6f1c2e8a-…" \
  -F company_id=1 -F department_id=4 -F account_id=12 -F amount=12000 \
  -F date=2026-11-18 -F description="Lab kits" -F receipt=@receipt.jpg
```

A batch of cheques (all-or-nothing):
```json
POST /cheques/batch
{ "rows": [
  { "cheque_date": "2026-11-17", "company_id": 1, "deposit_account_id": 2, "department_id": 4,
    "cheque_number": "900101", "amount": "25000", "bank_charges": "100" },
  { "cheque_date": "2026-11-17", "company_id": 1, "deposit_account_id": 2, "department_id": 4,
    "cheque_number": "900102", "amount": "18000" }
] }
```
