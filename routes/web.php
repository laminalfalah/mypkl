<?php

Auth::routes();
Route::get('/home','HomeController@index',['middleware' => ['auth']]);

// HOME //
Route::group(['prefix' => '', 'middleware' => ['web']],function() {
  // LOGIN //
  Route::get('/login', 'AuthController@showLoginForm')->name('login');
  Route::post('/login', 'AuthController@login')->name('post.login');
  // VEFIFICATION //
  Route::get('/verification/{email}/{verifyToken}', 'UserController@verifikasi')->name('verifikasi');
  Route::put('/verification/{email}/{verifyToken}', 'UserController@save')->name('save');
  Route::match(['get', 'post'], 'register', function() {
    return redirect('/');
  });

  // BERANDA //
  Route::get('/', 'BerandaController@index')->name('beranda');
  Route::get('/id','BerandaController@index')->name('beranda.id');
  Route::get('/how-to-order', 'BerandaController@carapemesanan')->name('beranda.carapemesanan');
  Route::get('/aboutus', 'BerandaController@aboutus')->name('beranda.aboutus');
  Route::get('/contactus', 'BerandaController@contactus')->name('beranda.contactus');
  Route::get('/check', 'BerandaController@form_cek')->name('form.cek');
  Route::post('/check' , 'BerandaController@post_cek')->name('post.form.cek');

  // Route Tiket //
  Route::get('/tiket', 'BerandaController@tiket')->name('tiket.beranda');

  // Route Hotel //
  Route::get('/hotel', 'BerandaController@hotel')->name('hotel.beranda');

  // Route Sewa Mobil //
  Route::get('/sewa-mobil', 'BerandaController@car_rental')->name('mobil.beranda');

  // Route Tour //
  Route::group(['prefix' => 'tour'], function () {
    Route::get('/', 'TourController@beranda')->name('tour.beranda');
    Route::get('/request','RequestTourController@permintaan')->name('tour.request');
    Route::post('/request', 'RequestTourController@kirim_permintaan')->name('tour.kirim');
    Route::post('/cari','TourController@cari')->name('tour.search');
    Route::get('/{slug}', 'TourController@lihat_paket')->name('tour.view');
    Route::get('/{slug}/pesan', 'BookingTourController@form_pesan')->name('tour.form_pesan');
    Route::post('/pesan', 'BookingTourController@sendForm_pesan')->name('tour.sendPesan');
  });

  // Route Umroh //
  Route::group(['prefix' => 'umroh'], function () {
    Route::get('/', 'UmrohController@beranda')->name('umroh.beranda');
    Route::post('/cari', 'UmrohController@cari')->name('umroh.search');
    Route::get('/{slug}', 'UmrohController@lihat_paket')->name('umroh.view');
    Route::get('/{slug}/pesan', 'BookingUmrohController@form_pesan')->name('umroh.form_pesan');
    Route::post('/pesan', 'BookingUmrohController@sendForm_pesan')->name('umroh.sendPesan');
  });

  // Route Blog //
  Route::group(['prefix' => 'blog'], function () {
    Route::get('/', 'ArticleController@beranda')->name('blog.beranda');
    Route::get('/{slug}', 'ArticleController@lihat_artikel')->name('blog.lihat');
  });
});

