# Thrift Shop - Panduan Setup

Proyek Laravel Thrift Shop - Toko Online Thrift Fashion

## Persyaratan Sistem
- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL/MariaDB
- Web Server (Apache/Nginx) atau Laragon/XAMPP

## Langkah Setup

### 1. Persiapan
- Pastikan PHP, Composer, Node.js, dan MySQL sudah terinstall
- Copy seluruh folder proyek ini ke folder web server Anda (misal: htdocs atau www)

### 2. Install Dependencies PHP
```bash
composer install
```

### 3. Install Dependencies JavaScript
```bash
npm install
npm run build
```

### 4. Setup Environment
- Copy file `.env.example` menjadi `.env`
- Edit file `.env` dan sesuaikan konfigurasi database:

```env
APP_NAME="Thrift Shop"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost/thrift-shop

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=thrift_shop
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Generate Application Key
```bash
php artisan key:generate
```

### 6. Setup Database
- Buat database baru di MySQL dengan nama `thrift_shop`
- Import file `database_backup.sql` (jika tersedia) atau jalankan migration:

```bash
php artisan migrate
php artisan db:seed
```

### 7. Setup Storage Link
```bash
php artisan storage:link
```

### 8. Cache Clear (Opsional)
```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
```

### 9. Jalankan Aplikasi
```bash
php artisan serve
```

Atau jika menggunakan Laragon/XAMPP, akses melalui browser:
`http://localhost/thrift-shop/public`

## Akun Default

### Admin
- Email: admin@thriftshop.com
- Password: admin123

### Customer (contoh)
Dapat register sendiri melalui aplikasi

## Troubleshooting

### Error: "Class not found"
```bash
composer dump-autoload
```

### Error: "Permission denied"
Pastikan folder `storage` dan `bootstrap/cache` memiliki permission write

### Error: "SQLSTATE[HY000] [1045] Access denied"
Periksa konfigurasi database di file `.env`

### Error: "The only supported ciphers are AES-128-CBC and AES-256-CBC"
```bash
php artisan key:generate
```

## Struktur Folder
```
thrift-shop/
├── app/                 # Kode aplikasi
├── bootstrap/           # Bootstrap Laravel
├── config/              # Konfigurasi
├── database/            # Migration & Seeders
├── public/              # Assets publik
├── resources/           # Views & Assets
├── routes/              # Route definitions
├── storage/             # File storage
├── tests/               # Unit tests
├── vendor/              # Dependencies PHP
├── .env.example         # Template environment
├── artisan             # Laravel CLI
├── composer.json       # Dependencies PHP
├── package.json        # Dependencies JS
└── README.md           # Dokumentasi ini
```

## Fitur Aplikasi
- ✅ Manajemen Produk (CRUD)
- ✅ Sistem Keranjang Belanja
- ✅ Sistem Checkout & Pembayaran
- ✅ Manajemen Order
- ✅ Dashboard Admin
- ✅ Authentication (Login/Register)
- ✅ Responsive Design dengan Bootstrap

## Teknologi
- Laravel 12.x
- MySQL
- Bootstrap 5
- Font Awesome
- Chart.js
- Vite (Asset bundling)

## Support
Jika ada pertanyaan, silakan hubungi developer.