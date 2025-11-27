@extends('layouts.app')

@section('title', 'Data Bangunan')

@section('content')



{{-- BUTTON TAMBAH --}}
@if(auth()->check() && auth()->user()->isAdmin())
<div>
    <a href="{{ route('bangunan.create') }}" class="btn-add">Tambah</a>
</div>
@endif

{{-- TABLE --}}
<table class="table-clean mt-4">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama Bangunan</th>
            <th>Kode Bangunan</th>
            <th>Tanah</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($items as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->nama_bangunan }}</td>
            <td>{{ $item->kode_bangunan }}</td>
            <td>{{ optional($item->tanah)->nama_tanah }}</td>
            <td>
                @if(auth()->check() && auth()->user()->isAdmin())
                    <a href="{{ route('bangunan.edit', $item->id) }}" class="btn-edit">Edit</a>

                    <form action="{{ route('bangunan.destroy', $item->id) }}" 
                          method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete">
                            Hapus
                        </button>
                    </form>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
