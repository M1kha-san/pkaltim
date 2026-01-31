@extends('layouts.admin')
@section('title', 'Data Makanan')
@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Makanan: {{ $makanan->nama_makanan }}</h1>
</div>

<div class="row">
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white py-3">
                <h6 class="m-0 fw-bold text-primary"><i class="fas fa-edit me-1"></i> Data Utama</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.makanan.update', $makanan->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="nama_makanan" class="form-label">Nama Makanan</label>
                        <input type="text" class="form-control @error('nama_makanan') is-invalid @enderror" name="nama_makanan" value="{{ old('nama_makanan', $makanan->nama_makanan) }}" required>
                        @error('nama_makanan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="asal_daerah" class="form-label">Asal Daerah</label>
                        <input type="text" class="form-control @error('asal_daerah') is-invalid @enderror" name="asal_daerah" value="{{ old('asal_daerah', $makanan->asal_daerah) }}" required>
                        @error('asal_daerah')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" rows="4">{{ old('deskripsi', $makanan->deskripsi) }}</textarea>
                        @error('deskripsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="gambar" class="form-label">Foto Makanan (Biarkan kosong jika tidak diganti)</label>
                        <input type="file" class="form-control @error('gambar') is-invalid @enderror" name="gambar" accept="image/*">
                        @error('gambar')<div class="invalid-feedback">{{ $message }}</div>@enderror

                        @if($makanan->gambar)
                        <div class="mt-2">
                            <small class="text-muted">Gambar Saat Ini:</small><br>
                            <img src="{{ asset('storage/' . $makanan->gambar) }}" class="img-thumbnail mt-1" width="150">
                        </div>
                        @endif
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.makanan.index') }}" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary">Update Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-5">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white py-3">
                <h6 class="m-0 fw-bold text-success"><i class="fas fa-store me-1"></i> Lokasi & Harga</h6>
            </div>
            <div class="card-body">

                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif

                <form action="{{ route('admin.makanan.attach', $makanan->id) }}" method="POST" class="row g-2 align-items-end mb-4">
                    @csrf
                    <div class="col-12">
                        <label class="form-label small text-muted">Pilih Rumah Makan</label>
                        <select name="rumah_makan_id" class="form-select form-select-sm" required>
                            <option value="">-- Pilih Lokasi --</option>
                            @foreach($rumahMakans as $rm)
                            <option value="{{ $rm->id }}">{{ $rm->nama_rumah_makan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-8">
                        <label class="form-label small text-muted">Harga (Rp)</label>
                        <input type="number" name="harga" class="form-control form-select-sm" placeholder="cth: 15000" required>
                    </div>
                    <div class="col-4">
                        <button type="submit" class="btn btn-sm btn-success w-100">
                            <i class="fas fa-plus"></i> Tambah
                        </button>
                    </div>
                </form>

                <hr>

                <h6 class="small fw-bold text-muted mb-3">Tersedia di:</h6>
                <div class="list-group list-group-flush">
                    @forelse($makanan->rumahMakans as $mitra)
                    <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                        <div>
                            <div class="fw-bold">{{ $mitra->nama_rumah_makan }}</div>
                            <form action="{{ route('admin.makanan.rumah-makan.destroy', ['makanan' => $makanan->id, 'rumahMakanId' => $mitra->id]) }}" method="POST" onsubmit="return confirm('Hapus rumah makan ini dari makanan?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-link text-danger btn-sm p-0"><i class="fas fa-trash"></i></button>
                            </form>
                            <small class="text-muted">Rp {{ number_format($mitra->pivot->harga, 0, ',', '.') }}</small>
                        </div>
                    </div>
                    @empty
                    <div class="text-center text-muted py-3">
                        <small>Belum terhubung ke rumah makan manapun.</small>
                    </div>
                    @endforelse
                </div>

            </div>
        </div>
    </div>
</div>
@endsection