# 🏢 Sistem Informasi Manajemen Aset (Asset Management System)

Sistem informasi berbasis Laravel untuk mengelola data aset perusahaan secara hierarki: dari **Tanah** → **Bangunan** → **Ruangan** → **Barang**. Dilengkapi dengan otentikasi pengguna, kontrol akses berbasis role (admin/user), logging aktivitas, dan dashboard statistik real-time.

---

## ✨ Fitur Utama

- 🏗️ **Manajemen Hierarki Aset**
  - Tanah (Lahan/Properti)
  - Bangunan (di atas Tanah)
  - Ruangan (di dalam Bangunan, dengan lantai)
  - Barang/Aset (di dalam Ruangan)
  - Kategori Barang

- 👥 **Otentikasi & Otorisasi**
  - Register/Login pengguna
  - Role-based access control (Admin/User)
  - Middleware perlindungan untuk operasi admin
  - Dashboard khusus user yang sudah login

- 📊 **Dashboard & Pelaporan**
  - Statistik total Tanah, Bangunan, Ruangan, Barang
  - Status aset (Aktif, Dalam Perbaikan, Rusak)
  - Log aktivitas terbaru dengan detail user & role
  - Activity log untuk tracking perubahan aset

- 🔐 **Admin Panel**
  - Manajemen user (view, edit, hapus)
  - Ubah role user (User ↔ Admin)
  - Hanya admin yang dapat create/edit/delete aset

- 🎨 **UI Modern**
  - Bootstrap 5 responsive design
  - Custom CSS dengan animasi smooth
  - Dropdown profile & logout confirmation
  - Alert feedback untuk success/error

---

## 🛠️ Tech Stack

- **Framework:** Laravel 11
- **Database:** MySQL/SQLite
- **Frontend:** Blade templates, Bootstrap 5, Custom CSS
- **Build Tool:** Vite
- **Testing:** Pest PHP + PHPUnit
- **Authentication:** Laravel Session-based Auth
- **ORM:** Eloquent

---

## 📋 Database Structure

```
Tanah (Properties)
  ├── id, nama, lokasi, luas, created_at, updated_at
  └── Relationships:
      └── hasMany Bangunan

Bangunan (Buildings)
  ├── id, tanah_id, nama, tahun_dibangun, luas, created_at, updated_at
  └── Relationships:
      ├── belongsTo Tanah
      └── hasMany Ruangan

Ruangan (Rooms)
  ├── id, bangunan_id, nama, lantai, luas, created_at, updated_at
  └── Relationships:
      ├── belongsTo Bangunan
      └── hasMany Barang

Barang (Assets/Items)
  ├── id, ruangan_id, kategori_id, nama, kondisi, deskripsi, created_at, updated_at
  └── Relationships:
      ├── belongsTo Ruangan
      ├── belongsTo Kategori
      └── hasMany Activity

Kategori (Categories)
  ├── id, nama, deskripsi, created_at, updated_at
  └── Relationships:
      └── hasMany Barang

User
  ├── id, name, email, password, role (admin/user), created_at, updated_at
  └── Relationships:
      └── hasMany Activity

Activity (Audit Log)
  ├── id, user_id, description, status, created_at, updated_at
  └── Relationships:
      └── belongsTo User
```

---

## 🚀 Installation & Setup

### Prerequisites
- PHP 8.2+
- Composer
- Node.js & npm
- MySQL/SQLite database

### Step 1: Clone Repository
```bash
git clone https://github.com/Erzetkaa666/444.git
cd 444
```

### Step 2: Install Dependencies
```bash
composer install
npm install
```

### Step 3: Setup Environment
```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env` dengan konfigurasi database Anda:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=aset_management
DB_USERNAME=root
DB_PASSWORD=
```

### Step 4: Run Migrations & Seeders
```bash
php artisan migrate
php artisan db:seed
```

Seeder akan membuat:
- 1 admin user: `admin@example.com` / `password`
- Sample data (Tanah, Bangunan, Ruangan, Barang, Kategori)

### Step 5: Build Assets
```bash
npm run dev
```
(untuk development dengan hot reload)

atau

```bash
npm run build
```
(untuk production)

### Step 6: Jalankan Server
```bash
php artisan serve
```

Akses aplikasi di `http://127.0.0.1:8000`

---

## 👤 Default Credentials

Setelah menjalankan seeder:

| Field | Value |
|-------|-------|
| Email | `admin@example.com` |
| Password | `password` |
| Role | Admin |

⚠️ **PENTING:** Ubah password default di production!

---

## 📝 Cara Menambah Admin Account

### Opsi 1: Via Seeder (Cepat)
```bash
php artisan db:seed --class=AdminUserSeeder
```

### Opsi 2: Via Tinker (Interaktif)
```bash
php artisan tinker
```
```php
use App\Models\User;
use Illuminate\Support\Facades\Hash;

User::create([
  'name' => 'Admin Baru',
  'email' => 'admin2@example.com',
  'password' => Hash::make('strongpassword'),
  'role' => 'admin'
]);
```

