<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Tour as Tour;
use App\Models\Umroh as Umroh;
use App\Models\RequestTour as Minta_Tour;
use App\Models\BookingTour as PemesananTour;
use App\Models\BookingUmroh as PemesananUmroh;
use App\Models\Article as Artikel;
use App\Models\User as User;
use App\Models\Profile as Profile;
use Auth, Validator, Session;

class AdminController extends Controller
{
  public function __construct()
  {
    $this->middleware(['auth','role:admin']);
  }

  // DASHBOARD ADMIN //
  public function index()
  {
    $tours    = Tour::all();
    $umrohs   = Umroh::all();
    $blog     = Artikel::all();
    $users    = User::where('status','=','Activated')->get();
    $users1   = User::where('status','=','Pending')->get();
    $users2   = User::where('status','=','Blocked')->get();
    $Rtours   = Minta_Tour::where('status','=','Pending')->get();
    $Ptours   = PemesananTour::where('status','=','Pending')->get();
    $Pumrohs  = PemesananUmroh::where('status','=','Pending')->get();
    $Ptours1  = PemesananTour::all();
    $Pumrohs1 = PemesananUmroh::all();
    return view('backend.admin.dashboard',compact('profil','tours','umrohs','blog','users','users1','users2','Rtours','Ptours','Pumrohs','Ptours1','Pumrohs1'));
  }

  // DASHBOARD PROFILE ADMIN //
  public function profil()
  {
    $profil = DB::table('profiles')
              ->join('users','users.id', '=', 'profiles.user_id')
              ->select('users.id','users.name','profiles.*')
              ->where('users.email','=',Auth::user()->email)
              ->first();
    return view('backend.admin.profile',compact('profil'));
  }

  public function file_manager()
  {
    return view('backend.admin.file');
  }

  public function photos_manager()
  {
    return view('backend.admin.photos');
  }

}
