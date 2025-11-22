@extends('template.master')

@section('content')
    <!-- Content -->

    <div class="page-content">

        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">Bahan</h4>
                        {{-- <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item active">Welcome to Xoric Dashboard</li>
                            </ol> --}}
                    </div>
                    <div class="col-md-4">
                        {{-- <div class="float-end d-none d-md-block">
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
                            </div> --}}
                        <button type="button" class="btn btn-sm btn-light float-end" data-bs-toggle="modal"
                            data-bs-target="#add-bahan">
                            <i class="fa fa-plus-circle"></i>
                            Tambah Outlet
                        </button>
                    </div>
                </div>

            </div>
        </div>
        <!-- end page title end breadcrumb -->

        <div class="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <table id="datatable" class="tabledt-responsive nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Bahan</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($bahan as $b)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $b->bahan }}</td>

                                                <td>
                                                    <button type="button" class="btn btn-sm btn-primary"
                                                        data-bs-toggle="modal" data-bs-target="#edit-bahan{{ $b->id }}">
                                                        <i class="fa fa-edit"></i>
                                                    </button>

                                                    <form class="d-inline-block" action="{{ route('dropDataBahan') }}"
                                                        method="post">
                                                        @csrf
                                                        @method('patch')
                                                        <input type="hidden" name="id" value="{{ $b->id }}">
                                                        <button class="btn btn-sm ml-2 btn-danger" type="submit"
                                                            onclick="return confirm('Apakah anda yakin ingin menghapus data bahan?')"><i
                                                                class="fa fa-trash"></i> </button>
                                                    </form>

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

            </div> <!-- container-fluid -->
        </div>
        <!-- end page-content-wrapper -->
    </div>
    <!-- End Page-content -->

    <form action="{{ route('addBahan') }}" method="post">
        @csrf
        <div id="add-bahan" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabeltambah"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0" id="myModalLabeltambah">Tambah Bahan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span class="mdi mdi-close"></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">

                            <div class="col-12">
                                <label>Bahan</label>
                                <input type="text" name="bahan" class="form-control" placeholder="Masukan bahan"
                                    required>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
    </form>



    @foreach ($bahan as $b)
        <form action="{{ route('editBahan') }}" method="post">
            @csrf
            @method('patch')
            <div class="modal fade" id="edit-bahan{{ $b->id }}" role="dialog" aria-labelledby="exampleModalLabelEdit"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabelEdit">Edit Bahan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <span class="mdi mdi-close"></span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="row">
                                <input type="hidden" name="id" value="{{ $b->id }}">
                                <div class="col-12">
                                    <label>Bahan</label>
                                    <input type="text" name="bahan" class="form-control" placeholder="Masukan bahan"
                                        value="{{ $b->bahan }}" required>
                                </div>

                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Edit</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
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



        });
    </script>
@endsection
@endsection
