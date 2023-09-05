<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Produk;
use Illuminate\Validation\Validator;

class MainController extends Controller
{
    public function getTotalProduk()
    {
        return Produk::count();
    }

    public function dashboard()
    {
        $totalProduk = $this->getTotalProduk();

        return view('layouts.dashboard', ['totalProduk' => $totalProduk]);
    }

    public function dataProduk()
    {
        $datas = DB::table('tb_produk')->paginate(2);
        return view('layouts/dataProduk')->with('datas', $datas);
    }

    public function create()
    {
        return view('layouts.create');
    }

    public function store(Request $request)
    {

        $datas = new Produk();
        $datas->idBarang = $request->idBarang;
        $datas->judulProduk = $request->judulProduk;
        $datas->deskripsi = $request->deskripsi;
        $datas->harga = $request->harga;

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $gambarPath = $gambar->store('produk', 'publik');
            $datas->gambar = $gambarPath;
        }

        $datas->save();

        return redirect('./dataProduk')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit($idBarang)
    {
        $data = DB::table('tb_produk')->where('idBarang', $idBarang)->first();
        return view('layouts.edit', ['data' => $data]);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'judulProduk' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'gambar' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads'), $imageName);

            // Update data dalam tabel
            DB::table('tb_produk')
                ->where('idBarang', $id)
                ->update([
                    'judulProduk' => $validatedData['judulProduk'],
                    'deskripsi' => $validatedData['deskripsi'],
                    'harga' => $validatedData['harga'],
                    'gambar' => $imageName, // Simpan nama file gambar dalam database
                ]);
        } else {
            // Update data tanpa mengubah gambar
            DB::table('tb_produk')
                ->where('idBarang', $id)
                ->update([
                    'judulProduk' => $validatedData['judulProduk'],
                    'deskripsi' => $validatedData['deskripsi'],
                    'harga' => $validatedData['harga'],
                ]);
        }

        return redirect()->back()->with('success', 'Data barang berhasil diperbarui.');
    }

    public function delete($idBarang)
    {
        $barang = DB::table('tb_produk')->where('idBarang', $idBarang)->first();

        if (!$barang) {
            return redirect()->route('dataProduk')->with('error', 'Data tidak ditemukan.');
        }

        DB::table('tb_produk')->where('idBarang', $idBarang)->delete();

        return redirect()->route('dataProduk')->with('success', 'Data berhasil dihapus.');
    }
}
