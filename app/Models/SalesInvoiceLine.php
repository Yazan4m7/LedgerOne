<?php
namespace App\Models; use Illuminate\Database\Eloquent\Model;
class SalesInvoiceLine extends Model {protected $guarded=[]; public function invoice(){return $this->belongsTo(SalesInvoice::class,'sales_invoice_id');}}
