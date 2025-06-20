@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Dashboard Pasien</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <a href="{{ route('pasien.create') }}" class="btn btn-success mb-3">+ Tambah Pasien</a>

    <form action="{{ route('pasien.index') }}" method="GET" class="mb-3 d-flex">
        <input type="text" name="search" class="form-control me-2" placeholder="Cari pasien" value="{{ request('search') }}">
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-search"></i> Cari
        </button>
    </form>

    <table class="table table-bordered table-striped">
        <thead class="table-dark text-center">
            <tr>
                <th>No</th>
                <th>Nama Pasien</th>
                <th>Alamat</th>
                <th>Tanggal Lahir</th>
                <th>Jenis Kelamin</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($dataPasien as $index => $pasien)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $pasien['nama'] ?? '-' }}</td>
                    <td>{{ $pasien['alamat'] ?? '-' }}</td>
                    <td class="text-center">{{ $pasien['tanggal_lahir'] ?? '-' }}</td>
                    <td class="text-center">{{ $pasien['jenis_kelamin'] ?? '-' }}</td>
                    <td class="text-center">
                        <a href="{{ route('pasien.edit', $pasien['id']) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('pasien.destroy', $pasien['id']) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">Belum ada data pasien.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection