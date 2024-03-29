@extends('layouts.dashboard')

@section('content')
    <div class="mb-2">
        <a href="{{route('dashboard.kategoribukurelasi.create')}}" class="btn btn-primary">+ Kategori Buku Relasi</a>
    </div>

    @if(session()->has('message'))
    <div class="alert alert-success">
        <strong>{{session()->get('message')}}</strong>
        <button type="button" class="close" data-dismiss="alert">
            <span>&times;</span>
        </button>
    </div>
    @endif

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-8 align-self-center">
                    <h3>Kategori Buku Relasi</h3>
                </div>
                <div class="col-4">
                    <form method="get" action="{{ route('dashboard.kategoribukurelasi') }}">
                        <div class="input-group">
                            <input type="text" class="form-control form-control-sm" name="q" value="{{ $request['q'] ?? '' }}">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-secondary btn-sm">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            @if($kategoribukurelasi->total())
                <table class="table table-bordered table-striped table-hover">
                    <thead>    
                        <tr>
                            <th>No</th>
                            <th>Buku</th>
                            <th>Kategori</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kategoribukurelasi as $relasi)
                            <tr>
                                <td>{{ ($kategoribukurelasi->currentPage() -1 ) * $kategoribukurelasi->perPage() + $loop->iteration }}</td>
                                <td>
                                    {{ $relasi->bukubuku->title }}
                                </td>
                                <td>
                                    {{ $relasi->kategoriBuku->namakategori }}
                                </td>
                                <td><a href="{{ route('dashboard.kategoribukurelasi.edit', $relasi->kategoribukuid) }}" class="btn btn-success btn-sm"><i class="fas fa-pen"></i></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $kategoribukurelasi->links() }}
            @else
                <h5 class="text-center p-3">Belum ada data Buku</h5>
            @endif
        </div>
    </div>
@endsection