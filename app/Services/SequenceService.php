<?php
namespace App\Services;
use App\Models\Sequence;
use Illuminate\Support\Facades\DB;
final class SequenceService {
 public function next(int $companyId,string $key,string $prefix=''): string {return DB::transaction(function()use($companyId,$key,$prefix){$s=Sequence::where('company_id',$companyId)->where('key',$key)->lockForUpdate()->first(); if(!$s){try{$s=Sequence::create(['company_id'=>$companyId,'key'=>$key,'next_value'=>1]);}catch(\Throwable){$s=Sequence::where('company_id',$companyId)->where('key',$key)->lockForUpdate()->firstOrFail();}} $n=$s->next_value; $s->next_value=$n+1; $s->save(); return $prefix.str_pad((string)$n,6,'0',STR_PAD_LEFT);},5);}
}