@extends('layouts.app')

@section('title', 'Data Ruangan')

@section('content')

{{-- Tambah (hanya admin) --}}
@if(auth()->check() && auth()->user()->isAdmin())
<div>
    <a href="{{ route('ruangan.create') }}" class="btn-add">Tambah</a>
</div>
@endif

{{-- TABLE --}}
<table class="table-clean">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama Ruangan</th>
            <th>Kode Ruangan</th>
            <th>Bangunan</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($items as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->nama_ruangan }}</td>
            <td>{{ $item->kode_ruangan }}</td>
            <td>{{ optional($item->bangunan)->nama_bangunan ?? 'Bangunan ' . $item->bangunan_id }}</td>

            <td>
                @if(auth()->check() && auth()->user()->isAdmin())

                <a href="{{ route('ruangan.edit', $item->id) }}" class="btn-edit">Edit</a>

                <form action="{{ route('ruangan.destroy', $item->id) }}"
                      method="POST"
                      style="display:inline-block"
                      onsubmit="return confirm('Yakin ingin menghapus?')">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn-delete">Hapus</button>
                </form>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
