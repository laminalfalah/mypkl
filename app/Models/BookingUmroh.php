<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Umroh;

class BookingUmroh extends Model
{
    protected $table = 'booking_umrohs';

    protected $fillable = [
      'package_id', 'code_booking', 'name', 'email', 'telephone', 'package', 'price', 'participant', 'total', 'status', 'reason_rejection'
    ];

    public function get_title()
    {
      return $this->hasOne(Umroh::class);
    }
}
