<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = "profiles";

    public $timestamps = false;

    protected $fillable = [
      'user_id', 'place_of_birth', 'date_of_birth', 'sex', 'religion', 'status_marriage', 'citizen', 'address', 'telephone', 'univercity', 'grade', 'ipk', 'graduation'
    ];

    public function get_user()
    {
      return $this->hasOne(User::class);
    }
}
