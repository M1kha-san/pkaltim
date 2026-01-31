@extends('layouts.admin')
@section('title', 'Data Rumah Makan')
@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Data Rumah Makan</h1>
    <a href="{{ route('admin.rumah-makan.create') }}" class="btn btn-success">
        <i class="fas fa-plus me-1"></i> Tambah RM
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Rumah Makan</th>
                        <th>Alamat</th>
                        <th>Koordinat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rumahMakans as $rm)
                    <tr>
                        <td>{{ $rumahMakans->firstItem() + $loop->index }}</td>
                        <td class="fw-bold">{{ $rm->nama_rumah_makan }}</td>
                        <td>{{ Str::limit($rm->alamat, 50) }}</td>
                        <td>
                            <small class="text-muted">
                                Lat: {{ $rm->latitude }}<br>
                                Long: {{ $rm->longitude }}
                            </small>
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('admin.rumah-makan.edit', $rm->id) }}" class="btn btn-sm btn-warning text-white"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('admin.rumah-makan.destroy', $rm->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data ini?');">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-3">Belum ada data rumah makan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">{{ $rumahMakans->links() }}</div>
    </div>
</div>
@endsection