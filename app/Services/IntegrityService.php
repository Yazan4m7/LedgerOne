<?php
namespace App\Services;
use App\Models\{Journal,JournalLine,Account};
use App\Support\Decimal;
class IntegrityService {public function check(?int $companyId=null):array{$errors=[];$q=Journal::query()->whereIn('status',['posted','reversed'])->with('lines');if($companyId)$q->where('company_id',$companyId);foreach($q->cursor() as $j){$d='0.000';$c='0.000';if($j->lines->count()<2)$errors[]="Journal {$j->id} has fewer than two lines";foreach($j->lines as $l){$d=Decimal::add($d,$l->debit);$c=Decimal::add($c,$l->credit);$a=Account::find($l->account_id);if(!$a||$a->company_id!==$j->company_id)$errors[]="Journal {$j->id} contains a cross-company/orphan account";if((Decimal::cmp($l->debit,'0')>0)===(Decimal::cmp($l->credit,'0')>0))$errors[]="Journal {$j->id} contains an invalid line {$l->id}";}if(Decimal::cmp($d,$c)!==0)$errors[]="Journal {$j->id} is unbalanced";}return $errors;}}
