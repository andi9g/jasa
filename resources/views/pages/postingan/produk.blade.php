@extends('layouts.admin')

@section('activepostingan', 'active')

@section('title', 'Postingan')

@section('judul', "Data Produk")

@section('content')
    <div class="card-box pd-20 mb-10">
        <div class="row">
            <div class="col-md-6">
                <a href="{{ route('postingan.create', []) }}" class="btn btn-primary">Tambah Produk</a>
            </div>
            <div class="col-md-6">
                <form action="{{ url()->current() }}">
                    <div class="input-group mb-0">
                        <input class="form-control" type="text" name="keyword" value="{{ $keyword }}" placeholder="kata kunci" aria-label="kata kunci" aria-describedby="keyword">
                        <div class="input-group-append">
                            <button type="submit" class="input-group-text bg-secondary text-light" id="keyword">
                                <i class="fa fa-search"></i> Cari
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row">
        @foreach ($produk as $item)
            
        <div class="col-md-6">
            <div class="blog-list " >
                <ul>
                    <li>
                        <div class="row no-gutters" >
                            <div class="col-lg-5 col-md-12 col-sm-12">
                                <div class="blog-img" style="background: url(&quot;url('gambar/logo/{{ $item->gambar }}', )&quot;) center center no-repeat;">
                                    <img src="{{ url('gambar/postingan', [$item->gambar]) }}" alt="" class="bg_img" style="display: none;">
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-12 col-sm-12">
                                <div class="blog-caption">
                                    <h4>
                                        <a href="#">{{$item->namaproduk}}</a>
                                    </h4>
                                    <div class="blog-by">
                                        <p>
                                            <?php
                                                echo substr(strip_tags(htmlspecialchars_decode($item->deskripsi),'<p><img><ul><li><ol><strong><i><u><center><b><h1><h2><h3><h4><h5><a><table><tr><td><th><div>'), 0, 220)." ...";
                                            ?>
                                        </p>
                                        <div class="pt-10">
                                            <div class="">
                                                <a href="{{ route('tampil.produk', [$item->idproduk]) }}" class="btn btn-outline-primary">
                                                    <i class="fa fa-gear"></i>
                                                    KELOLA
                                                </a>
                                                
                                                <form action='{{ route('postingan.destroy', [$item->idproduk]) }}' method='post' class='d-inline'>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type='submit' onclick="return confirm('yakin ingin dihapus')" class='btn btn-outline-danger'>
                                                        <i class="fa fa-trash"></i> Hapus
                                                    </button>
                                                </form>
                                                <a href="{{ route('postingan.edit', [$item->idproduk]) }}" class="btn btn-outline-info">
                                                 <i class="fa fa-edit"></i> Edit
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    
                </ul>
            </div>

        </div>
        @endforeach
    </div>
    
@endsection


