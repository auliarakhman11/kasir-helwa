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
                            <div class="col-10">
                                <input type="text" id="search_field" class=" form-control" placeholder="Cari Produk...">
                            </div>
                            <ul class="col-12 list-inline gallery-categories-filter text-center" id="filter">
                                <li class="list-inline-item"><a class="categories active" data-filter="*">All</a></li>
                                @foreach ($gender as $g)
                                    <li class="list-inline-item"><a class="categories"
                                            data-filter=".{{ str_replace(' ', '', $g->nm_gender) }}">{{ $g->nm_gender }}</a>
                                    </li>
                                @endforeach
                                @foreach ($kategori as $k)
                                    <li class="list-inline-item"><a class="categories"
                                            data-filter=".{{ str_replace(' ', '', $k->kategori) }}">{{ $k->kategori }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="row justtify-content-center container-grid projects-wrapper" id="demonames">
                            @foreach ($produk as $d)
                                <div
                                    class="col-4 {{ str_replace(' ', '', $d->gender->nm_gender) }} {{ str_replace(' ', '', $d->kategori->kategori) }}">
                                    <a href="#modal_detail{{ $d->id }}" data-bs-toggle="modal">
                                        <div class="card bg-primary">
                                            <img class="card-img-top img-fluid mt-2" src="{{ asset('img') }}/parfume.png"
                                                style="max-height: 150px;" alt="Card image cap">
                                            <div class="card-body">
                                                <h4 class="card-title font-size-16 mt-0 text-white demoname">
                                                    {{ $d->nm_produk }}</h4>
                                                {{-- <p class="card-text">Some quick example text to build on the card title and make
                                            up the bulk of the card's content.</p>
                                        <a href="#" class="btn btn-primary waves-effect waves-light">Button</a> --}}
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- end row -->



            </div>
            <!-- end container-fluid -->
        </div>
        <!-- end page-content-wrapper -->
    </div>


    @foreach ($produk as $d)
        <div id="modal_detail{{ $d->id }}" class="modal fade" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabeltambah" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0" id="myModalLabeltambah">Detail Produk</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span class="mdi mdi-close"></span>
                        </button>
                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
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

            var btsearch = {
                init: function(search_field, searchable_elements, searchable_text_class) {
                    $(search_field).keyup(function(e) {
                        e.preventDefault();
                        var query = $(this).val().toLowerCase();
                        if (query) {
                            // loop through all elements to find match
                            $.each($(searchable_elements), function() {
                                var title = $(this).find(searchable_text_class).text()
                                    .toLowerCase();
                                if (title.indexOf(query) == -1) {
                                    $(this).hide();
                                } else {
                                    $(this).show();
                                }
                            });
                        } else {
                            // empty query so show everything
                            $(searchable_elements).show();
                        }
                    });
                }
            }

            // INIT
            $(function() {

                btsearch.init('#search_field', '#demonames div', '.demoname');
            });
            //end search



        });
    </script>
@endsection
@endsection
