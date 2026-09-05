<?php
namespace App\Models; use Illuminate\Database\Eloquent\Model;
class PurchaseBillLine extends Model {protected $guarded=[]; public function bill(){return $this->belongsTo(PurchaseBill::class,'purchase_bill_id');}}
