# AMS — Cash-In / Cash-Out & Government Cheque Clearing

Laravel 12 · Livewire 4 + Volt (functional API) · Herozi Bootstrap 5 admin theme · MySQL (InnoDB) · ApexCharts · DomPDF

## What it does

I run several **companies** of my own. Each has one **cash in hand** and any number of **bank accounts**.
My customers are **government departments**: I spend for them (hand over cash, send a bank transfer, or buy
goods from a supplier) and the government later pays with **cheques** — sometimes before, sometimes after.

| Area | Screens |
|---|---|
| **Money in** | Enter a govt cheque for a department and the bank it was deposited into — **one step**: the company's bank goes up (less optional bank charges) and the department is credited. Cheques older than 6 months are refused. |
| **Money out** | Department payments: **cash given**, **bank transfer** or **goods purchased** (paid now or **on credit** to a supplier). Supplier payments. General expenses by category. |
| **Transfers** | Within one company (ATM / cash withdrawal, cash deposit, bank to bank) or **between my companies** — the receiving company owes the sender until it is sent back. |
| **Ledgers** | Company ledger, cash statements, bank statements, department (customer) ledger per company and in total, supplier ledger — on screen, printable and as PDF. Double-entry journal with CSV export. |
| **Deals** | **Close a deal** with a department: the leftover balance (cheques minus spending) is booked as profit or loss. |
| **Setup** | Opening balances (cash / bank, departments, suppliers), expense categories, users (administrators only for now), audit log. |

### Accounting rules enforced by `App\Services\LedgerService`

* Every posting is a balanced set of debit / credit lines, and each company's lines balance on their own.
* Source documents (cheques, payments, transfers…) implement `PostsToLedger`; saving one voids its old
  journal entries and re-posts them, so edits and deletes always keep the ledger consistent. Voided rows stay
  visible in the journal.
* No cash or bank account may go below zero; a company can never pay a supplier more than it owes.
* Department balance = spent for them − cheques received. Positive: they owe me. Negative: I hold their money.
* Department, supplier and inter-company balances are read straight from the journal (`App\Services\Balances`);
  only account balances are cached (`php artisan ams:recalculate-balances` rebuilds them).

## Setup (Windows / WAMP)

The WAMP MySQL server defaults to MyISAM, so the app forces InnoDB (`DB_ENGINE`, default `InnoDB`) because
transactions and foreign keys are required.

```bash
composer install
```

Front-end assets (`public/assets`) are **not** committed; build them from `resources/assets` with Laravel Mix
(Node 18+). Run this after every pull that touches `resources/assets` or `webpack.mix.js`:

```bash
npm install
```

```bash
npm run dev
```

Use `npm run production` for a minified production build. `webpack` is pinned to 5.99.9 in `package.json`
because newer 5.x releases removed a file Laravel Mix 6 depends on.

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

`db:seed` creates the first administrator (only if there is none) and default expense categories. Credentials are documented in
`database/seeders/DatabaseSeeder.php`; change the password after the first sign-in.

Optional sample data (three companies, departments, suppliers and about four months of activity):

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

`ams:recalculate-balances` rebuilds every cash / bank account balance from the posted journal.

```bash
php artisan migrate:fresh --seed
```

## Where things live

```
app/Enums/                      AccountType, ChequeStatus, PaymentMethod, TransactionType, LedgerAccount, ...
app/Models/                     Company, Account, Department, Supplier + documents that implement PostsToLedger
app/Services/LedgerService.php  double-entry posting, voiding, sync of documents, invariants, recalculation
app/Services/Balances.php       department / supplier / inter-company / profit balances from the journal
app/Services/*Service.php       Cheque, Payment, Transfer, Deal (closings & openings), MasterData, Statement
resources/views/livewire/       Volt single-file components
  cheques/          register-cheque (one-step deposit), list
  payments/         create, list
  supplier-payments/, expenses/, transfers/, accounts/, opening-balances/   manage (list + modal)
  companies/        list, summary
  departments/      list, balances, close-deal, closings
  suppliers/        list
  statements/       ledger (account, department, supplier, company)
  transactions/     datatable
  dashboard/        overview-metrics, charts, attention
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
