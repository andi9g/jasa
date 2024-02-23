@extends('layouts.umum')

@section('keyword', $keyword)
@section('title', "")


@section('search')
<div class="container pd-0 xs-pd-20-10" >
    <form action="{{ url()->current() }}">
        <div class="input-group m-0 mt-4">
            <input class="form-control pd-20" type="text" name="keyword" value="@yield('keyword')" placeholder="Search" aria-label="keyword" aria-describedby="keyword">
            <div class="input-group-append">
                <button type="submit" class="input-group-text bg-secondary px-4" id="keyword"><i class="fa fa-search text-light"></i></button>
            </div>
        </div>
    </form>
</div>
@endsection

@section('content')

        
        <div class="blog-wrap">
            <div class="container pd-0">
                
                <div class="row">
                    <div class="col-md-8 col-sm-12">
                        @if (!empty($idkategori))
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{ url('product', []) }}">Produk</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Kategori</li>
                            </ol>
                          </nav>

                        @endif
                        <div class="title pb-20 mb-0">
                            <div class="clearfix">
                                <div class="float-left">
                                    <h2 class="h3 mb-0 text-secondary">
                                        PRODUK
                                        @if (!empty($idkategori))
                                        @section('activekategori', 'active')
                                        @section('activekategori'.$idkategori, 'active')
                                        <i class="icon-copy fa fa-angle-double-right" aria-hidden="true"></i>
                                              {{ strtoupper($kategori2->singkatan) }}
                                        
                                              @else 
                                              
                                              @section('activeproduct', 'active')
                                        @endif
                                    </h2>
                                </div>
                                <div class="float-right">
                                    <p class="mb-0 text-secondary"> Total {{ count($produk) }}</p>
                                </div>
                            </div>
                            
                            <hr class="py-0 my-0 bg-secondary">
                        </div>
                        <div class="blog-list mt-0">
                            <ul>
                                @foreach ($produk as $item)
                                <li>
                                    <div class="row no-gutters">
                                        <div class="col-lg-5 col-md-12 col-sm-12">
                                            <div class="blog-img" style="background: url(&quot;gambar/postingan/{{ $item->gambar }}&quot;) center center no-repeat;">
                                                <img src="{{ url('gambar/postingan', [$item->gambar]) }}" alt="" class="bg_img" style="display: none;">
                                            </div>
                                        </div>
                                        <div class="col-lg-7 col-md-12 col-sm-12">
                                            <div class="blog-caption">
                                                <h4>
                                                    <a href="{{ route('detail', [$item->idproduk]) }}">{{$item->namaproduk}}</a>
                                                </h4>
                                                <div class="blog-by">
                                                    <?php
                                                        echo substr(strip_tags(htmlspecialchars_decode($item->deskripsi),'<p><img><ul><li><ol><strong><i><u><center><b><h1><h2><h3><h4><h5><a><table><tr><td><th><div>'),0,250)." . . .";
                                                    ?>
                                                    <div class="pt-10">
                                                        <a href="{{ route('detail', [$item->idproduk]) }}" class="btn btn-outline-primary">Read More Product</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                    
                                @endforeach
                                @if ($produk->count() == 0)
                                <li>
                                    <center>
                                        <h5 class="h5 py-2 my-0 text-secondary">
                                            Products not Found
                                            <br>
                                            <a href="{{ url('product', []) }}" class="text-blue pb-2">< Back to Home ></a>
                                        </h5>

                                        
                                        
                                    </center>
                                </li>
                                    
                                @endif
                                
                            </ul>
                        </div>
                        <div class="blog-pagination">
                            {{ $produk->links('vendor.pagination.bootstrap-4') }}
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        
                        <div class="card-box mb-30">
                            <h5 class="pd-20 h5 mb-0">Kategori</h5>
                            <div class="latest-post">
                                <ul>
                                    @foreach ($kategori as $item)
                                    <a href="{{ route('kategori', [$item->idkategori]) }}">
                                    <li class="@if ($loop->iteration % 2 == 0)
                                        bg-light
                                    @endif">
                                        <h4>
                                                {{ $item->namakategori }}
                                            </h4>
                                            <span>{{ $item->singkatan }}
                                                
                                            </span>
                                            <span class="badge badge-sm badge-info badge-pill rounded-sm">Post {{ $item->total }}</span>
                                        </li>
                                    </a>
                                        
                                    @endforeach
                                    
                                </ul>
                            </div>
                        </div>

                        <div class="card-box mb-30">
                            <h5 class="pd-20 h5 mb-0">
                                <i class="icon-copy bi bi-telephone-fill"></i>
                                Kontak Admin</h5>
                            <div class="latest-post">
                                <ul>
                                    @foreach ($hubungi as $item)
                                    <li class="list-group-item d-flex align-items-center justify-content-between text-uppercase rounded-0">
                                        <a >
                                        <h4>
                                                {{ ucwords($item->nama) }}
                                            </h4>
                                            <span>+{{ $item->nohp }}
                                                
                                            </span>
                                            <span class="badge badge-sm badge-info badge-pill rounded-sm">Post {{ $item->total }}</span>
                                        </li>
                                        </a>
                                    @endforeach
                                    
                                    
                                </ul>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    
    

@endsection