<?php
namespace App\Models; use Illuminate\Database\Eloquent\Model; use App\Traits\BelongsToCompany;
class AuditLog extends Model {use BelongsToCompany; public $timestamps=true; protected $guarded=[]; protected function casts():array{return ['before'=>'array','after'=>'array'];} public function user(){return $this->belongsTo(User::class);}}
