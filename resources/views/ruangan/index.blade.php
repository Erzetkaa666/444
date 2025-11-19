@extends('layouts.app')

@section('title', 'Data Ruangan')

@section('content')

<div>
    <a href="{{ route('ruangan.create') }}">Tambah</a>
</div>
<table class="table table-bordered mt-4 ">
    <thead>
        <tr class="table-secondary">
            <th >ID</th>
            <th >Nama Ruangan</th>
            <th >Kode Ruangan</th>
            <th >Bangunan</th>
            <th >Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($items as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->nama_ruangan }}</td>
            <td>{{ $item->kode_ruangan }}</td>
            <td>{{ optional($item->bangunan)->nama_bangunan ?? optional($item->bangunan)->name ?? 'Bangunan '.$item->bangunan_id }}</td>
            <td>
                <a href="{{ route('ruangan.edit', $item->id) }}">Edit</a>
                <form action="{{ route('ruangan.destroy', $item->id) }}" method="post" style="display:inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
