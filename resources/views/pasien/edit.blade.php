@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h3>Edit Data Pasien</h3>

    <form action="{{ route('pasien.update', $pasien['id']) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" value="{{ $pasien['nama'] ?? '' }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control">{{ $pasien['alamat'] ?? '' }}</textarea>
        </div>

        <div class="mb-3">
            <label>Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" value="{{ $pasien['tanggal_lahir'] ?? '' }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-control" required>
                <option value="" disabled selected>Pilih Jenis Kelamin</option>
                <option value="L">L</option>
                <option value="P">P</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('pasien.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection