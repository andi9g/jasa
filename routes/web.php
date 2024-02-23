<?php

use Illuminate\Support\Facades\Route;

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

Route::get("login", "Auth\LoginController@showLoginForm");
Route::post("login", "Auth\LoginController@login")->name("login");

Route::get('product', 'productC@index')->name('product');
Route::get('product/category/{idkategori}', 'productC@kategori')->name('kategori');
Route::get('product/detail/{idproduk}', 'productC@detail')->name('detail');
Route::get('product/package/{iddetailproduk}/{namadetailproduk}', 'productC@package')->name('package');

Route::get('/', function () {
    return redirect('login');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/home', function() {
        return redirect('postingan');
    });

    Route::resource('admin', 'adminC');
    Route::put('reset/admin/{iduser}', 'adminC@reset')->name('reset.admin');
    
    //postingan
    Route::resource('postingan', 'produkC');
    Route::post('ckedit/upload', 'produkC@uploadimage')->name('ckeditor.upload');

    //kategori
    Route::resource('kategori', 'kategoriC');
    
    //detailproduk
    Route::get("produk/{idproduk}", "produkC@produk")->name('tampil.produk');
    Route::get("produk/{idproduk}/tambah", "produkC@formproduk")->name('tambah.produk');
    Route::post("produk/{idproduk}/store", "produkC@tambahproduk")->name('store.produk');
    Route::get("produk/{idproduk}/edit", "produkC@editproduk")->name('edit.produk');
    Route::put("produk/{idproduk}/update", "produkC@updateproduk")->name('update.produk');
    Route::delete("produk/{idproduk}/destroy", "produkC@destroyproduk")->name('destroy.produk');
    Route::get("produk/{idproduk}/gambar", "produkC@gambarproduk")->name('gambar.produk.dokumentasi');
    Route::post("produk/{idproduk}/gambarupload", "produkC@gambarprodukupload")->name('gambar.produk.upload');
    Route::delete("produk/{idgambardetailproduk}/gambarhapus", "produkC@gambarprodukhapus")->name('gambar.produk.hapus');

    //logout
    Route::post("logout", "Auth\LoginController@logout")->name("logout");
    //profil
    Route::get('profil', "profilC@index");
    Route::post('profil/ubahnama', "profilC@ubahnama")->name("ubah.nama");
    Route::post('profil/ubahpassword', "profilC@ubahpassword")->name("ubah.password");
    Route::post('profil/ubahgambar', "profilC@ubahgambar")->name("ubah.gambar");

    //pengaturan
    Route::resource('pengaturan', 'pengaturanC');
    Route::post('kontak/create', 'pengaturanC@kontak')->name('pengaturan.kontak.tambah');
    Route::put('kontak/ubah/{idhubungi}', 'pengaturanC@ubahkontak')->name('pengaturan.kontak.ubah');
    Route::delete('kontak/hapus/{idhubungi}', 'pengaturanC@hapuskontak')->name('pengaturan.kontak.hapus');
});



// Route::get('pdf', 'startController@pdf');

// Route::get('siswa/export/', 'startController@export');



// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
