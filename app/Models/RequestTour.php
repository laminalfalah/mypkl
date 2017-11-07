<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestTour extends Model
{

  protected $table = "request_tours";

  protected $fillable = [
    'code_booking', 'name', 'email', 'telephone', 'location', 'duration', 'note', 'status', 'reason_rejection'
  ];

}
