<style>
    .invoice {
        margin: auto;
        width: 80mm;
        background: #FFF;
    }

    .huruf {
        font-size: 18px;
    }

    .huruf2 {
        font-size: 25px;
    }
</style>
<script>
    window.print();
</script>







<div class="invoice">
    <br>
    <center>
        <img width="150" src="{{ asset('img') }}/helwa.png" alt="">

    </center>
    <p align="center" class="huruf">{{ $dt_invoice->cabang->nama }}</p>

    <table width="100%">
        {{-- <tr>
        <td width="40%" class="huruf">No Invoice</td>
      <td style="text-align: left; " class="huruf">: {{ $dt_invoice->no_invoice }}</td>
    </tr> --}}
        <tr>
            <td width="40%" class="huruf">Waktu</td>
            <td style="text-align: left; " class="huruf">: {{ date('d M Y', strtotime($dt_invoice->tgl)) }}
                {{ date('H:i', strtotime($dt_invoice->created_at)) }}</td>
        </tr>
        <!-- <tr>
        <td width="40%" class="huruf">Order</td>
      <td style="text-align: left; " class="huruf">: Kasir Orchard</td>
    </tr> -->
        <tr>
            <td width="40%" class="huruf">Kasir</td>
            <td style="text-align: left; " class="huruf">:
                @if ($dt_invoice->penjualanKaryawan)
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($dt_invoice->penjualanKaryawan as $kry)
                        @if ($i > 1)
                            ,
                        @endif
                        {{ $kry->karyawan->nama }}
                        @php
                            $i++;
                        @endphp
                    @endforeach
                @endif

            </td>
        </tr>

        <tr>
            <td width="40%" class="huruf">Customer</td>
            <td style="text-align: left; " class="huruf">: {{ $dt_invoice->nm_customer }}</td>
        </tr>

        <tr>
            <td width="40%" class="huruf">Pembayaran</td>
            <td style="text-align: left; " class="huruf">:
                {{ $dt_invoice->pembayaran ? $dt_invoice->pembayaran->pembayaran : '' }}</td>
        </tr>

    </table>

    <hr>
    @php
        $total_produk = 0;
        $qty_produk = 0;
    @endphp
    <table width="100%">
        @foreach ($dt_invoice->penjualan as $d)
            <tr class="huruf" style="margin-bottom: 2px;">
                <td width="10%">{{ $d->qty }}</td>
                <td width="70%">{{ ucwords($d->getMenu->ganti_nama) }} ({{ $d->cluster->nm_cluster }})
                    {{ $d->ukuran }} ml

                    <br>
                    {{ $d->catatan }}
                </td>

                <td width="20%" style="text-align: right;">
                    <strong>{{ number_format($d->harga * $d->qty, 0) }}</strong>
                </td>
            </tr>
            @php
                $total_produk += $d->harga * $d->qty;
                $qty_produk += $d->qty;
            @endphp
        @endforeach



    </table>
    <hr>
    <table width="100%">

        <tr class="huruf">
            <td><strong>Subtotal {{ $qty_produk }} Produk</strong></td>
            <td style="text-align: right;"><strong>{{ number_format($total_produk, 0) }}</strong></td>
        </tr>
        @if ($dt_invoice->diskon > 0)
            <tr class="huruf">
                <td><strong>Diskon</strong></td>
                <td style="text-align: right;"><strong>{{ number_format($dt_invoice->diskon, 0) }}</strong></td>
            </tr>
            <tr class="huruf">
                <td><strong>Grand Total</strong></td>
                <td style="text-align: right;">
                    <strong>{{ number_format($total_produk - $dt_invoice->diskon, 0) }}</strong>
                </td>
            </tr>
        @endif

        <tr class="huruf">
            <td>Total Pembayaran</td>
            <td style="text-align: right;">{{ number_format($dt_invoice->dibayar, 0) }}</td>
        </tr>
        <tr class="huruf">
            <td>Kembalian</td>
            <td style="text-align: right;">
                {{ number_format($dt_invoice->dibayar - ($total_produk - $dt_invoice->diskon), 0) }}</td>
        </tr>
    </table>
    <hr>
    <hr>
    <p class="huruf" align="center">Terimakasih</p>
    <p class="huruf" align="center" style="margin-top: -10px;">WA : 0813-8053-500</p>
    <p class="huruf" align="center">Instagram : helwa.perfume</p>
    <p class="huruf" align="center">Terbayar</p>

    @php
        $zona_waktu = date('d M Y h:i');

    @endphp
    <p class="huruf" align="center" style="margin-top: -10px;"><-------- <?= $zona_waktu ?> --------></p>

</div>



<!-- <script>
    var url = document.getElementById('url').value;
    var count = 5; // dalam detik
    function countDown() {
        if (count > 0) {
            count--;
            var waktu = count + 1;
            $('#pesan').html('Anda akan di redirect ke ' + url + ' dalam ' + waktu + ' detik.');
            setTimeout("countDown()", 1000);
        } else {
            window.location.href = url;
        }
    }
    countDown();
</script>  -->
