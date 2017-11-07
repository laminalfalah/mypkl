<?php

namespace App\Models;

use Eloquent;
use App\Models\User;
use App\Models\Role;
use App\Models\Profile;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Eloquent implements Authenticatable, CanResetPasswordContract
{
  use Notifiable, CanResetPassword, AuthenticableTrait;
  //use SoftDeletes { restore as private restoreB; }
  use EntrustUserTrait { restore as private restoreA; }

  public function restore()
  {
    $this->restoreA();
    //$this->restoreB();
  }
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */

  protected $table = 'users';

  protected $fillable = [
      'name', 'email', 'password', 'verifyToken', 'status'
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
      'password', 'remember_token',
  ];

  public function profile()
  {
    return $this->hasMany(Profile::class);
  }

  public function hasSex($jk)
  {
    foreach ($this->profile as $k) {
      if ($k->sex === $jk) return true;
    }
    return false;
  }

  public function role()
  {
    return $this->belongsToMany(Role::class);
  }
}
