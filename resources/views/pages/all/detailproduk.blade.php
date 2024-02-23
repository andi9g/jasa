@extends('layouts.umum')

@section('keyword', $keyword)
@section('title', $produk->namadetailproduk)

@section('content')

        
        <div class="blog-wrap">
            <div class="container pd-0">

                <div class="row">
                    <div class="col-md-8 col-sm-12">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{ url('product', []) }}">Produk</a></li>
                              <li class="breadcrumb-item"><a href="{{ route('detail', $produk->idproduk) }}">Detail Produk</a></li>
                              <li class="breadcrumb-item active" aria-current="page">{{ $produk->namadetailproduk }}</li>
                            </ol>
                          </nav>
                        <div class="clearfix">
                            <div class="float-left">
                                <h1 class="">
                                    {{ $produk->namadetailproduk }}
                                </h1>
                                
                                <h4 class="h5 text-secondary mb-2">
                                    <p class="my-0 py-0">
                                        {{ ucfirst(strtolower($produk->produk->namaproduk)) }}
                                    </p>
                                </h4>
                                <small class="text-secondary">
                                    <i class="fa fa-eye"></i> {{ $view }} View
                                </small>
                                
                            </div>
                            <div class="float-right">
                                
                            </div>
                        </div>
                        
                        <div class="blog-detail card-box overflow-hidden mb-30">
                            <div class="blog-img">
                                <img src="{{ url('gambar/postingan', [$produk->gambar]) }}" width="100%" alt="">
                            </div>
                            <div class="blog-caption text-dark">
                                
                                <h5 class="mb-10 text-success">
                                    Rp{{ number_format($produk->hargamin, 0, ",",".") }} ~ Rp{{ number_format($produk->hargamax, 0, ",",".") }}
                               </h5>
                                <?php
                                    echo strip_tags(htmlspecialchars_decode($produk->deskripsi),'<p><img><ul><li><ol><strong><i><u><center><b><h1><h2><h3><h2><h5><a><table><tr><td><th><div>');
                                ?>

                                <br>
                                <small class="text-secondary">
                                    # <i>
                                        {{ $produk->produk->kategori->namakategori }}
                                        </i>
                                </small>

                                @php
                                    $pesan = "Hallo, saya tertarik dengan produk yang ditawarkan.%0A%0A*".$produk->namadetailproduk."*%0AHarga : *Rp".number_format($produk->hargamin, 0, ",",".")." ~ Rp".number_format($produk->hargamax, 0, ",",".")."*%0A%0A*LINKS*%0A".url()->current();
                                @endphp

                                <h5 class="h6 text-secondary mb-2">
                                    <p class="my-0 py-0">
                                        PESAN SEKARANG
                                    </p>
                                </h5>
                                
                                @foreach ($hubungi as $item)
                                    <a target="_blank" href="https://api.whatsapp.com/send?phone=+{{ $item->nohp }}&text={{ $pesan }}" class="btn btn-success mt-2 btn-block">
                                        <i class="fa fa-whatsapp"></i> +{{ $item->nohp }}
                                    </a>
                                    <a href="{{ route('detail', [$produk->idproduk]) }}" class="btn btn-secondary mt-2 btn-block">KEMBALI KE HALAMAN SEBELUMNYA</a>
                                        
                                @endforeach
                            </div>
                        </div>

                        <div class="title pb-20 mb-0" id="detail">
                            <div class="clearfix">
                                <div class="float-left">
                                    <h2 class="h3 mb-0 text-secondary">
                                        DOKUMENTASI KEGIATAN
                                    </h2>
                                </div>
                            </div>
                            
                            <hr class="py-0 my-0 bg-secondary">
                        </div>

                        @if (count($gambardetailproduk) == 0)
                            <h3>Belum ada Dokumentasi</h3>

                            @else

                            <div id="carouselExampleIndicators" class="carousel slide mb-4" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    @foreach ($gambardetailproduk as $item)
                                    <li data-target="#carouselExampleIndicators" data-slide-to="{{ $loop->iteration }}" class="@if ($loop->iteration == 1)
                                        active
                                    @endif"></li>
                                        
                                    @endforeach
                                </ol>
                                <div class="carousel-inner rounded-lg">
                                    @foreach ($gambardetailproduk as $item)
                                    <div style="max-height: 350px" class="carousel-item @if ($loop->iteration == 1)
                                        active
                                    @endif">
                                        <img class="d-block w-100" src="{{ url('gambar/dokumentasi', [$item->gambar]) }}" alt="Second slide">
                                    </div>
                                        
                                    @endforeach
                                    
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        @endif

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
    <button class="welcome-modal-close">
        <i class="bi bi-x-lg"></i>
    </button>
    @php
        $pesan = "Hallo, saya tertarik dengan produk yang ditawarkan.%0A%0A*".$produk->namadetailproduk."*%0AHarga : *Rp".number_format($produk->hargamin, 0, ",",".")." ~ Rp".number_format($produk->hargamax, 0, ",",".")."*%0A%0A*LINKS*%0A".url()->current();
    @endphp

    <div class="text-center pt-4">
        @foreach ($hubungi as $item)
        <a target="_blank" href="https://api.whatsapp.com/send?phone=+{{ $item->nohp }}&text={{ $pesan }}" class="btn btn-success mt-2 btn-block">
            <i class="fa fa-whatsapp"></i> +{{ $item->nohp }}
        </a>
            
        @endforeach
        <hr>
        <a href="#detail" class="btn btn-dark btn-block">
            Lihat Dokumentasi
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