# 🛒 Toko Online CodeIgniter 4

Proyek ini adalah platform toko online yang dibangun menggunakan [CodeIgniter 4](https://codeigniter.com/). Sistem ini menyediakan beberapa fungsionalitas untuk toko online, termasuk manajemen produk, keranjang belanja, sistem checkout dengan integrasi RajaOngkir, dan sistem transaksi.

## 📋 Daftar Isi

- [Fitur](#fitur)
- [Persyaratan Sistem](#persyaratan-sistem)
- [Instalasi](#instalasi)
- [Struktur Proyek](#struktur-proyek)
- [Teknologi yang Digunakan](#teknologi-yang-digunakan)

## ✨ Fitur

### Katalog Produk
- Tampilan produk dengan gambar
- Pencarian dan filter produk
- Manajemen produk (CRUD) untuk admin
- Export data produk ke PDF

### Keranjang Belanja
- Tambah/hapus produk dari keranjang
- Update jumlah produk
- Mengosongkan keranjang
- Tampilan real-time total harga

### Sistem Checkout & Transaksi
- Proses checkout dengan data pengiriman
- Integrasi dengan API RajaOngkir untuk:
  - Pencarian lokasi tujuan pengiriman
  - Perhitungan biaya ongkir otomatis
  - Pilihan layanan kurir (JNE, dsb)
- Perhitungan total otomatis dengan biaya ongkir
- Penyimpanan data transaksi ke database

### Sistem Autentikasi
- Login pengguna dengan role (admin/guest)
- Logout pengguna
- Session management

### Panel Admin
- Manajemen produk (Create, Read, Update, Delete)
- View detail produk
- QR Code untuk produk
- Export produk ke PDF

### UI Responsif
- Template NiceAdmin Bootstrap 5
- Responsive design
- Components Bootstrap

## 🔧 Persyaratan Sistem

- PHP >= 8.2
- MySQL/MariaDB
- Composer
- XAMPP (untuk development)
- Web server (Apache)

## 📦 Instalasi

### Untuk Perangkat Baru (Clone dari GitHub)

1. **Clone repository**
   ```bash
   git clone https://github.com/Addnta/Belajar-ci4-tugas.git
   cd Belajar-ci4-tugas
   ```

2. **Install dependensi PHP**
   ```bash
   composer install
   ```

3. **Siapkan template NiceAdmin**
   - Download dari [Google Drive](https://drive.google.com/file/d/1VwpEmBEcu0HccuoZG7h3HoKooIonZZ7H/view?usp=sharing)
   - Copy folder `vendor` dari NiceAdmin ke `public/NiceAdmin/assets`

4. **Konfigurasi Database**
   - Buka XAMPP dan start Apache & MySQL
   - Buat database baru di phpMyAdmin dengan nama `ci4`
   - Copy file `.env` dan sesuaikan konfigurasi database jika diperlukan

5. **Setup Database**
   ```bash
   php spark migrate
   php spark db:seed ProductSeeder
   php spark db:seed UserSeeder
   ```

6. **Jalankan Aplikasi**
   ```bash
   php spark serve
   ```

7. **Akses Aplikasi**
   - Buka browser dan akses `http://localhost:8080`
   - Login dengan akun admin atau guest

## 🏗️ Struktur Proyek

```
Myproject/
├── app/
│   ├── Controllers/          # Logika aplikasi
│   │   ├── AuthController.php
│   │   ├── ProdukController.php
│   │   ├── TransaksiController.php
│   │   └── Api/
│   ├── Models/               # Model database
│   │   ├── ProductModel.php
│   │   ├── UserModel.php
│   │   ├── TransactionModel.php
│   │   └── TransactionDetailModel.php
│   ├── Views/                # Template UI
│   │   ├── v_home.php
│   │   ├── v_produk.php
│   │   ├── v_keranjang.php
│   │   ├── v_checkout.php
│   │   ├── v_login.php
│   │   ├── layout.php
│   │   └── components/
│   ├── Services/             # Business logic
│   │   └── RajaOngkirService.php
│   ├── Config/
│   │   ├── Routes.php        # Routing configuration
│   │   └── Database.php
│   ├── Database/
│   │   ├── Migrations/       # Database migrations
│   │   └── Seeds/            # Database seeders
│   └── Filters/
│       └── Auth.php
├── public/
│   ├── index.php
│   ├── img/                  # Gambar produk
│   └── NiceAdmin/            # Template admin
├── vendor/                   # Composer dependencies
├── tests/
│   └── api/                  # API testing files
├── .env                      # Environment configuration
├── composer.json
└── README.md
```

## 🛠️ Teknologi yang Digunakan

- **Backend Framework**: CodeIgniter 4.7.2
- **Database**: MySQL/MariaDB
- **Frontend Template**: NiceAdmin (Bootstrap 5)
- **Frontend Library**: Select2, jQuery
- **External API**: RajaOngkir API (Shipping Cost)
- **PDF Export**: DOMPDF
- **Server**: Apache (XAMPP)

## 📝 Akun Testing

Setelah menjalankan seeder, gunakan akun berikut untuk testing:

### Admin
- Username: `admin` (atau sesuai di UserSeeder)
- Password: Lihat di database

### Guest
- Username: `guest` (atau sesuai di UserSeeder)
- Password: Lihat di database

## 📚 Dokumentasi API

### RajaOngkir Integration

Project ini mengintegrasikan RajaOngkir API untuk:

1. **Search Destination** - Mencari lokasi tujuan pengiriman
   - Endpoint: `GET /ajax/destinations`
   - Parameter: `q` (keyword pencarian)

2. **Calculate Cost** - Menghitung biaya pengiriman
   - Endpoint: `GET /ajax/costs`
   - Parameter: `destination` (ID lokasi tujuan)

Untuk setup, tambahkan API Key RajaOngkir ke file `.env`:
```env
RAJAONGKIR_API_KEY=your_api_key_here
RAJAONGKIR_BASE_URL=https://rajaongkir.komerce.id/api/v1/
```

## 🚀 Workflow Git

Untuk development berkelanjutan:

1. **Sebelum mulai coding**
   ```bash
   git pull origin main
   ```

2. **Setelah selesai coding**
   ```bash
   git add .
   git commit -m "Deskripsi perubahan"
   git push origin main
   ```

## 📧 Kontak & Lisensi

Proyek ini dibuat sebagai tugas pembelajaran CodeIgniter 4.

---

**Last Updated**: 7 Juli 2026
