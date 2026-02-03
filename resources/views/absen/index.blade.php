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
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-12">
                                <h4 class="page-title mb-1">Absen</h4>
                            </div>

                        </div>
                    </div>

                    <div class="card-body">
                        @if (date('H:i') <= '15:00')
                            <form action="{{ route('addAbsen') }}" method="post">
                                @csrf
                                <div class="row justify-content-center">
                                    <div class="col-12 text-center">
                                        <h4>Shift 1</h4>
                                        <input type="hidden" name="shift" value="1" required>
                                        <div class="col-12" id="hasil_absen"></div>
                                        <div class="col-12" id="pilih_karyawan"></div>
                                        {{-- <div class="col-12" id="pin"></div> --}}
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#modal_absen"
                                            class="btn btn-primary mt-2" id="absen"><i class="fas fa-mobile-alt"></i>
                                            Ambil Absen</button>
                                        <div id="button_submit">

                                        </div>

                                    </div>
                                </div>
                            </form>
                        @else
                            <form action="{{ route('addAbsen') }}" method="post">
                                @csrf
                                <div class="row justify-content-center">
                                    <div class="col-12 text-center">
                                        <h4>Shift 2</h4>
                                        <input type="hidden" name="shift" value="2" required>
                                        <div class="col-12" id="hasil_absen"></div>
                                        <div class="col-12" id="pilih_karyawan"></div>
                                        {{-- <div class="col-12" id="pin"></div> --}}
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#modal_absen"
                                            class="btn btn-primary mt-2" id="absen"><i class="fas fa-mobile-alt"></i>
                                            Ambil Absen</button>
                                        <div id="button_submit">

                                        </div>

                                    </div>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
                <!-- end row -->



            </div>
            <!-- end container-fluid -->
        </div>
        <!-- end page-content-wrapper -->
    </div>

    {{-- <div class="modal fade" id="modal_absen" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title" id="exampleModalLabel">Absen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="d-flex justify-content-center" id="camera_absen"></div>



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close_absen">Close</button>
                    <button type="button" class="btn btn-primary" id="ambil_absen"><i class="fas fa-mobile-alt"></i>
                        Ambil Absen</button>
                </div>
            </div>
        </div>
    </div> --}}

    <div id="modal_absen" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabeltambah"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myModalLabeltambah">Absen</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span class="mdi mdi-close"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-center" id="camera_absen"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal"
                        id="close_absen">Close</button>
                    <button type="button" class="btn btn-primary" id="ambil_absen"><i class="fas fa-mobile-alt"></i>
                        Ambil Absen</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

    <script src="{{ asset('webcam') }}/webcam.min.js"></script>


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

            $('body').on('hidden.bs.modal', function() {
                if ($('.modal.show').length > 0) {
                    $('body').addClass('modal-open');
                }
            });

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


            $(document).on('click', '#absen', function() {
                Webcam.set({
                    width: 300,
                    height: 400,
                    image_format: 'jpeg',
                    jpeg_quality: 90,
                    flip_horiz: true,
                    fps: 45,
                    constraints: {
                        facingMode: 'user'
                    }
                });
                Webcam.attach('#camera_absen');
            });

            $(document).on('click', '#close_absen', function() {
                Webcam.reset();
            });

            $(document).on('click', '#ambil_absen', function() {

                Webcam.snap(function(data_uri) {

                    var table_absen = '';
                    table_absen += '<img style="max-height: 700px;" src="' + data_uri + '"/>';
                    table_absen += '<input type="hidden" name="foto" value="' + data_uri +
                        '" required>';


                    $('#hasil_absen').html(table_absen);

                    $('#button_submit').html(
                        '<button type="submit"class="btn btn-primary mt-2" id="absen"><i class="fas fa-save"></i> Save</button>'
                    );

                    $('#pilih_karyawan').html(
                        '<select name="karyawan_id" class="form-control mt-2" required><option value="">Pilih Karyawan</option>@foreach ($karyawan as $k)<option value="{{ $k->id }}">{{ $k->nama }}</option>@endforeach</select>'
                    );

                    // $('#pin').html(
                    //     '<input type="password" placeholder="Masukan Pin" class="form-control mt-2" name="pin" required>'
                    // );


                });
                $("#modal_absen").modal('hide');
                Webcam.reset();
            });



        });
    </script>
@endsection
@endsection
