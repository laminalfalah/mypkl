<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Datatables;
use Yajra\DataTables\Html\Builder;
use App\Models\User as User;
use App\Models\Tour as Tour;
use App\Models\BookingTour as Pemesanan;
use Session, Validator, Mail, Auth;
use App\Mail\PemesananTourPelanggan;
use App\Mail\PemesananTourDiTerima;
use App\Mail\PemesananTourDiTolak;

class BookingTourController extends Controller
{
    public function __construct()
    {
      $this->middleware('web');
    }

    // GENERATE CODE BOOKING //
    protected function code_booking($length)
    {
      $char = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
      $str = "";
      for ($i=1; $i <= $length; $i++) {
        $pos = rand(0, strlen($char)-1);
        $str .= $char{$pos};
      }
      return $str;
    }

    public function sendEMailPemesanan($thisUser)
    {
      Mail::to($thisUser['email'])->send(new PemesananTourPelanggan($thisUser));
    }

    public function sendEMailPemesananTerima($thisUser)
    {
      Mail::to($thisUser['email'])->send(new PemesananTourDiTerima($thisUser));
    }

    public function sendMailPemesananTolak($User)
    {
      Mail::to($User['email'])->send(new PemesananTourDiTolak($User));
    }

    // FORM DETAIL PEMESANAN PAKET TOUR //
    public function form_pesan($slug)
    {
      $month = [
        '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April', '05' => 'Mei', '06' => 'Juni',
        '07' => 'Juli','08' => 'Agustus', '09' => 'September','10' => 'Oktober','11' => 'November','12' => 'Desember'
      ];
      $tour = Tour::where('slug', $slug)->first();
      return view('frontend.tour.pesan',compact('tour','month'));
    }

    // KIRIM DETAIL PEMESANAN PAKET TOUR //
    public function sendForm_pesan(Request $request)
    {
      $validator = Validator::make(request()->all(), [
        'name'        => 'required|string|max:30',
        'email'       => 'required|email|max:100',
        'telephone'   => 'required|min:7|max:15',
        'days'        => 'required',
        'months'      => 'required',
        'years'       => 'required',
        'participant' => 'required|min:1',
        'note'        => 'max:160'
      ]);
      if($validator->fails()) {
        Session::flash("flash_notification", [
          "level"   => "danger",
          "message" => "Please... field is required",
        ]);
        return redirect()->back()->withErrors($validator->errors());
      }
      $user = DB::table('users')
              ->join('role_user','users.id', '=' ,'role_user.user_id')
              ->join('roles','roles.id', '=', 'role_user.role_id')
              ->select('users.id', 'users.name', 'users.email')
              ->where('roles.name','=','operator')
              ->first();
      $tgl = [
        $request->days, $request->months, $request->years
      ];
      $pack = Tour::where('title',$request->package)->first();
      $join = implode('-',$tgl);
      $date = date('Y-m-d', strtotime($join));
      $pemesanan = Pemesanan::create([
        'code_booking'   => $this->code_booking(6),
        'package_id'     => $pack->id,
        'name'           => $request->name,
        'email'          => $request->email,
        'telephone'      => $request->telephone,
        'price'          => $request->price,
        'participant'    => $request->participant,
        'total'          => $request->price * $request->participant,
        'departure_date' => $date,
        'note'           => $request->note
      ]);
      Session::flash("flash_notification", [
        "level"   => "success",
        "message" => "Pemesanan tour telah dikirim, silahkan cek email anda."
      ]);
      $thisUser = Pemesanan::findOrfail($pemesanan->id);
      $this->sendEMailPemesanan($thisUser);
      $User = User::findOrfail($user->id);
      //$this->sendMailPemesanan($User);
      Mail::send('email.pemesanan.pemesanantourPerusahaan', [
        'user'      => $User->name,
        'code_booking' => $thisUser->code_booking,
        'package_id'     => $request->get('package'),
        'name'           => $request->get('name'),
        'email'          => $request->get('email'),
        'telephone'      => $request->get('telephone'),
        'price'          => $request->get('price'),
        'participant'    => $request->get('participant'),
        'total'          => $request->get('price') * $request->get('participant'),
        'departure_date' => $date,
        'note'           => $request->get('note')
        ], function ($message){
          $user = DB::table('users')
                  ->join('role_user','users.id', '=' ,'role_user.user_id')
                  ->join('roles','roles.id', '=', 'role_user.role_id')
                  ->select('users.id', 'users.name', 'users.email')
                  ->where('roles.name','=','operator')
                  ->first();
          $message->to($user->email,'Operator')->subject('Notifikasi Pemesanan Tour');
      });
      return view('frontend.tour.sendPemesanan');
    }

