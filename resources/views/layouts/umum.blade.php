@php
	$pengaturan = DB::table('pengaturan')->first();
	$logo = empty($pengaturan->logo)?'':$pengaturan->logo;
	$namaweb = empty($pengaturan->namaweb)?'':$pengaturan->namaweb;
@endphp
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Basic Page Info -->
        <meta charset="utf-8"/>
        
        <title>
            @yield('title')
        </title>
        <style>
            th td {
                padding: 5px 5px !important;
                margin: 0 !important;
            }
        </style>
        <!-- Site favicon -->
        <link
            rel="apple-touch-icon"
            sizes="180x180"
            href="vendors/images/apple-touch-icon.png"/>
        <link
            rel="icon"
            type="image/png"
            sizes="32x32"
            href="vendors/images/favicon-32x32.png"/>
        <link
            rel="icon"
            type="image/png"
            sizes="16x16"
            href="vendors/images/favicon-16x16.png"/>

        <!-- Mobile Specific Metas -->
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, maximum-scale=1"/>

        @include('layouts.header')
        @yield('header')

    </head>
    <body class="bg-sm body-sm sidebar-shrink">
        
        <div class="header bg-gradient-primary" style="height: 65px;">
            <a href="{{ url('product', []) }}" class="header-left mt-0">
                
                 {{-- <img src="{{ url('gambar/logo', [$logo]) }}" style="height: 85px" class="rounded-circle ml-1 mt-4 p-2 bg-white" alt=""> --}}
                 <img src="{{ url('gambar/logo', [$logo]) }}" style="height: 60px" class="rounded-lg ml-1 mt-0 bg-white" alt="">
                 <h4 class="h2 ml-1 mt-1">{{ $namaweb }}</h4>
            </a>
            
            <div class="float-right">
                
                <div class="menu-icon bi bi-list mt-2 mr-2 p-0" style="font-size: 30pt !important"></div>
                {{-- <a href="{{ url('login', []) }}" class="btn btn-outline-success btn-sm p-1 mt-3 mr-2">
                    <i class="fa fa-sign-in"></i> Login
                </a> --}}

            </div>
        </div>

        <div class="left-side-bar">
            {{-- <div class="brand-logo d-lg-none" style="height: 65px;">
                <div class="">
                    <a href="{{ url('product', []) }}">
                        <img src="{{ url('gambar/logo', [$logo]) }}" width="55px" class="rounded-circle" class="dark-logo"/>
                        <h4 class="h2 ml-2 mt-1 text-light">{{ $namaweb }}</h4>
                    </a>
                    <div class="close-sidebar" data-toggle="left-sidebar-close">
                        <i class="ion-close-round"></i>
                    </div>
                </div>
                
            </div> --}}
            <div class="menu-block customscroll">
                <div class="sidebar-menu">
                    <ul id="accordion-menu">
                        <li>
                            <a href="{{ url('product', []) }}" class="dropdown-toggle no-arrow @yield('activeproduct')">
                                <span class="micon fa fa-newspaper-o"></span ><span class="mtext">Produk</span>
                            </a>
                        </li>

                        <li class="dropdown @yield('activekategori')">
							<a href="javascript:;" class="dropdown-toggle" data-option="off">
								<span class="micon bi bi-house"></span><span class="mtext">Kategori</span>
							</a>
							<ul class="submenu" style="display: none;">
                                @php
                                    $kategori = DB::table('kategori')->get();
                                @endphp
                                @foreach ($kategori as $item)
								<li><a href="{{ route('kategori', [$item->idkategori]) }}" class="@yield('activekategori'.$item->idkategori)">{{ $item->namakategori }}</a></li>
                                @endforeach
							</ul>
						</li>

                        <li>
                            <br>
                            <br>
                            <a href="{{ url('login', []) }}" class="btn btn-block btn-outline-primary">
                                <span class="micon fa fa-sign-in"></span ><span class="mtext"> LOGIN</span>
                            </a>
                        </li>

                        
                    </ul>
                </div>
            </div>
        </div>

        <div class="mobile-menu-overlay"></div>

        <div class="main-container">
        
            @yield('search')

            <div class="pd-ltr-20 height-100-p xs-pd-20-10">
                
                <div class="min-height-200px">
                    @yield('content')

                </div>
            </div>

            

        </div>

        <div class="jumbotron bg-dark text-light pt-5">
            <div class="row">
                <div class="col-md-8">
                    <h4 class="my-0 py-0 text-light">Google Map</h4>
                    <hr class="bg-light py-0 my-2 my-0 ">
                    <div style="max-width:100%;overflow:hidden;color:red;width:100%;height:300px;"><div id="display-google-map" style="height:100%; width:100%;max-width:100%;"><iframe style="height:100%;width:100%;border:0;" frameborder="0" src="https://www.google.com/maps/embed/v1/place?q=smkn1+gunungkijang&key=AIzaSyBFw0Qbyq9zTFTd-tUY6dZWTgaQzuU17R8"></iframe></div><a class="googlemaps-made" rel="nofollow" href="https://www.bootstrapskins.com/themes" id="grab-maps-authorization">premium bootstrap themes</a><style>#display-google-map img.text-marker{max-width:none!important;background:none!important;}img{max-width:none}</style></div>
                </div>
                <div class="col-md-4">
                    <h4 class="my-0 py-0 text-light">Developer Website</h4>
                    <hr class="bg-light py-0 my-2 my-0 ">
                    <p>ARBP</p>
                    
                </div>
            </div>
        </div>


        @yield('pesan')

        @include('layouts.footer') @include('sweetalert::alert')
        @yield('footer')
    </body>
</html>