@extends('layouts.umum')

@section('keyword', $keyword)
@section('title', $produk->namaproduk)

@section('content')

        
        <div class="blog-wrap">
            <div class="container pd-0">

                <div class="row">
                    <div class="col-md-8 col-sm-12">
                            <nav aria-label="breadcrumb ">
                                <ol class="breadcrumb ">
                                  <li class="breadcrumb-item"><a href="{{ url('product', []) }}">Produk</a></li>
                                  <li class="breadcrumb-item active" aria-current="page">Detail Produk</li>
                                </ol>
                              </nav>

                        <h2 class="">
                            {{ $produk->namaproduk }}
                        </h2>
                        
                        <h5 class="h6 mb-10  text-secondary">
                            <p>
                                {{ ucfirst(strtolower($produk->kategori->namakategori)) }}
                            </p>
                        </h5>
                        
                        <div class="blog-detail card-box overflow-hidden mb-30">
                            <div class="blog-img">
                                <img src="{{ url('gambar/postingan', [$produk->gambar]) }}" width="100%" alt="">
                            </div>
                            <div class="blog-caption text-dark">
                                
                                <?php
                                    echo strip_tags(htmlspecialchars_decode($produk->deskripsi),'<p><img><ul><li><ol><strong><i><u><center><b><h1><h2><h3><h2><h5><a><table><tr><td><th><div>');
                                ?>


                                <br>
                               
                            </div>
                        </div>

                        <div class="title pb-20 mb-0" id="detail">
                            <div class="clearfix">
                                <div class="float-left">
                                    <h2 class="h3 mb-0 text-secondary">
                                        Menyediakan Jasa
                                    </h2>
                                </div>
                            </div>
                            
                            <hr class="py-0 my-0 bg-secondary">
                        </div>

                        <div class="blog-list mt-0">
                            <ul>
                                @foreach ($detailproduk as $item)
                                <li>
                                    <div class="row no-gutters">
                                        <div class="col-lg-4 col-md-12 col-sm-12">
                                            <div class="blog-img" style="background: url(&quot;gambar/postingan/{{ $item->gambar }}&quot;) center center no-repeat;">
                                                <img src="{{ url('gambar/postingan', [$item->gambar]) }}" alt="" class="bg_img" style="display: none;">
                                            </div>
                                        </div>
                                        @php
                                            $namadetailproduk = str_replace(" ", "-", $item->namadetailproduk);
                                        @endphp
                                        <div class="col-lg-8 col-md-12 col-sm-12">
                                            <div class="blog-caption">
                                                <h3>
                                                    <a href="{{ route('package', [$item->iddetailproduk, $namadetailproduk]) }}">{{$item->namadetailproduk}}</a>
                                                </h3>
                                                <div class="blog-by">
                                                    <?php
                                                        echo substr(strip_tags(htmlspecialchars_decode($item->deskripsi),'<p><img><ul><li><ol><strong><i><u><center><b><h1><h2><h3><h4><h5><a><table><tr><td><th><div>'),0,200);
                                                    ?>
                                                    <h5>
                                                        Rp{{ number_format($item->hargamin, 0, ",",".") }} ~ Rp{{ number_format($item->hargamax, 0, ",",".") }}
                                                   </h5>
                                                    <div class="pt-10">
                                                        <a href="{{ route('package', [$item->iddetailproduk, $namadetailproduk]) }}" class="btn btn-outline-primary">LIHAT LEBIH DETAIL</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                    
                                @endforeach
                                @if ($detailproduk->count() == 0)
                                <li>
                                    <center>
                                        <h5 class="h5 py-2 my-0 text-secondary">
                                            Belum ada Jasa yang Ditawarkan
                                            <br>
                                            <a href="{{ url('product', []) }}" class="text-blue pb-2">< Kembali ke Produk ></a>
                                        </h5>

                                        
                                        
                                    </center>
                                </li>
                                    
                                @endif
                                
                            </ul>
                            {{ $detailproduk->links('vendor.pagination.bootstrap-4') }}
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


@section('pesan')
    
<button class="welcome-modal-btn btn-success">
    Detail Paket dan Kontak
</button>




<div class="welcome-modal">
    <h3 class="mt-2">
        <i class="fa fa-phone"></i> Kontak 
    </h3>
    <button class="welcome-modal-close">
        <i class="bi bi-x-lg"></i>
    </button>

    <div class="text-center">
        @foreach ($hubungi as $item)
        <a target="_blank" href="https://api.whatsapp.com/send?phone=+{{ $item->nohp }}&text=Hallo, saya tertarik dengan produk yang ditawarkan.%0A%0A*LINKS*%0A{{ url()->current() }}" class="btn btn-success mt-2 btn-block rounded-sm">
            <i class="fa fa-whatsapp"></i> +{{ $item->nohp }}
        </a>
            
        @endforeach
        <hr>
        <a href="#detail" class="btn btn-dark btn-block rounded-sm">
            Detail Paket
        </a>
        <div class="pb-2">
            <span></span>
            <span></span>
        </div>
    </div>
    
</div>
@endsection

@section('footer')
<script>
    function smoothScroll(target, duration) {
        var target = document.querySelector(target);
        var targetPosition = target.getBoundingClientRect().top;
        var startPosition = window.pageYOffset;
        var distance = targetPosition - startPosition;
        var startTime = null;

        function animation(currentTime) {
            if (startTime === null) startTime = currentTime;
            var timeElapsed = currentTime - startTime;
            var run = easing(timeElapsed, startPosition, distance, duration);
            window.scrollTo(0, run);
            if (timeElapsed < duration) requestAnimationFrame(animation);
        }

        function easing(t, b, c, d) {
            t /= d / 2;
            if (t < 1) return c / 2 *t * t + b;
            t--;
            return -c / 2 * (t * (t - 2) - 1) + b;
        }

        requestAnimationFrame(animation);
    }

    var detail = document.querySelector('#detail');

    var detailLink = document.querySelector('a[href="#detail"]');

    detailLink.addEventListener('click', function() {
        smoothScroll('#detail', 1000);
    });

   
</script>
@endsection