@extends('layouts.dashboard')

@section('content')
    <div class="mb-2">
        <a href="{{route('dashboard.kategoribuku.create')}}" class="btn btn-primary">+ Kategori Buku</a>
    </div>

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-8 align-self-center">
                    <h3>Kategori Buku</h3>
                </div>
                <div class="col-4">
                    <form method="get" action="{{ route('dashboard.kategoribuku')}}">
                        <div class="input-group">
                            <input type="text" class="form-control form-control-sm" name="q" value="{{ $request['q'] ?? ''}}">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-secondary btn-sm">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            @if($kategoribuku->total())
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kategori</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kategoribuku as $kategori)
                        <tr>
                            <td>{{ ($kategoribuku->currentPage() - 1) * $kategoribuku->perPage() + $loop->iteration }}</td>
                            <td>1</td>
                            <td>{{ $kategori->namakategori }}</td>
                            <td><a href="{{ route('dashboard.kategoribuku.edit', ['id' =>$kategori->kategoriid]) }}" class="btn btn-success btn-sm"><i class="fas fa-pen"></i></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $kategoribuku->links() }}
            @else
                <h5 class="text-center p-3">Belum ada Kategori Buku</h5>
            @endif
        </div>
    </div>
@endsection