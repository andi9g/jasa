@extends('layouts.admin')

@section('activepostingan', 'active')

@section('judul', ucwords(strtolower('Produk '.$produk->namaproduk)))

@section('menu')
<li class="breadcrumb-item">
    <a href="{{ url('postingan', []) }}">Data Postingan</a>
</li>
@endsection

@section('title', ucwords(strtolower('Produk '.$produk->namaproduk)))

@section('content')
    <div class="card-box pd-20 mb-30">
        <div class="row">
            <div class="col-md-6">
                <a href="{{ url('postingan', []) }}" class="btn btn-outline-danger btn-sm">Kembali</a>

                <a href="{{ route('tambah.produk', [$idproduk]) }}" class="btn btn-sm btn-primary">TAMBAH PRODUK</a>
            </div>
            <div class="col-md-6">
                <div class="input-group">
                    <input class="form-control" type="text" name="keyword" placeholder="kata kunci" aria-label="kata kunci" aria-describedby="keyword">
                    <div class="input-group-append">
                        <button type="submit" class="input-group-text bg-secondary text-light" id="keyword">
                            <i class="fa fa-search"></i> Cari
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered table-sm">
                <thead>
                    <tr>
                        <th width="5px">No</th>
                        <th>Nama Produk/Jasa</th>
                        <th>Detail</th>
                        <th>Gambar Dokumentasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($detailproduk as $item)
                    <tr>
                        <td>{{ $loop->iteration + $detailproduk->firstItem() - 1 }}</td>
                        <td>{{ $item->namadetailproduk }}</td>
                        <td>
                            <button class="badge badge-btn border-0 badge-primary" type="button" data-toggle="modal" data-target="#detail{{ $item->iddetailproduk }}">
                                <i class="fa fa-eye"></i> Lihat
                            </button>
                        </td>
                        <td>
                            <a href="{{ route('gambar.produk.dokumentasi', [$item->iddetailproduk]) }}" class="badge badge-btn border-0 badge-success">
                                <i class="fa fa-image"></i> Gambar Dokumentasi
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('edit.produk', [$item->iddetailproduk]) }}" class="badge badge-btn badge-info">
                                <i class="fa fa-edit"></i> Edit
                            </a>
                            <form action='{{ route('destroy.produk', [$item->iddetailproduk]) }}' method='post' class='d-inline'>
                                 @csrf
                                 @method('DELETE')
                                 <button type='submit' onclick="return confirm('Yakin ingin dihapus?')" class='badge badge-danger badge-btn border-0'>
                                     <i class="fa fa-trash"></i> Hapus
                                 </button>
                            </form>
                        </td>
                    </tr>

                    <div id="detail{{ $item->iddetailproduk }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title{{ $item->iddetailproduk }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="my-modal-title{{ $item->iddetailproduk }}">Detail</h5>
                                    <button class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <img src="{{ url('gambar/postingan', [$item->gambar]) }}" width="100%" alt="">

                                    <div class="row">
                                        <div class="col-md-12">
                                            <p class="my-0 mt-2"><b>Deskripsi</b></p>

                                            <?php
                                                echo strip_tags(htmlspecialchars_decode($item->deskripsi),'<p><img><ul><li><ol><strong><i><u><center><b><h1><h2><h3><h4><h5><a><table><tr><td><th><div>');
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>    

@endsection