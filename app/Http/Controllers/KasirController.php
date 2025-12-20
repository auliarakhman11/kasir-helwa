<?php

namespace App\Http\Controllers;

use App\Models\Gender;
use App\Models\Karyawan;
use App\Models\Kategori;
use App\Models\Pembayaran;
use App\Models\Produk;
use App\Models\Resep;
use Illuminate\Http\Request;

class KasirController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Kasir',
            'produk' => Produk::where('status', 'ON')->where('hapus', 0)->with(['gender', 'kategori'])->get(),
            'gender' => Gender::all(),
            'kategori' => Kategori::all(),
            'resep' => Resep::where('void', 0)->with('cluster')->get(),
            'pembayaran' => Pembayaran::where('aktif', 1)->get(),
            'karyawan' => Karyawan::where('aktif', 1)->get(),
        ];
        return view('kasir.index', $data);
    }
}