// ROUTE DASHBOARD ADMIN //
Route::group(['prefix' => 'dashboard/admin', 'middleware' => ['auth','role:admin']], function() {
  Route::get('/','AdminController@index')->name('dashboard.admin');
  Route::get('/profile', 'AdminController@profil')->name('dashboard.admin.profile');
  Route::get('/password', 'PasswordController@index')->name('password.change');
  Route::put('/password', 'PasswordController@update')->name('password.post');
  Route::get('/filemanager', 'AdminController@file_manager')->name('dashboard.admin.file');
  Route::get('/photos', 'AdminController@photos_manager')->name('dashboard.admin.photos');

  // UBAH PASSWORD //

  // PAKET TOUR //
  Route::resource('/tour','TourController');
  // PAKET UMROH //
  Route::resource('/umroh', 'UmrohController');
  // ARTIKEL //
  Route::resource('/blog', 'ArticleController');
  // SLIDESHOW //
  Route::resource('/slideshow','SlideController');
  // USERS //
  Route::resource('/users', 'UserController');
  // ROLE //
  Route::resource('/role','RoleController');

  // PEMESANAN TOUR //
  Route::group(['prefix' => 'pemesanan'], function() {
    Route::get('/tour', 'BookingTourController@beranda_pemesanan')->name('tour.pemesanan');
    Route::get('/tour/{id}/edit', 'BookingTourController@edit_pemesanan')->name('tour.pemesanan.edit');
    Route::put('/tour/{id}', 'BookingTourController@update_pemesanan')->name('tour.pemesanan.update');
    Route::get('/tour/detail/{id}', 'BookingTourController@show_pemesanan')->name('tour.pemesanan.show');
    Route::delete('/tour/{id}', 'BookingTourController@destroy_pemesanan')->name('tour.pemesanan.destroy');
  });

  // PERMINTAAN TOUR //
  Route::group(['prefix' => 'permintaan'],function() {
    Route::get('/tour', 'RequestTourController@beranda_permintaan')->name('tour.permintaan');
    Route::get('/tour/{id}/edit', 'RequestTourController@edit_permintaan')->name('tour.permintaan.edit');
    Route::put('/tour/{id}', 'RequestTourController@update_permintaan')->name('tour.permintaan.update');
    Route::get('/tour/detail/{id}', 'RequestTourController@show_permintaan')->name('tour.permintaan.detail');
    Route::delete('/tour/{id}', 'RequestTourController@destroy_permintaan')->name('tour.permintaan.destroy');
  });

  // PEMESANAN UMROH //
  Route::group(['prefix' => 'pemesanan'], function() {
    Route::get('/umroh', 'BookingUmrohController@beranda_pemesanan')->name('umroh.pemesanan');
    Route::get('/umroh/{id}/edit', 'BookingUmrohController@edit_pemesanan')->name('umroh.pemesanan.edit');
    Route::put('/umroh/{id}', 'BookingUmrohController@update_pemesanan')->name('umroh.pemesanan.update');
    Route::get('/umroh/detail/{id}', 'BookingUmrohController@show_pemesanan')->name('umroh.pemesanan.show');
    Route::delete('/umroh/{id}', 'BookingUmrohController@destroy_pemesanan')->name('umroh.pemesanan.destroy');
  });

  // DOWNLOAD //
  Route::get('/tour/download/{slug}','DownloadController@downloadPaketTour')->name('tour.download.paket');
  Route::get('/pemesanan/tour/download/{id}','DownloadController@downloadPemesananTour')->name('tour.pemesanan.download');
  Route::get('/permintaan/tour/download/{id}','DownloadController@downloadPermintaanTour')->name('tour.download.permintaan');
  Route::get('/umroh/download/{slug}','DownloadController@downloadPaketUmroh')->name('umroh.download');
  Route::get('/pemesanan/umroh/download/{id}','DownloadController@downloadPemesananUmroh')->name('umroh.pemesanan.download');

});

