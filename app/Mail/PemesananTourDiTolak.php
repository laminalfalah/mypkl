<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\BookingTour as Pemesanan;

class PemesananTourDiTolak extends Mailable
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
         $this->pemesanan = $pemesanan;
     }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Pemesanan Tour Ditolak')->view('email.pemesanan.pemesanantourtolak');
    }
}
