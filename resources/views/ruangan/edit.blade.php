@extends('layouts.app')

@section('title', 'Edit Data Ruangan')

@section('content')
    <div class="card m-4">
        <div class="card-header">
            <h2 class="card-title text-center">Edit Data</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('ruangan.update', $ruangan->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="mb-2">
                    <label for="inputNama" class="form-label">Nama Ruangan</label>
                    <input type="text" name="nama_ruangan" id="inputNama" value="{{ old('nama_ruangan', $ruangan->nama_ruangan) }}" class="form-control">
                </div>
                <div class="mb-2">
                    <label for="inputKode" class="form-label">Kode Ruangan</label>
                    <input type="text" name="kode_ruangan" id="inputKode" value="{{ old('kode_ruangan', $ruangan->kode_ruangan) }}" class="form-control">
                </div>
                <div class="mb-2">
                    <label for="selectBangunan" class="form-label">Pilih Bangunan</label>
                    <select name="bangunan_id" id="selectBangunan" class="form-select">
                        <option value="">-- Pilih Bangunan --</option>
                        @foreach ($bangunans as $bangunan)
                            <option value="{{ $bangunan->id }}" {{ old('bangunan_id', $ruangan->bangunan_id) == $bangunan->id ? 'selected' : '' }}>{{ $bangunan->nama_bangunan }} ({{ $bangunan->kode_bangunan }})</option>
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
