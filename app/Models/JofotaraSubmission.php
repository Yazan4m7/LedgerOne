<?php
namespace App\Models; use Illuminate\Database\Eloquent\Model; use App\Traits\BelongsToCompany;
class JofotaraSubmission extends Model {use BelongsToCompany; protected $guarded=[]; protected function casts():array{return ['submitted_at'=>'datetime'];}}
