<?php
namespace App\Models; use Illuminate\Database\Eloquent\Model; use App\Traits\BelongsToCompany;
class AccountingPeriod extends Model {use BelongsToCompany; protected $guarded=[]; protected function casts():array{return ['start_date'=>'date','end_date'=>'date','closed_at'=>'datetime','reopened_at'=>'datetime'];} public function fiscalYear(){return $this->belongsTo(FiscalYear::class);} public function isOpen():bool{return $this->status==='open';}}
