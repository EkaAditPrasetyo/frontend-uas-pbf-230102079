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