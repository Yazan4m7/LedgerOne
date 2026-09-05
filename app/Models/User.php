<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable; use App\Traits\BelongsToCompany;
class User extends Authenticatable {use HasFactory,Notifiable,BelongsToCompany; protected $guarded=[]; protected $hidden=['password','remember_token']; protected function casts():array{return ['email_verified_at'=>'datetime','password'=>'hashed','active'=>'boolean'];} public function company(){return $this->belongsTo(Company::class);} public function roles(){return $this->belongsToMany(Role::class);} public function hasPermission(string $slug):bool{return $this->roles()->whereHas('permissions',fn($q)=>$q->where('slug',$slug))->exists();}}
