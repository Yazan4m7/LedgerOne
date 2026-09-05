<?php
namespace App\Console\Commands;
use Illuminate\Console\Command;
use App\Services\IntegrityService;
class LedgerIntegrityCheck extends Command {protected $signature='ledgerone:integrity-check {--company=}';protected $description='Validate posted ledger invariants';public function handle():int{$errors=app(IntegrityService::class)->check($this->option('company')?(int)$this->option('company'):null);if(!$errors){$this->info('Ledger integrity check passed.');return self::SUCCESS;}foreach($errors as $e)$this->error($e);return self::FAILURE;}}
