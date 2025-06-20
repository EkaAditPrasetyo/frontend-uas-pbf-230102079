@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h3>Form Tambah Obat</h3>
    <form action="{{ route('obat.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Nama Obat</label>
            <input type="text" name="nama_obat" class="form-control">
        </div>

        <div class="mb-3">
            <label>Kategori</label>
            <input type="text" name="kategori" class="form-control">
        </div>

        <div class="mb-3">
            <label>Stok</label>
            <input type="number" name="stok" class="form-control">
        </div>

        <div class="mb-3">
            <label>Harga</label>
            <input type="number" name="harga" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('obat.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection