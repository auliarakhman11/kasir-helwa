@extends('template.master')

@section('content')
    <!-- Content -->

    <div class="page-content">

        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">Produk</h4>
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
                            data-bs-target="#add-produk">
                            <i class="fa fa-plus-circle"></i>
                            Tambah Produk
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
                                            <th>Produk</th>
                                            <th>Kategori</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($produk as $p)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $p->nm_produk }}</td>
                                                <td>{{ $p->kategori->kategori }}</td>
                                                
                                                <td class="{{ $p->status == 'ON' ? 'text-success' : 'text-danger' }}">
                                                    {{ $p->status }}</td>

                                                <td>
                                                    <button type="button" class="btn btn-sm btn-warning resep" data-bs-toggle="modal"
                                                        data-bs-target="#resep" produk-id="{{ $p->id }}"
                                                        nm-produk="{{ $p->nm_produk }}">
                                                        Resep
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                                        data-bs-target="#edit-product{{ $p->id }}">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <a href="{{ route('deleteProduk', $p->id) }}"
                                                        onclick="return confirm('Aoakah yakin ingin menghapus produk?')"
                                                        class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
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

    <form action="{{ route('addProduct') }}" method="post">
        @csrf
        <div id="add-produk" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabeltambah"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0" id="myModalLabeltambah">Tambah Produk</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span class="mdi mdi-close"></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row form-group ">
                            {{-- <div class="col-sm-4">
                                <label for="">Masukkan Gambar</label>
                                <input type="file" class="dropify text-sm"
                                    data-default-file="{{ asset('img') }}/kebabyasmin.jpeg" name="foto"
                                    placeholder="Image" required>
                            </div> --}}
                            <div class="col-12">
                                <div class="form-group row">
                                    <div class="col-lg-6 mb-2">
                                        <label for="">
                                            <dt>Nama Produk</dt>
                                        </label>
                                        <input type="text" name="nm_produk" class="form-control"
                                            placeholder="Nama Produk" required>
                                    </div>

                                    <div class="col-lg-6 mb-2">
                                        <label for="">
                                            <dt>Kategori</dt>
                                        </label>
                                        <select name="kategori_id" class="form-control" required>
                                            @foreach ($kategori as $k)
                                                <option value="{{ $k->id }}">{{ $k->kategori }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-lg-6 mb-2">
                                        <label for="">
                                            <dt>Status</dt>
                                        </label>
                                        <select name="status" class="form-control" required>
                                            <option value="ON">ON</option>
                                            <option value="OFF">OFF</option>
                                        </select>
                                    </div>


                                    

                                    <div class="col-12 text-center"><label for="">
                                            <dt>Outlet</dt>
                                        </label></div>

                                    @foreach ($cabang as $k)
                                        <div class="col-4">
                                            <label for="{{ $k->nama . $k->id }}"><input type="checkbox"
                                                    id="{{ $k->nama . $k->id }}" value="{{ $k->id }}"
                                                    name="cabang_id[]"> {{ $k->nama }}</label>
                                        </div>
                                    @endforeach

                                </div>
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



    @foreach ($produk as $p)
        <form action="{{ route('editProduk') }}" method="post">
            @csrf
            @method('patch')
            <div class="modal fade" id="edit-product{{ $p->id }}" role="dialog" aria-labelledby="exampleModalLabelEdit"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabelEdit">Edit Produk</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <span class="mdi mdi-close"></span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="row">
                                <input type="hidden" name="id" value="{{ $p->id }}">
                                {{-- <div class="col-sm-4">
                                    <label for="">Masukkan Gambar</label>
                                    <input type="file" class="dropify text-sm"
                                        data-default-file="{{ asset('') }}{{ $p->foto }}" name="foto"
                                        placeholder="Image">
                                </div> --}}
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-lg-6 mb-2">
                                            <label for="">
                                                <dt>Nama Produk</dt>
                                            </label>
                                            <input type="text" name="nm_produk" value="{{ $p->nm_produk }}"
                                                class="form-control" placeholder="Nama Produk" required>
                                        </div>

                                        <div class="col-lg-6 mb-2">
                                            <label for="">
                                                <dt>Kategori</dt>
                                            </label>
                                            <select name="kategori_id" class="form-control" required>
                                                @foreach ($kategori as $k)
                                                    <option value="{{ $k->id }}"
                                                        {{ $k->id == $p->kategori->id ? 'selected' : '' }}>
                                                        {{ $k->kategori }}</option>
                                                @endforeach
                                            </select>
                                        </div>


                                        <div class="col-lg-6 mb-2">
                                            <label for="">
                                                <dt>Status</dt>
                                            </label>
                                            <select name="status" class="form-control" required>
                                                <option value="ON" {{ $p->status == 'ON' ? 'selected' : '' }}>ON
                                                </option>
                                                <option value="OFF" {{ $p->status == 'OFF' ? 'selected' : '' }}>OFF
                                                </option>
                                            </select>
                                        </div>

                                        <div class="col-12 text-center"><label for="">
                                                <dt>Outlet</dt>
                                            </label></div>
                                        @php
                                            $dtProdukCabang = [];
                                        @endphp
                                        @if ($p->produkCabang)
                                            @foreach ($p->produkCabang as $pk)
                                                @php
                                                    $dtProdukCabang[] = $pk->cabang_id;
                                                @endphp
                                            @endforeach
                                        @endif


                                        @foreach ($cabang as $k)
                                            <div class="col-4">
                                                <label for="{{ $k->nama . $k->id . $p->id }}"><input
                                                        id="{{ $k->nama . $k->id . $p->id }}" type="checkbox"
                                                        value="{{ $k->id }}" name="cabang_id[]"
                                                        {{ in_array($k->id, $dtProdukCabang) ? 'checked' : '' }}>
                                                    {{ $k->nama }}</label>
                                            </div>
                                        @endforeach




                                    </div>
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


    <form id="input_resep">
        @csrf
        <div class="modal fade" id="resep" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="header-resep"></h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <input type="hidden" name="produk_id" id="produk_id">
                    <div class="modal-body" id="form-resep">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </div>
            </div>
        </div>
    </form>



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


            function getResep(id) {
                $('#form-resep').html(
                    '<div class="spinner-border text-secondary" role="status"><span class="visually-hidden"></span></div>'
                );
                $.get('getHargaResep/' + id, function(data) {
                    $('#form-resep').html(data);

                    $('.select2bs4').select2({
                        theme: 'bootstrap4'
                    });

                });

            }

            $(document).on('click', '.resep', function() {
                var id = $(this).attr("produk-id");
                var nm_produk = $(this).attr("nm-produk");

                $('#header-resep').html('Resep ' + nm_produk);
                $('#produk_id').val(id);

                getResep(id);



            });

            var count_bahan = 1;
            $(document).on('click', '#tambah-bahan', function() {
                count_bahan = count_bahan + 1;
                var html_code = '<div class="row" id="row' + count_bahan + '">';

                html_code +=
                    '<div class="col-6"><div class="form-group"><select name="bahan_id[]"  class="form-control select2bs4" required><option value="">-Pilih Bahan-</option><?php foreach ($bahan as $b) : ?><option value="<?= $b->id ?>"><?= $b->bahan ?></option><?php endforeach; ?> </select></div></div>';

                html_code +=
                    '<div class="col-5"><div class="form-group"><input type="number" name="takaran[]" class="form-control" required></div></div>';

                html_code += '<div class="col-1"><button type="button" data-row="row' + count_bahan +
                    '" class="btn btn-danger btn-sm remove_bahan">-</button></div>';

                html_code += "</div>";

                $('#tambah-resep').append(html_code);
                $('.select2bs4').select2({
                    theme: 'bootstrap4',
                    tags: true,
                });
            });

            $(document).on('click', '.remove_bahan', function() {
                var delete_row = $(this).data("row");
                $('#' + delete_row).remove();
            });

            $(document).on('submit', '#input_resep', function(event) {
                event.preventDefault();
                var id = $('#produk_id').val();
                $.ajax({
                    url: "{{ route('addResep') }}",
                    method: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        getResep(id);
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: "Resep berhasil dibuat",
                            showConfirmButton: !1,
                            timer: 1500
                        });
                    }
                });

            });

            $(document).on('click', '.hapus-resep', function() {
                var produk_id = $(this).attr("produk-id");
                var id = $(this).attr("id-resep");


                $.ajax({
                    url: "{{ route('dropResep') }}",
                    method: "POST",
                    data: {
                        id: id
                    },
                    success: function(data) {
                        getResep(produk_id);
                        
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: "Resep berhasi dihapus",
                            showConfirmButton: !1,
                            timer: 1500
                        });
                    },
                    error: function(err) { //jika error tampilkan error pada console
                        console.log(err);
                    }

                });



            });



        });
    </script>
@endsection
@endsection
