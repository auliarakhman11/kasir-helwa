<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use App\Models\HargaPengeluaran;
use Illuminate\Http\Request;

class CabangController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Outlet',
            'outlet' => Cabang::all(),
        ];
        return view('cabang.index', $data);
    }

    public function addOutlet(Request $request)
    {

        $data = [
            'nama' => $request->nama,
            'kota_id' => 1,
            'alamat' => $request->alamat,
            'foto' => NULL,
            'map' => $request->map,
            'no_tlpn' => $request->no_tlpn,
            'time_zone' => $request->time_zone,
            'off' => $request->off,
            'possition' => 0,
        ];
        $cabang = Cabang::create($data);

        $akun_id = $request->akun_id;
        $harga = $request->harga;

        for ($count = 0; $count < count($akun_id); $count++) {
            $harga_insert = [
                'cabang_id' => $cabang->id,
                'akun_id' => $akun_id[$count],
                'harga' => $harga[$count]
            ];
            HargaPengeluaran::create($harga_insert);
        }

        return redirect(route('outlet'))->with('success', 'Data berhasil dibuat');
    }

    public function editOutlet(Request $request)
    {
        $data = [
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'map' => $request->map,
            'no_tlpn' => $request->no_tlpn,
            // 'gapok' => $request->gapok,
            'off' => $request->off,
            'time_zone' => $request->time_zone,
        ];

        Cabang::where('id', $request->id)->update($data);


        return redirect(route('outlet'))->with('success', 'Data berhasil diubah');
    }

    public function editHargaPengeluaran(Request $request)
    {
        if ($request->akun_id) {
            $akun_id = $request->akun_id;
            $harga = $request->harga;

            for ($count = 0; $count < count($akun_id); $count++) {
                $harga_update = [
                    'harga' => $harga[$count]
                ];
                $cek = HargaPengeluaran::where('akun_id', $akun_id[$count])->where('cabang_id', $request->cabang_id)->first();
                if ($cek) {
                    HargaPengeluaran::where('akun_id', $akun_id[$count])->where('cabang_id', $request->cabang_id)->update($harga_update);
                } else {
                    $harga_insert = [
                        'cabang_id' => $request->cabang_id,
                        'akun_id' => $akun_id[$count],
                        'harga' => $harga[$count]
                    ];
                    HargaPengeluaran::create($harga_insert);
                }
            }
        }

        return redirect(route('outlet'))->with('success', 'Data berhasil diubah');
    }
}
