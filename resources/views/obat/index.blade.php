@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Dashboard Obat</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <a href="{{ route('obat.create') }}" class="btn btn-success mb-3">+ Tambah Obat</a>

    <form action="{{ route('obat.index') }}" method="GET" class="mb-3 d-flex"> 
        <input type="text" name="search" class="form-control me-2" placeholder="Cari obat" value="{{ request('search') }}">
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-search"></i> Cari
        </button>
    </form>

    <table class="table table-bordered table-striped">
        <thead class="table-dark text-center">
            <tr>
                <th>No</th>
                <th>Nama Obat</th>
                <th>Kategori</th>
                <th>Stok</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($dataObat as $index => $obat)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $obat['nama_obat'] ?? '-' }}</td>
                    <td>{{ $obat['kategori'] ?? '-' }}</td>
                    <td class="text-center">{{ $obat['stok'] ?? 0 }}</td>
                    <td>Rp {{ number_format($obat['harga'] ?? 0, 0, ',', '.') }}</td>
                    <td class="text-center">
                        <a href="{{ route('obat.edit', $obat['id']) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('obat.destroy', $obat['id']) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">Belum ada data obat.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection