# LedgerOne production deployment

## Release gate

A release is acceptable only when all CI jobs pass, a clean database can run `migrate:fresh --seed`, `php artisan test` passes, and `php artisan ledgerone:integrity-check` reports no errors. JoFotara live submission is explicitly outside this gate until authorized credentials and validation are available.

## Required production settings

- PHP 8.2+ (8.3 recommended), MySQL 8+
- `APP_ENV=production`, `APP_DEBUG=false`
- a unique generated `APP_KEY`
- HTTPS only; set `SESSION_SECURE_COOKIE=true`
- least-privilege MySQL account; never use the root database account for the app
- persistent `storage/`, queue worker, scheduled backups, and monitored disk space
- encrypted secrets outside Git; never commit `.env`

Run on deployment:

```bash
composer install --no-dev --prefer-dist --optimize-autoloader
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan migrate --force
php artisan ledgerone:integrity-check
```

## Backups

Take database backups at least daily and before every migration. Keep encrypted off-site copies and test restore procedures regularly. A backup is not considered valid until restored to an isolated environment and `ledgerone:integrity-check` passes.

Suggested restore verification:

1. Restore the MySQL dump to an isolated database.
2. Point a non-production LedgerOne instance at it.
3. Run `php artisan ledgerone:integrity-check`.
4. Compare trial balance totals with the source environment.
5. Verify document, payment, period-close, and audit histories are present.

## Accounting controls

Posted journals and posted financial documents are immutable. Corrections use reversal journals or credit documents. Closed periods reject ordinary posting. Reopening requires a privileged permission and a reason, recorded in the audit trail. Account balances are always derived from posted journal lines; cached balances must never become authoritative.

## JoFotara

`JOFOTARA_ENABLED=false` must remain in production until an authorized account is available and generated documents have passed live/test validation. Do not add credentials to source control. Reported government documents must never be made editable by reopening an accounting period.
