<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Masukkan Model Detail Pemesanan dan Transaksi
use App\Models\User;
use App\Models\Role;
use App\Models\Slideshows;
use Session, Validator, Auth;
use Illuminate\Support\Facades\DB;

class BerandaController extends Controller
{

    public function __construct()
    {
      $this->middleware('web');
    }

    public function index()
    {
      $slide = Slideshows::where('post_status','=','Publish')->limit(6)->get();
      $month = [
        '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April', '05' => 'Mei', '06' => 'Juni',
        '07' => 'Juli','08' => 'Agustus', '09' => 'September','10' => 'Oktober','11' => 'November','12' => 'Desember'
      ];
      return view('frontend.beranda', compact('month','slide'));
    }

    public function tiket()
    {
      $slide = Slideshows::where('post_status','=','Publish')->limit(6)->get();
      return view('frontend.tiket.index',compact('slide'));
    }

    public function hotel()
    {
      $slide = Slideshows::where('post_status','=','Publish')->limit(6)->get();
      return view('frontend.hotel.index',compact('slide'));
    }

    public function car_rental()
    {
      $slide = Slideshows::where('post_status','=','Publish')->limit(6)->get();
      return view('frontend.mobil.index',compact('slide'));
    }

    public function form_cek()
    {
      return view('frontend.check');
    }

    public function post_cek(Request $request)
    {
      $validator = Validator::make(request()->all(), [
        'email' => 'required|email|min:5|max:100',
        'code_booking' => 'required|min:6|max:6'
      ]);
      if($validator->fails())
      {
        Session::flash("flash_notification", [
          "level"   => "danger",
          "message" => "Please... field is required",
        ]);
        return redirect()->route('form.cek');
      }
      if ($request->tipe === "request_tours") {
        $sql = DB::table('request_tours')
               ->select('location as title','request_tours.*')
               ->where('code_booking','=',$request->code_booking)
               ->where('email','=',$request->email)
               ->first();
        return view('frontend.hasilcheck',compact('sql'));
      } elseif ($request->tipe === "booking_tours") {
        $sql = DB::table('tours')
               ->select('tours.title','booking_tours.*')
               ->join('booking_tours','booking_tours.package_id','=','tours.id')
               ->where('code_booking','=',$request->code_booking)
               ->where('email','=',$request->email)
               ->first();
        return view('frontend.hasilcheck',compact('sql'));
      } elseif ($request->tipe === "booking_umrohs") {
        $sql = DB::table('umrohs')
               ->select('umrohs.title','booking_umrohs.*')
               ->join('booking_umrohs','booking_umrohs.package_id','=','umrohs.id')
               ->where('code_booking','=',$request->code_booking)
               ->where('email','=',$request->email)
               ->first();
        return view('frontend.hasilcheck',compact('sql'));
      } else {
        Session::flash("flash_notification", [
          "level"   => "danger",
          "message" => "Please... choose tipe booking",
        ]);
        return redirect()->route('form.cek');
      }
    }

    public function carapemesanan()
    {
      return view('frontend.carapemesanan');
    }

    public function aboutus()
    {
      return view('frontend.aboutus');
    }

    public function contactus()
    {
      return view('frontend.contactus');
    }

}
