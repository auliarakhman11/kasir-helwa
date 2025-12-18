<?php

namespace App\Http\Controllers;

use App\Models\Gender;
use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;

class KasirController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Kasir',
            'produk' => Produk::where('status', 'ON')->where('hapus', 0)->with(['gender', 'kategori'])->get(),
            'gender' => Gender::all(),
            'kategori' => Kategori::all()
        ];
        return view('kasir.index', $data);
    }
}
