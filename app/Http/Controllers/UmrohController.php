<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Datatables;
use Yajra\DataTables\Html\Builder;
use App\Models\User as User;
use App\Models\Umroh as Umroh;
use App\Models\Slideshows;
use App\Models\BookingUmroh as Pemesanan;
use PDF, Session, Validator, Mail, Auth;
use App\Mail\PemesananUmrohPelanggan;
use App\Mail\PemesananUmrohDiTerima;
use App\Mail\PemesananUmrohDiTolak;

class UmrohController extends Controller
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

    // CARI PAKET UMROH //
    public function cari(Request $request)
    {
      $validator = Validator::make(request()->all(), [
        'package' => 'required',
        'month'   => 'required',
        'year'    => 'required'
      ]);
      if($validator->fails()) {
        return redirect()->back()->withErrors($validator->errors());
      }
      $tipe   = $request->package;
      $day    = date('d',strtotime('now'));
      $month  = $request->month;
      $year   = $request->year;
      $tgl = [
        $request->year,$request->month,$day
      ];
      $join = implode('-',$tgl);
      $date = date('Y-m-d', strtotime($join));
      $search = DB::table('users')
                ->join('umrohs','umrohs.user_id','=','users.id')
                ->select('users.id as num','users.name','umrohs.*')
                ->where('post_status','Publish')
                ->where('category',$tipe)
                ->where('start_period','<=',$date)
                ->where('end_period','>=',$date)
                ->orderBy('created_at','desc')->orderBy('updated_at','desc')
                ->get();
      return view('frontend.umroh.search',compact('tipe','month','year','search'));
    }

    // BERANDA UMROH //
    public function beranda()
    {
      $umroh = DB::table('users')
               ->join('umrohs','umrohs.user_id','=','users.id')
               ->select('users.id as num','users.name','umrohs.*')
               ->where('post_status','Publish')
               ->orderBy('created_at','desc')->orderBy('updated_at','desc')
               ->paginate(15);
      $slide = DB::table('slideshows')->where('post_status','=','Publish')->limit(6)->get();
      return view('frontend.umroh.index',compact('umroh','slide'));
    }

    // LIHAT DETAIL PAKET UMROH //
    public function lihat_paket($slug)
    {
      $tampil = DB::table('users')
               ->join('umrohs','umrohs.user_id','=','users.id')
               ->select('users.id as num','users.name','umrohs.*')
               ->where('umrohs.slug','=',$slug)
               ->first();
      return view('frontend.umroh.view', compact('tampil'));
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

    // DAFTAR PAKET UMROH //
    public function index(Request $request, Builder $htmlBuilder)
    {
        if($request->ajax()) {
          if (Auth::user()->hasRole('admin')) {
            $umroh = DB::table('users')
                     ->join('umrohs','umrohs.user_id','=','users.id')
                     ->select('users.id as num','users.name','umrohs.*')
                     ->orderBy('created_at','desc');
            return DataTables::of($umroh)
            ->addColumn('action', function($umroh) {
              return view('backend.layouts.action', [
                'model' => $umroh,
                'edit_url' => route('umroh.edit',$umroh->id),
                'detail_url' => route('umroh.show',$umroh->id),
                'del_url' => route('umroh.destroy',$umroh->id)
              ]);
            })
            ->make(true);
          } elseif (Auth::user()->hasRole('operator')) {
            $umroh = DB::table('umrohs')
                     ->join('users','umrohs.user_id','=','users.id')
                     ->join('role_user','users.id', '=' ,'role_user.user_id')
                     ->join('roles','roles.id', '=', 'role_user.role_id')
                     ->select('users.id as num', 'users.name','umrohs.*','roles.name as level')
                     ->where('roles.name','=','Company')->orWhere('roles.name','=','Operator')
                     ->orderBy('created_at','desc');
            return DataTables::of($umroh)
              ->addColumn('action', function($umroh){
                return view('backend.layouts.action', [
                  'model' => $umroh,
                  'edit_url' => route('operator.umroh.edit',$umroh->id),
                  'detail_url' => route('operator.umroh.show',$umroh->id),
                  'del_url' => route('operator.umroh.destroy',$umroh->id)
                ]);
              })
              ->make(true);
          } else {
            $umroh = DB::table('users')
                     ->join('umrohs','umrohs.user_id','=','users.id')
                     ->select('users.id as num','users.name','umrohs.*')
                     ->where('users.name','=',Auth::user()->name)
                     ->orderBy('created_at','desc');
            return DataTables::of($umroh)
            ->addColumn('action', function($umroh) {
              return view('backend.layouts.action', [
                'model' => $umroh,
                'edit_url' => route('company.umroh.edit',$umroh->id),
                'detail_url' => route('company.umroh.show',$umroh->id),
                'del_url' => route('company.umroh.destroy',$umroh->id)
              ]);
            })
            ->make(true);
          }
        }
        $html = $htmlBuilder
                ->addColumn(['data' => 'title', 'name' => 'title', 'title' => 'Nama Paket'])
                ->addColumn(['data' => 'name', 'name' => 'name', 'title' => 'Author', 'searchable' => false])
                ->addColumn(['data' => 'category', 'name' => 'package', 'title' => 'Kategori', 'searchable' => false])
                ->addColumn(['data' => 'post_status', 'name' => 'post_status', 'title' => 'Status', 'searchable' => false])
                ->addColumn(['data' => 'action', 'name' => 'action', 'title' => 'Action', 'orderable' => false, 'searchable' => false]);
        return view('backend.umroh.index')->with(compact('html'));
    }

    // FORM TAMBAH PAKET UMROH //
    public function create()
    {
        return view('backend.umroh.create');
    }

    // SIMPAN DATA PAKET UMROH //
    public function store(Request $request)
    {
        $validator = Validator::make(request()->all(), [
          'title'      => 'required|max:255', 'category'      => 'required',
          'fupload'    => 'required', 'status' => 'required',
          'duration'   => 'required', 'start_period'          => 'required|date',
          'end_period' => 'required|date', 'price'            => 'required|max:13',
          'itinerary'  => 'required', 'terms_conditions'      => 'required',
        ]);
        if($validator->fails()) {
          return redirect()->back()->withErrors($validator->errors());
        }
        $user = User::where('email',Auth::user()->email)->first();
        $start  = date("Y-m-01", strtotime($request->start_period));
        $end    = date("Y-m-d", strtotime($request->end_period));
        $umrohs = Umroh::create([
          'user_id'          => $user->id,
          'title'            => $request->title,
          'slug'             => str_slug($request->title, '-'),
          'category'         => $request->category,
          'images'           => $request->fupload,
          'status'           => $request->status,
          'duration'         => $request->duration,
          'start_period'     => $start,
          'end_period'       => $end,
          'price'            => $request->price,
          'itinerary'        => $request->itinerary,
          'terms_conditions' => $request->terms_conditions,
        ]);
        Session::flash("flash_notification", [
          "level"   => "success",
          "message" => "Paket Umroh Berhasil Disimpan"
        ]);
        if (Auth::user()->hasRole('admin')) {
          return redirect()->route('umroh.index');
        } elseif (Auth::user()->hasRole('operator')) {
          return redirect()->route('operator.umroh.index');
        } else {
          return redirect()->route('company.umroh.index');
        }
    }

    // DETAIL PAKET UMROH //
    public function show($id)
    {
        $umroh = DB::table('users')
                 ->join('umrohs','umrohs.user_id','=','users.id')
                 ->select('users.id as num','users.name','umrohs.*')
                 ->where('umrohs.id','=',$id)
                 ->first();
        return view('backend.umroh.show',compact('umroh'));
    }

    // FORM EDIT PAKET UMROH //
    public function edit($id)
    {
        $umroh = DB::table('users')
                 ->join('umrohs','umrohs.user_id','=','users.id')
                 ->select('users.id as num','users.name','umrohs.*')
                 ->where('umrohs.id','=',$id)
                 ->first();
        return view('backend.umroh.edit', compact('umroh'));
    }

    // UBAH PAKET UMROH //
    public function update(Request $request, $id)
    {
      $validator = Validator::make(request()->all(), [
        'title'      => 'required|max:255', 'category'      => 'required',
        'images'     => 'required', 'status' => 'required',
        'duration'   => 'required', 'start_period'          => 'required|date',
        'end_period' => 'required|date', 'price'            => 'required|numeric|max:13',
        'itinerary'  => 'required', 'terms_conditions'      => 'required',
      ]);
      if($validator->fails()) {
        redirect()->back()->withErrors($validator->errors());
      }
      $user = User::where('email',Auth::user()->email)->first();
      $start  = date("Y-m-01", strtotime($request->start_period));
      $end    = date("Y-m-d", strtotime($request->end_period));
      $umrohs = Umroh::find($id);
      $umrohs->update([
        'user_id'          => $user->id,
        'title'            => $request->title,
        'slug'             => str_slug($request->title, '-'),
        'category'         => $request->category,
        'images'           => $request->images,
        'status'           => $request->status,
        'duration'         => $request->duration,
        'start_period'     => $start,
        'end_period'       => $end,
        'price'            => $request->price,
        'itinerary'        => $request->itinerary,
        'terms_conditions' => $request->terms_conditions,
      ]);
      Session::flash("flash_notification", [
        "level"   => "success",
        "message" => "Paket Umroh Berhasil Dirubah"
      ]);
      if (Auth::user()->hasRole('admin')) {
        return redirect()->route('umroh.index');
      } elseif (Auth::user()->hasRole('operator')) {
        return redirect()->route('operator.umroh.index');
      } else {
        return redirect()->route('company.umroh.index');
      }
    }

    // HAPUS PAKET UMROH //
    public function destroy($id)
    {
        $umroh = Umroh::destroy($id);
        Session::flash("flash_notification", [
          "level"   => "success",
          "message" => "Paket Umroh Berhasil Dihapus"
        ]);
        if (Auth::user()->hasRole('admin')) {
          return redirect()->route('umroh.index');
        } elseif (Auth::user()->hasRole('operator')) {
          return redirect()->route('operator.umroh.index');
        } else {
          return redirect()->route('company.umroh.index');
        }
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
      return view('backend.umroh.pemesanan')->with(compact('html'));
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
      return view('backend.umroh.pemesananshow',compact('pemesanan','jumlah'));
    }

    // EDIT PEMESANAN UMROH //
    public function edit_pemesanan($id)
    {
      $pemesanans = DB::table('umrohs')
                   ->join('booking_umrohs','package_id','=','umrohs.id')
                   ->select('umrohs.title','booking_umrohs.*')
                   ->where('booking_umrohs.id','=',$id)
                   ->first();
      return view('backend.umroh.pemesananedit',compact('pemesanans'));
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

    // DOWNLOAD PAKET UMROH //
    public function downloadPaket($slug)
    {
      $umroh = DB::table('users')
               ->join('umrohs','umrohs.user_id','=','users.id')
               ->select('users.id as num','users.name', 'umrohs.*')
               ->where('umrohs.slug','=',$slug)
               ->first();
      $pdf   = PDF::loadView('backend.admin.umroh.pdf',compact('umroh'))
               ->setPaper('a4','Potrait')->save('files/'.$umroh->title.'-'.date('d-F-Y').'.pdf');

      return $pdf->download($umroh->title.'-'.date('d-F-Y').'.pdf');
    }

    // DOWNLOAD PEMESANAN TOUR //
    public function downloadPemesanan($id)
    {
      $Pumroh = DB::table('umrohs')
               ->join('booking_umrohs','package_id','=','umrohs.id')
               ->select('umrohs.title','booking_umrohs.*')
               ->where('booking_umrohs.id','=',$id)
               ->first();
      $jumlah = $Pumroh->participant * $Pumroh->price;
      $pdf   = PDF::loadView('backend.admin.umroh.pemesananpdf',compact('Pumroh','jumlah'))
               ->setPaper('a4','Potrait')->save('files/'.$Pumroh->name.'-'.$Pumroh->title.'-'.date('d-F-Y').'.pdf');
      return $pdf->download($Pumroh->name.'-'.$Pumroh->title.'-'.date('d-F-Y').'.pdf');
    }
}
