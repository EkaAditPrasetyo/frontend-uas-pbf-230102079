@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h3>Edit Data Obat</h3>
    <form action="{{ route('obat.update', $obat['id']) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama Obat</label>
            <input type="text" name="nama_obat" value="{{ $obat['nama_obat'] }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Kategori</label>
            <input type="text" name="kategori" value="{{ $obat['kategori'] }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Stok</label>
            <input type="number" name="stok" value="{{ $obat['stok'] }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Harga</label>
            <input type="number" name="harga" value="{{ $obat['harga'] }}" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('obat.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection