<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

html, body {
    height: 100%;
}

body {
    background-color: #121212;
    color: #f1f1f1;
    line-height: 1.4;
    -webkit-font-smoothing:antialiased;
    -moz-osx-font-smoothing:grayscale;
}

nav {
    background-color: #1e1e1e;
    color: #ffffff;
    width: 100%;
    position: sticky; 
    top: 0;
    z-index: 1100;
    box-shadow: 0 2px 8px rgba(0,0,0,0.6);
}

nav > div {
    max-width: 1200px;
    margin: 0 auto;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    padding: 10px 18px;
}

nav > div > div:first-child,
nav > div > div {
    display: flex;
    align-items: center;
    gap: 12px;
    flex-wrap: wrap;
}

nav a {
    color: #e9e9e9;
    text-decoration: none;
    padding: 8px 12px;
    border-radius: 8px;
    font-weight: 600;
    transition: background 0.18s ease, color 0.12s ease, transform 0.08s ease;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

nav a:hover,
nav a:focus {
    background-color: rgba(0,173,181,0.08);
    color: #00e6ef;
    transform: translateY(-1px);
    outline: none;
    text-decoration: none;
}

nav a[href*="login"],
nav a[href*="#register"] {
    border: 1px solid rgba(255,255,255,0.04);
    background-color: rgba(255,255,255,0.02);
}

nav a.active,
nav a[aria-current="page"] {
    background: linear-gradient(90deg, rgba(0,173,181,0.12), rgba(0,173,181,0.02));
    color: #00d1d9;
    box-shadow: 0 6px 16px rgba(0,173,181,0.06);
}

nav img {
    border-radius: 50%;
    display: inline-block;
    vertical-align: middle;
}

nav .nav-right {
    margin-left: auto;
    display: flex;
    align-items: center;
    gap: 12px;
}

@media (max-width: 860px) {
    nav > div {
        padding: 10px 12px;
    }

    nav a {
        padding: 7px 9px;
        font-size: 0.95rem;
    }
}

@media (max-width: 520px) {
    nav > div {
        flex-direction: column;
        align-items: stretch;
        gap: 6px;
    }

    nav > div > div:first-child,
    nav > div > div {
        justify-content: center;
    }

    nav a {
        display: block;
        width: 100%;
        text-align: center;
        padding: 10px 12px;
    }
}
.nav {
    transform: none !important;
    left: auto !important;
}

a:focus {
    box-shadow: 0 0 0 4px rgba(0,173,181,0.08);
    border-radius: 8px;
}
</style>

<nav>
    <div>
        {{-- @guest --}} 
            <a href="{{ route('login') }}">Login</a>   
            <a href="#register">Register</a>   
        {{-- @endguest
        @auth --}} 
            <a href="#user">Users</a>
            <a href="{{ route('tanah.index') }}">Tanah</a>
            <a href="{{ route('bangunan.index') }}">Bangunan</a>
            <a href="#ruangan">Ruangan</a>
            <a href="#kategori">Kategori</a>
            <a href="#barang">Barang</a>
        {{-- @endauth --}} 
    </div>
</nav>
