@extends('layouts.admin')

@section('judul', 'Data Kategori')

@section('title', 'Data Kategori')

@section('activekategori', 'active')

@section('content')
    <div class="card-box pd-20 mb-30">
        <div class="row">
            <div class="col-md-6">
                <div class="input-group ">
                    <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#tambahkategori">Tambah Kategori</button>
                </div>
            </div>
            <div class="col-md-6">
                <form action="{{ url()->current() }}">
                    <div class="input-group ">
                        <input class="form-control" type="text" name="keyword" placeholder="keyword" aria-label="keyword" aria-describedby="keyword">
                        <div class="input-group-append">
                            <button type="submit" class="input-group-text px-4 text-light bg-secondary" id="keyword">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <table class="table-hover table table-striped table-bordered table-sm">
            <thead>
                <tr>
                    <th width="5px">No</th>
                    <th>Nama Kategori</th>
                    <th>Singkatan</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($kategori as $item)
                    <tr>
                        <td>{{ $loop->iteration + $kategori->firstItem() - 1 }}</td>
                        <td>{{ $item->namakategori }}</td>
                        <td>{{ $item->singkatan }}</td>
                        <td>
                            <form action='{{ route('kategori.destroy', [$item->idkategori]) }}' method='post' class='d-inline'>
                                 @csrf
                                 @method('DELETE')
                                 <button type='submit' onclick="return confirm('yakin ingin di hapus?')" class='badge badge-danger badge-btn border-0'>
                                     <i class="fa fa-trash"></i>
                                 </button>
                            </form>

                            <button class="badge badge-btn border-0 badge-primary" type="button" data-toggle="modal" data-target="#ubah{{ $item->idkategori }}">
                                <i class="fa fa-edit"></i> Ubah
                            </button>
                        </td>
                    </tr>
                    <div id="ubah{{ $item->idkategori }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="ubah-kategori{{ $item->idkategori }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="ubah-kategori{{ $item->idkategori }}">Ubah Data</h5>
                                    <button class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('kategori.update', [$item->idkategori]) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="namakategori">Nama Kategori</label>
                                            <input id="namakategori" class="form-control" value="{{ $item->namakategori }}" type="text" name="namakategori" placeholder="masukan nama kategori">
                                        </div>
                    
                                        <div class="form-group">
                                            <label for="singkatan">Singkatan</label>
                                            <input id="singkatan" class="form-control" type="text" value="{{ $item->singkatan }}" name="singkatan" placeholder="contoh : TKJ, ATPH, DPIB & LDP">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success">Ubah</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>

    <div id="tambahkategori" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="tambah-kategori" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambah-kategori">Tambah Kategori</h5>
                    <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('kategori.store', []) }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="namakategori">Nama Kategori</label>
                            <input id="namakategori" class="form-control" type="text" name="namakategori" placeholder="masukan nama kategori">
                        </div>
    
                        <div class="form-group">
                            <label for="singkatan">Singkatan</label>
                            <input id="singkatan" class="form-control" type="text" name="singkatan" placeholder="contoh : TKJ, ATPH, DPIB & LDP">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection