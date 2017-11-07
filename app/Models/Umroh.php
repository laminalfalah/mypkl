<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Umroh extends Model
{
  protected $table = "umrohs";

  protected $fillable = [
    'user_id', 'title', 'slug', 'category', 'images', 'post_status', 'duration', 'start_period', 'end_period', 'price', 'itinerary', 'terms_conditions'
  ];
}
