<?php
namespace App\Models; use Illuminate\Database\Eloquent\Model; use App\Traits\BelongsToCompany;
class FxRevaluationItem extends Model {use BelongsToCompany; protected $guarded=[]; protected function casts():array{return ['revaluation_date'=>'date'];} public function journal(){return $this->belongsTo(Journal::class);} public function revaluable(){return $this->morphTo();}}
