<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['middleware' =>'auth'], function(){

	Route::resource('kategori', 'KategoriProdukController');
	Route::resource('kategori_transaksi', 'KategoriTransaksiController');
	Route::resource('kas', 'KasController');
	Route::resource('item-masuk', 'ItemMasukController');
	Route::resource('kas_masuk', 'KasMasukController');
	Route::resource('kas_keluar', 'KasKeluarController');
	Route::resource('kas_mutasi', 'KasMutasiController');
	Route::resource('komisi', 'KomisiProdukController');
	Route::resource('produk', 'ProdukController');
	Route::resource('pasien', 'PasienController');
	Route::resource('penjamin', 'PenjaminController');
	Route::resource('gudang', 'GudangController');
	Route::resource('suplier', 'SuplierController');
	Route::resource('poli', 'PoliController');
	Route::resource('user', 'UserController');
	Route::resource('otoritas', 'OtoritasController');
	Route::resource('satuan', 'SatuanController');
	Route::get('/otoritas/{id}/permission/', 'OtoritasController@permission')->name('otoritas.permission');




});



//ITEM MASUK
	Route::get('/item-masuk/proses-form-edit/{id}',[
	'middleware' => ['auth'],
	'as' => 'item-masuk.proses_form_edit',
	'uses' => 'ItemMasukController@proses_form_edit'
	]);

	Route::post('/item-masuk/proses-tambah-tbs-item-masuk',[
	'middleware' => ['auth'],
	'as' => 'item-masuk.proses_tambah_tbs_item_masuk',
	'uses' => 'ItemMasukController@proses_tambah_tbs_item_masuk'
	]);

	Route::post('/item-masuk/proses-tambah-edit-tbs-item-masuk/{id}',[
	'middleware' => ['auth'],
	'as' => 'item-masuk.proses_tambah_edit_tbs_item_masuk',
	'uses' => 'ItemMasukController@proses_tambah_edit_tbs_item_masuk'
	]);

	Route::post('/item-masuk/proses-hapus-tbs-item-masuk/{id}',[
	'middleware' => ['auth'],
	'as' => 'item-masuk.proses_hapus_tbs_item_masuk',
	'uses' => 'ItemMasukController@proses_hapus_tbs_item_masuk'
	]);

	Route::post('/item-masuk/proses-hapus-edit-tbs-item-masuk/{id}',[
	'middleware' => ['auth'],
	'as' => 'item-masuk.proses_hapus_edit_tbs_item_masuk',
	'uses' => 'ItemMasukController@proses_hapus_edit_tbs_item_masuk'
	]);

	Route::post('/item-masuk/proses-hapus-semua-tbs-item-masuk/',[
	'middleware' => ['auth'],
	'as' => 'item-masuk.proses_hapus_semua_tbs_item_masuk',
	'uses' => 'ItemMasukController@proses_hapus_semua_tbs_item_masuk'
	]);

	Route::post('/item-masuk/proses-hapus-semua-edit-tbs-item-masuk/{id}',[
	'middleware' => ['auth'],
	'as' => 'item-masuk.proses_hapus_semua_edit_tbs_item_masuk',
	'uses' => 'ItemMasukController@proses_hapus_semua_edit_tbs_item_masuk'
	]);

	Route::post('/item-masuk/proses-edit-item-masuk/{id}',[
	'middleware' => ['auth'],
	'as' => 'item-masuk.proses_edit_item_masuk',
	'uses' => 'ItemMasukController@proses_edit_item_masuk'
	]);

	Route::post('/item-masuk/proses-barcode-item-masuk',[
	'middleware' => ['auth'],
	'as' => 'item-masuk.proses_barcode_item_masuk',
	'uses' => 'ItemmasukController@proses_barcode_item_masuk'
	]);

	Route::post('/item-masuk/proses-barcode-edit-item-masuk/{id}',[
	'middleware' => ['auth'],
	'as' => 'item-masuk.proses_barcode_edit_item_masuk',
	'uses' => 'ItemmasukController@proses_barcode_edit_item_masuk'
	]);
// end route item masuk


