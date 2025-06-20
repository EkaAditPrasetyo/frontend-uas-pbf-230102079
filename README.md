
## UAS PBF Frontend Eka Adit Prasetyo (230102079) TI 2D

Nama : Eka Adit Prasetyo (7)

NPM : 230102079

Kelas : TI 2D

## Cara Instal atau Membuat Project pada Laravel atau CodeIgniter
- Masuk ke folder yang untuk menyimpan folder projek, Kemudian masuk ke terminal cmd
- Untuk membuat project Code Igniter menggunakan cara seperti ini : composer create-project codeigniter4/appstarter backend_rumahsakit[NamaProjek]
- Untuk membuat project Laravel menggunakan cara seperti ini : composer create-project laravel/laravel frontend-uas-230102079[NamaProjek]
- Jika sudah terunduh semua kemudian masuk dengan cara : cd [Namaprojek] di terminal cmd
- Setelah masuk folder yang telah dibuat maka tinggal modifikasi

## Penerapan Database
CREATE DATABASE db_rumahsakit_[NIM_ANDA];
USE db_rumahsakit_[NIM_ANDA];

CREATE TABLE pasien (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(100),
  alamat TEXT,
  tanggal_lahir DATE,
  jenis_kelamin ENUM('L', 'P')
);

CREATE TABLE obat (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama_obat VARCHAR(100),
  kategori VARCHAR(50),
  stok INT,
  harga DECIMAL(10,2)
);

## Struktur Proyek
Ini adalah aplikasi Laravel standar yang memiliki struktur folder sebagai berikut:

- `app/` - Berisi file logic aplikasi seperti controller dan model.
- `routes/web.php` - Berisi route aplikasi.
- `resources/views/` - Berisi tampilan berbasis Blade.
- `public/` - Root direktori untuk akses web.
- `.env` - File konfigurasi lingkungan.
- `artisan` - Command-line Laravel tool.

## Fitur yang Tersedia
1. **Manajemen Obat**
   - Melihat daftar obat
   - Menambahkan obat baru
   - Mengedit data obat
   - Menghapus data obat

2. **Manajemen Pasien**
    - Melihat daftar pasien
   - Menambahkan pasien baru
   - Mengedit data pasien
   - Menghapus data pasien

3. **Adanya fitur search untuk mencari data obat/data pasien**
