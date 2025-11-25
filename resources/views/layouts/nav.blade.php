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
</nav>
