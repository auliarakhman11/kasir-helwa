<?php

namespace App\Http\Controllers;

use App\Models\Gender;
use App\Models\Produk;
use Illuminate\Http\Request;

class KasirController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Kasir',
            'produk' => Produk::where('status', 'ON')->where('hapus', 0)->with(['gender'])->get(),
            'gender' => Gender::all(),
        ];
        return view('kasir.index', $data);
    }
}
