<?php
namespace App\Models; use Illuminate\Database\Eloquent\Model; use App\Traits\BelongsToCompany;
class CompanyIntegration extends Model {use BelongsToCompany; protected $guarded=[]; protected function casts():array{return ['enabled'=>'boolean'];}}
