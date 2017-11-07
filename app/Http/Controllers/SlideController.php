<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Datatables;
use Yajra\DataTables\Html\Builder;
use App\Models\Slideshows;
use Session, Validator;

class SlideController extends Controller
{
    public function __construct()
    {
      $this->middleware('web');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Builder $htmlBuilder)
    {
      if($request->ajax()){
        $slide = Slideshows::select(['id','images','post_status']);
        return DataTables::of($slide)
          ->addColumn('action', function($slide) {
            return view('backend.layouts.action', [
              'model' => $slide,
              'edit_url' => route('slideshow.edit',$slide->id),
              'detail_url' => route('slideshow.show',$slide->id),
              'del_url' => route('slideshow.destroy',$slide->id)
            ]);
          })->make(true);
      }
      $html = $htmlBuilder
              ->addColumn(['data' => 'id', 'name' => 'id', 'title' => '#ID'])
              ->addColumn(['data' => 'images', 'name' => 'images', 'title' => 'Name Photos'])
              ->addColumn(['data' => 'post_status', 'name' => 'post_status', 'title' => 'Status'])
              ->addColumn(['data' => 'action', 'name' => 'action', 'title' => 'Action', 'orderable' => false, 'searchable' => false]);
      return view('backend.admin.slideshow.index')->with(compact('html'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.admin.slideshow.create');
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
        'fupload'    => 'required',
      ]);
      if($validator->fails()) {
        Session::flash("flash_notification", [
          "level"   => "danger",
          "message" => "Please.. field is required",
        ]);
        return redirect()->back()->withErrors($validator->errors());
      }
      $slide = Slideshows::where('post_status','Publish')->get()->count();
      if($slide === 6 && $request->post_status === "Publish") {
        Session::flash("flash_notification", [
          "level"   => "danger",
          "message" => "Telah Melewati Batas Maximum Status Publish Pada Slideshow. Harap mengubah menjadi simpan di kolom status !",
        ]);
        return redirect()->route('slideshow.create');
      } elseif ($slide < 7) {
        $slide = Slideshows::create([
          'images'      => $request->fupload,
          'slug'        => $request->slug,
          'post_status' => $request->post_status
        ]);
        Session::flash("flash_notification", [
          "level"   => "success",
          "message" => "Slideshow Berhasil Disimpan"
        ]);
        return redirect()->route('slideshow.index');
      } else {
        $slide = Slideshows::create([
          'images'      => $request->fupload,
          'slug'        => $request->slug,
          'post_status' => 'Draft'
        ]);
        Session::flash("flash_notification", [
          "level"   => "warning",
          "message" => "Slideshow Berhasil Disimpan dengan Status Draft",
        ]);
        return redirect()->route('slideshow.index');
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $slide = Slideshows::findOrFail($id);
        return view('backend.admin.slideshow.show',compact('slide'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $slide = Slideshows::findOrFail($id);
      return view('backend.admin.slideshow.edit',compact('slide'));
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
        'images'    => 'required',
      ]);
      if($validator->fails()) {
        Session::flash("flash_notification", [
          "level"   => "danger",
          "message" => "Please.. field is required",
        ]);
        redirect()->back()->withErrors($validator->errors());
      }
      $slide = Slideshows::where('post_status','Publish')->get()->count();
      if($slide === 6 && $request->post_status === "Publish") {
        Session::flash("flash_notification", [
          "level"   => "danger",
          "message" => "Telah Melewati Batas Maximum Status Publish Pada Slideshow. Harap mengubah menjadi simpan di kolom status !",
        ]);
        return redirect()->route('slideshow.index');
      } elseif ($slide < 7) {
        $slide = Slideshows::findOrFail($id);
        $slide->update([
          'images'      => $request->fupload,
          'slug'        => $request->slug,
          'post_status' => $request->post_status
        ]);
        Session::flash("flash_notification", [
          "level"   => "success",
          "message" => "Slideshow Berhasil Dirubah"
        ]);
        return redirect()->route('slideshow.index');
      } else {
        $slide = Slideshows::findOrFail($id);
        $slide->update([
          'images'      => $request->fupload,
          'slug'        => $request->slug,
          'post_status' => 'Draft'
        ]);
        Session::flash("flash_notification", [
          "level"   => "warning",
          "message" => "Slideshow Berhasil Dirubah dengan Status Draft",
        ]);
        return redirect()->route('slideshow.index');
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      Slideshows::destroy($id);
      Session::flash("flash_notification", [
        "level"   => "success",
        "message" => "Slideshow Berhasil Dihapus"
      ]);
      return redirect()->route('slideshow.index');
    }
}
