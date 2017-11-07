<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Datatables;
use Yajra\DataTables\Html\Builder;
use Illuminate\Support\Str;
use App\Models\User as User;
use App\Models\Role as Role;
use App\Models\Profile as Profile;
use PDF, Session, Validator, Mail;
use App\Mail\VerifyEmail;

class UserController extends Controller
{
    public function __construct()
    {
      $this->middleware('web');
    }

    // GENERATE PASSWORD //
    protected function code_booking($length)
    {
      $char = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
      $str = "";
      for ($i=1; $i <= $length; $i++) {
        $pos = rand(0, strlen($char)-1);
        $str .= $char{$pos};
      }
      return $str;
    }

    // DAFTAR AKUN PENGGUNA //
    public function index(Request $request, Builder $htmlBuilder)
    {
      if($request->ajax()) {
        $users = DB::table('users')
                 ->leftjoin('profiles','profiles.id','=','users.id')
                 ->join('role_user','users.id','=','role_user.user_id')
                 ->join('roles','roles.id','=','role_user.role_id')
                 ->select('users.id as num', 'users.email','users.name',
                          'users.status','roles.display_name as level',
                          'profiles.place_of_birth','profiles.date_of_birth',
                          'profiles.sex', 'profiles.religion', 'profiles.status_marriage',
                          'profiles.citizen', 'profiles.address', 'profiles.univercity',
                          'profiles.grade', 'profiles.ipk', 'profiles.graduation');
        return DataTables::of($users)
          ->addColumn('action', function($users) {
            return view('backend.layouts.action', [
              'model' => $users,
              'edit_url' => route('users.edit',$users->num),
              'detail_url' => route('users.show',$users->num),
              'del_url' => route('users.destroy',$users->num)
            ]);
          })->make(true);

      }
      $html = $htmlBuilder
              ->addColumn(['data' => 'name', 'name' => 'name', 'title' => 'Nama'])
              ->addColumn(['data' => 'level', 'name' => 'level', 'title' => 'Level'])
              ->addColumn(['data' => 'status', 'name' => 'status', 'title' => 'Status'])
              ->addColumn(['data' => 'action', 'name' => 'action', 'title' => 'Action', 'orderable' => false, 'searchable' => false]);
      return view('backend.admin.users.index')->with(compact('html'));
    }

    // FORM TAMBAH AKUN PENGGUNA //
    public function create()
    {
        $role = DB::table('roles')->get();
        return view('backend.admin.users.create',compact('role'));
    }

    // SIMPAN DATA AKUN PENGGUNA //
    public function store(Request $request)
    {
        $validator = Validator::make(request()->all(), [
          'name' => 'required|string|max:191',
          'email' => 'required|string|email|max:191|unique:users',
          'level' => 'required'
        ]);
        if ($validator->fails()) {
          Session::flash("flash_notification", [
            "level"   => "danger",
            "message" => "Please.. field is required",
          ]);
          return redirect()->back()->withErrors($validator->errors());
        }
        $user = User::create([
          'name'        => $request->name,
          'email'       => $request->email,
          'password'    => bcrypt($this->code_booking(8)),
          'verifyToken' => Str::random(40)
        ]);
        $role = Role::where('name',$request->level)->first();
        $user->attachRole($role);
        $profil = Profile::create([
          'user_id' => $user->id
        ]);
        Session::flash("flash_notification", [
          "level"   => "success",
          "message" => "Akun Pengguna Telah Ditambahkan. Silahkan Melakukan Verifikasi Email Untuk Aktivasi"
        ]);
        if(!$user->save()) {
          abort(500);
        }
        $thisUser = User::findOrfail($user->id);
        $this->sendEmail($thisUser);
        return redirect()->route('users.index');
    }

    // KIRIM EMAIL KE AKUN PENGGUNA BARU //
    public function sendEmail($thisUser)
    {
      Mail::to($thisUser['email'])->send(new VerifyEmail($thisUser));
    }

    // SET PASSWORD BARU //
    public function verifikasi($email, $verifyToken)
    {
        $user = User::where(['email' => $email, 'verifyToken' => $verifyToken])->first();
        if($user == null) {
          Session::flash("flash_notification", [
            "level"   => "danger",
            "message" => "Sorry ! Your account link has expired !!"
          ]);
          return redirect()->route('login');
        } else {
          return view('auth.setPassword',compact('user'));
        }
    }

