<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = "articles";

    protected $fillable = [
      'user_id', 'title', 'slug', 'post_status', 'images', 'description'
    ];

    public function getUser()
    {
      return $this->belongsTo(User::class);
    }
}
