@extends('template.master')

@section('content')

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
                            <div class="col-md-6 col-12">
                                <table class="table table-bordered table-striped" style="border: 1px solid black;">
                                    <tbody>
                                        <tr>
                                            <td colspan="2" class="text-center"><strong><u>Laporan
                                                        {{ date('d/m/Y') }}</u></strong></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="text-center"><strong>Penjualan</strong></td>
                                        </tr>
                                        @php
                                            $tot_invoive = 0;
                                        @endphp
                                        @foreach ($penjualan as $d)
                                            @php
                                                $tot_invoive += $d->ttl + $d->ttl_pembulatan - $d->ttl_diskon;
                                            @endphp
                                            <tr>
                                                <td><strong>{{ $d->nama }}</strong></td>
                                                <td><strong>{{ number_format($d->ttl + $d->ttl_pembulatan - $d->ttl_diskon, 0) }}</strong>
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td><strong>Total Penjualan</strong></td>
                                            <td><strong>{{ number_format($tot_invoive, 0) }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="text-center"><strong>Pengeluaran</strong></td>
                                        </tr>
                                        @php
                                            $tot_pengeluaran_kas = 0;
                                        @endphp
                                        @foreach ($pengeluaran as $d)
                                            @php
                                                if ($d->jenis == 1) {
                                                    $tot_pengeluaran_kas += $d->jml;
                                                }

                                            @endphp
                                            <tr>
                                                <td><strong>{{ $d->jenis == 1 ? 'Pengeluaran Kas' : 'Pengeluaran Laba' }}</strong>
                                                </td>
                                                <td><strong>{{ number_format($d->jml, 0) }}</strong>
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td><strong>Sisa Kas</strong></td>
                                            <td><strong>{{ number_format($tot_invoive - $tot_pengeluaran_kas, 0) }}</strong>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <table class="table mt-3 table-striped table-bordered" style="border: 1px solid black;">
                                    <thead>
                                        <tr class="text-center">
                                            <th><strong>Produk</strong></th>
                                            <th><strong>Qty</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($produk as $d)
                                            <tr>
                                                <td>{{ $d->ganti_nama }}</td>
                                                <td>{{ $d->ttl_qty }}</td>
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
