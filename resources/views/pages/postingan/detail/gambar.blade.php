@extends('layouts.admin')

@section('judul', ucwords(strtolower('Gambar Dokumentasi')))

@section('menu')
<li class="breadcrumb-item">
    <a href="{{ url('postingan', []) }}">Data Postingan</a>
</li>
<li class="breadcrumb-item">
    <a href="{{ route('tampil.produk', [$data->idproduk]) }}">{{ strtolower($data->produk->namaproduk) }}</a>
</li>
@endsection
@section('activepostingan', 'active')

@section('title','Gambar Dokumentasi')


@section('header')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ url('plugins/dropzone/min/dropzone.min.css', []) }}">
<link rel="stylesheet" href="{{ url('plugins/dropzone/min/basic.min.css', []) }}">


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


    <div class="card-box pd-20 mb-10">
        <a href="{{ url()->current() }}" class="btn btn-block btn-info rounded-0">Refresh Halaman</a>
        <form action="{{ route('gambar.produk.upload', [$iddetailproduk]) }}" class="dropzone" id="my-dropzone" enctype="multipart/form-data">
            @csrf
        </form>
        
    </div>
    <div class="card-box pd-20">
        <h4>GAMBAR :</h4>
        <div class="row">
            @foreach ($produk as $item)
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <img src="{{ url('gambar/dokumentasi', [$item->gambar]) }}" width="100%" alt="">
                    </div>
                    
                    <div class="card-footer">
                        <form action='{{ route('gambar.produk.hapus', [$item->idgambardetailproduk]) }}' method='post' class='d-inline'>
                             @csrf
                             @method('DELETE')
                             <button type='submit' onclick="return confirm('Yakin ingin dihapus?')" class='btn btn-danger btn-block'>
                                 HAPUS
                             </button>
                        </form>
                    </div>
                </div>

            </div>
            @endforeach
        </div>
    </div>


@endsection


@section('footer')
<script src="{{ url('plugins/dropzone/min/dropzone.min.js', []) }}"></script>

<script>



</script>

@endsection