### Opsi 3: Via Admin Panel
1. Login sebagai admin
2. Buka `/users`
3. Edit user yang ingin dijadikan admin
4. Ubah role menjadi "Admin" → Simpan

### Opsi 4: Direct SQL
```sql
UPDATE users SET role = 'admin' WHERE email = 'user@example.com';
```

---

## 🔐 Role & Permissions

| Action | User | Admin |
|--------|------|-------|
| View Dashboard | ✅ | ✅ |
| View Resources (Read) | ✅ | ✅ |
| Create Resources | ❌ | ✅ |
| Edit Resources | ❌ | ✅ |
| Delete Resources | ❌ | ✅ |
| Manage Users | ❌ | ✅ |
| View Activity Log | ✅ | ✅ |

---

## 📂 Project Structure

```
444/
├── app/
│   ├── Http/
│   │   ├── Controllers/     # CRUD controllers
│   │   ├── Middleware/      # IsAdmin middleware
│   ├── Models/              # Eloquent models (User, Barang, Ruangan, etc.)
│   └── Providers/
├── database/
│   ├── migrations/          # Schema migrations
│   ├── factories/           # Model factories for testing
│   └── seeders/             # Database seeders
├── resources/
│   ├── css/
│   │   └── dashboard.css    # Dashboard styles
│   ├── js/                  # JavaScript files
│   └── views/               # Blade templates
│       ├── auth/            # Login/Register
│       ├── layouts/         # Main layout
│       ├── dashboard.blade.php
│       ├── users/           # User management (admin)
│       └── [tanah|bangunan|ruangan|barang|kategori]/
├── routes/
│   ├── web.php              # Web routes dengan auth & middleware
│   └── console.php
├── tests/
│   ├── Feature/
│   │   ├── AdminAccessTest.php
│   │   ├── UserManagementTest.php
│   │   └── RegisterTest.php
│   └── Unit/
├── vite.config.js
├── tailwind.config.js
├── package.json
├── composer.json
└── README.md
```

---

## 🧪 Testing

Jalankan test suite:

```bash
# Semua test
php artisan test

# Test spesifik
php artisan test --filter=AdminAccessTest
php artisan test --filter=UserManagementTest
php artisan test --filter=RegisterTest
```

---

## 📖 API Routes (Web Routes)

### Authentication
- `GET /login` - Form login
- `POST /login` - Submit login
- `GET /register` - Form register
- `POST /register` - Submit register
- `POST /logout` - Logout

### Dashboard
- `GET /dashboard` - Dashboard dengan statistik

### Resources (Tanah, Bangunan, Ruangan, Barang, Kategori)
- `GET /{resource}` - List semua (authenticated users)
- `GET /{resource}/create` - Form create (admin only)
- `POST /{resource}` - Store (admin only)
- `GET /{resource}/{id}/edit` - Form edit (admin only)
- `PUT /{resource}/{id}` - Update (admin only)
- `DELETE /{resource}/{id}` - Delete (admin only)

### User Management (Admin Only)
- `GET /users` - List users
- `GET /users/{id}/edit` - Edit user role
- `PUT /users/{id}` - Update user role
- `DELETE /users/{id}` - Delete user

---

## 🎯 Workflow Contoh

1. **Register Akun Baru**
   - Akses `/register`
   - Buat akun dengan role otomatis "User"
   - Login dengan kredensial baru

2. **Admin Create Aset** (hanya admin)
   - Login sebagai admin
   - Dashboard → View atau navigate ke resource
   - Create Tanah → Create Bangunan → Create Ruangan → Create Barang
   - Setiap perubahan tercatat di Activity Log

3. **User View Aset**
   - Login sebagai user
   - Lihat semua aset di dashboard & resource pages (read-only)
   - Tidak bisa create/edit/delete

4. **Admin Manage Users**
   - Login sebagai admin
   - Buka `/users`
   - Edit user role jika diperlukan
   - Hapus user jika diperlukan

---

## 🐛 Troubleshooting

### Dashboard CSS tidak muncul
```bash
# Clear cache
php artisan optimize:clear

# Rebuild assets
npm run build
# atau (dev)
npm run dev
```

### Migrasi gagal
```bash
# Reset database
php artisan migrate:reset
php artisan migrate
php artisan db:seed
```

### Login tidak bisa
- Pastikan `.env` DB_CONNECTION benar
- Pastikan migrations sudah dijalankan
- Check user ada di database: `php artisan tinker` → `User::all()`

---

## 📧 Contact & Support

- **Instagram:** @rzk.666
- **Discord:** Erzet#6222

---

## 📄 License

This project is open source and available under the MIT License.

---

**Made with ❤️ by [Erzetkaa666](https://github.com/Erzetkaa666)**


