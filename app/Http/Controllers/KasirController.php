<?php

namespace App\Http\Controllers;

use App\Models\Gender;
use App\Models\InvoiceKasir;
use App\Models\Karyawan;
use App\Models\Kategori;
use App\Models\Pembayaran;
use App\Models\PenjualanKarywan;
use App\Models\PenjualanKasir;
use App\Models\Produk;
use App\Models\Resep;
use App\Models\Stok;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

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

    public function checkout(Request $request)
    {
        $no_invoice = 'INV' . date('dmy') . strtoupper(Str::random(5));
        $total_invoice = 0;
        $tot_diskon = 0;
        $tgl = date('Y-m-d');
        $admin = Auth::user()->id;
        // $dt_user = User::where('id', $admin)->with(['cabang'])->first();

        $nm_customer = $request->nm_customer;
        $no_tlp = $request->no_tlp;

        $pembayaran_id = $request->pembayaran_id;

        $cart = $request->cart;

        if (count($cart) > 0) {

            $karyawan_id = $request->karyawan_id;

            if ($karyawan_id) {
                $online = 0;

                $dt_invoice = InvoiceKasir::create([
                    'no_invoice' => $no_invoice,
                    'nm_customer' => $nm_customer,
                    'total' => 0,
                    'pembulatan' => 0,
                    'dibayar' => 0,
                    'diskon' => $tot_diskon,
                    'no_tlp' => $no_tlp,
                    'void' => 0,
                    'admin' => $admin,
                    'tgl' => $tgl,
                    'pembayaran_id' => $pembayaran_id,
                    'cabang_id' => 1,
                    'print' => 0,
                    'online' => $online,
                ]);

                foreach ($cart as $c) {
                    $online = 0;
                    $diskon = 0;


                    // if (array_key_exists("diskon", $c)) {
                    //     if ($c['diskon'] > 0 && $c['price'] > 0) {
                    //         if ($c['diskon'] > 100) {
                    //             $harga = $c['price'] - $c['diskon'];
                    //             $diskon = $c['diskon'];
                    //             $total_penjualan = ($c['quantity'] * $c['harga_normal']) + $total_varian - $diskon;
                    //         } else {
                    //             $harga = $c['price'] - ($c['price'] * $c['diskon'] / 100);
                    //             $diskon = (($c['quantity'] * $c['price']) + $total_varian) * $c['diskon'] / 100;
                    //             $total_penjualan = ($c['quantity'] * $c['harga_normal']) + $total_varian - $diskon;
                    //         }
                    //     } else {
                    //         $harga = $c['price'];
                    //         $diskon = 0;
                    //         $total_penjualan = ($c['quantity'] * $c['harga_normal']) + $total_varian;
                    //     }
                    // } else {
                    //     $harga = $c['price'];
                    //     $diskon = 0;
                    //     $total_penjualan = ($c['quantity'] * $c['harga_normal']) + $total_varian;
                    // }

                    // $tot_diskon += $diskon;

                    // if ($c['dp']) {
                    //     $dp = $c['dp'];
                    // }


                    $dt_penjualan = [

                        'invoice_id' => $dt_invoice->id,
                        'produk_id' => $c['id_bujur'],
                        'resep_id' => $c['resep_id'],
                        'cluster_id' => $c['cluster_id'],
                        'ukuran' => $c['ukuran'],
                        'qty' => $c['quantity'],
                        'harga' => $c['price'],
                        'harga_normal' => $c['harga_normal'],
                        'catatan' => NULL,
                        'pembayaran_id' => $pembayaran_id,
                        'diskon' => $diskon,
                        'total' => $c['quantity'] * $c['price'],
                        'void' => 0,
                        'admin' => $admin,
                        'cabang_id' => 1,
                        'tgl' => $tgl,
                        'online' => $online,
                    ];
                    $penjualan_id = PenjualanKasir::create($dt_penjualan);

                    $dt_resep = Resep::where('id', $c['resep_id'])->first();

                    if ($dt_resep) {

                        if ($dt_resep->takaran1 && $dt_resep->takaran2 && $dt_resep->ukuran) {
                            $qty_alkohol = $dt_resep->takaran1 * $dt_resep->ukuran / 100;
                            $qty_produk = $dt_resep->takaran2 * $dt_resep->ukuran / 100;
                        } else {
                            $qty_alkohol = 0;
                            $qty_produk = 0;
                        }

                        Stok::create([
                            'invoice_id' => $dt_invoice->id,
                            'penjualan_id' => $penjualan_id->id,
                            'produk_id' => 0,
                            'cabang_id' => 1,
                            'qty' => $qty_alkohol,
                            'harga' => 0,
                            'tgl' => $tgl,
                            'admin' => $admin,
                            'jenis' => 2,
                            'void' => 0
                        ]);

                        Stok::create([
                            'invoice_id' => $dt_invoice->id,
                            'penjualan_id' => $penjualan_id->id,
                            'produk_id' => $c['id_bujur'],
                            'cabang_id' => 1,
                            'qty' => $qty_produk,
                            'harga' => 0,
                            'tgl' => $tgl,
                            'admin' => $admin,
                            'jenis' => 2,
                            'void' => 0
                        ]);
                    }

                    $total_invoice += $c['quantity'] * $c['price'];

                    // $total_pendapatan += ($c['quantity'] * $c->options->harga_normal)+$total_varian;

                }

                PenjualanKarywan::create([
                    'invoice_id' => $dt_invoice->id,
                    'karyawan_id' => $request->karyawan_id,
                    'tgl' => $tgl,
                    'cabang_id' => 1,
                    'jml_komisi' => 0,
                    'void' => 0,
                    'online' => $online,
                ]);

                InvoiceKasir::where('id', $dt_invoice->id)->update([
                    'total' => $total_invoice,
                    'dibayar' => $total_invoice,
                ]);

                return $no_invoice;
            } else {
                return 'karyawan';
            }
        } else {
            // return redirect(route('penjualan'))->with('error','Gagal! Keranjang kosong');
            return 'kosong';
        }
    }

    public function printNota(Request $request)
    {
        $inv = $request->query('inv');
        $invoice = InvoiceKasir::where('invoice_kasir.no_invoice', $inv)->with(['penjualan', 'penjualan.getMenu', 'penjualan.cluster', 'cabang', 'penjualanKaryawan', 'penjualanKaryawan.karyawan', 'pembayaran'])->first();

        if ($invoice) {
            $data = [
                'dt_invoice' => $invoice
            ];
            return view('kasir.nota', $data);
        } else {
            return redirect(route('kasir'))->with('error', 'Data nota tidak ditemukan!');
        }
    }

    public function listInvoice()
    {
        $data = [
            'title' => 'List Invoice',
            'invoice' => InvoiceKasir::where('invoice_kasir.tgl', date('Y-m-d'))->where('invoice_kasir.void', 0)->with(['penjualan', 'penjualan.getMenu', 'penjualan.cluster', 'penjualanKaryawan.karyawan', 'pembayaran'])->orderBy('invoice_kasir.pembayaran_id', 'ASC')->orderBy('invoice_kasir.id', 'DESC')->get(),
        ];
        return view('kasir.list_invoice', $data);
    }

    public function sendMessage()
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer poozSo0VnQobTGiYOhaAHjaeaF0kJs0zixyKFosFdoMTjstAxJ',
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])
            ->post('https://api.whatspie.com/messages', [
                'device' => '62895704893952',
                'receiver' => '6281346350676',
                'type' => 'file',
                'file_url' => 'https://kasir.kebabyasmin.id/pdf/INV260425I130B.pdf',
                'message' => 'ðŸ“š API Documentation v2.1\n\nLatest version with new endpoints and examples.',
                'simulate_typing' => 1
            ]);

        // Cek jika request berhasil
        // if ($response->successful()) {
        //     return response()->json(['message' => 'Message sent successfully', 'data' => $response->json()]);
        // } else {
        //     return response()->json(['error' => 'Failed to send message', 'data' => $response->json()], $response->status());
        // }
        if ($response->successful()) {
            return true;
        } else {
            return false;
        }
    }

    public function sendMessage2()
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer poozSo0VnQobTGiYOhaAHjaeaF0kJs0zixyKFosFdoMTjstAxJ',
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])
            ->post('https://api.whatspie.com/messages', [
                'device' => '6281346350676',
                'receiver' => '62895704893952',
                'type' => 'file',
                'file_url' => 'https://kasir.kebabyasmin.id/pdf/INV260425I130B.pdf',
                'message' => 'ðŸ“š API Documentation v2.1\n\nLatest version with new endpoints and examples.',
                'simulate_typing' => 1
            ]);

        // Cek jika request berhasil
        if ($response->successful()) {
            return response()->json(['message' => 'Message sent successfully', 'data' => $response->json()]);
        } else {
            return response()->json(['error' => 'Failed to send message', 'data' => $response->json()], $response->status());
        }
    }

    public function sendWa(Request $request)
    {



        $inv = $request->no_invoice;
        $invoice = InvoiceKasir::where('invoice_kasir.no_invoice', $inv)->with(['penjualan', 'penjualan.getMenu', 'penjualan.cluster', 'cabang', 'penjualanKaryawan', 'penjualanKaryawan.karyawan', 'pembayaran'])->first();
        $nm_customer = $invoice->nm_customer;
        $no_tlp = $invoice->no_tlp;
        $no_wa = substr($no_tlp, 1);


        $data = [
            'dt_invoice' => $invoice
        ];

        $directory = '/home/u1644550/public_html/kasir.helwaperfume.id/pdf_nota/' . $inv . '.pdf';
        Pdf::loadView('kasir.sendWa', $data)->save($directory);

        $response = Http::withHeaders([
            'Authorization' => 'Bearer poozSo0VnQobTGiYOhaAHjaeaF0kJs0zixyKFosFdoMTjstAxJ',
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])
            ->post('https://api.whatspie.com/messages', [
                'device' => '628138053500',
                'receiver' => '62' . $no_wa,
                'type' => 'file',
                'file_url' => 'https://kasir.helwaperfume.id/pdf_nota/' . $inv . '.pdf',
                'message' => 'Terimakasih sudah membeli produk Helwa PerfumeðŸ¥³ Berikut kami lampirkan nota pembelian anda.',
                'simulate_typing' => 1
            ]);

        // Cek jika request berhasil
        // if ($response->successful()) {
        //     return response()->json(['message' => 'Message sent successfully', 'data' => $response->json()]);
        // } else {
        //     return response()->json(['error' => 'Failed to send message', 'data' => $response->json()], $response->status());
        // }
        if ($response->successful()) {
            return true;
        } else {
            return false;
        }
    }
}
