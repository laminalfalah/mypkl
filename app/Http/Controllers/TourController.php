<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Datatables;
use Yajra\DataTables\Html\Builder;
use App\Models\User as User;
use App\Models\Tour as Tour;
use App\Models\Slideshows;
use App\Models\BookingTour as Pemesanan;
use App\Models\RequestTour as MintaTour;
use Session, Validator, Mail, Auth;

class TourController extends Controller
{

    public function __construct()
    {
      $this->middleware('web');
    }

    // CARI PAKET TOUR //
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
      $day    = date('d', strtotime('now'));
      $month  = $request->month;
      $year   = $request->year;
      $tgl = [
        $request->year,$request->month,$day
      ];
      $join = implode('-',$tgl);
      $date = date('Y-m-d', strtotime($join));
      $search = DB::table('users')
                ->join('tours','tours.user_id','=','users.id')
                ->select('users.id as num','users.name','tours.*')
                ->where('post_status','Publish')
                ->where('category',$tipe)
                ->where('start_period','<=',$date)
                ->where('end_period','>=',$date)
                ->orderBy('created_at','desc')->orderBy('updated_at','desc')
                ->get();
      return view('frontend.tour.search', compact('tipe','month','year','search'));
    }

    // Beranda Tour //
    public function beranda()
    {
      $domestik       = DB::table('users')
                        ->join('tours','tours.user_id','=','users.id')
                        ->select('users.id as num', 'users.name','tours.*')
                        ->where('post_status','Publish')->where('category', 'Domestik')
                        ->orderBy('created_at','desc')->orderBy('updated_at','desc')
                        ->paginate(25);
      $internasional  = DB::table('users')
                        ->join('tours','tours.user_id','=','users.id')
                        ->select('users.id as num', 'users.name', 'tours.*')
                        ->where('post_status','Publish')->where('category', 'Internasional')
                        ->orderBy('created_at','desc')->orderBy('updated_at','desc')
                        ->paginate(25);
      $slide = DB::table('slideshows')->where('post_status','=','Publish')->limit(6)->get();
      return view('frontend.tour.index',compact('domestik','internasional','slide'));
    }

    // LIHAT DETAIL PAKET TOUR //
    public function lihat_paket($slug)
    {
      $tampil = DB::table('users')
                ->join('tours','tours.user_id','=','users.id')
                ->select('users.id as num', 'users.name', 'tours.*')
                ->where('tours.slug','=',$slug)
                ->first();
      return view('frontend.tour.view',compact('tampil'));
    }

    // DAFTAR PAKET TOUR //
    public function index(Request $request, Builder $htmlBuilder)
    {
      if ($request->ajax()) {
        if (Auth::user()->hasRole('admin')) {
          $tours = DB::table('tours')
                   ->join('users','tours.user_id','=','users.id')
                   ->select('users.id as num', 'users.name','tours.*')
                   ->orderBy('created_at','desc');
          return DataTables::of($tours)
            ->addColumn('action', function($tours){
              return view('backend.layouts.action', [
                'model' => $tours,
                'edit_url' => route('tour.edit',$tours->id),
                'detail_url' => route('tour.show',$tours->id),
                'del_url' => route('tour.destroy',$tours->id)
              ]);
            })
            ->make(true);
        } elseif (Auth::user()->hasRole('operator')) {
          $tours = DB::table('tours')
                   ->join('users','tours.user_id','=','users.id')
                   ->join('role_user','users.id', '=' ,'role_user.user_id')
                   ->join('roles','roles.id', '=', 'role_user.role_id')
                   ->select('users.id as num', 'users.name','tours.*','roles.name as level')
                   ->where('roles.name','=','Company')->orWhere('roles.name','=','Operator')
                   ->orderBy('created_at','desc');
          return DataTables::of($tours)
            ->addColumn('action', function($tours){
              return view('backend.layouts.action', [
                'model' => $tours,
                'edit_url' => route('operator.tour.edit',$tours->id),
                'detail_url' => route('operator.tour.show',$tours->id),
                'del_url' => route('operator.tour.destroy',$tours->id)
              ]);
            })
            ->make(true);
        } else {
          $tours = DB::table('users')
                   ->join('tours','tours.user_id','=','users.id')
                   ->select('users.id as num', 'users.name','tours.*')
                   ->where('users.name','=',Auth::user()->name)
                   ->orderBy('created_at','desc');
          return DataTables::of($tours)
            ->addColumn('action', function($tours){
              return view('backend.layouts.action', [
                'model' => $tours,
                'edit_url' => route('company.tour.edit',$tours->id),
                'detail_url' => route('company.tour.show',$tours->id),
                'del_url' => route('company.tour.destroy',$tours->id)
              ]);
            })
            ->make(true);
        }
      }
      $html = $htmlBuilder
              ->addColumn(['data' => 'title', 'name' => 'title', 'title' => 'Nama Paket'])
              ->addColumn(['data' => 'name', 'name' => 'name', 'title' => 'Author','searchable' => false])
              ->addColumn(['data' => 'category', 'name' => 'category', 'title' => 'Kategori','searchable' => false])
              ->addColumn(['data' => 'post_status', 'name' => 'post_status', 'title' => 'Status','searchable' => false])
              ->addColumn(['data' => 'action', 'name' => 'action', 'title' => 'Action', 'orderable' => false, 'searchable' => false]);
      return view('backend.tour.index')->with(compact('html'));
    }

    // FORM TAMBAH PAKET TOUR //
    public function create()
    {
        return view('backend.tour.create');
    }

    // SIMPAN PAKET TOUR //
    public function store(Request $request)
    {
        $validator = Validator::make(request()->all(), [
          'title'      => 'required', 'category'         => 'required',
          'fupload'    => 'required', 'status'           => 'required',
          'duration'   => 'required', 'start_period'     => 'required',
          'end_period' => 'required', 'price'            => 'required',
          'itinerary'  => 'required', 'terms_conditions' => 'required',
        ]);
        if($validator->fails()) {
          redirect()->back()->withErrors($validator->errors());
        }
        if($request->fupload === null) { $img = '/photos/no-image.jpg'; } else { $img = $request->fupload; }
        $user = User::where('email',Auth::user()->email)->first();
        $start  = date("Y-m-01", strtotime($request->start_period));
        $end    = date("Y-m-d", strtotime($request->end_period));
        $tours = Tour::create([
          'user_id'          => $user->id,
          'title'            => $request->title,
          'slug'             => str_slug($request->title, '-'),
          'category'         => $request->category,
          'images'           => $img,
          'post_status'      => $request->post_status,
          'duration'         => $request->duration,
          'start_period'     => $start,
          'end_period'       => $end,
          'price'            => $request->price,
          'itinerary'        => $request->itinerary,
          'terms_conditions' => $request->terms_conditions
        ]);
        Session::flash("flash_notification", [
          "level"   => "success",
          "message" => "Paket Tour Berhasil Disimpan"
        ]);
        if (Auth::user()->hasRole('admin')) {
          return redirect()->route('tour.index');
        } elseif (Auth::user()->hasRole('operator')) {
          return redirect()->route('operator.tour.index');
        } else {
          return redirect()->route('company.tour.index');
        }
    }

    // DETAIL PAKET TOUR //
    public function show($id)
    {
        $tour = DB::table('users')
                ->join('tours','tours.user_id','=','users.id')
                ->select('users.id as num', 'users.name','tours.*')
                ->where('tours.id','=',$id)
                ->first();
        return view('backend.tour.show', compact('tour'));
    }

    // FORM EDIT PAKET TOUR //
    public function edit($id)
    {
        $tour = DB::table('users')
              ->join('tours','tours.user_id','=','users.id')
              ->select('users.id as num', 'users.name','tours.*')
              ->where('tours.id','=',$id)
              ->first();
        return view('backend.tour.edit', compact('tour'));
    }

    // UBAH PAKET TOUR //
    public function update(Request $request, $id)
    {
      $validator = Validator::make(request()->all(), [
        'title'      => 'required', 'category'         => 'required',
        'images'     => 'required', 'status'           => 'required',
        'duration'   => 'required', 'start_period'     => 'required',
        'end_period' => 'required', 'price'            => 'required',
        'itinerary'  => 'required', 'terms_conditions' => 'required',
      ]);
      if($validator->fails()) {
        redirect()->back()->withErrors($validator->errors());
      }
      $user = User::where('email',Auth::user()->email)->first();
      $start  = date("Y-m-01", strtotime($request->start_period));
      $end    = date("Y-m-d", strtotime($request->end_period));
      $tours = Tour::find($id);
      $tours->update([
        'user_id'          => $user->id,
        'title'            => $request->title,
        'slug'             => str_slug($request->title, '-'),
        'category'         => $request->category,
        'images'           => $request->images,
        'post_status'      => $request->post_status,
        'duration'         => $request->duration,
        'start_period'     => $start,
        'end_period'       => $end,
        'price'            => $request->price,
        'itinerary'        => $request->itinerary,
        'terms_conditions' => $request->terms_conditions,
      ]);
      Session::flash("flash_notification", [
        "level"   => "success",
        "message" => "Paket Tour Berhasil Dirubah"
      ]);
      if (Auth::user()->hasRole('admin')) {
        return redirect()->route('tour.index');
      } elseif (Auth::user()->hasRole('operator')) {
        return redirect()->route('operator.tour.index');
      } else {
        return redirect()->route('company.tour.index');
      }
    }

    // HAPUS PAKET TOUR //
    public function destroy($id)
    {
        $tour = Tour::destroy($id);
        Session::flash("flash_notification", [
          "level"   => "success",
          "message" => "Paket Tour Berhasil Dihapus"
        ]);
        if(Auth::user()->hasRole('admin')) {
          return redirect()->route('tour.index');
        } elseif (Auth::user()->hasRole('operator')) {
          return redirect()->route('operator.tour.index');
        } else {
          return redirect()->route('company.tour.index');
        }
    }
}