// ROUTE DASHBOARD OPERATOR //
Route::group(['prefix' => 'dashboard/operator', 'middleware' => ['auth','role:operator']], function() {
  Route::get('/','OperatorController@index')->name('dashboard.operator');
  Route::get('/profile', 'OperatorController@profil')->name('dashboard.operator.profile');
  Route::get('/password', 'PasswordController@index')->name('operator.password.change');
  Route::put('/password', 'PasswordController@update')->name('operator.password.post');

  // PAKET TOUR //
  Route::group(['prefix' => 'tour'], function() {
    Route::get('/','TourController@index')->name('operator.tour.index');
    Route::get('/create','TourController@create')->name('operator.tour.create');
    Route::post('/','TourController@store')->name('operator.tour.store');
    Route::get('/{id}/edit','TourController@edit')->name('operator.tour.edit');
    Route::put('/{id}', 'TourController@update')->name('operator.tour.update');
    Route::get('/detail/{id}','TourController@show')->name('operator.tour.show');
    Route::delete('/{id}', 'TourController@destroy')->name('operator.tour.destroy');
  });

  // PEMESANAN TOUR //
  Route::group(['prefix' => 'pemesanan'], function() {
    Route::get('/tour', 'BookingTourController@beranda_pemesanan')->name('operator.tour.pemesanan');
    Route::get('/tour/{id}/edit', 'BookingTourController@edit_pemesanan')->name('operator.tour.pemesanan.edit');
    Route::put('/tour/{id}', 'BookingTourController@update_pemesanan')->name('operator.tour.pemesanan.update');
    Route::get('/tour/detail/{id}', 'BookingTourController@show_pemesanan')->name('operator.tour.pemesanan.show');
    Route::delete('/tour/{id}', 'BookingTourController@destroy_pemesanan')->name('operator.tour.pemesanan.destroy');
  });

  // PERMINTAAN TOUR //
  Route::group(['prefix' => 'permintaan'],function() {
    Route::get('/tour', 'RequestTourController@beranda_permintaan')->name('operator.tour.permintaan');
    Route::get('/tour/{id}/edit', 'RequestTourController@edit_permintaan')->name('operator.tour.permintaan.edit');
    Route::put('/tour/{id}', 'RequestTourController@update_permintaan')->name('operator.tour.permintaan.update');
    Route::get('/tour/detail/{id}', 'RequestTourController@show_permintaan')->name('operator.tour.permintaan.detail');
    Route::delete('/tour/{id}', 'RequestTourController@destroy')->name('operator.tour.permintaan.destroy');
  });

  // PAKET UMROH //
  Route::group(['prefix' => 'umroh'], function() {
    Route::get('/','UmrohController@index')->name('operator.umroh.index');
    Route::get('/create','UmrohController@create')->name('operator.umroh.create');
    Route::post('/','UmrohController@index')->name('operator.umroh.store');
    Route::get('/{id}/edit','UmrohController@edit')->name('operator.umroh.edit');
    Route::put('/{id}', 'UmrohController@update')->name('operator.umroh.update');
    Route::get('/detail/{id}','TourController@show')->name('operator.umroh.show');
    Route::delete('/{id}', 'TourController@destroy')->name('operator.umroh.destroy');
  });

  // PEMESANAN UMROH //
  Route::group(['prefix' => 'pemesanan'], function() {
    Route::get('/umroh', 'BookingUmrohController@beranda_pemesanan')->name('operator.umroh.pemesanan');
    Route::get('/umroh/{id}/edit', 'BookingUmrohController@edit_pemesanan')->name('operator.umroh.pemesanan.edit');
    Route::put('/umroh/{id}', 'BookingUmrohController@update_pemesanan')->name('operator.umroh.pemesanan.update');
    Route::get('/umroh/detail/{id}', 'BookingUmrohController@show_pemesanan')->name('operator.umroh.pemesanan.show');
    Route::delete('/umroh/{id}', 'BookingUmrohController@destroy_pemesanan')->name('operator.umroh.pemesanan.destroy');
  });

  // ARTIKEL //
  Route::group(['prefix' => 'blog'], function() {
    Route::get('/', 'ArticleController@index')->name('operator.blog.index');
    Route::get('/create','ArticleController@create')->name('operator.blog.create');
    Route::post('/', 'ArticleController@store')->name('operator.blog.store');
    Route::get('/{id}/edit','ArticleController@edit')->name('operator.blog.edit');
    Route::put('/{id}', 'ArticleController@update')->name('operator.blog.update');
    Route::get('/detail/{id}','ArticleController@show')->name('operator.blog.show');
    Route::delete('/{id}', 'ArticleController@destroy')->name('operator.blog.destroy');
  });

  // DOWNLOAD //
  Route::get('/tour/download/{slug}','DownloadController@downloadPaket')->name('operator.tour.download.paket');
  Route::get('/pemesanan/tour/download/{id}','DownloadController@downloadPemesanan')->name('operator.tour.pemesanan.download');
  Route::get('/permintaan/tour/download/{id}','DownloadController@downloadPermintaan')->name('operator.tour.download.permintaan');
  Route::get('/umroh/download/{slug}','DownloadController@downloadPaket')->name('operator.umroh.download');
  Route::get('/pemesanan/umroh/download/{id}','DownloadController@downloadPemesanan')->name('operator.umroh.pemesanan.download');
});

