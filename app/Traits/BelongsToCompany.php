<?php
namespace App\Traits;
use Illuminate\Database\Eloquent\Builder;
trait BelongsToCompany {
 protected static function bootBelongsToCompany(): void {
  static::creating(function($model){ if(!$model->company_id && auth()->check()) $model->company_id=auth()->user()->company_id; });
 }
 public function scopeForCompany(Builder $q, int $companyId): Builder { return $q->where($this->qualifyColumn('company_id'),$companyId); }
 public function resolveRouteBindingQuery($query,$value,$field=null){
  $q=parent::resolveRouteBindingQuery($query,$value,$field);
  if(auth()->check()) $q->where($this->qualifyColumn('company_id'),auth()->user()->company_id);
  else $q->whereRaw('1=0');
  return $q;
 }
}