<?php
namespace App\Models; use Illuminate\Database\Eloquent\Model; use App\Traits\BelongsToCompany;
class Payment extends Model {use BelongsToCompany; protected $guarded=[]; protected function casts():array{return ['payment_date'=>'date','void_date'=>'date','voided_at'=>'datetime'];} public function allocations(){return $this->hasMany(PaymentAllocation::class);} public function journal(){return $this->belongsTo(Journal::class);} public function contact(){return $this->belongsTo(Contact::class);}}
