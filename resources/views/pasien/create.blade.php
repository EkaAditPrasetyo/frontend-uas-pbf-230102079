@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h3>Form Tambah Pasien</h3>
    <form action="{{ route('pasien.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Nama Pasien</label>
            <input type="text" name="nama" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control" rows="2" required></textarea>
        </div>

        <div class="mb-3">
            <label>Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-control" required>
                <option value="" disabled selected>Pilih Jenis Kelamin</option>
                <option value="L">L</option>
                <option value="P">P</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('pasien.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection