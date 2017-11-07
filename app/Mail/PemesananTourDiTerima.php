<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;
use App\Models\BookingTour as Pemesanan;
use App\Models\Tour as Tour;

class PemesananTourDiTerima extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
     public $pemesanan;
     public function __construct(Pemesanan $pemesanan)
     {
       $pemesanan = DB::table('tours')->select('tours.title','booking_tours.*')
                    ->join('booking_tours','package_id','=','tours.id')
                    ->where('booking_tours.id','=',$pemesanan->id)->first();
       $this->pemesanan = $pemesanan;
     }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Pemesanan Tour Diterima')->view('email.pemesanan.pemesanantourterima');
    }
}
