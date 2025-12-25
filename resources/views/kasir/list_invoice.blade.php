@extends('template.master')

@section('content')

    <style>
        .card-input-element {
            display: none;
        }

        .card-input {
            margin: 10px;
            padding: 0px;
        }

        .card-input:hover {
            cursor: pointer;
        }

        .card-input-element:checked+.card-input {
            box-shadow: 0 0 1px 1px #2ecc71;
            background-color: #beecd1;
            color: black;
        }
    </style>

    <div class="page-content">

        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                {{-- <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">Cards</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Bootstrap UI</a></li>
                            <li class="breadcrumb-item active">Cards</li>
                        </ol>
                    </div>
                    <div class="col-md-4">
                        <div class="float-end d-none d-md-block">
                            <div class="dropdown d-inline-block">
                                <button type="button"
                                    class="btn btn-light rounded-pill user text-start d-flex align-items-center"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="mdi mdi-settings-outline me-1"></i> Settings
                                </button>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Separated link</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}

            </div>
        </div>
        <!-- end page title end breadcrumb -->

        <div class="page-content-wrapper">
            <div class="container-fluid">
                <div class="card">

                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-12">
                                <table id="datatable" class="tabledt-responsive nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Waktu</th>
                                            <th>Jenis Pembayaran</th>
                                            <th>Total<br>Produk</th>
                                            <th>Total<br>Tagihan</th>
                                            <th>Kasir</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                            $total = 0;
                                        @endphp
                                        @foreach ($invoice as $inv)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ date('d M Y H:i', strtotime($inv->created_at)) }}</td>
                                                <td>{{ $inv->pembayaran->pembayaran }}</td>
                                                <td>
                                                    @php
                                                        $ttl_produk = 0;
                                                        $total += $inv->total;
                                                    @endphp
                                                    @foreach ($inv->penjualan as $p)
                                                        @php
                                                            $ttl_produk += $p->qty;
                                                        @endphp
                                                    @endforeach
                                                    {{ number_format($ttl_produk, 0) }}
                                                </td>
                                                <td>{{ number_format($inv->total, 0) }}</td>
                                                <td>

                                                    @foreach ($inv->penjualanKaryawan as $k)
                                                        {{ $k->karyawan->nama }},
                                                    @endforeach

                                                </td>
                                                <td width="20%">
                                                    @php
                                                        $url = route('printNota') . '?inv=' . $inv->no_invoice;
                                                    @endphp
                                                    <a href="{{ route('printNota') . '?inv=' . $inv->no_invoice }}"
                                                        class="btn btn-sm btn-primary mt-2"><i class="fas fa-print"></i></a>
                                                    <button type="button" class="btn btn-sm btn-primary mt-2"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modal_detail{{ $inv->id }}">
                                                        <i class="fas fa-search"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-sm mt-2 btn-primary btn_kirim_wa"
                                                        no_invoice="{{ $inv->no_invoice }}">
                                                        <i class="fab fa-whatsapp"></i>
                                                    </button>
                                                    {{-- <button type="button" class="btn btn-sm btn-primary mt-2" data-toggle="modal" data-target="#send{{ $inv->id }}">
                                                  <i class="fab fa-whatsapp"></i>
                                                </button> --}}
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- end row -->



            </div>
            <!-- end container-fluid -->
        </div>
        <!-- end page-content-wrapper -->
    </div>

    @foreach ($invoice as $d)
        <div id="modal_detail{{ $d->id }}" class="modal fade modal-detail" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabeldetail" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title text-white mt-0" id="myModalLabeldetail">Detail</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span class="mdi mdi-close"></span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Produk</th>
                                    <th>Ukuran</th>
                                    <th>Qty x Harga</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                    $total = 0;
                                @endphp
                                @foreach ($d->penjualan as $p)
                                    @php
                                        $total += $p->total;
                                    @endphp
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $p->getMenu->ganti_nama }} ({{ $p->cluster->nm_cluster }})</td>
                                        <td>{{ $p->ukuran }} ml</td>
                                        <td>{{ $p->qty }} x {{ number_format($p->harga, 0) }}</td>
                                        <td>{{ number_format($p->total, 0) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4"><strong>Total</strong></td>
                                    <td><strong>{{ number_format($total, 0) }}</strong></td>
                                </tr>
                            </tfoot>
                        </table>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>

                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
    @endforeach





@section('script')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });

        $(document).ready(function() {

            <?php if(session('success')): ?>
            Swal.fire({
                position: "top-end",
                icon: "success",
                title: "<?= session('success') ?>",
                showConfirmButton: !1,
                timer: 1500
            });
            <?php endif; ?>

            <?php if(session('error')): ?>
            Swal.fire({
                position: "top-end",
                icon: "error",
                title: "<?= session('error') ?>",
                showConfirmButton: !1,
                timer: 1500
            });
            <?php endif; ?>

            $(document).on('click', '.btn_kirim_wa', function() {
                const no_invoice = $(this).attr("no_invoice");

                $(this).html(
                    '<div class="spinner-border text-light" role="status"><span class="visually-hidden">Loading...</span></div>'
                );
                $(this).attr("disabled", true);

                $.ajax({
                    url: "{{ route('sendWa') }}",
                    method: 'GET',
                    dataType: "json",
                    data: {
                        no_invoice: no_invoice
                    },
                    success: function(data) {

                        if (data) {
                            Swal.fire({
                                position: "top-end",
                                icon: "success",
                                title: "Struk pembelian berhasil dikirim",
                                showConfirmButton: !1,
                                timer: 1500
                            });

                            $('#btn_kirim_wa').html(
                                '<i class="fab fa-whatsapp"></i>');
                            $('#btn_kirim_wa').removeAttr("disabled");
                        } else {
                            $('#btn_kirim_wa').html(
                                '<i class="fab fa-whatsapp"></i>');
                            $('#btn_kirim_wa').removeAttr("disabled");
                            Swal.fire({
                                position: "top-end",
                                icon: "error",
                                title: "Error! ada masalah! Cek Nomor Wa!",
                                showConfirmButton: !1,
                                timer: 1500
                            });
                        }

                    },
                    error: function(err) { //jika error tampilkan error pada console
                        $('#btn_kirim_wa').html('<i class="fab fa-whatsapp"></i>');
                        $('#btn_kirim_wa').removeAttr("disabled");
                        Swal.fire({
                            position: "top-end",
                            icon: "error",
                            title: "Error! ada masalah!",
                            showConfirmButton: !1,
                            timer: 1500
                        });
                        console.log(err);

                    }
                });



            });


        });
    </script>
@endsection
@endsection
