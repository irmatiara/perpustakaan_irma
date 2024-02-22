@extends('layouts.dashboard')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-8 align-self-center">
                    <h3>Kategori Buku</h3>
                </div>
                <div class="col-4 text-right">
                    <button class="btn btn-sm text-secondary" data-bs-toggle="modal" data-bs-target="#deleteModal"><i class="fas fa-trash"></i></button>
                        <!--Tambahkan konten sesuai kebutuhan-->
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <form action="{{ route('dashboard.kategoribuku.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="namakategori">Nama Kategori</label>
                            <input type="text" class="form-control" name="namakategori" value="">
                            @error('namakategori')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mt-4">
                            <button type="button" onclick="window.history.back()" class="btn btn-sm btn-secondary button-spacing">Cancel</button>
                            <button type="submit" class="btn btn-success btn-sm">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="deleteModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <p>Anda yakin ingin menghapus kategori buku</p>
                </div>

                <div class="modal-footer">
                    <form action="{{ route('dashboard.kategoribuku.delete') }}" method="post">
                        @csrf
                        @method('delete')
                        <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </div>
@endsection