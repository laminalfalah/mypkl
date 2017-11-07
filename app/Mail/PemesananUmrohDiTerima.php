<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;
use App\Models\BookingUmroh as Pemesanan;
use App\Models\Umroh as Umroh;

class PemesananUmrohDiTerima extends Mailable
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
      $pemesanan = DB::table('umrohs')->select('umrohs.title','booking_umrohs.*')
                   ->join('booking_umrohs','package_id','=','umrohs.id')
                   ->where('booking_umrohs.id','=',$pemesanan->id)->first();
      $this->pemesanan = $pemesanan;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Pemesanan Umroh Diterima')->view('email.pemesanan.pemesananumrohterima');
    }
}
