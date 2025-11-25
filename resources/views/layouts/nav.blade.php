<<<<<<< HEAD
<nav>
    <style>
        nav {
            font-family: 'Inter', sans-serif;
            background: #4f46e5; /* ungu elegan */
            padding: 14px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        /* Menu kiri */
        .menu {
            display: flex;
            gap: 20px;
        }

        .menu a {
            text-decoration: none;
            color: #ffffff; /* ← TEKS PUTIH */
            font-weight: 600;
            font-size: 15px;
            padding: 8px 14px;
            border-radius: 8px;
            transition: 0.25s ease;
        }

        .menu a:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        /* Profile icon */
        .profile {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #4f46e5; /* icon ungu */
            font-weight: bold;
            cursor: pointer;
            transition: 0.25s ease;
            text-decoration: none;
        }

        .profile:hover {
            background: #e0e0ff;
            transform: translateY(-2px);
        }
    </style>

    <div class="menu">
        @guest
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}">Register</a>
        @endguest

        @auth
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <a href="{{ route('tanah.index') }}">Tanah</a>
            <a href="{{ route('bangunan.index') }}">Bangunan</a>
            <a href="{{ route('ruangan.index') }}">Ruangan</a>
            <a href="{{ route('kategori.index') }}">Kategori</a>
            <a href="{{ route('barang.index') }}">Barang</a>
        @endauth
    </div>

    {{-- Profile Icon / Dropdown --}}
    @guest
        <a href="{{ route('login') }}" class="profile">👤</a>
    @else
        <div class="dropdown">
            <button class="profile dropdown-toggle" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="border:none;background:transparent">👤</button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                <li class="px-3 py-2">
                    <div class="d-flex flex-column">
                        <strong>{{ Auth::user()->name }}</strong>
                        <small class="text-muted">{{ Auth::user()->email }}</small>
                    </div>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" onsubmit="return confirm('Yakin ingin logout?');">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    @endguest
=======
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">

        <a class="navbar-brand" href="#">Navbar</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                {{-- @guest --}}
                <li class="nav-item">
                    <a class="nav-link" href="#login">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#register">Register</a>
                </li>
                {{-- @endguest --}}

                {{-- @auth --}}
                <li class="nav-item">
                    <a class="nav-link" href="#user">Users</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('tanah.index') }}">Tanah</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#bangunan">Bangunan</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#ruangan">Ruangan</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#kategori">Kategori</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#barang">Barang</a>
                </li>
                {{-- @endauth --}}
            </ul>

            {{-- contoh form search --}}
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>

        </div>
    </div>
>>>>>>> eab064c8df27f26ca1055c166db3d6bbf0fff1ec
</nav>
