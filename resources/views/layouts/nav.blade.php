<nav>
<style>
/* ---------------------------------------------------
   NAVBAR CORPORATE THEME (Slate Professional)
--------------------------------------------------- */
nav {
    font-family: 'Inter', sans-serif;
    background: #1E293B; /* Slate-800 */
    padding: 14px 30px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 2px 12px rgba(0,0,0,0.1);
    position: sticky;
    top: 0;
    z-index: 100;
    border-bottom: 1px solid rgba(255,255,255,0.06);
}

/* ---------------------------------------------------
   MENU
--------------------------------------------------- */
.menu {
    display: flex;
    gap: 18px;
}

.menu a {
    text-decoration: none;
    color: #CBD5E1; /* Slate-300 */
    font-weight: 500;
    font-size: 15px;
    padding: 8px 14px;
    border-radius: 8px;
    transition: 0.25s ease;
    position: relative;
}

/* Active menu underline */
.menu a.active::after {
    content: "";
    position: absolute;
    bottom: -4px;
    left: 20%;
    width: 60%;
    height: 3px;
    background: #38BDF8; /* Sky-400 */
    border-radius: 10px;
    opacity: 1;
    transform: scaleX(1);
    transition: 0.3s ease;
}

/* Hover */
.menu a:hover {
    background: rgba(255,255,255,0.12);
    transform: translateY(-2px);
    color: #fff;
}

/* ---------------------------------------------------
   PROFILE AVATAR
--------------------------------------------------- */
.profile {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: #334155; /* Slate-700 */
    color: #E2E8F0; /* Slate-200 */
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    font-size: 15px;
    cursor: pointer;
    transition: 0.25s ease;
    border: 1px solid rgba(255,255,255,0.08);
}

.profile:hover {
    background: #475569; /* Slate-600 */
    transform: translateY(-2px);
}

.profile:focus {
    box-shadow: none !important;
}

/* ---------------------------------------------------
   DROPDOWN
--------------------------------------------------- */
.dropdown-menu {
    border-radius: 14px;
    padding: 10px 0;
    border: none;
    min-width: 240px;
    box-shadow: 0 10px 24px rgba(0,0,0,0.12);
    animation: fadeDown 0.2s ease forwards;
    transform-origin: top right;
    opacity: 0;
}

@keyframes fadeDown {
    0% { opacity: 0; transform: translateY(-6px) scale(0.98); }
    100% { opacity: 1; transform: translateY(0) scale(1); }
}

.dropdown-item {
    padding: 10px 18px;
    font-size: 15px;
    transition: 0.2s ease;
    border-radius: 6px;
}

.dropdown-item:hover {
    background: #F1F5F9;
}

hr.dropdown-divider {
    margin: 6px 0;
    opacity: 0.15;
}

.dropdown-item.text-danger:hover {
    background: #FEE2E2;
    color: #B91C1C;
}
</style>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const profile = document.querySelector(".profile");

    @auth
        const name = "{{ Auth::user()->name }}".trim();
        const initial = name.charAt(0).toUpperCase();
        if (profile) profile.textContent = initial;
    @endauth
});
</script>

<!-- NAV CONTENT -->
<div class="menu">
    @guest
        <a href="{{ route('login') }}" class="{{ request()->routeIs('login') ? 'active' : '' }}">Login</a>
        <a href="{{ route('register') }}" class="{{ request()->routeIs('register') ? 'active' : '' }}">Register</a>
    @endguest

    @auth
        <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>

        @if(auth()->user()->isAdmin())
            <a href="{{ route('users.index') }}" class="{{ request()->routeIs('users.*') ? 'active' : '' }}">Users</a>
        @endif

        <a href="{{ route('tanah.index') }}" class="{{ request()->routeIs('tanah.*') ? 'active' : '' }}">Tanah</a>
        <a href="{{ route('bangunan.index') }}" class="{{ request()->routeIs('bangunan.*') ? 'active' : '' }}">Bangunan</a>
        <a href="{{ route('ruangan.index') }}" class="{{ request()->routeIs('ruangan.*') ? 'active' : '' }}">Ruangan</a>
        <a href="{{ route('kategori.index') }}" class="{{ request()->routeIs('kategori.*') ? 'active' : '' }}">Kategori</a>
        <a href="{{ route('barang.index') }}" class="{{ request()->routeIs('barang.*') ? 'active' : '' }}">Barang</a>
    @endauth
</div>

@guest
    <a href="{{ route('login') }}" class="profile">👤</a>
@else
    <div class="dropdown">
        <button class="profile dropdown-toggle" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="border:none;background:transparent"></button>

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
