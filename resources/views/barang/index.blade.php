@extends('layouts.app')

@section('title', 'Data Barang')

@section('content')


@if(auth()->check() && auth()->user()->isAdmin())
<div>
    <a href="{{ route('barang.create') }}" class="btn-add">Tambah</a>
</div>
@endif

<table class="table-clean">
    <thead>
        <tr class="table-secondary">
            <th>ID</th>
            <th>Nama Barang</th>
            <th>Kode Inventaris</th>
            <th>Kategori</th>
            <th>Ruangan</th>
            <th>Tahun</th>
            <th>Sumber Dana</th>
            <th>Kondisi</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($items as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->nama_barang }}</td>
            <td>{{ $item->kode_inventaris }}</td>
            <td>{{ optional($item->kategori)->nama_kategori }}</td>
            <td>{{ optional($item->ruangan)->nama_ruangan }}</td>
            <td>{{ $item->tahun_pengadaan }}</td>
            <td>{{ $item->sumber_dana }}</td>
            <td>{{ $item->kondisi }}</td>
            <td>
                @if(auth()->check() && auth()->user()->isAdmin())
                <a href="{{ route('barang.edit', $item->id) }}" class="btn-edit" >Edit</a>
                <form action="{{ route('barang.destroy', $item->id) }}" method="post" style="display:inline">
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
