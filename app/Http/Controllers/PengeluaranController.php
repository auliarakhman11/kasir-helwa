<?php

namespace App\Http\Controllers;

use App\Models\AkunPengeluaran;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengeluaranController extends Controller
{
    public function pengeluaran(Request $request)
    {

        return view('pengeluaran.pengeluaran', [
            'title' => 'Pengeluaran',
            'akun' => AkunPengeluaran::where('void', 0)->get(),
            'pengeluaran' => Pengeluaran::where('tgl', date('Y-m-d'))->where('void', 0)->orderBy('tgl', 'ASC')->orderBy('id', 'DESC')->with(['akun'])->get(),
        ]);
    }

    public function addPengeluaran(Request $request)
    {
        Pengeluaran::create([
            'cabang_id' => Auth::user()->cabang_id,
            'akun_id' => $request->akun_id,
            'jenis' => $request->jenis,
            'jumlah' => $request->jumlah,
            'ket' => $request->ket,
            'tgl' => $request->tgl,
            'user_id' => 1,
            'void' => 0
        ]);

        return redirect()->back()->with('success', 'Data berhasil dibuat');
    }

    public function editPengeluaran(Request $request)
    {
        Pengeluaran::where('id', $request->id)->update([
            'akun_id' => $request->akun_id,
            'jumlah' => $request->jumlah,
            'ket' => $request->ket,
            'tgl' => $request->tgl,
            'jenis' => $request->jenis,
        ]);

        return redirect()->back()->with('success', 'Data berhasil diubah');
    }

    public function dropPengeluaran(Request $request)
    {

        Pengeluaran::where('id', $request->id)->update([
            'void' => 1,
        ]);

        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
