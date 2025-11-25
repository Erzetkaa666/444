@extends('layouts.app')

@section('title', 'Edit Data Kategori')

@section('content')
    <div class="card m-4">
        <div class="card-header">
            <h2 class="card-title text-center">Edit Data</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('kategori.update', $kategori->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="mb-2">
                    <label for="inputNama" class="form-label">Nama Kategori</label>
                    <input type="text" name="nama_kategori" id="inputNama" value="{{ old('nama_kategori', $kategori->nama_kategori) }}" class="form-control">
                </div>
                <div class="mb-2">
                    <button type="submit" class="btn btn-success me-2">Submit</button>
                    <button type="reset" class="btn btn-outline-secondary me-2">Batal</button>
                </div>
            </form>
        </div>
    </div>
@endsection
