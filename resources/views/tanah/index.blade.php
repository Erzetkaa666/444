@extends('layouts.app')

@section('title', 'Data Tanah')

@section('content')



{{-- Tombol Tambah --}}
@if(auth()->check() && auth()->user()->isAdmin())
    <div>
        <a href="{{ route('tanah.create') }}" class="btn-add">Tambah</a>
    </div>
@endif


{{-- TABLE --}}
<table class="table-clean">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama Tanah</th>
            <th>Kode Tanah</th>
            <th>Luas(m2)</th>
            <th>No Sertifikat</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
    @foreach ($items as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->nama_tanah }}</td>
            <td>{{ $item->kode_tanah }}</td>
            <td>{{ $item->luas }}</td>
            <td>{{ $item->no_sertifikat }}</td>
            <td>
                @if(auth()->check() && auth()->user()->isAdmin())
                    <a href="{{ route('tanah.edit', $item->id) }}" class="btn-edit">Edit</a>

                    <form action="{{ route('tanah.destroy', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Yakin ingin menghapus?')" class="btn-delete">Hapus</button>
                    </form>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

@endsection
