<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Datatables;
use Yajra\DataTables\Html\Builder;
use App\Models\Role;
use Session,Validator;
class RoleController extends Controller
{
    public function __construct()
    {
      $this->middleware(['auth','role:admin']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Builder $htmlBuilder)
    {
      if ($request->ajax()) {
        $role = Role::select('id','name', 'display_name', 'description');
        return DataTables::of($role)
          ->addColumn('action', function($role){
            return view('backend.layouts.actionrole', [
              'model' => $role,
              'edit_url' => route('role.edit',$role->id),
              'del_url' => route('role.destroy',$role->id)
            ]);
          })
          ->make(true);
      }
      $html = $htmlBuilder
              ->addColumn(['data' => 'name', 'name' => 'name', 'title' => 'Level'])
              ->addColumn(['data' => 'display_name', 'name' => 'display_name', 'title' => 'Nama Tampilan'])
              ->addColumn(['data' => 'description', 'name' => 'description', 'title' => 'Deskripsi'])
              ->addColumn(['data' => 'action', 'name' => 'action', 'title' => 'Action', 'orderable' => false, 'searchable' => false]);
      return view('backend.admin.role.index')->with(compact('html'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.admin.role.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $validator = Validator::make(request()->all(), [
        'name' => 'required|string|unique:roles,name|min:2|max:30',
        'display_name' => 'required|min:2|max:30',
        'description' => 'required|min:2|max:100'
      ]);
      if($validator->fails()) {
        Session::flash("flash_notification", [
          "level"   => "danger",
          "message" => "Please.. field is required",
        ]);
        return redirect()->back()->withErrors($validator->errors());
      }
      Role::create([
        'name' => strtolower($request->name),
        'display_name' => $request->display_name,
        'description' => $request->description
      ]);
      Session::flash("flash_notification", [
        "level"   => "success",
        "message" => "Role Berhasil Ditambahkan"
      ]);
      return redirect()->route('role.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::findOrfail($id);
        return view('backend.admin.role.edit',compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $validator = Validator::make(request()->all(), [
        'name' => 'required|string|unique|max:30',
        'display_name' => 'required|max:30',
        'description' => 'required|max:100'
      ]);
      if($validator->fails()) {
        Session::flash("flash_notification", [
          "level"   => "danger",
          "message" => "Please.. field is required",
        ]);
        return redirect()->back()->withErrors($validator->errors());
      }
      $role = Role::findOrfail($id);
      $role->update([
        'name' => strtolower($request->name),
        'display_name' => $request->display_name,
        'description' => $request->description
      ]);
      Session::flash("flash_notification", [
        "level"   => "success",
        "message" => "Role Berhasil Dirubah"
      ]);
      return redirect()->route('role.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $role = Role::findOrfail($id);
      if ($role === 1) {
        Session::flash("flash_notification", [
          "level"   => "warning",
          "message" => "Role Admin Tidak Boleh Dihapus"
        ]);
        return redirect()->route('role.index');
      } else {
        Role::destroy($id);
        Session::flash("flash_notification", [
          "level"   => "success",
          "message" => "Role Berhasil DiHapus"
        ]);
        return redirect()->route('role.index');
      }
    }
}
