<?php

namespace App\Http\Controllers;

use App\Models\Resep;
use App\Models\Ukuran;
use Illuminate\Http\Request;

class UkuranController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Ukuran',
            'ukuran' => Ukuran::where('void', 0)->get(),
        ];
        return view('ukuran.index', $data);
    }

    public function addUkuran(Request $request)
    {

        $cek = Ukuran::where('ukuran', $request->ukuran)->where('void', 0)->first();

        if ($cek) {
            return redirect()->back()->with('error', 'Ukuran sudah ada');
        } else {
            $data = [
                'ukuran' => $request->ukuran,
            ];
            Ukuran::create($data);
            return redirect()->back()->with('success', 'Data berhasil dibuat');
        }
    }

    public function editUkuran(Request $request)
    {
        $cek = Ukuran::where('id', '!=', $request->id)->where('ukuran', $request->ukuran)->where('void', 0)->first();
        if ($cek) {
            return redirect()->back()->with('error', 'Ukuran sudah ada');
        } else {
            $data = [
                'ukuran' => $request->ukuran,
            ];
            Ukuran::where('id', $request->id)->update($data);

            if ($request->ukuran != $request->ukuran_old) {
                Resep::where('ukuran', $request->ukuran_old)->update([
                    'ukuran' => $request->ukuran,
                ]);
            }

            return redirect()->back()->with('success', 'Data berhasil diubah');
        }
    }

    public function deleteUkuran($ukuran)
    {
        $data = [
            'void' => 1
        ];

        Ukuran::where('ukuran', $ukuran)->update($data);

        Resep::where('ukuran', $ukuran)->update($data);

        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
