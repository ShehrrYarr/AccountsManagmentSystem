# AMS — Cash-In / Cash-Out & Government Cheque Clearing

Laravel 12 · Livewire 4 + Volt (functional API) · Herozi Bootstrap 5 admin theme · MySQL (InnoDB) · ApexCharts · DomPDF

## What it does

| Area | Screens |
|---|---|
| **Cash in** | Receive government cheques for a company → clear them by **bank deposit** or **over-the-counter encashment** (into the Cash Vault), with per-cheque commission and bank charges. Bounce / cancel with automatic reversal. |
| **Cash out** | Pay companies by **cash payout**, **bank transfer** (split across several of the company's accounts) or **direct vendor purchase** (with receipt). Internal transfers between my own accounts. |
| **Ledger** | Double-entry journal (`transactions` + `journal_ledger_entries`) with filters, sorting, expandable debit/credit lines and CSV export. Manual company adjustments (admin). |
| **Companies** | Payable (I owe them) and receivable (they owe me) tracked separately. Statement of account on screen, printable, and as PDF. |
| **Control** | Admin / Staff roles. Staff clearings, payouts, purchases, edits and deletes go to an **approvals queue**. Full audit log with before / after values. |

### Accounting rules enforced by `App\Services\LedgerService`

* Every posting is a balanced set of debit / credit lines; cached balances update in the same DB transaction.
* No bank or cash account may go below zero.
* A payout can never exceed what you owe the company (no advances). Receivables come only from adjustments.
* A cleared cheque cannot be bounced if the company was already paid out of that money. Record an
  *Overpaid → Receivable* adjustment first.
* Received cheques do not affect company balances until they clear (they are tracked as memo entries).
* Edits and deletes void the original journal entries and re-post them; voided rows stay visible in the journal.

## Setup (Windows / WAMP)

The WAMP MySQL server defaults to MyISAM, so the app forces InnoDB (`DB_ENGINE`, default `InnoDB`) because
transactions and foreign keys are required.

```bash
composer install
```

```bash
copy .env.example .env
```

```bash
php artisan key:generate
```

Create the databases `ams` and `ams_testing` (utf8mb4) in phpMyAdmin, then:

```bash
php artisan migrate
```

```bash
php artisan db:seed
```

`db:seed` creates the first administrator and the Cash Vault. Credentials are documented in
`database/seeders/DatabaseSeeder.php`; change the password after the first sign-in.

Optional sample data (companies, cheques, payouts over the last 8 months):

```bash
php artisan db:seed --class=DemoDataSeeder
```

Run the app:

```bash
php artisan serve
```

## Useful commands

```bash
php artisan test
```

```bash
php artisan ams:recalculate-balances
```

`ams:recalculate-balances` rebuilds every company payable / receivable and account balance from the posted journal.

```bash
php artisan migrate:fresh --seed
```

## Where things live

```
app/Enums/                      ChequeStatus, TransactionType, LedgerAccount, DisbursementType, ...
app/Services/LedgerService.php  double-entry posting, voiding, invariants, recalculation
app/Services/*Service.php       Cheque, Disbursement, InternalTransfer, Adjustment, MasterData, Approval, Statement
resources/views/livewire/       Volt single-file components
  cheques/        register-cheque, clear-cheque, close-cheque, list
  disbursements/  create, list
  transactions/   datatable
  dashboard/      overview-metrics, charts, attention
  companies/      list, bank-accounts, statement, summary
  ...             transfers, adjustments, approvals, users, audit, bank-accounts, master
resources/views/layouts/        Herozi-based app & auth layouts; livewire-glue (toasts, modals, Alpine select, charts)
resources/views/ams/            page views that embed the Volt components
tests/Feature/Ledger            accounting rules
tests/Feature/Ui                every Volt component + page access
```

### Livewire ↔ Herozi conventions

* `$this->dispatch('transaction-updated')` after any money movement; stats, lists, journal and charts listen and refresh.
* `$this->dispatch('modal-show' | 'modal-hide', id: '...')` opens / closes Herozi Bootstrap modals (`<x-modal>`).
* `$this->dispatch('toast', type: 'success', message: '...')` shows a SweetAlert2 toast.
* `<x-searchable-select wire:model.live="company_id" :options="..."/>` is the Alpine-powered searchable dropdown.
* Volt state has no class defaults, so components reset forms with `fill([...])`, never `reset()`.

The original Herozi demo pages are still available to administrators at `/herozi/{page}` as a UI reference.
