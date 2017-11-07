<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Tour;

class BookingTour extends Model
{
  protected $table = 'booking_tours';

  protected $fillable = [
    'package_id', 'code_booking', 'name', 'email', 'telephone', 'price', 'participant', 'departure_date', 'note', 'total', 'status', 'reason_rejection'
  ];

  public function tour()
  {
    return $this->hasOne(Tour::class);
  }
}
