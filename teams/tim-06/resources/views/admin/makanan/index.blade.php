@extends('layouts.admin')
@section('title', 'Data Kuliner')
@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Data Kuliner</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('admin.makanan.create') }}" class="btn btn-success">
            <i class="fas fa-plus me-1"></i> Tambah Kuliner
        </a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th scope="col" width="5%">No</th>
                        <th scope="col" width="15%">Gambar</th>
                        <th scope="col">Nama Makanan</th>
                        <th scope="col">Asal Daerah</th>
                        <th scope="col" width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($makanans as $index => $item)
                    <tr>
                        <td>{{ $makanans->firstItem() + $index }}</td>
                        <td>
                            @if($item->gambar)
                                <img src="{{ asset('storage/' . $item->gambar) }}" class="img-thumbnail rounded" style="width: 80px; height: 60px; object-fit: cover;">
                            @else
                                <span class="badge bg-secondary">No Image</span>
                            @endif
                        </td>
                        <td class="fw-bold">{{ $item->nama_makanan }}</td>
                        <td>{{ $item->asal_daerah }}</td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('admin.makanan.edit', $item->id) }}" class="btn btn-sm btn-warning text-white" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.makanan.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus {{ $item->nama_makanan }}?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">
                            <i class="fas fa-box-open fa-2x mb-2"></i><br>
                            Belum ada data makanan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="mt-3">
            {{ $makanans->links() }} 
            </div>
    </div>
</div>
@endsection