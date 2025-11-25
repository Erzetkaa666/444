@extends('layouts.app')

@section('title', 'Tambah Data Barang')

@section('content')
    <div class="card m-4">
        <div class="card-header">
            <h2 class="card-title text-center">Tambah Data</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('barang.store') }}" method="post">
                @csrf
                <div class="mb-2">
                    <label for="inputNama" class="form-label">Nama Barang</label>
                    <input type="text" name="nama_barang" id="inputNama" value="{{ old('nama_barang') }}" class="form-control">
                </div>
                <div class="mb-2">
                    <label for="inputKode" class="form-label">Kode Inventaris</label>
                    <input type="text" name="kode_inventaris" id="inputKode" value="{{ old('kode_inventaris') }}" class="form-control">
                </div>
                <div class="mb-2">
                    <label for="selectKategori" class="form-label">Pilih Kategori</label>
                    <select name="kategori_id" id="selectKategori" class="form-select">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($kategoris as $kategori)
                            <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>{{ $kategori->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-2">
                    <label for="selectRuangan" class="form-label">Pilih Ruangan</label>
                    <select name="ruangan_id" id="selectRuangan" class="form-select">
                        <option value="">-- Pilih Ruangan --</option>
                        @foreach ($ruangans as $ruangan)
                            <option value="{{ $ruangan->id }}" {{ old('ruangan_id') == $ruangan->id ? 'selected' : '' }}>{{ $ruangan->nama_ruangan }} ({{ optional($ruangan->bangunan)->nama_bangunan }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-2">
                    <label for="inputTahun" class="form-label">Tahun Pengadaan</label>
                    <input type="number" name="tahun_pengadaan" id="inputTahun" value="{{ old('tahun_pengadaan') }}" class="form-control">
                </div>
                <div class="mb-2">
                    <label for="inputSumber" class="form-label">Sumber Dana</label>
                    <input type="text" name="sumber_dana" id="inputSumber" value="{{ old('sumber_dana') }}" class="form-control">
                </div>
                <div class="mb-2">
                    <label for="inputKondisi" class="form-label">Kondisi</label>
                    <input type="text" name="kondisi" id="inputKondisi" value="{{ old('kondisi') }}" class="form-control">
                </div>
                <div class="mb-2">
                    <button type="submit" class="btn btn-success me-2">Submit</button>
                    <button type="reset" class="btn btn-outline-secondary me-2">Batal</button>
                </div>
            </form>
        </div>
    </div>
@endsection
