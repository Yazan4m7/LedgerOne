<?php
namespace App\Models; use Illuminate\Database\Eloquent\Model; use App\Traits\BelongsToCompany;
class FiscalYear extends Model {use BelongsToCompany; protected $guarded=[]; protected function casts():array{return ['start_date'=>'date','end_date'=>'date','closed_at'=>'datetime'];} public function periods(){return $this->hasMany(AccountingPeriod::class);} public function closingJournal(){return $this->belongsTo(Journal::class,'closing_journal_id');}}
