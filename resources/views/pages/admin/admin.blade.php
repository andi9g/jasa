@extends('layouts.admin')

@section('title', 'Data Admin')
@section('judul', 'Data Admin')
@section('activeadmin', 'active')

@section('content')
    
    <div class="pd-20 mb-30 card-box">
        <div class="clearfix">
            <div class="row">
                <div class="col-md-6">
                    <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#tambahadmin">Tambah Admin</button>
                </div>
                <div class="col-md-6">
                    <form action="{{ url()->current() }}">
                        <div class="input-group">
                            <input class="form-control" type="text" name="keyword" value="{{ $keyword }}" placeholder="keyword" aria-label="keyword" aria-describedby="keyword">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-secondary" id="keyword"><i class="fa fa-search"></i> Cari</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-bordered table-sm table-hover">
                <thead>
                    <tr>
                        <th width="5px">No</th>
                        <th>Nama</th>
                        <th>Posisi</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($admin as $item)
                    <tr>
                        <td>{{ $loop->iteration + $admin->firstItem() - 1 }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->posisi }}</td>
                        <td class="text-primary">{{ $item->username }}</td>
                        <td>{{ $item->email }}</td>
                        <td>
                            @if (Hash::check('admin'.date('Y'), $item->password)) 
                                Default
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            <form action='{{ route('admin.destroy', [$item->iduser]) }}' method='post' class='d-inline'>
                                 @csrf
                                 @method('DELETE')
                                 <button type='submit' onclick="return confirm('apakah yakin ingin di hapus?')" class='badge badge-danger badge-btn border-0'>
                                     <i class="fa fa-trash"></i>
                                 </button>
                            </form>

                            <button class="badge badge-btn border-0 badge-info d-inline" type="button" data-toggle="modal" data-target="#editadmin{{ $item->iduser }}">
                                <i class="fa fa-edit"></i>
                            </button>

                            <form action='{{ route('reset.admin', [$item->iduser]) }}' method='post' class='d-inline'>
                                 @csrf
                                 @method('PUT')
                                 <button type='submit' onclick="return confirm('Yakin ingin direset?')" class='badge badge-warning badge-btn border-0'>
                                     <i class="fa fa-key"></i>
                                 </button>
                            </form>
                        </td>

                    </tr>

                        <div id="editadmin{{ $item->iduser }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="edit-admin{{ $item->iduser }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="edit-admin{{ $item->iduser }}">Ubah Data</h5>
                                        <button class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('admin.store', []) }}" method="post">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="name">Masukan Nama</label>
                                                <input id="name" required class="form-control @error('name')
                                                    is-invalid
                                                @enderror" type="text" value="{{ $item->name }}" name="name">
                    
                                            </div>
                        
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input id="email" required class="form-control @error('email')
                                                    is-invalid
                                                @enderror" type="email" value="{{ $item->email }}" name="email">
                                            </div>
                        
                                            <div class="form-group">
                                                <label for="username">Username</label>
                                                <input id="username" required class="form-control @error('username')
                                                    is-invalid
                                                @enderror" type="text" value="{{ $item->username }}" name="username">
                                            </div>
                        
                                            <div class='form-group'>
                                                <label for='forposisi' class='text-capitalize'>Posisi</label>
                                                <select name='posisi' id='forposisi' class='form-control'>
                                                    <option value='admin' @if ($item->posisi=='admin')
                                                        selected
                                                    @endif>Admin</option>
                                                    <option value='superadmin' @if ($item->posisi=='superadmin')
                                                        selected
                                                    @endif>Superadmin</option>
                                                <select>
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

        <div class="w-100 justi mt-30">
            {{ $admin->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>


    <div id="tambahadmin" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="tambah-admin" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambah-admin">Tambah admin</h5>
                    <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.store', []) }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Masukan Nama</label>
                            <input id="name" required class="form-control @error('name')
                                is-invalid
                            @enderror" type="text" value="{{ old('name') }}" name="name">

                        </div>
    
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" required class="form-control @error('email')
                                is-invalid
                            @enderror" type="email" value="{{ old('email') }}" name="email">
                        </div>
    
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input id="username" required class="form-control @error('username')
                                is-invalid
                            @enderror" type="text" value="{{ old('username') }}" name="username">
                        </div>
                        
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input id="password" required class="form-control @error('password')
                                is-invalid
                            @enderror" type="password" name="password">
                        </div>
    
                        <div class='form-group'>
                            <label for='forposisi' class='text-capitalize'>Posisi</label>
                            <select name='posisi' id='forposisi' class='form-control'>
                                <option value='admin' @if (old('posisi')=='admin')
                                    selected
                                @endif>Admin</option>
                                <option value='superadmin' @if (old('posisi')=='superadmin')
                                    selected
                                @endif>Superadmin</option>
                            <select>
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