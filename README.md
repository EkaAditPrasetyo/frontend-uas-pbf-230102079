
# UAS PBF Eka Adit Prasetyo (230102079) TI 2D

Nama : Eka Adit Prasetyo (7)

NPM : 230102079

Kelas : TI 2D

# Cara Instal atau Membuat Project pada Laravel atau CodeIgniter
Saya menggunakan Laravel (v10.3.3)
- Masuk ke folder yang untuk menyimpan folder projek, Kemudian masuk ke terminal cmd
- Untuk membuat project Code Igniter menggunakan cara seperti ini : composer create-project codeigniter4/appstarter backend_rumahsakit[NamaProjek]
- Untuk membuat project Laravel menggunakan cara seperti ini : composer create-project laravel/laravel frontend-uas-230102079[NamaProjek]
- Jika sudah terunduh semua kemudian masuk dengan cara : cd [Namaprojek] di terminal cmd
- Setelah masuk folder yang telah dibuat maka tinggal modifikasi

# Penerapan Database
``` sh
CREATE DATABASE db_rumahsakit_230102079;
USE db_rumahsakit_230102079;

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
```

# Struktur Proyek
Ini adalah aplikasi Laravel standar yang memiliki struktur folder sebagai berikut:

- `app/` - Berisi file logic aplikasi seperti controller dan model.
- `routes/web.php` - Berisi route aplikasi.
- `resources/views/` - Berisi tampilan berbasis Blade.
- `public/` - Root direktori untuk akses web.
- `.env` - File konfigurasi lingkungan.
- `artisan` - Command-line Laravel tool.

- Isi Controller di Laravel(Frontend)
  - Untuk ObatController.php
    
``` sh
<?php
//Eka Adit Prasetyo
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class ObatController extends Controller
{
   public function index(Request $request)//index
    {
        $search = $request->query('search');

        $response = Http::get('http://localhost:8080/obat');

        if ($response->successful()) {
            $json = $response->json();
            $dataObat = $json['data'] ?? []; 

        // Filter lokal berdasarkan input pencarian
            if ($search) {
                $search = strtolower($search);
                $dataObat = array_filter($dataObat, function ($obat) use ($search) {
                    return str_contains(strtolower($obat['nama_obat']), $search) ||
                        str_contains(strtolower($obat['kategori']), $search);
                });
            }

        } else {
            $dataObat = [];
        }

        return view('obat.index', compact('dataObat'));
    }


    public function create()//buat
    {
        return view('obat.create');
    }

    public function store(Request $request)//simpan
    {
        $validated = $request->validate([
            'nama_obat' => 'required',
            'kategori' => 'required',
            'stok' => 'required|integer',
            'harga' => 'required|numeric',
        ]);

        $response = Http::post('http://localhost:8080/obat', $validated);

        return $response->successful()
            ? redirect()->route('obat.index')->with('success', 'Data berhasil ditambahkan.')
            : back()->with('error', 'Gagal menambahkan data.');
    }

    public function edit($id)//edit
    {
        $response = Http::get("http://localhost:8080/obat/$id");

        if ($response->successful()) {
            $obat = $response->json()['data']; // Ambil bagian data
            return view('obat.edit', compact('obat'));
        }

        return redirect()->route('obat.index')->with('error', 'Data tidak ditemukan.');
    }


    public function update(Request $request, $id)//simpan perubahan
    {
        $validated = $request->validate([
            'nama_obat' => 'required',
            'kategori' => 'required',
            'stok' => 'required|integer',
            'harga' => 'required|numeric',
        ]);

        $response = Http::put("http://localhost:8080/obat/$id", $validated);

        return $response->successful()
            ? redirect()->route('obat.index')->with('success', 'Data berhasil diubah.')
            : back()->with('error', 'Gagal mengubah data.');
    }

    public function destroy($id)//hapus
    {
        $response = Http::delete("http://localhost:8080/obat/$id");

        return $response->successful()
            ? redirect()->route('obat.index')->with('success', 'Data berhasil dihapus.')
            : back()->with('error', 'Gagal menghapus data.');
    }
}
```
- Untuk PasienController.php
  
``` sh
<?php
//Eka Adit Prasetyo
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class PasienController extends Controller
{
   public function index(Request $request) //index
    {
        $search = $request->query('search');

       $response = Http::get('http://localhost:8080/pasien');

    if ($response->successful()) {
        $json = $response->json();
        $dataPasien = $json['data'] ?? [];

    // Filter lokal berdasarkan input pencarian
        if ($search) {
            $search = strtolower($search);
            $dataPasien = array_filter($dataPasien, function ($pasien) use ($search) {
                return str_contains(strtolower($pasien['nama']), $search) ||
                       str_contains(strtolower($pasien['jenis_kelamin']), $search);
            });
        }

    } else {
        $dataObat = [];
    }
    return view('pasien.index', compact('dataPasien'));
    }

    public function create() //buat 
    {
        return view('pasien.create');
    }

    public function store(Request $request)//simpan
    {
        // Validasi input jika perlu
        $validated = $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
        ]);

        // Kirim data ke API CI4
        $response = Http::post('http://localhost:8080/pasien', $validated);

        return $response->successful()
            ? redirect()->route('pasien.index')->with('success', 'Data berhasil ditambahkan.')
            : back()->with('error', 'Gagal menambahkan data.');
    }

    public function edit($id)//ubah
    {
        $response = Http::get("http://localhost:8080/pasien/$id");

        if ($response->successful()) {
            $pasien = $response->json()['data']; // Ambil bagian data
            return view('pasien.edit', compact('pasien'));
        }

        return redirect()->route('pasien.index')->with('error', 'Data tidak ditemukan.');
    }


    public function update(Request $request, $id)//simpan perubahan
    {
        $validated = $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
        ]);

        $response = Http::put("http://localhost:8080/pasien/$id", $validated);

        return $response->successful()
            ? redirect()->route('pasien.index')->with('success', 'Data berhasil diubah.')
            : back()->with('error', 'Gagal mengubah data.');
    }

    public function destroy($id)//hapus
    {
        $response = Http::delete("http://localhost:8080/pasien/$id");

        return $response->successful()
            ? redirect()->route('pasien.index')->with('success', 'Data berhasil dihapus.')
            : back()->with('error', 'Gagal menghapus data.');
    }
}
```
- Isi Routes(web.php) di Laravel(Frontend)

