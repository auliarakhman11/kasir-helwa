<?php

namespace App\Http\Controllers;

use App\Models\Bahan;
use Illuminate\Http\Request;

class BahanController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Daftar Bahan',
            'bahan' => Bahan::where('aktif', 'Y')->where('jenis', 1)->orderBy('possition', 'ASC')->get(),
        ];
        return view('bahan.index', $data);
    }


    public function addBahan(Request $request)
    {

        $cek = Bahan::where('bahan', $request->bahan)->where('jenis', 1)->where('aktif', 'Y')->first();

        if ($cek) {
            return redirect(route('bahan'))->with('error', 'Bahan sudah ada');
        } else {
            $data = [
                'bahan' => $request->bahan,
                'possition' => 0,
                'jenis' => 1
            ];
            Bahan::create($data);
            return redirect(route('bahan'))->with('success', 'Data berhasil dibuat');
        }
    }

    public function editBahan(Request $request)
    {
        $data = [
            'bahan' => $request->bahan,
        ];
        Bahan::where('id', $request->id)->update($data);

        return redirect(route('bahan'))->with('success', 'Data berhasil diubah');
    }

    public function dropDataBahan(Request $request)
    {
        $data = [
            'aktif' => 'T'
        ];

        Bahan::where('id', $request->id)->update($data);
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
