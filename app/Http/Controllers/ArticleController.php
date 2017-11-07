<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Datatables;
use Yajra\DataTables\Html\Builder;
use App\Models\Article as Blog;
use App\Models\User as User;
use App\Models\Profile as Profile;
use PDF, Session, Validator, Auth;

class ArticleController extends Controller
{
    public function __construct()
    {
      $this->middleware('web');
    }

    // BERANDA ARTIKEL //
    public function beranda()
    {
      $blog = DB::table('users')
              ->join('articles','articles.user_id','=','users.id')
              ->select('users.id as n','users.name','users.email','articles.*')
              ->where('post_status','Publish')
              ->orderBy('created_at','desc')->orderBy('updated_at','desc')->paginate(15);
      return view('frontend.artikel.index', ['blog' => $blog], compact('profil'));
    }

    // LIHAT ARTIKEL //
    public function lihat_artikel($slug)
    {
      $tampil = DB::table('users')
              ->join('articles','articles.user_id','=','users.id')
              ->select('users.id as n','users.name','users.email','articles.*')
              ->where('slug','=',$slug)
              ->first();
      return view('frontend.artikel.view', compact('tampil'));
    }

    // DAFTAR ARTIKEL //
    public function index(Request $request, Builder $htmlBuilder)
    {
      if($request->ajax()) {
        if (Auth::user()->hasRole('admin')) {
          $blog = DB::table('users')
                  ->join('articles','articles.user_id','=','users.id')
                  ->select('users.id as n','users.name','users.email','articles.*')
                  ->orderBy('id','desc');
          return DataTables::of($blog)
          ->addColumn('action', function($blog) {
            return view('backend.layouts.action', [
              'model' => $blog,
              'edit_url' => route('blog.edit',$blog->id),
              'detail_url' => route('blog.show',$blog->id),
              'del_url' => route('blog.destroy',$blog->id)
            ]);
          })
          ->make(true);
        } elseif (Auth::user()->hasRole('operator')) {
          $blog = DB::table('users')
                  ->join('articles','articles.user_id','=','users.id')
                  ->select('users.id as n','users.name','users.email','articles.*')
                  ->where('users.name','=',Auth::user()->name)
                  ->orderBy('id','desc');
          return DataTables::of($blog)
          ->addColumn('action', function($blog) {
            return view('backend.layouts.action', [
              'model' => $blog,
              'edit_url' => route('operator.blog.edit',$blog->id),
              'detail_url' => route('operator.blog.show',$blog->id),
              'del_url' => route('operator.blog.destroy',$blog->id)
            ]);
          })
          ->make(true);
        } else {
          $blog = DB::table('users')
                  ->join('articles','articles.user_id','=','users.id')
                  ->select('users.id as n','users.name','users.email','articles.*')
                  ->where('users.name','=',Auth::user()->name)
                  ->orderBy('id','desc');
          return DataTables::of($blog)
          ->addColumn('action', function($blog) {
            return view('backend.layouts.action', [
              'model' => $blog,
              'edit_url' => route('company.blog.edit',$blog->id),
              'detail_url' => route('company.blog.show',$blog->id),
              'del_url' => route('company.blog.destroy',$blog->id)
            ]);
          })
          ->make(true);
        }
      }
      $html = $htmlBuilder
              ->addColumn(['data' => 'title', 'name' => 'title', 'title' => 'Judul'])
              ->addColumn(['data' => 'post_status', 'name' => 'post_status', 'title' => 'Status'])
              ->addColumn(['data' => 'name', 'name' => 'name', 'title' => 'Author'])
              ->addColumn(['data' => 'action', 'name' => 'action', 'title' => 'Action', 'orderable' => false, 'searchable' => false]);
      return view('backend.blog.index')->with(compact('html'));
    }

    // FORM TAMBAH ARTIKEL //
    public function create()
    {
        return view('backend.blog.create');
    }

    // SIMPAN ARTIKEL //
    public function store(Request $request)
    {
      $validator = Validator::make(request()->all(), [
        'title' => 'required',
        'status' => 'required',
        'fupload' => 'required',
        'description' => 'required'
      ]);
      if($validator->fails()) {
        Session::flash("flash_notification", [
          "level"   => "danger",
          "message" => "Please.. field is required",
        ]);
        redirect()->back()->withErrors($validator->errors());
      }
      $user = User::where('email',Auth::User()->email)->first();
      $blogs = Blog::create([
        'user_id' => $user->id,
        'title' => $request->title,
        'slug' => str_slug($request->title, '-'),
        'author' => $request->author,
        'status' => $request->status,
        'images' => $request->fupload,
        'description' => $request->description
      ]);
      Session::flash("flash_notification", [
        "level" => "success",
        "message" => "Artikel Berhasil Disimpan"
      ]);
      if(Auth::user()->hasRole('admin')) {
        return redirect()->route('blog.index');
      } elseif (Auth::user()->hasRole('operator')) {
        return redirect()->route('operator.blog.index');
      } else {
        return redirect()->route('company.blog.index');
      }
    }

    // LIHAT DETAIL ARTIKEL //
    public function show($id)
    {
      $blog = DB::table('users')
              ->join('articles','articles.user_id','=','users.id')
              ->select('users.id as n','users.name','users.email','articles.*')
              ->where('articles.id','=',$id)
              ->first();
      return view('backend.blog.show', ['blog' => $blog]);
    }

    // EDIT ARTIKEL //
    public function edit($id)
    {
      $blog = DB::table('users')
              ->join('articles','articles.user_id','=','users.id')
              ->select('users.id as n','users.name','users.email','articles.*')
              ->where('articles.id','=',$id)
              ->first();
      return view('backend.blog.edit', ['blog' => $blog]);
    }

    // UBAH ARTIKEL //
    public function update(Request $request, $id)
    {
      $validator = Validator::make(request()->all(), [
        'title' => 'required', 'status' => 'required', 'images' => 'required', 'description' => 'required'
      ]);
      if($validator->fails()) {
        Session::flash("flash_notification", [
          "level"   => "danger",
          "message" => "Please.. field is required",
        ]);
        redirect()->back()->withErrors($validator->errors());
      }
      $user = User::where('email', Auth::User()->email)->first();
      $blogs = Blog::find($id);
      $blogs->update([
        'user_id' => $user->id,
        'title' => $request->title,
        'slug' => str_slug($request->title, '-'),
        'post_status' => $request->post_status,
        'images' => $request->images,
        'description' => $request->description
      ]);
      Session::flash("flash_notification", [
        "level" => "success",
        "message" => "Artikel Berhasil Dirubah"
      ]);
      if(Auth::user()->hasRole('admin')) {
        return redirect()->route('blog.index');
      } elseif (Auth::user()->hasRole('operator')) {
        return redirect()->route('operator.blog.index');
      } else {
        return redirect()->route('company.blog.index');
      }
    }

    // HAPUS ARTIKEL //
    public function destroy($id)
    {
      $blog = Blog::destroy($id);
      Session::flash("flash_notification", [
        "level" => "success",
        "message" => "Artikel Berhasil Dihapus"
      ]);
      if(Auth::user()->hasRole('admin')) {
        return redirect()->route('blog.index');
      } elseif (Auth::user()->hasRole('operator')) {
        return redirect()->route('operator.blog.index');
      } else {
        return redirect()->route('company.blog.index');
      }
    }
}
