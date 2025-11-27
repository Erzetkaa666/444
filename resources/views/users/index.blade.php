@extends('layouts.app')

@section('title', 'Data Users')

@section('content')

{{-- Tambah User (hanya admin) --}}
@if(auth()->check() && auth()->user()->isAdmin())
<div>
    <a href="{{ route('users.create') }}" class="btn-add">Tambah</a>
</div>
@endif

{{-- TABLE --}}
<table class="table-clean">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Role</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($users as $user)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>

            <td>
                @if($user->isAdmin())
                    Admin
                @else
                    User
                @endif
            </td>

            <td>
                {{-- Aksi hanya untuk admin --}}
                @if(auth()->check() && auth()->user()->isAdmin())

                <a href="{{ route('users.edit', $user->id) }}" class="btn-edit">Edit</a>

                @if(auth()->user()->id !== $user->id) {{-- admin tidak boleh hapus dirinya sendiri --}}
                <form action="{{ route('users.destroy', $user->id) }}"
                      method="POST"
                      style="display:inline-block"
                      onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn-delete">Hapus</button>
                </form>
                @endif

                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
