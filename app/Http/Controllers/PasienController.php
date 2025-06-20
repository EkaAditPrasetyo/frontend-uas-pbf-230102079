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