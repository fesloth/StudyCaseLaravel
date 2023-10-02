<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApiController extends Controller
{
    public function index()
    {
        $produk = Produk::all();
        return response()->json($produk);
    }

    public function getDetailProduk($id)
    {
        $produk = Produk::find($id);

        if (!$produk) {
            return response()->json(['message' => 'Data produk tidak ditemukan'], 404);
        }

        return response()->json($produk);
    }

    public function createProduk(Request $request)
    {
        // Validasi data yang diterima dari formulir jika diperlukan
        $validatedData = $request->validate([
            'judulProduk' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'gambar' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Sesuaikan dengan kebutuhan Anda
        ]);

        // Proses gambar jika diunggah
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $gambarPath = $gambar->store('produk', 'public');
        }

        // Buat produk baru
        $produk = new Produk();
        $produk->judulProduk = $validatedData['judulProduk'];
        $produk->deskripsi = $validatedData['deskripsi'];
        $produk->harga = $validatedData['harga'];
        $produk->gambar = isset($gambarPath) ? $gambarPath : null; // Jika gambar diunggah

        $produk->save();

        // Kembalikan respons JSON dengan pesan sukses dan data produk yang baru ditambahkan
        return response()->json(['message' => 'Data produk berhasil ditambahkan', 'data' => $produk], 201);
    }

    public function updateProduk(Request $request, $id)
    {
        // Temukan produk yang akan diperbarui berdasarkan ID
        $produk = Produk::find($id);

        if (!$produk) {
            return response()->json(['message' => 'Data produk tidak ditemukan'], 404);
        }

        // Validasi data yang diterima dari formulir jika diperlukan
        $validatedData = $request->validate([
            'judulProduk' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'gambar' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Sesuaikan dengan kebutuhan Anda
        ]);

        // Proses gambar jika diunggah
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $gambarPath = $gambar->store('produk', 'public');
            $produk->gambar = $gambarPath;
        }

        // Perbarui data produk
        $produk->judulProduk = $validatedData['judulProduk'];
        $produk->deskripsi = $validatedData['deskripsi'];
        $produk->harga = $validatedData['harga'];

        $produk->save();

        // Kembalikan respons JSON dengan pesan sukses dan data produk yang diperbarui
        return response()->json(['message' => 'Data produk berhasil diperbarui', 'data' => $produk]);
    }

    public function deleteProduk($id)
    {
        // Temukan produk yang akan dihapus berdasarkan ID
        $produk = Produk::find($id);

        if (!$produk) {
            return response()->json(['message' => 'Data produk tidak ditemukan'], 404);
        }

        // Hapus gambar terkait jika ada (gunakan Storage::delete())
        if ($produk->gambar) {
            Storage::delete($produk->gambar); 
        }

        // Hapus data produk
        $produk->delete();

        // Kembalikan respons JSON dengan pesan sukses
        return response()->json(['message' => 'Data produk berhasil dihapus']);
    }

    public function getDataUser()
    {
        $users = User::all();
        return response()->json($users);
    }

    public function getTotalUser()
    {
        $totalUsers = User::count();
        return response()->json(['total_users' => $totalUsers]);
    }
}
