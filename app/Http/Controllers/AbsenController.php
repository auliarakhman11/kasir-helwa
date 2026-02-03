<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\Karyawan;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbsenController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Absen',

            'karyawan' => Karyawan::where('aktif', 1)->get(),
        ];
        return view('absen.index', $data);
    }

    public function addAbsen(Request $request)
    {
        $user_id = Auth::id();
        $karyawan_id = $request->karyawan_id;

        $cek_pw = Karyawan::where('id', $karyawan_id)->first();

        if (!$cek_pw) {
            return redirect(route('absen'))->with('error', 'Karyawan tidak terdaftar!');
        }

        // if ($cek_pw->pin != $request->pin) {
        //     return redirect(route('absen'))->with('error', 'Pin Salah!');
        // }

        $foto = $request->foto;
        // $folderPath = "/home/u1644550/public_html/cobakasir/img_outlet/";
        $folderPath = public_path('foto_absen/');
        $image_parts = explode(";base64,", $foto);
        $image_base64 = base64_decode($image_parts[1]);
        $dt_foto = date('Ymd') . $user_id . $karyawan_id . "absen_datang.png";
        $file = $folderPath . $dt_foto;
        file_put_contents($file, $image_base64);

        if ($request->shift == 1) {
            if (date('H:i') > '10:00') {
                $waktu1 = new DateTime(date('Y-m-d') . ' 10:00:00');
                $waktu2 = new DateTime(date('Y-m-d H:i:s'));

                // Menghitung selisih waktu
                $interval = $waktu1->diff($waktu2);

                $selisih_menit = $interval->h * 60 + $interval->i;

                if ($selisih_menit > 0) {
                    $potongan = $selisih_menit * 1000;
                } else {
                    $potongan = 0;
                }
            } else {
                $potongan = 0;
            }
        } else {
            if (date('H:i') > '15:00') {
                $waktu1 = new DateTime(date('Y-m-d') . ' 15:00:00');
                $waktu2 = new DateTime(date('Y-m-d H:i:s'));

                // Menghitung selisih waktu
                $interval = $waktu1->diff($waktu2);

                $selisih_menit = $interval->h * 60 + $interval->i;

                if ($selisih_menit > 0) {
                    $potongan = $selisih_menit * 1000;
                } else {
                    $potongan = 0;
                }
            } else {
                $potongan = 0;
            }
        }

        $cek_sudah = Absen::where('karyawan_id', $karyawan_id)->where('shift', $request->shift)->where('tgl', date('Y-m-d'))->where('void', 0)->first();

        if ($cek_sudah) {
            Absen::where('id', $cek_sudah->id)->update([
                'jam' => date('H:i:s'),
                'potongan' => $potongan,
                'foto' => $dt_foto,
                'void' => 0,
                'user_id' => $user_id
            ]);
        } else {
            Absen::create([
                'karyawan_id' => $karyawan_id,
                'shift' => $request->shift,
                'tgl' => date('Y-m-d'),
                'jam' => date('H:i:s'),
                'potongan' => $potongan,
                'foto' => $dt_foto,
                'void' => 0,
                'user_id' => $user_id
            ]);
        }


        if ($potongan == 0) {
            return redirect(route('absen'))->with('success', 'Anda berhasil absen tepat waktu');
        } else {
            return redirect(route('absen'))->with('success', 'Anda terlambat ' . $selisih_menit . 'Menit dengan potongan Rp.' . number_format($potongan, 0));
        }
    }
}