// ROUTE DASHBOARD COMPANY //
Route::group(['prefix' => 'dashboard/company', 'middleware' => ['auth','role:company']], function() {
  Route::get('/','DashboardController@index')->name('dashboard.company');
  Route::get('/profile', 'DashboardController@profil')->name('dashboard.company.profile');
  Route::get('/password', 'PasswordController@index')->name('company.password.change');
  Route::put('/password', 'PasswordController@update')->name('company.password.post');

  // PAKET TOUR //
  Route::group(['prefix' => 'tour'], function() {
    Route::get('/','TourController@index')->name('company.tour.index');
    Route::get('/create','TourController@create')->name('company.tour.create');
    Route::post('/','TourController@store')->name('company.tour.store');
    Route::get('/{id}/edit','TourController@edit')->name('company.tour.edit');
    Route::put('/{id}', 'TourController@update')->name('company.tour.update');
    Route::get('/detail/{id}','TourController@show')->name('company.tour.show');
    Route::delete('/{id}', 'TourController@destroy')->name('company.tour.destroy');
  });

  // PEMESANAN TOUR //
  Route::group(['prefix' => 'pemesanan'], function() {
    Route::get('/tour', 'BookingTourController@beranda_pemesanan')->name('company.tour.pemesanan');
    Route::get('/tour/detail/{id}', 'BookingTourController@show_pemesanan')->name('company.tour.pemesanan.show');
  });

  // PERMINTAAN TOUR //
  Route::group(['prefix' => 'permintaan'],function() {
    Route::get('/tour', 'RequestTourController@beranda_permintaan')->name('company.tour.permintaan');
    Route::get('/tour/detail/{id}', 'RequestTourController@show_permintaan')->name('company.tour.permintaan.detail');
  });

  // PAKET UMROH //
  Route::group(['prefix' => 'umroh'], function() {
    Route::get('/','UmrohController@index')->name('company.umroh.index');
    Route::get('/create','UmrohController@create')->name('company.umroh.create');
    Route::post('/','UmrohController@store')->name('company.umroh.store');
    Route::get('/{id}/edit','UmrohController@edit')->name('company.umroh.edit');
    Route::put('/{id}', 'UmrohController@update')->name('company.umroh.update');
    Route::get('/detail/{id}','UmrohController@show')->name('company.umroh.show');
    Route::delete('/{id}', 'TourController@destroy')->name('company.umroh.destroy');
  });

  // PEMESANAN UMROH //
  Route::group(['prefix' => 'pemesanan'], function() {
    Route::get('/umroh', 'BookingUmrohController@beranda_pemesanan')->name('company.umroh.pemesanan');
    Route::get('/umroh/{id}/edit', 'BookingUmrohController@edit_pemesanan')->name('company.umroh.pemesanan.edit');
    Route::put('/umroh/{id}', 'BookingUmrohController@update_pemesanan')->name('company.umroh.pemesanan.update');
    Route::get('/umroh/detail/{id}', 'BookingUmrohController@show_pemesanan')->name('company.umroh.pemesanan.show');
    Route::delete('/umroh/{id}', 'BookingUmrohController@destroy_pemesanan')->name('company.umroh.pemesanan.destroy');
  });

  // ARTIKEL //
  Route::group(['prefix' => 'blog'], function() {
    Route::get('/', 'ArticleController@index')->name('company.blog.index');
    Route::get('/create','ArticleController@create')->name('company.blog.create');
    Route::post('/', 'ArticleController@store')->name('company.blog.store');
    Route::get('/{id}/edit','ArticleController@edit')->name('company.blog.edit');
    Route::put('/{id}', 'ArticleController@update')->name('company.blog.update');
    Route::get('/detail/{id}','ArticleController@show')->name('company.blog.show');
    Route::delete('/{id}', 'ArticleController@destroy')->name('company.blog.destroy');
  });

});