    // SIMPAN PASSWORD BARU DARI AKUN PENGGUNA BARU //
    public function save(Request $request, $email, $verifyToken)
    {
      $users = User::where(['email' => $email, 'verifyToken' => $verifyToken])->first();
      if ($users) {
        $validator = Validator::make(request()->all(), [
          'password' => 'required|string|min:8|confirmed',
          'password_confirmation' => 'required|string|min:8|same:password'
        ]);
        if ($validator->fails()) {
          Session::flash("flash_notification", [
            "level"   => "danger",
            "message" => "Password Does not match",
          ]);
          return redirect()->back()->withErrors($validator->errors());
        }
        $users = User::where(['email' => $email, 'verifyToken' => $verifyToken])
                 ->update([
                   'password' => bcrypt($request->password),
                   'status' => 'Activated',
                   'verifyToken' => NULL
                 ]);
        Session::flash("flash_notification", [
          "level"   => "success",
          "message" => "Congratulations, Your Account is Active !"
        ]);
        return redirect()->route('login');
      } else {
        Session::flash("flash_notification", [
          "level"   => "danger",
          "message" => "Sorry, Your Account Can't be Verified !"
        ]);
        return redirect()->route('verifikasi');
      }
    }

    // DETAIL AKUN PENGGUNA //
    public function show($id)
    {
      $users = DB::table('users')
               ->leftjoin('profiles','profiles.user_id','=','users.id')
               ->join('role_user','users.id','=','role_user.user_id')
               ->join('roles','roles.id','=','role_user.role_id')
               ->select('users.id as num', 'users.email','users.name',
                        'users.status','roles.display_name as level',
                        'profiles.place_of_birth','profiles.date_of_birth',
                        'profiles.sex', 'profiles.religion', 'profiles.status_marriage',
                        'profiles.citizen', 'profiles.address', 'profiles.telephone','profiles.univercity',
                        'profiles.grade', 'profiles.ipk', 'profiles.graduation')
               ->where('users.id','=',$id)->first();
      return view('backend.admin.users.show', compact('users'));
    }

    // FORM EDIT AKUN PENGGUNA //
    public function edit($id)
    {
      $users = DB::table('users')
               ->leftjoin('profiles','profiles.user_id','=','users.id')
               ->join('role_user','users.id','=','role_user.user_id')
               ->join('roles','roles.id','=','role_user.role_id')
               ->select('users.id as num', 'users.email','users.name',
                        'users.status','roles.display_name as level',
                        'profiles.place_of_birth','profiles.date_of_birth',
                        'profiles.sex', 'profiles.religion', 'profiles.status_marriage',
                        'profiles.citizen', 'profiles.address', 'profiles.telephone','profiles.univercity',
                        'profiles.grade', 'profiles.ipk', 'profiles.graduation')
               ->where('users.id','=',$id)->first();
      return view('backend.admin.users.edit', compact('users'));
    }

    // UPDATE AKUN PENGGUNA //
    public function update(Request $request, $id)
    {
      $validator = Validator::make(request()->all(), [
        'name' => 'required|string|max:191', 'email' => 'required|string|email|max:191|unique:users',
        'place_of_birth' => 'required|string|max:191', 'date_of_birth' => 'required', 'sex' => 'required',
        'religion' => 'required', 'status_marriage' => 'required', 'citizen' => 'required', 'address' => 'required',
        'telephone' => 'required', 'univercity' => 'required|max:191', 'grade' => 'required',
        'ipk' => 'required|max:3', 'graduation' => 'required', 'status' => 'required', 'level' => 'required'
      ]);
      if ($validator->fails()) {
        Session::flash("flash_notification", [
          "level"   => "danger",
          "message" => "Please.. field is required",
        ]);
        redirect()->back()->withErrors($validator->errors());
      }

      $users = User::find($id);
      $profil = Profile::where('user_id',$id)->first();
      $users->update([
        'name'   => $request->name,
        'email'  => $request->email,
        'status' => $request->status
      ]);
      $role = Role::where('name',$request->level)->first();
      if (!$role === $request->level) {
        $users->attachRole($role);
      }
      $profil->update([
        'place_of_birth' => $request->place_of_birth,
        'date_of_birth' => $request->date_of_birth,
        'sex' => $request->sex,
        'religion' => $request->religion,
        'status_marriage' => $request->status_marriage,
        'citizen' => $request->citizen,
        'address' => $request->address,
        'telephone' => $request->telephone,
        'univercity' => $request->univercity,
        'grade' => $request->grade,
        'ipk' => $request->ipk,
        'graduation' => $request->graduation
      ]);
      Session::flash("flash_notification", [
        "level"   => "success",
        "message" => "Akun Pengguna Telah Dirubah."
      ]);
      return redirect()->route('users.index');
    }

    // HAPUS AKUN PENGGUNA //
    public function destroy($id)
    {
        $users = User::destroy($id);
        Session::flash("flash_notification", [
          "level"   => "success",
          "message" => "Akun Pengguna Berhasil Dihapus"
        ]);
        return redirect()->route('users.index');
    }
}
