@extends('layouts.admin')

@section('judul', ucwords(strtolower('Tambah Produk')))

@section('menu')
<li class="breadcrumb-item">
    <a href="{{ url('postingan', []) }}">Data Postingan</a>
</li>
@endsection
@section('activepostingan', 'active')

@section('title','Form Tambah Produk')


@section('header')
{{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
<script src="{{ url('plugins/ckeditor/ckeditor.js', []) }}"></script>


<style>
    #container {
        width: 1000px;
        margin: 20px auto;
    }
    .ck-editor__editable[role="textbox"] {
        /* Editing area */
        min-height: 200px;
    }
    .ck-content .image {
        /* Block images */
        max-width: 80%;
        margin: 20px auto;
    }
</style>
@endsection

@section('content')


    <div class="card-box pd-20 mb-30">
        
        <form action="{{ route('store.produk', [$idproduk]) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="namadetailproduk">Nama Produk</label>
                        <input id="namadetailproduk" required value="{{ old('namadetailproduk') }}" class="form-control" type="text" name="namadetailproduk" placeholder="Nama Produk">
                    </div>
                    <div class="form-group">
                        <label for="hargamin">Harga Min</label>
                        <input id="hargamin" required value="{{ old('hargamin') }}" class="form-control" type="number" name="hargamin" placeholder="Harga Minimal">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class='form-group'>
                        <label for='forgambar' class='text-capitalize'>Masukan Gambar Produk</label>
                        <input type='file' required name='gambar' value="{{ old('gambar') }}" id='forgambar' class='form-control' placeholder='masukan namaplaceholder'>
                    </div>
                    <div class="form-group">
                        <label for="hargamax">Harga Maximal</label>
                        <input id="hargamax" required value="{{ old('hargamax') }}" class="form-control" type="number" name="hargamax" placeholder="Harga Tertinggi">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Deskripsi</label>
                        <textarea id="konten" required class="form-control" name="konten" rows="3">{{ old('konten') }}</textarea>
                    </div>
                </div>
            </div>
            <div class="clearfix">
                <div class="float-left">
                    <a href="{{ route('tampil.produk', [$idproduk]) }}" class="btn btn-outline-danger btn-sm">Kembali</a>
                </div>
                <div class="float-right">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-send"></i> TAMBAH PRODUK
                    </button>
                </div>
            </div>
        </form>
    </div>


@endsection


@section('footer')
<script>

    CKEDITOR.replace('konten', {
        filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form',

        language:'en-gb'
    });

    CKEDITOR.config.allowedContent = true;


</script>

@endsection
