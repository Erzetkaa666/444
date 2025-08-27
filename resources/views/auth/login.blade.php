@extends('layouts.app')

@section('title', 'Login')

@section('content')
<style>
    .flex-1.row {
        display: flex !important;
        justify-content: center;
        align-items: center;
        min-height: calc(100vh - 120px); 
        padding: 20px;
    }

    .col-6.mx-auto {
        width: 420px;
        max-width: 100%;
        margin: 0 auto;
    }

    .card {
        background-color: #171717;
        border: 1px solid #2b2b2b;
        border-radius: 12px;
        box-shadow: 0 6px 20px rgba(0,0,0,0.6);
        overflow: hidden;
    }

    .card.m-4 {
        margin: 1rem !important;
    }

    .card-header {
        background: linear-gradient(90deg, rgba(0,173,181,0.06), rgba(0,0,0,0));
        padding: 18px 20px;
        border-bottom: 1px solid rgba(255,255,255,0.03);
    }

    .card-title {
        margin: 0;
        font-size: 1.25rem;
        color: #ffffff;
    }

    .card-body {
        padding: 20px;
    }

    .form-label {
        display: block;
        margin-bottom: 6px;
        color: #cfcfcf;
        font-weight: 600;
    }

    .form-control {
        width: 100%;
        padding: 10px 12px;
        border-radius: 8px;
        border: 1px solid #333;
        background-color: #151515;
        color: #f1f1f1;
        transition: border-color 0.18s ease, box-shadow 0.18s ease, background 0.18s ease;
        font-size: 0.95rem;
    }

    .form-control::placeholder {
        color: #8f8f8f;
    }

    .form-control:focus {
        border-color: #00adb5;
        outline: none;
        box-shadow: 0 0 0 6px rgba(0,173,181,0.06);
    }

    .mb-2 {
        margin-bottom: 0.75rem !important;
    }

    .btn {
        display: inline-block;
        padding: 10px 14px;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        text-align: center;
        transition: transform 0.08s ease, box-shadow 0.12s ease, background 0.12s ease;
        border: none;
    }

    .btn-block {
        display: block;
        width: 100%;
    }

    .btn-success {
        background-color: #00adb5;
        color: #ffffff;
        box-shadow: 0 6px 14px rgba(0,173,181,0.12);
    }

    .btn-success:hover {
        transform: translateY(-2px);
        background-color: #00a3a8;
    }

    .btn-outline-secondary {
        background: transparent;
        color: #eaeaea;
        border: 1px solid #3a3a3a;
    }

    .btn-outline-secondary:hover {
        background: rgba(255,255,255,0.02);
        transform: translateY(-2px);
    }

    .me-2 {
        margin-right: 0.5rem !important;
    }

    .text-muted {
        color: #a6a6a6 !important;
        margin: 8px 0;
        font-size: 0.95rem;
    }

    @media (max-width: 480px) {
        .col-6.mx-auto {
            width: 92%;
            padding: 0 6px;
        }

        .card {
            border-radius: 10px;
        }

        .card-header,
        .card-body {
            padding: 14px;
        }
    }
    </style>

    <div class="flex-1 row">
        <div class="col-6 mx-auto">
            <div class="card m-4">
                <div class="card-header">
                    <h2 class="card-title text-center">Login</h2>
                </div>
                <div class="card-body">
                    <form action="{{ url('/login') }}" method="post">
                        @csrf
                        <div class="mb-2">
                            <label for="inputEmail" class="form-label">Email</label>
                            <input type="email" name="email" id="inputEmail" value="{{ old('email') }}"
                                class="form-control">
                        </div>
                        <div class="mb-2">
                            <label for="inputPassword" class="form-label">Password</label>
                            <input type="password" name="password" id="inputPassword" value="{{ old('password') }}"
                                class="form-control">
                        </div>
                        <div class="mb-2 row">
                            <div class="col-6 mx-auto">
                                <button type="submit" class="btn btn-block btn-success me-2">Submit</button>
                                <p class="text-muted">Atau</p>
                                <button type="reset" class="btn btn-outline-secondary me-2">Register</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
