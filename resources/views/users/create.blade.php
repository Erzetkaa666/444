@extends('layouts.app')

@section('title', 'Tambah User')

@section('content')
    <div class="card m-4">
        <div class="card-header">
            <h2 class="card-title text-center">Tambah User</h2>
        </div>

        <div class="card-body">
            <form action="{{ route('users.store') }}" method="POST">
                @csrf

                {{-- Nama --}}
                <div class="mb-3">
                    <label for="inputNama" class="form-label">Nama</label>
                    <input 
                        type="text" 
                        name="name" 
                        id="inputNama" 
                        class="form-control" 
                        value="{{ old('name') }}" 
                        required
                    >
                </div>

                {{-- Email --}}
                <div class="mb-3">
                    <label for="inputEmail" class="form-label">Email</label>
                    <input 
                        type="email" 
                        name="email" 
                        id="inputEmail" 
                        class="form-control" 
                        value="{{ old('email') }}" 
                        required
                    >
                </div>

                {{-- Password --}}
                <div class="mb-3">
                    <label for="inputPassword" class="form-label">Password</label>
                    <input 
                        type="password" 
                        name="password" 
                        id="inputPassword" 
                        class="form-control"
                        required
                    >
                </div>

                {{-- Role --}}
                <div class="mb-3">
                    <label for="inputRole" class="form-label">Role</label>
                    <select name="role" id="inputRole" class="form-control" required>
                        <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                </div>

                {{-- Tombol --}}
                <div class="mt-3">
                    <button type="submit" class="btn btn-success me-2">Submit</button>
                    <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">Batal</a>
                </div>

            </form>
        </div>
    </div>
@endsection
