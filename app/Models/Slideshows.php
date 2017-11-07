<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slideshows extends Model
{
    protected $table = "slideshows";

    protected $fillable = [
      'slug', 'images', 'post_status'
    ];
}
