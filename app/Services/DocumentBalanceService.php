<?php
namespace App\Services;
use App\Models\{SalesInvoice,PurchaseBill,PaymentAllocation,FxRevaluationItem};
use App\Support\Decimal;
use Illuminate\Support\Facades\DB;
class DocumentBalanceService {
 public function sales(SalesInvoice $invoice,string $asOf):array{return $this->balance($invoice,$asOf,'sales');}
 public function purchase(PurchaseBill $bill,string $asOf):array{return $this->balance($bill,$asOf,'purchase');}
 private function balance(object $doc,string $asOf,string $kind):array{
  $isSales=$kind==='sales'; $creditClass=$isSales?SalesInvoice::class:PurchaseBill::class; $dateCol=$isSales?'invoice_date':'bill_date'; $creditFk=$isSales?'credit_of_invoice_id':'credit_of_bill_id';
  $credits=$creditClass::where('company_id',$doc->company_id)->where($creditFk,$doc->id)->where('status','posted')->whereDate($dateCol,'<=',$asOf)->get();
  $creditForeign='0.000';$creditBase='0.000';foreach($credits as $c){$creditForeign=Decimal::add($creditForeign,$c->total);$creditBase=Decimal::add($creditBase,$c->base_total);}
  $allocs=PaymentAllocation::query()->where('allocatable_type',get_class($doc))->where('allocatable_id',$doc->id)->whereHas('payment',function($q)use($asOf){$q->whereDate('payment_date','<=',$asOf)->where(function($q)use($asOf){$q->where('status','posted')->orWhere(function($q)use($asOf){$q->where('status','voided')->whereDate('void_date','>',$asOf);});});})->get();
  $paidForeign='0.000';$paidBase='0.000';foreach($allocs as $a){$paidForeign=Decimal::add($paidForeign,$a->amount);$paidBase=Decimal::add($paidBase,$a->base_amount);}
  $reval='0.000';$items=FxRevaluationItem::where('company_id',$doc->company_id)->where('revaluable_type',get_class($doc))->where('revaluable_id',$doc->id)->whereDate('revaluation_date','<=',$asOf)->get();foreach($items as $i)$reval=Decimal::add($reval,$i->carrying_adjustment);
  return ['foreign'=>Decimal::sub(Decimal::sub($doc->total,$creditForeign),$paidForeign),'base'=>Decimal::add(Decimal::sub(Decimal::sub($doc->base_total,$creditBase),$paidBase),$reval)];
 }
}