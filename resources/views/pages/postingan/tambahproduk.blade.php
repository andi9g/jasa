@extends('layouts.admin')

@section('judul', "Form Tambah Produk")
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
        
        <form action="{{ route('postingan.store', []) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="namaproduk">Nama Produk</label>
                        <input id="namaproduk" required value="{{ old('namaproduk') }}" class="form-control" type="text" name="namaproduk" placeholder="Nama Produk">
                    </div>
                    <div class="form-group">
                        <label>Kategori</label>
                        <select
                            class="custom-select2 form-control"
                            name="idkategori"
                            style="width: 100%; height: 38px"
                        >
                            @foreach ($kategori as $item)
                                <option value="{{ $item->idkategori }}" @if (old('idkategori') == $item->idkategori)
                                    selected
                                @endif>{{ $item->namakategori }}</option>
                            @endforeach
                            
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class='form-group'>
                        <label for='forgambar' class='text-capitalize'>Masukan Gambar Produk</label>
                        <input type='file' required name='gambar' value="{{ old('gambar') }}" id='forgambar' class='form-control' placeholder='masukan namaplaceholder'>
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
