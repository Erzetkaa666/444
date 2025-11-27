@extends('layouts.app')

@section('title', 'Register')

@section('content')

<style>
/* ---------------------------------------------------
   REGISTER PAGE STYLE — identical to login style
--------------------------------------------------- */

.login-wrapper {
    max-width: 480px;
    margin: 50px auto;
}

.login-card {
    background: #ffffff;
    padding: 30px;
    border-radius: 18px;
    box-shadow: 0 6px 25px rgba(0,0,0,0.12);
    border: 1px solid #e5e7eb;
}

.login-title {
    font-size: 26px;
    font-weight: 700;
    color: #1E3A8A;
    text-align: center;
    margin-bottom: 10px;
}

.login-description {
    text-align: center;
    color: #64748b;
    margin-bottom: 20px;
    font-size: 14px;
}

/* Input */
.form-control-modern {
    width: 100%;
    border: 1px solid #cbd5e1;
    padding: 12px 14px;
    border-radius: 10px;
    font-size: 15px;
    transition: 0.25s;
}

.form-control-modern:focus {
    border-color: #8b5cf6;
    box-shadow: 0 0 0 3px rgba(139,92,246,0.25);
    outline: none;
}

/* Button */
.btn-primary-modern {
    width: 100%;
    background: #7C3AED;
    border: none;
    padding: 12px;
    font-size: 15px;
    border-radius: 10px;
    color: white;
    font-weight: 600;
    transition: 0.25s;
}

.btn-primary-modern:hover {
    background: #6D28D9;
    transform: translateY(-2px);
}

.btn-outline-modern {
    width: 100%;
    padding: 12px;
    font-size: 15px;
    border-radius: 10px;
    font-weight: 600;
    border: 2px solid #1E3A8A;
    color: #1E3A8A;
    background: transparent;
    transition: 0.25s;
}

.btn-outline-modern:hover {
    background: #1E3A8A;
    color: white;
    transform: translateY(-2px);
}

/* Link */
.text-small {
    text-align: center;
    margin-top: 12px;
    color: #475569;
}

.text-small a {
    text-decoration: none;
    color: #7C3AED;
    font-weight: 600;
}

.text-small a:hover {
    text-decoration: underline;
}
</style>

<div class="login-wrapper">
    <div class="login-card">

        <h2 class="login-title">Buat Akun Baru</h2>
        <p class="login-description">Daftar untuk mulai menggunakan aplikasi</p>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register') }}" method="post">
            @csrf

            <div class="mb-3">
                <label>Nama</label>
                <input type="text" name="name" value="{{ old('name') }}"
                       class="form-control-modern" placeholder="Masukkan nama...">
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}"
                       class="form-control-modern" placeholder="Masukkan email...">
            </div>

            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password"
                       class="form-control-modern" placeholder="Masukkan password...">
            </div>

            <div class="mb-3">
                <label>Konfirmasi Password</label>
                <input type="password" name="password_confirmation"
                       class="form-control-modern" placeholder="Masukkan ulang password...">
            </div>

            <button type="submit" class="btn-primary-modern">Register</button>

            <p class="text-small">
                Sudah punya akun?
                <a href="{{ route('login') }}">Login di sini</a>
            </p>
        </form>

    </div>
</div>

@endsection
