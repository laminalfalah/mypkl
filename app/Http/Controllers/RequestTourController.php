<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Datatables;
use Yajra\DataTables\Html\Builder;
use App\Models\RequestTour as MintaTour;
use App\Models\User as User;
use App\Mail\RequestTourPelanggan;
use App\Mail\PermintaanTourDiTerima;
use App\Mail\PermintaanTourDiTolak;
use Session, Validator, Mail, Auth;

class RequestTourController extends Controller
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

    // KIRIM EMAIL KE PEMESAN
    public function sendEMailRequest($thisUser)
    {
      Mail::to($thisUser['email'])->send(new RequestTourPelanggan($thisUser));
    }

    // KIRIM EMAIL KE PEMESANAN DI TERIMA
    public function sendEMailRequestTerima($thisUser)
    {
      Mail::to($thisUser['email'])->send(new PermintaanTourDiTerima($thisUser));
    }

    // KIRIM EMAIL KE PEMESANAN DI TOLAK
    public function sendMailRequestTolak($thisUser)
    {
      Mail::to($thisUser['email'])->send(new PermintaanTourDiTolak($thisUser));
    }

    // FORM REQUEST TOUR //
    public function permintaan()
    {
      return view('frontend.tour.request');
    }

    // KIRIM REQUEST TOUR //
    public function kirim_permintaan(Request $request)
    {
      $validator = Validator::make(request()->all(), [
        'name'      => 'required|string|max:30',
        'email'     => 'required|email|max:50',
        'telephone' => 'required|min:7|max:15',
        'location'  => 'required|string',
        'duration'  => 'required',
        'note'      => 'max:160'
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
      $mintatour = MintaTour::create([
        'code_booking' => $this->code_booking(6),
        'name'      => $request->name,
        'email'     => $request->email,
        'telephone' => $request->telephone,
        'location'  => $request->location,
        'duration'  => $request->duration,
        'note'      => $request->note
      ]);
      Session::flash("flash_notification", [
        "level"   => "success",
        "message" => "Permintaan anda telah dikirim. Silahkan cek email anda"
      ]);
      $thisUser = MintaTour::findOrfail($mintatour->id);
      $this->sendEMailRequest($thisUser);
      $User = User::findOrfail($user->id);
      Mail::send('email.permintaan.permintaantourPerusahaan', [
        'user'      => $User->name,
        'code_booking' => $thisUser->code_booking,
        'name'      => $request->get('name'),
        'email'     => $request->get('email'),
        'telephone' => $request->get('telephone'),
        'location'  => $request->get('location'),
        'duration'  => $request->get('duration'),
        'note'      => $request->get('note')
      ], function ($message){
        $user = DB::table('users')
                ->join('role_user','users.id', '=' ,'role_user.user_id')
                ->join('roles','roles.id', '=', 'role_user.role_id')
                ->select('users.id', 'users.name', 'users.email')
                ->where('roles.name','=','operator')
                ->first();
        $message->to($user->email,'Operator')->subject('Notifikasi Permintaan Tour');
      });
      return redirect()->route('tour.request');
    }

    // DAFTAR PERMINTAAN TOUR //
    public function beranda_permintaan(Request $request, Builder $htmlBuilder)
    {
      if ($request->ajax()) {
        if (Auth::user()->hasRole('admin')) {
          $Rtours = MintaTour::select(['id','code_booking', 'name', 'telephone', 'email', 'status'])->orderBy('created_at','desc');
          return DataTables::of($Rtours)
            ->addColumn('action', function($Rtours){
              return view('backend.layouts.action', [
                'model' => $Rtours,
                'edit_url' => route('tour.permintaan.edit',$Rtours->id),
                'detail_url' => route('tour.permintaan.detail',$Rtours->id),
                'del_url' => route('tour.permintaan.destroy',$Rtours->id)
              ]);
            })
            ->make(true);
        } elseif (Auth::user()->hasRole('operator')) {
          $Rtours = MintaTour::select(['id','code_booking', 'name', 'telephone', 'email', 'status'])->orderBy('created_at','desc');
          return DataTables::of($Rtours)
            ->addColumn('action', function($Rtours){
              return view('backend.layouts.action', [
                'model' => $Rtours,
                'edit_url' => route('operator.tour.permintaan.edit',$Rtours->id),
                'detail_url' => route('operator.tour.permintaan.detail',$Rtours->id),
                'del_url' => route('operator.tour.permintaan.destroy',$Rtours->id)
              ]);
            })
            ->make(true);
        } else {
          $Rtours = MintaTour::select(['id','code_booking', 'name', 'telephone', 'email', 'status'])->orderBy('created_at','desc');
          return DataTables::of($Rtours)
            ->addColumn('action', function($Rtours){
              return view('backend.layouts.actioncompany', [
                'model' => $Rtours,
                'detail_url' => route('company.tour.permintaan.detail',$Rtours->id)
              ]);
            })
            ->make(true);
        }
      }
      $html = $htmlBuilder
              ->addColumn(['data' => 'code_booking', 'name' => 'code_booking', 'title' => 'Kode'])
              ->addColumn(['data' => 'name', 'name' => 'name', 'title' => 'Nama'])
              ->addColumn(['data' => 'telephone', 'name' => 'telephone', 'title' => 'Telepon'])
              ->addColumn(['data' => 'email', 'name' => 'email', 'title' => 'Email'])
              ->addColumn(['data' => 'status', 'name' => 'status', 'title' => 'Status', 'searchable' => false])
              ->addColumn(['data' => 'action', 'name' => 'action', 'title' => 'Action', 'orderable' => false, 'searchable' => false]);
      return view('backend.request_tour.permintaan')->with(compact('html'));
    }

    // DETAIL PERMINTAAN TOUR //
    public function show_permintaan($id)
    {
      $Rtour = MintaTour::find($id);
      return view('backend.request_tour.permintaanshow',compact('Rtour'));
    }

    // EDIT PERMINTAAN TOUR //
    public function edit_permintaan($id)
    {
      $Rtour = MintaTour::find($id);
      return view('backend.request_tour.permintaanedit',compact('Rtour'));
    }

    // UPDATE PERMINTAAN TOUR //
    public function update_permintaan(Request $request, $id)
    {
      $Rtour = MintaTour::find($id);
      $Rtour->update([
        'status' => $request->status,
        'reason_rejection' => $request->reason_rejection
      ]);
      if ($request->status === "Approved"){
        $thisUser = MintaTour::findOrfail($Rtour->id);
        $this->sendEMailRequestTerima($thisUser);
        Session::flash("flash_notification", [
          "level"   => "success",
          "message" => "<i class='fa fa-check'></i>&nbsp;Status Permintaan Diterima"
        ]);
        if (Auth::user()->hasRole('admin')) {
          return redirect()->route('tour.permintaan');
        } elseif (Auth::user()->hasRole('operator')) {
          return redirect()->route('operator.tour.permintaan');
        }
      } elseif ($request->status === "Rejected"){
        $thisUser = MintaTour::findOrfail($Rtour->id);
        $this->sendMailRequestTolak($thisUser);
        if (Auth::user()->hasRole('admin')) {
          Session::flash("flash_notification", [
            "level"   => "warning",
            "message" => "<i class='fa fa-warning'></i>&nbsp;Status Permintaan Ditolak"
          ]);
          return redirect()->route('tour.permintaan');
        } else {
          Session::flash("flash_notification", [
            "level"   => "warning",
            "message" => "<i class='fa fa-warning'></i>&nbsp;Status Permintaan Ditolak"
          ]);
          return redirect()->route('operator.tour.permintaan');
        }
      } else {
        Session::flash("flash_notification", [
          "level"   => "info",
          "message" => "Tidak Ada Perubahan"
        ]);
        if (Auth::user()->hasRole('admin')) {
          return redirect()->route('tour.permintaan');
        } else {
          return redirect()->route('operator.tour.permintaan');
        }
      }
    }

    // HAPUS PERMINTAAN TOUR //
    public function destroy_permintaan($id)
    {
      $Rtour = MintaTour::destroy($id);
      Session::flash("flash_notification", [
        "level"   => "success",
        "message" => "Permintaan Tour Berhasil Dihapus"
      ]);
      if (Auth::user()->hasRole('admin')) {
        return redirect()->route('tour.permintaan');
      } else {
        return redirect()->route('operator.tour.permintaan');
      }
    }
}
