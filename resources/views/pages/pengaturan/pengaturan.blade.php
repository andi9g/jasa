@extends('layouts.admin')

@section('judul', "PENGATURAN")

@section('title', 'PENGATURAN')
@section('judul2', 'FORM PENGATURAN')

@section('content')

<div class="row">
    <div class="col-md-6">
        <div class="pd-20 card-box mb-30">
            <div class="clearfix mb-20">
                 <div class="pull-left">
                     FORM PENGATURAN WEBSITE
                 </div>
                 <div class="pull-right">
                    
                </div>
             </div>
        
            <form action="{{ route('pengaturan.store', []) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="namaweb">Nama Website</label>
                    <input id="namaweb" class="form-control" type="text" name="namaweb" value="{{ empty($data->namaweb)?'':$data->namaweb }}">
                </div>
        
                <div class="form-group">
                    <label for="logo">Masukan Logo</label>
                    <div class="text-left my-2">
                        <img src="{{ url('gambar/logo', [ empty($data->logo)?'':$data->logo ]) }}" width="100px" alt="">
                    </div>
                    <input id="logo" class="form-control" type="file" name="logo">
                    
                </div>
        
                <div class="text-right">
                    <button type="submit" class="btn btn-success ">UPDATE</button>
                </div>
            </form>
        
        </div>

    </div>

    <div class="col-md-6">
        <div class="pd-20 md-30 card-box">
            <button class="btn btn-primary mb-20" type="button" data-toggle="modal" data-target="#tambahhubungi">Tambah Informasi Kontak</button>
            

            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th width="5px">No</th>
                        <th>Nama</th>
                        <th>HP/WA</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($hubungi as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->nohp }}</td>
                            <td>
                                <form action='{{ route('pengaturan.kontak.hapus', [$item->idhubungi]) }}' method='post' class='d-inline'>
                                     @csrf
                                     @method('DELETE')
                                     <button type='submit' onclick="return confirm('Yakin ingin di hapus?')" class='badge badge-danger badge-btn border-0'>
                                         <i class="fa fa-trash"></i>
                                     </button>
                                </form>

                                <button class="badge badge-btn border-0 badge-info" type="button" data-toggle="modal" data-target="#ubahkontak{{ $item->idhubungi }}">
                                    <i class="fa fa-edit"></i>
                                </button>
                            </td>
                        </tr>

                        <div id="ubahkontak{{ $item->idhubungi }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="ubah-hubungi" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="ubah-hubungi">Ubah Data</h5>
                                        <button class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('pengaturan.kontak.ubah', [$item->idhubungi]) }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="nama">Nama</label>
                                                <input id="nama" class="form-control" type="text" value="{{ $item->nama }}" name="nama">
                                            </div>
                                            <div class="form-group">
                                                <label for="nohp">Nomor HP</label>
                                                <input id="nohp" class="form-control" type="number" value="{{ $item->nohp }}" name="nohp">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success">Tambah</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="tambahhubungi" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="tambah-hubungi" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambah-hubungi">Nomor yang dapat dihubungi</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('pengaturan.kontak.tambah', []) }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input id="nama" class="form-control" type="text" name="nama">
                    </div>
                    <div class="form-group">
                        <label for="nohp">Nomor HP</label>
                        <input id="nohp" class="form-control" type="number" name="nohp">
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