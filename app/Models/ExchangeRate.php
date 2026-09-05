<?php
namespace App\Models; use Illuminate\Database\Eloquent\Model; use App\Traits\BelongsToCompany;
class ExchangeRate extends Model {use BelongsToCompany; protected $guarded=[]; protected function casts():array{return ['rate_date'=>'date'];} public function currency(){return $this->belongsTo(Currency::class);}}
