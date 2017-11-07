<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Datatables;
use Yajra\DataTables\Html\Builder;
use App\Models\User as User;
use App\Models\Umroh as Umroh;
use App\Models\BookingUmroh as Pemesanan;
use Session, Validator, Mail, Auth;
use App\Mail\PemesananUmrohPelanggan;
use App\Mail\PemesananUmrohDiTerima;
use App\Mail\PemesananUmrohDiTolak;

class BookingUmrohController extends Controller
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
    Mail::to($thisUser['email'])->send(new PemesananUmrohPelanggan($thisUser));
  }

  public function sendEMailPemesananTerima($thisUser)
  {
    Mail::to($thisUser['email'])->send(new PemesananUmrohDiTerima($thisUser));
  }

  public function sendMailPemesananTolak($User)
  {
    Mail::to($User['email'])->send(new PemesananUmrohDiTolak($User));
  }

  // FORM DETAIL PEMESANAN PAKET UMROH //
  public function form_pesan($slug)
  {
    $month = [
      '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April', '05' => 'Mei', '06' => 'Juni',
      '07' => 'Juli','08' => 'Agustus', '09' => 'September','10' => 'Oktober','11' => 'November','12' => 'Desember'
    ];
    $umroh = Umroh::where('slug',$slug)->first();
    return view('frontend.umroh.pesan', compact('month','umroh'));
  }

  // KIRIM DETAIL PEMESANAN PAKET UMROH //
  public function sendForm_pesan(Request $request)
  {
    $validator = Validator::make(request()->all(), [
      'name'        => 'required|string|max:30',
      'email'       => 'required|email|max:100',
      'telephone'   => 'required|min:7|max:15',
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
    $pack = Umroh::where('title',$request->package)->first();
    $pemesanan = Pemesanan::create([
      'code_booking'   => $this->code_booking(6),
      'package_id'     => $pack->id,
      'name'           => $request->name,
      'email'          => $request->email,
      'telephone'      => $request->telephone,
      'price'          => $request->price,
      'participant'    => $request->participant,
      'total'          => $request->price * $request->participant,
    ]);
    Session::flash("flash_notification", [
      "level"   => "success",
      "message" => "Pemesanan umroh telah dikirim. Kami akan memproses pemesanan dalam kurun waktu 24 - 48 Jam. Silahkan cek email anda."
    ]);
    $thisUser = Pemesanan::findOrfail($pemesanan->id);
    $this->sendEMailPemesanan($thisUser);
    $User = User::findOrfail($user->id);
    Mail::send('email.pemesanan.pemesananumrohPerusahaan', [
      'user'      => $User->name,
      'code_booking' => $thisUser->code_booking,
      'package_id'     => $request->get('package'),
      'name'           => $request->get('name'),
      'email'          => $request->get('email'),
      'telephone'      => $request->get('telephone'),
      'price'          => $request->get('price'),
      'participant'    => $request->get('participant'),
      'total'          => $request->get('price') * $request->get('participant')
      ], function ($message){
        $user = DB::table('users')
                ->join('role_user','users.id', '=' ,'role_user.user_id')
                ->join('roles','roles.id', '=', 'role_user.role_id')
                ->select('users.id', 'users.name', 'users.email')
                ->where('roles.name','=','operator')
                ->first();
        $message->to($user->email,'Operator')->subject('Notifikasi Pemesanan Umroh');
    });
    return view('frontend.umroh.sendPemesanan');
  }

  // DAFTAR PEMESANAN UMROH //
  public function beranda_pemesanan(Request $request, Builder $htmlBuilder)
  {
    if ($request->ajax()) {
      if (Auth::user()->hasRole('admin')) {
        $pemesanans = DB::table('umrohs')
                      ->join('booking_umrohs','package_id','=','umrohs.id')
                      ->select('umrohs.title','booking_umrohs.*')
                      ->orderBy('created_at','desc');
        return DataTables::of($pemesanans)
          ->addColumn('action', function($pemesanans){
            return view('backend.layouts.action', [
              'model' => $pemesanans,
              'edit_url' => route('umroh.pemesanan.edit',$pemesanans->id),
              'detail_url' => route('umroh.pemesanan.show',$pemesanans->id),
              'del_url' => route('umroh.pemesanan.destroy',$pemesanans->id)
            ]);
          })
          ->make(true);
      } elseif (Auth::user()->hasRole('operator')) {
        $pemesanans = DB::table('umrohs')
                      ->join('booking_umrohs','package_id','=','umrohs.id')
                      ->select('umrohs.title','booking_umrohs.*')
                      ->orderBy('created_at','desc');
        return DataTables::of($pemesanans)
          ->addColumn('action', function($pemesanans){
            return view('backend.layouts.action', [
              'model' => $pemesanans,
              'edit_url' => route('operator.umroh.pemesanan.edit',$pemesanans->id),
              'detail_url' => route('operator.umroh.pemesanan.show',$pemesanans->id),
              'del_url' => route('operator.umroh.pemesanan.destroy',$pemesanans->id)
            ]);
          })
          ->make(true);
      } else {
        $pemesanans = DB::table('umrohs')
                      ->join('booking_umrohs','package_id','=','umrohs.id')
                      ->select('umrohs.title','booking_umrohs.*')
                      ->orderBy('created_at','desc');
        return DataTables::of($pemesanans)
          ->addColumn('action', function($pemesanans){
            return view('backend.layouts.actioncompany', [
              'model' => $pemesanans,
              'detail_url' => route('company.umroh.pemesanan.show',$pemesanans->id)
            ]);
          })
          ->make(true);
      }
    }
    $html = $htmlBuilder
            ->addColumn(['data' => 'code_booking', 'name' => 'code_booking', 'title' => 'Kode Booking'])
            ->addColumn(['data' => 'name', 'name' => 'name', 'title' => 'Nama Pemesan'])
            ->addColumn(['data' => 'email', 'name' => 'email', 'title' => 'Email'])
            ->addColumn(['data' => 'telephone', 'name' => 'telephone', 'title' => 'Telepon'])
            ->addColumn(['data' => 'title', 'name' => 'title', 'title' => 'Paket Umroh'])
            ->addColumn(['data' => 'status', 'name' => 'status', 'title' => 'Status', 'searchable' => false])
            ->addColumn(['data' => 'action', 'name' => 'action', 'title' => 'Action', 'orderable' => false, 'searchable' => false]);
    return view('backend.pemesanan_umroh.pemesanan')->with(compact('html'));
  }

  // DETAIL PEMESANAN UMROH //
  public function show_pemesanan($id)
  {
    $pemesanan = DB::table('umrohs')
                 ->join('booking_umrohs','package_id','=','umrohs.id')
                 ->select('umrohs.title','booking_umrohs.*')
                 ->where('booking_umrohs.id','=',$id)
                 ->first();
    $jumlah = $pemesanan->price * $pemesanan->participant;
    return view('backend.pemesanan_umroh.pemesananshow',compact('pemesanan','jumlah'));
  }

  // EDIT PEMESANAN UMROH //
  public function edit_pemesanan($id)
  {
    $pemesanans = DB::table('umrohs')
                 ->join('booking_umrohs','package_id','=','umrohs.id')
                 ->select('umrohs.title','booking_umrohs.*')
                 ->where('booking_umrohs.id','=',$id)
                 ->first();
    return view('backend.pemesanan_umroh.pemesananedit',compact('pemesanans'));
  }

  // UPDATE PEMESANAN UMROH //
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
        "message" => "<i class='fa fa-check'></i>&nbsp;Status Pemesanan Umroh Diterima"
      ]);
      $thisUser = Pemesanan::findOrfail($pemesanans->id);
      $this->sendEMailPemesananTerima($thisUser);
      if (Auth::user()->hasRole('admin')) {
        return redirect()->route('umroh.pemesanan');
      } else {
        return redirect()->route('operator.umroh.pemesanan');
      }
    } elseif($request->status === "Rejected"){
      $thisUser = Pemesanan::findOrfail($pemesanans->id);
      $this->sendMailPemesananTolak($thisUser);
      if (Auth::user()->hasRole('admin')) {
        Session::flash("flash_notification", [
          "level"   => "warning",
          "message" => "<i class='fa fa-warning'></i>&nbsp;Status Pemesanan Ditolak"
        ]);
        return redirect()->route('umroh.pemesanan');
      } elseif (Auth::user()->hasRole('operator')) {
        Session::flash("flash_notification", [
          "level"   => "warning",
          "message" => "<i class='fa fa-warning'></i>&nbsp;Status Pemesanan Ditolak"
        ]);
        return redirect()->route('operator.umroh.pemesanan');
      }
    } else {
      Session::flash("flash_notification", [
        "level"   => "info",
        "message" => "<i class='fa fa-info'></i>&nbsp;Tidak Ada Perubahan"
      ]);
      if (Auth::user()->hasRole('admin')) {
        return redirect()->route('umroh.pemesanan');
      } else {
        return redirect()->route('operator.umroh.pemesanan');
      }
    }
  }

  // HAPUS PEMESANAN UMROH //
  public function destroy_pemesanan($id)
  {
    $pemesanan = Pemesanan::destroy($id);
    Session::flash("flash_notification", [
      "level"   => "success",
      "message" => "Data Pemesanan Berhasil Dihapus"
    ]);
    if (Auth::user()->hasRole('admin')) {
      return redirect()->route('umroh.pemesanan');
    } else {
      return redirect()->route('operator.umroh.pemesanan');
    }
  }
}