    // DAFTAR PEMESANAN TOUR //
    public function beranda_pemesanan(Request $request, Builder $htmlBuilder)
    {
      if ($request->ajax()) {
        if (Auth::user()->hasRole('admin')) {
          $pemesanans = DB::table('tours')
                        ->join('booking_tours','package_id','=','tours.id')
                        ->select('tours.title','booking_tours.*')
                        ->orderBy('created_at','desc');
          return DataTables::of($pemesanans)
            ->addColumn('action', function($pemesanans){
              return view('backend.layouts.action', [
                'model' => $pemesanans,
                'edit_url' => route('tour.pemesanan.edit',$pemesanans->id),
                'detail_url' => route('tour.pemesanan.show',$pemesanans->id),
                'del_url' => route('tour.pemesanan.destroy',$pemesanans->id)
              ]);
            })
            ->make(true);
        } elseif (Auth::user()->hasRole('operator')) {
          $pemesanans = DB::table('tours')
                        ->join('booking_tours','package_id','=','tours.id')
                        ->select('tours.title','booking_tours.*')
                        ->orderBy('created_at','desc');
          return DataTables::of($pemesanans)
            ->addColumn('action', function($pemesanans){
              return view('backend.layouts.action', [
                'model' => $pemesanans,
                'edit_url' => route('operator.tour.pemesanan.edit',$pemesanans->id),
                'detail_url' => route('operator.tour.pemesanan.show',$pemesanans->id),
                'del_url' => route('operator.tour.pemesanan.destroy',$pemesanans->id)
              ]);
            })
            ->make(true);
        } else {
          $pemesanans = DB::table('tours')
                        ->join('booking_tours','package_id','=','tours.id')
                        ->select('tours.title','booking_tours.*')
                        ->orderBy('created_at','desc');
          return DataTables::of($pemesanans)
            ->addColumn('action', function($pemesanans){
              return view('backend.layouts.actioncompany', [
                'model' => $pemesanans,
                'detail_url' => route('company.tour.pemesanan.show',$pemesanans->id)
              ]);
            })
            ->make(true);
        }
      }
      $html = $htmlBuilder
              ->addColumn(['data' => 'code_booking', 'name' => 'code_booking', 'title' => 'Kode'])
              ->addColumn(['data' => 'name', 'name' => 'name', 'title' => 'Nama Pemesan'])
              ->addColumn(['data' => 'email', 'name' => 'email', 'title' => 'Email'])
              ->addColumn(['data' => 'telephone', 'name' => 'telephone', 'title' => 'Telepon'])
              ->addColumn(['data' => 'title', 'name' => 'title', 'title' => 'Paket Tour'])
              ->addColumn(['data' => 'status', 'name' => 'status', 'title' => 'Status', 'searchable' => false])
              ->addColumn(['data' => 'action', 'name' => 'action', 'title' => 'Action', 'orderable' => false, 'searchable' => false]);
      return view('backend.pemesanan_tour.pemesanan')->with(compact('html'));
    }

    // DETAIL PEMESANAN TOUR //
    public function show_pemesanan($id)
    {
      $pemesanans = DB::table('tours')
                    ->join('booking_tours','package_id','=','tours.id')
                    ->select('tours.title','booking_tours.*')
                    ->where('booking_tours.id','=',$id)
                    ->first();
      $jumlah = $pemesanans->price * $pemesanans->participant;
      return view('backend.pemesanan_tour.pemesananshow',compact('pemesanans','jumlah'));
    }

    // EDIT PEMESANAN TOUR //
    public function edit_pemesanan($id)
    {
      $pemesanans = DB::table('tours')
                    ->join('booking_tours','package_id','=','tours.id')
                    ->select('tours.title','booking_tours.*')
                    ->where('booking_tours.id','=',$id)
                    ->first();
      return view('backend.pemesanan_tour.pemesananedit',compact('pemesanans'));
    }

    // UPDATE PEMESANAN TOUR //
    public function update_pemesanan(Request $request, $id)
    {
      $pemesanans = Pemesanan::find($id);
      $pemesanans->update([
        'status' => $request->status,
        'reason_rejection' => $request->reason_rejection
      ]);
      if ($request->status === "Approved"){
        Session::flash("flash_notification", [
          "level"   => "success",
          "message" => "<i class='fa fa-check'></i>&nbsp;Status Pemesanan Tour Diterima"
        ]);
        $thisUser = Pemesanan::findOrfail($pemesanans->id);
        $this->sendEMailPemesananTerima($thisUser);
        if (Auth::user()->hasRole('admin')) {
          return redirect()->route('tour.pemesanan');
        } elseif (Auth::user()->hasRole('operator')) {
          return redirect()->route('operator.tour.pemesanan');
        }
      } elseif($request->status === "Rejected"){
        $thisUser = Pemesanan::findOrfail($pemesanans->id);
        $this->sendMailPemesananTolak($thisUser);
        if (Auth::user()->hasRole('admin')) {
          Session::flash("flash_notification", [
            "level"   => "warning",
            "message" => "<i class='fa fa-warning'></i>&nbsp;Status Pemesanan Ditolak"
          ]);
          return redirect()->route('tour.pemesanan');
        } elseif (Auth::user()->hasRole('operator')) {
          Session::flash("flash_notification", [
            "level"   => "warning",
            "message" => "<i class='fa fa-warning'></i>&nbsp;Status Pemesanan Ditolak"
          ]);
          return redirect()->route('operator.tour.pemesanan');
        }
      } else {
        Session::flash("flash_notification", [
          "level"   => "info",
          "message" => "<i class='fa fa-info'></i>&nbsp;Tidak Ada Perubahan"
        ]);
        if (Auth::user()->hasRole('admin')) {
          return redirect()->route('tour.pemesanan');
        } else {
          return redirect()->route('operator.tour.pemesanan');
        }
      }
    }

    // HAPUS PEMESANAN TOUR //
    public function destroy_pemesanan($id)
    {
      $pemesanan = Pemesanan::destroy($id);
      Session::flash("flash_notification", [
        "level"   => "success",
        "message" => "Data Pemesanan Berhasil Dihapus"
      ]);
      if(Auth::user()->hasRole('admin')) {
        return redirect()->route('tour.pemesanan');
      } else {
        return redirect()->route('operator.tour.pemesanan');
      }
    }
}
