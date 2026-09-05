<?php
namespace App\Models; use Illuminate\Database\Eloquent\Model; use App\Traits\BelongsToCompany;
class Sequence extends Model {use BelongsToCompany; protected $guarded=[];}
