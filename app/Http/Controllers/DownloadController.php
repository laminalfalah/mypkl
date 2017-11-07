<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Datatables;
use Yajra\DataTables\Html\Builder;
use App\Models\Tour as Tour;
use App\Models\Umroh as Umroh;
use App\Models\BookingTour as PemesananTour;
use App\Models\BookingUmroh as PemesananUmroh;
use App\Models\RequestTour as MintaTour;
use App\Models\User as User;
use PDF;

class DownloadController extends Controller
{
  public function __construct()
  {
    $this->middleware('web');
  }

  // Download Paket Tour //
  public function downloadPaketTour($slug)
  {
    $tour = DB::table('users')
            ->join('tours','tours.user_id','=','users.id')
            ->select('users.id as num', 'users.name','tours.*')
            ->where('tours.slug','=',$slug)
            ->first();
    $pdf  = PDF::loadView('backend.tour.pdf',compact('tour'))
            ->setPaper('a4','Potrait')->save('files/'.$tour->title.'-'.date('d-F-Y').'.pdf');
    return $pdf->download($tour->title.'-'.date('d-F-Y').'.pdf');
  }

  // Download Pemesanan Tour //
  public function downloadPemesananTour($id)
  {
    $Ptour = DB::table('tours')
             ->join('booking_tours','package_id','=','tours.id')
             ->select('tours.title','booking_tours.*')
             ->where('booking_tours.id','=',$id)
             ->first();
    $jumlah = $Ptour->price * $Ptour->participant;
    $pdf   = PDF::loadView('backend.pemesanan_tour.pemesananpdf', compact('Ptour','jumlah'))
             ->setPaper('a4','Potrait')->save('files/'.$Ptour->name.'-'.$Ptour->title.'-'.date('d-F-Y').'.pdf');
    return $pdf->download($Ptour->name.'-'.$Ptour->title.'-'.date('d-F-Y').'.pdf');
  }

  // Download Permintaan Tour //
  public function downloadPermintaanTour($id)
  {
    $Rtour = MintaTour::find($id);
    $pdf   = PDF::loadView('backend.request_tour.permintaanpdf',compact('Rtour'))
           ->setPaper('a4','Potrait')->save('files/'.$Rtour->name.'-'.$Rtour->location.'-'.date('d-F-Y').'.pdf');
    return $pdf->download($Rtour->name.'-'.$Rtour->location.'-'.date('d-F-Y').'.pdf');
  }

  // DOWNLOAD PAKET UMROH //
  public function downloadPaketUmroh($slug)
  {
    $umroh = DB::table('users')
             ->join('umrohs','umrohs.user_id','=','users.id')
             ->select('users.id as num','users.name', 'umrohs.*')
             ->where('umrohs.slug','=',$slug)
             ->first();
    $pdf   = PDF::loadView('backend.umroh.pdf',compact('umroh'))
             ->setPaper('a4','Potrait')->save('files/'.$umroh->title.'-'.date('d-F-Y').'.pdf');

    return $pdf->download($umroh->title.'-'.date('d-F-Y').'.pdf');
  }

  // DOWNLOAD PEMESANAN TOUR //
  public function downloadPemesananUmroh($id)
  {
    $Pumroh = DB::table('umrohs')
             ->join('booking_umrohs','package_id','=','umrohs.id')
             ->select('umrohs.title','booking_umrohs.*')
             ->where('booking_umrohs.id','=',$id)
             ->first();
    $jumlah = $Pumroh->participant * $Pumroh->price;
    $pdf   = PDF::loadView('backend.pemesanan_umroh.pemesananpdf',compact('Pumroh','jumlah'))
             ->setPaper('a4','Potrait')->save('files/'.$Pumroh->name.'-'.$Pumroh->title.'-'.date('d-F-Y').'.pdf');
    return $pdf->download($Pumroh->name.'-'.$Pumroh->title.'-'.date('d-F-Y').'.pdf');
  }
}
