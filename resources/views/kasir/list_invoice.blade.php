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
                                <table class="table table-sm">
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
                                        @endphp
                                        @foreach ($invoice as $inv)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ date('d M Y H:i', strtotime($inv->created_at)) }}</td>
                                                <td>{{ $inv->pembayaran->pembayaran }}</td>
                                                <td>
                                                    @php
                                                        $ttl_produk = 0;
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
                                                        data-toggle="modal" data-target="#detail{{ $inv->id }}">
                                                        <i class="fas fa-search"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-sm mt-2 btn-primary"
                                                        data-toggle="modal" data-target="#void{{ $inv->id }}">
                                                        <i class="fas fa-window-close"></i>
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



        });
    </script>
@endsection
@endsection
