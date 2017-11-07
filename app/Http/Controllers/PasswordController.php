<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User as User;
use Auth, Hash, Validator, Session;

class PasswordController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function index()
    {
      return view('auth.changepassword');
    }

    public function update(Request $request)
    {
      $validator = Validator::make(request()->all(), [
        'old' => 'required',
        'password' => 'required|string|min:8|confirmed',
        'password_confirmation' => 'required|string|min:8|same:password'
      ]);
      if ($validator->fails()) {
        Session::flash("flash_notification", [
          "level"   => "warning",
          "message" => "Password Tidak Sama !!!"
        ]);
        return redirect()->back()->withErrors($validator);
      }
      $user = User::find(Auth::id());
      $hashedPassword = $user->password;

      if (Hash::check($request->old, $hashedPassword)) {
        $user->update([
          'password' => Hash::make($request->password)
        ]);
        Session::flash("flash_notification", [
          "level"   => "success",
          "message" => "Password Sukses Dirubah."
        ]);
        return redirect()->back();
      } else {
        Session::flash("flash_notification", [
          "level"   => "danger",
          "message" => "Password Tidak Sesuai Dengan Password Lama Anda !!!"
        ]);
        return redirect()->back();
      }
    }
}
