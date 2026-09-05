<?php
namespace App\Models; use Illuminate\Database\Eloquent\Model; use Illuminate\Database\Eloquent\SoftDeletes; use App\Traits\BelongsToCompany;
class Contact extends Model {use BelongsToCompany,SoftDeletes; protected $guarded=[]; protected function casts():array{return ['active'=>'boolean'];} public function receivableAccount(){return $this->belongsTo(Account::class,'receivable_account_id');} public function payableAccount(){return $this->belongsTo(Account::class,'payable_account_id');}}
