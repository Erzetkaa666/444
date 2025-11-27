@extends('layouts.app')

@section('title', 'Tambah Data Ruangan')

@section('content')
<div class="card m-4">
    <div class="card-header">
        <h2 class="card-title text-center">Tambah Data Ruangan</h2>
    </div>

    <div class="card-body">
        <form action="{{ route('ruangan.store') }}" method="POST">
            @csrf

            {{-- Nama Ruangan --}}
            <div class="mb-2">
                <label for="inputNamaRuangan" class="form-label">Nama Ruangan</label>
                <input type="text" 
                       name="nama_ruangan" 
                       id="inputNamaRuangan" 
                       value="{{ old('nama_ruangan') }}" 
                       class="form-control">
            </div>

            {{-- Kode Ruangan --}}
            <div class="mb-2">
                <label for="inputKodeRuangan" class="form-label">Kode Ruangan</label>
                <input type="text" 
                       name="kode_ruangan" 
                       id="inputKodeRuangan" 
                       value="{{ old('kode_ruangan') }}" 
                       class="form-control">
            </div>

            {{-- Pilih Bangunan --}}
            <div class="mb-2">
                <label for="selectBangunan" class="form-label">Pilih Bangunan</label>
                <select name="bangunan_id" id="selectBangunan" class="form-select">
                    <option value="">-- Pilih Bangunan --</option>

                    @foreach ($bangunans as $bangunan)
                        <option value="{{ $bangunan->id }}"
                            {{ old('bangunan_id') == $bangunan->id ? 'selected' : '' }}>
                            {{ $bangunan->nama_bangunan }} ({{ $bangunan->kode_bangunan }})
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Tombol --}}
            <div class="mt-3">
                <button type="submit" class="btn btn-success me-2">Submit</button>
                <a href="{{ route('ruangan.index') }}" class="btn btn-outline-secondary me-2">Batal</a>
            </div>

        </form>
    </div>
</div>
@endsection
