@extends('layouts.app')

@section('title', 'Data Kategori')

@section('content')


@if(auth()->check() && auth()->user()->isAdmin())
<div>
    <a href="{{ route('kategori.create') }}" class="btn-add">Tambah</a>
</div>
@endif

<table class="table-clean">
    <thead>
        <tr class="table-secondary">
            <th>ID</th>
            <th>Nama Kategori</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($items as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->nama_kategori }}</td>
            <td>
                @if(auth()->check() && auth()->user()->isAdmin())
                <a href="{{ route('kategori.edit', $item->id) }}" class="btn-edit">Edit</a>
                <form action="{{ route('kategori.destroy', $item->id) }}" method="post" style="display:inline">
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
