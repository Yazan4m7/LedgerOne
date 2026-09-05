<?php
namespace App\Models; use Illuminate\Database\Eloquent\Model; use App\Traits\BelongsToCompany;
class Account extends Model {use BelongsToCompany; protected $guarded=[]; protected function casts():array{return ['is_postable'=>'boolean','active'=>'boolean'];} public function parent(){return $this->belongsTo(self::class,'parent_id');} public function children(){return $this->hasMany(self::class,'parent_id');} public function lines(){return $this->hasMany(JournalLine::class);} }
