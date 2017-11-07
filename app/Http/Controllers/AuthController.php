<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\User;
use App\Models\Role;
use DB, Session;

class AuthController extends Controller
{
  use AuthenticatesUsers;

  public function __construct()
  {
    $this->middleware('guest')->except('logout');
  }

  public function showLoginForm() {
    return view('auth.login');
  }

  public function login(Request $request) {
    $this->validate($request, [
      'email' => 'required|email|exists:users,email',
      'password' => 'required|min:8',
    ]);

    $attempts = [
      'email' => $request->email,
      'password' => $request->password,
      'status' => 'Activated',
    ];
    // CHECK STATUS, IF TRUE CAN LOGIN.
    if (Auth::attempt($attempts, (bool) $request->remember)) {
      $users = DB::table('users')
                    ->join('role_user','users.id', '=' ,'role_user.user_id')
                    ->join('roles','roles.id', '=', 'role_user.role_id')
                    ->select('roles.name','users.status')
                    ->where('users.email','=', $request->email)
                    ->get();
      // REDIRECT PAGE WITH ROLE
      foreach ($users as $list) {
        if ($list->name === "admin") {
          // Dashboard Admin
          return redirect()->intended('/dashboard/admin');
        } elseif ($list->name === "operator") {
          // Dashboard Direktur // Dashboard Manager // Dashboard Staff
          return redirect()->intended('/dashboard/operator');
        } elseif ($list->name === "company") {
          // Dashboard Direktur // Dashboard Manager // Dashboard Staff
          return redirect()->intended('/dashboard/company');
        } else {
          Session::flash("flash_notification", [
            "level" => "danger",
            "message" => "Access Forbidden"
          ]);
          return redirect()->intended('/login');
        }
      }
      // END REDIRECT PAGE WITH ROLE
    } else {
      $cek = DB::table('users')
             ->join('role_user','users.id', '=' ,'role_user.user_id')
             ->join('roles','roles.id', '=', 'role_user.role_id')
             ->select('roles.name','users.status')
             ->where('users.email','=', $request->email)
             ->get();
      // CHECK LOGIN, IF ROLE TRUE OR STATUS TRUE BUT PASSWORD WRONG
      foreach ($cek as $k) {
        $sts = $k->status;
        if ($sts == "Activated") {
          Session::flash("flash_notification", [
            "level" => "danger",
            "message" => "Email or Password is Wrong !"
          ]);
          return redirect()->intended('/login');
        } elseif ($sts == "Blocked") {
          Session::flash("flash_notification", [
            "level" => "danger",
            "message" => "Account Blocked. Call Us Administrator for Active Your Account !"
          ]);
          return redirect()->intended('/login');
        } else {
          Session::flash("flash_notification", [
            "level" => "warning",
            "message" => "Please.. Verification Your Email !"
          ]);
          return redirect()->intended('/login');
        }
      }
      // END CHECK LOGIN
    }
    Session::flash("flash_notification", [
      "level" => "danger",
      "message" => "Access Forbidden"
    ]);
    return redirect()->intended('/login');
  }

  /**
   * Get the needed authorization credentials from the request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array
   */
  protected function credentials(Request $request)
  {
      return ['email' => $request->{$this->username()}, 'password' => $request->password, 'status' => 'Activated'];
  }

  public function logout(Request $request)
  {
      $this->guard()->logout();

      $request->session()->invalidate();

      return redirect('/');
  }

  /**
   * Get the guard to be used during authentication.
   *
   * @return \Illuminate\Contracts\Auth\StatefulGuard
   */
  protected function guard()
  {
      return Auth::guard();
  }
}
