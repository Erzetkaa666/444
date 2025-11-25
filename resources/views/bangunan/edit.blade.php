@extends('layouts.app')

@section('title', 'Edit Data Bangunan')

@section('content')
    <div class="card m-4">
        <div class="card-header">
            <h2 class="card-title text-center">Edit Data</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('bangunan.update', $bangunan->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="mb-2">
                    <label for="inputNama" class="form-label">Nama Bangunan</label>
                    <input type="text" name="nama_bangunan" id="inputNama" value="{{ old('nama_bangunan', $bangunan->nama_bangunan) }}" class="form-control">
                </div>
                <div class="mb-2">
                    <label for="inputKode" class="form-label">Kode Bangunan</label>
                    <input type="text" name="kode_bangunan" id="inputKode" value="{{ old('kode_bangunan', $bangunan->kode_bangunan) }}" class="form-control">
                </div>
                <div class="mb-2">
                    <label for="selectTanah" class="form-label">Pilih Tanah</label>
                    <select name="tanah_id" id="selectTanah" class="form-select">
                        <option value="">-- Pilih Tanah --</option>
                        @foreach ($tanahs as $tanah)
                            <option value="{{ $tanah->id }}" {{ old('tanah_id', $bangunan->tanah_id) == $tanah->id ? 'selected' : '' }}>{{ $tanah->nama_tanah }} ({{ $tanah->kode_tanah }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-2">
                    <button type="submit" class="btn btn-success me-2">Submit</button>
                    <button type="reset" class="btn btn-outline-secondary me-2">Batal</button>
                </div>
            </form>
        </div>
    </div>
@endsection
