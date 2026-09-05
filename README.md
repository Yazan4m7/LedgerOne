# LedgerOne

LedgerOne is a Laravel 11 double-entry accounting system designed for Jordan. It uses an immutable posted ledger: corrections are additive reversal/credit entries, never edits to posted history.

## Implemented accounting scope

- hierarchical chart of accounts and company isolation
- draft, posted and reversed journals with balanced double entry
- accounting periods, close/reopen audit trail and fiscal-year close/reopen
- JOD base accounting plus transaction FX, realized FX and period-end unrealized revaluation
- customers/suppliers, sales/purchase documents, credit documents and tax codes
- receipts/supplier payments with allocation and AR/AP control accounts frozen at posting
- trial balance, general ledger, P&L, balance sheet, AR/AP aging and tax summary
- role-based permissions, append-only audit log, database immutability triggers and integrity command
- Docker deployment files and CI across SQLite/MySQL

JoFotara integration scaffolding exists, but **live JoFotara validation is intentionally disabled and not part of the production gate until authorized credentials are available**.

## Development

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate:fresh --seed
php artisan ledgerone:install --company="Demo Company" --slug=demo --email=owner@example.com
php artisan serve
```

Run tests:

```bash
php artisan test
php artisan ledgerone:integrity-check
```

See `docs/PRODUCTION.md` for the deployment and release checklist.
