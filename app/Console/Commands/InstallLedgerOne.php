<?php
namespace App\Console\Commands;
use Illuminate\Console\Command;
use App\Services\CompanyProvisioningService;
class InstallLedgerOne extends Command {protected $signature='ledgerone:install {--company=} {--slug=} {--email=} {--password=} {--year=}';protected $description='Provision a LedgerOne company, chart of accounts, periods and administrator';public function handle():int{$name=$this->option('company')?:'Demo Company';$slug=$this->option('slug')?:str($name)->slug();$email=$this->option('email')?:'owner@example.com';$password=$this->option('password')?:'ChangeMe-'.bin2hex(random_bytes(4));$year=(int)($this->option('year')?:date('Y'));$c=app(CompanyProvisioningService::class)->create($name,$slug,$email,$password,$year);$this->info("Created company #{$c->id} ({$c->slug})");if(!$this->option('password'))$this->warn("Generated admin password: $password");return self::SUCCESS;}}