```sh
<?php
//Eka Adit Prasetyo
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ObatController;
use App\Http\Controllers\PasienController;

// ROUTE UNTUK OBAT
Route::get('/obat', [ObatController::class, 'index'])->name('obat.index'); // dashboard
Route::get('/obat/create', [ObatController::class, 'create'])->name('obat.create'); // form tambah
Route::post('/obat', [ObatController::class, 'store'])->name('obat.store'); // simpan
Route::get('/obat/{id}/edit', [ObatController::class, 'edit'])->name('obat.edit'); // form edit
Route::put('/obat/{id}', [ObatController::class, 'update'])->name('obat.update'); // simpan perubahan
Route::delete('/obat/{id}', [ObatController::class, 'destroy'])->name('obat.destroy'); // hapus

// ROUTE UNTUK PASIEN
Route::get('/pasien', [PasienController::class, 'index'])->name('pasien.index'); // dashboard
Route::get('/pasien/create', [PasienController::class, 'create'])->name('pasien.create'); // form tambah
Route::post('/pasien', [PasienController::class, 'store'])->name('pasien.store'); // simpan
Route::get('/pasien/{id}/edit', [PasienController::class, 'edit'])->name('pasien.edit'); // form edit
Route::put('/pasien/{id}', [PasienController::class, 'update'])->name('pasien.update'); // simpan perubahan
Route::delete('/pasien/{id}', [PasienController::class, 'destroy'])->name('pasien.destroy'); // hapus

```
  
# Fitur yang Tersedia
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

# Menjalankan Proyek
1. Pada menu terminal di VsCode
   ``` sh
   php artisan serve
   ```
   Kemudian enter dan memunculkan link [http://127.0.0.1:8000]

2. Dengan menggunakan link tersebut akan diarahkan ke browser, kemudian beri /obat atau /pasien diujung link. Contoh http://127.0.0.1:8000/obat atau http://127.0.0.1:8000/pasien

3. Jika /obat akan menampilkan dashboard obat dan sebaliknya.

4. User dapat untuk CRUD dalam sistem tersebut dan terdapat fitur pencarian untuk mencari data.
   - Jika fitur pencarian di dashboard obat itu berdasarkan nama_obat dan atau kategori
   - Jika fitur pencarian di dashboard pasien itu berdasarkan nama dan atau jenis_kelamin
     
5. 📌 Catatan Tambahan
Project ini mengandalkan backend API yang sedang berjalan di http://localhost:8080.
Pastikan backend API aktif agar data bisa ditarik secara dinamis melalui HTTP Client Laravel.

# Tampilan Antarmuka Sistem E-Apotek
## 1. Obat
   - Dashboard obat
     
     ![Screenshot 2025-06-20 123051](https://github.com/user-attachments/assets/57f56850-6175-4c08-8ee4-06a58b9fe0ff)

- Form tambah obat
    
  ![Screenshot 2025-06-20 123140](https://github.com/user-attachments/assets/8941b298-6ae1-4867-afd8-e8c5d8f77bfc)

    - Form edit obat
      
      ![Screenshot 2025-06-20 123158](https://github.com/user-attachments/assets/2d85b7fb-77e0-40f1-a81f-fae571b3e6cb)

    - Hapus obat
      
      ![Screenshot 2025-06-20 123222](https://github.com/user-attachments/assets/afeefcc7-c015-4427-9471-f9e806dd938c)

    - Penggunaan fitur pencarian data obat
      
      ![Screenshot 2025-06-20 123241](https://github.com/user-attachments/assets/c6e99d98-dd1e-47c9-8156-252696887903)

## 2. Pasien
   - Dashboard pasien
     
     ![Screenshot 2025-06-20 123110](https://github.com/user-attachments/assets/215822b1-d92f-433e-8bbc-d178279784c8)

- Form tambah pasien
  
  ![Screenshot 2025-06-20 124548](https://github.com/user-attachments/assets/043b1ee1-5efe-4d4d-bca1-a8c986206e77)

 - Form edit pasien
   
   ![Screenshot 2025-06-20 124605](https://github.com/user-attachments/assets/f1514861-a9f1-4e5d-9bdb-74223e78b364)

- Hapus pasien
  
![Screenshot 2025-06-20 124618](https://github.com/user-attachments/assets/3ba6a626-67d2-480b-88ab-6bdff6148d9a)

- Penggunaan fitur pencarian data pasien
  
  ![Screenshot 2025-06-20 124636](https://github.com/user-attachments/assets/456e966b-c89d-48c2-9321-47f972124f2e)

