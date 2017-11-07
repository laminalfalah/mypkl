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

class OperatorController extends Controller
{
    public function __construct()
    {
      $this->middleware(['auth','role:operator']);
    }

    // DASHBOARD OPERATOR //
    public function index()
    {
      $tours    = Tour::all();
      $umrohs   = Umroh::all();
      $blog     = Artikel::all();
      $Rtours   = Minta_Tour::where('status','=','Pending')->get();
      $Ptours   = PemesananTour::where('status','=','Pending')->get();
      $Pumrohs  = PemesananUmroh::where('status','=','Pending')->get();
      $Ptours1  = PemesananTour::all();
      $Pumrohs1 = PemesananUmroh::all();
      return view('backend.operator.dashboard',compact('profil','tours','umrohs','blog','Rtours','Ptours','Pumrohs','Ptours1','Pumrohs1'));
    }

    public function profil()
    {
      $profil = DB::table('profiles')
                ->join('users','users.id', '=', 'profiles.user_id')
                ->select('users.id','users.name','profiles.*')
                ->where('users.email','=',Auth::user()->email)
                ->first();
      return view('backend.operator.profile',compact('profil'));
    }
}
