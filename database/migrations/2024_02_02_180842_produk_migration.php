<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProdukMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengaturan', function (Blueprint $table) {
            $table->bigIncrements('idpengaturan');
            $table->string('namaweb');
            $table->string('logo');
            $table->boolean('show')->default(0);
            $table->timestamps();
        });

        Schema::create('identitas', function (Blueprint $table) {
            $table->bigIncrements('ididentitas');
            $table->integer('iduser');
            $table->string('alamat');
            $table->string('nohp');
            $table->string('email');
            $table->timestamps();
        });

        Schema::create('hubungi', function (Blueprint $table) {
            $table->bigIncrements('idhubungi');
            $table->string('nohp');
            $table->string('nama');
            $table->timestamps();
        });

        Schema::create('produk', function (Blueprint $table) {
            $table->bigIncrements('idproduk');
            $table->string('namaproduk');
            $table->integer('idkategori');
            $table->string('gambar');
            $table->longText('deskripsi');
            $table->timestamps();
        });

        Schema::create('kategori', function (Blueprint $table) {
            $table->bigIncrements('idkategori');
            $table->string('namakategori');
            $table->string('singkatan')->nullable();
            $table->timestamps();
        });

        Schema::create('pengunjungproduk', function (Blueprint $table) {
            $table->bigIncrements('idpengunjungproduk');
            $table->bigInteger('idproduk');
            $table->longText('perangkat');
            $table->date('tanggal');
            $table->timestamps();
        });
        Schema::create('pengunjungprodukdetail', function (Blueprint $table) {
            $table->bigIncrements('idpengunjungprodukdetail');
            $table->bigInteger('iddetailproduk');
            $table->longText('perangkat');
            $table->date('tanggal');
            $table->timestamps();
        });

        Schema::create('pengelola', function (Blueprint $table) {
            $table->bigIncrements('idpengelola');
            $table->string('namapengelola');
            $table->string('jabatan');
            $table->char('wa', 14)->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();
            $table->timestamps();
        });

        Schema::create('detailproduk', function (Blueprint $table) {
            $table->bigIncrements('iddetailproduk');
            $table->integer('iduser');
            $table->integer('idproduk');
            $table->string('namadetailproduk');
            $table->string('gambar');
            $table->bigInteger('hargamin');
            $table->bigInteger('hargamax');
            $table->longText('deskripsi');
            $table->timestamps();
        });

        Schema::create('gambardetailproduk', function (Blueprint $table) {
            $table->bigIncrements('idgambardetailproduk');
            $table->integer('iddetailproduk');
            $table->string('gambar');
            $table->timestamps();
        });

        Schema::create('rating', function (Blueprint $table) {
            $table->bigIncrements('idrating');
            $table->integer('iddetailproduk');
            $table->integer('rating');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
