<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User as User;
use Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
      $this->middleware(['auth','role:company']);
    }

    public function index()
    {
      return view('backend.company.dashboard');
    }

    public function profil()
    {
      $profil = DB::table('profiles')
                ->join('users','users.id', '=', 'profiles.user_id')
                ->select('users.id','users.name','profiles.*')
                ->where('users.email','=',Auth::user()->email)
                ->first();
      return view('backend.company.profile',compact('profil'));
    }

}
