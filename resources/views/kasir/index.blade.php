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
                                            <img class="card-img-top img-fluid mt-2 lazy" loading="lazy"
                                                src="{{ asset('img') }}/parfume.png" style="max-height: 150px;"
                                                alt="Card image cap">
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
        <form class="input_cart">
            <div id="modal_detail{{ $d->id }}" class="modal fade modal-cart" tabindex="-1" role="dialog"
                aria-labelledby="myModalLabeltambah" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h5 class="modal-title text-white mt-0" id="myModalLabeltambah">Detail Produk
                                {{ $d->nm_produk }}
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <span class="mdi mdi-close"></span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row justify-content-center">
                                <input type="hidden" name="nm_produk" value="{{ $d->nm_produk }}">
                                <input type="hidden" name="id_produk" value="{{ $d->id }}">
                                @foreach ($resep as $r)
                                    <div class="col-3">
                                        <label>

                                            <input type="radio" name="resep_id"
                                                value="{{ $r->id }}|{{ $r->cluster->nm_cluster }}|{{ $r->ukuran }}|{{ $r->harga ? $r->harga : 0 }}"
                                                class="card-input-element" />
                                            <div class="card card-default card-input">
                                                <div class="card-header">{{ $r->cluster->nm_cluster }} {{ $r->ukuran }}
                                                    ml<br>Rp.{{ number_format($r->harga, 0) }}
                                                </div>
                                                {{-- <div class="card-body">
                                                Product specific content
                                            </div> --}}
                                            </div>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary waves-effect"
                                data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div>
        </form>
    @endforeach

    <div id="modal_cart" class="modal fade modal-cart" tabindex="-1" role="dialog" aria-labelledby="myModalLabelcart"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white mt-0" id="myModalLabelcart">Keranjang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span class="mdi mdi-close"></span>
                    </button>
                </div>
                <div class="modal-body" id="cart">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>


@section('script')
    <script type="text/javascript" src="{{ asset('cart') }}/jquery.lazy.min.js"></script>
    <script type="text/javascript" src="{{ asset('cart') }}/jquery.lazy.plugins.min.js"></script>
    <script src="{{ asset('cart') }}/ecom-utils.polyfill.min.js"></script>
    <script src="{{ asset('cart') }}/eventemitter3.umd.min.js"></script>
    <script src="{{ asset('cart') }}/ecom-cart.var.min.js"></script>


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

            function numberWithCommas(x) {
                return x.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",");
            }

            $(function() {
                $('.lazy').Lazy();
            });

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

            function loadCart() {

                let cart = '';
                if (ecomCart.data.items === undefined || ecomCart.data.items.length === 0) {
                    cart +=
                        '<center><br><br><img width="100" src="{{ asset('cart') }}/empty-cart.png" alt=""><br><br><h5>Keranjang belanja kosong!</h5></center>';
                } else {
                    let totl = 0;
                    let jml_produk = 0;
                    cart += '<div class="row">';
                    jQuery.each(ecomCart.data.items, (index, item) => {
                        let subtotal = 0;

                        subtotal += (parseInt(item['price']) * item['quantity']);
                        totl += (parseInt(item['price']) * item['quantity']);
                        jml_produk += item['quantity'];

                        cart +=
                            '<div class="col-4 mt-2 mb-2"><img src="{{ asset('img') }}/parfume.png" class="list-thumbnail border-0" width="130px;"/></div>';

                        cart += '<div class="col-8 mt-2 mb-2"><div class="row">';

                        cart += '<div class="col-12"><p>' + item['name'] + ' (' + item['cluster'] + ') ' +
                            item['ukuran'] + ' ml' + '</p><p>' + item['quantity'] + ' x ' +
                            numberWithCommas(
                                parseInt(item['price'])) + '</p><p>' + numberWithCommas(subtotal) +
                            '</p></div>';

                        cart += '<div class="col-4"><a class="min_cart mr-2" rowId="' + item['_id'] +
                            '" qty="' + item['quantity'] +
                            '" href="javascript:void(0)"><i class="fa fa-minus"></i></a></div>';
                        cart += '<div class="col-4"><a class="delete_cart mr-2" rowId="' + item['_id'] +
                            '" href="javascript:void(0)"><i class="fa fa-times"></i></a></div>';
                        cart += '<div class="col-4"><a class="plus_cart mr-2" rowId="' + item['_id'] +
                            '" qty="' + item['quantity'] +
                            '"  href="javascript:void(0)"><i class="fa fa-plus"></i></a></div>';

                        cart += '</div></div><hr class="bg-primary">';

                    });

                    cart += '</div>';

                    cart += '<div class="container mb-2"><strong>Total ' + jml_produk +
                        ' produk</strong> <strong style="float: right;">Rp. ' + numberWithCommas(totl) +
                        '</strong></div>';

                    cart +=
                        '<div class="row justify-content-center"><div class="col-6"><label for="">Jenis Pembayaran</label><select name="pembayaran_id" class="form-control">@foreach ($pembayaran as $pm)<option value="{{ $pm->id }}">{{ $pm->pembayaran }}</option>@endforeach</select></div><div class="col-12"><hr></div></div><div class="row justify-content-center"> @foreach ($karyawan as $k)<div class="col-4"><label><input type="radio" name="karyawan_id" value="{{ $k->id }}" class="card-input-element"/><div class="card card-default card-input"><div class="card-header">{{ $k->nama }}</div></div></label></div>@endforeach</div>';


                }

                $('#cart').html(cart);
            }

            loadCart();

            $(document).on('submit', '.input_cart', async function(event) {
                event.preventDefault();

                const dataD = $(this).serializeArray();

                //  console.log(dataD);


                let id_produk = '';
                let harga = '';
                let nm_produk = '';
                let qty = 1;

                let cluster_id = '';
                let cluster = '';
                let ukuran = '';

                let varian = [];

                let varian_c = '';

                $.each(dataD, function(index, d) {

                    if (d.name == 'resep_id') {
                        const dat = d.value.split('|');
                        harga = dat[3];
                        cluster_id = dat[0];
                        cluster = dat[1];
                        ukuran = dat[2]
                    }

                    if (d.name == 'id_produk') {
                        id_produk = d.value;
                        // console.log(id_produk);
                    }

                    if (d.name == 'nm_produk') {
                        nm_produk = d.value;
                    }

                    // if (d.name == 'varian_id[]') {
                    //     const dat = d.value.split('|')
                    //     varian.push({
                    //         id: dat[0],
                    //         nm_varian: dat[1],
                    //         harga: 0,
                    //     });

                    //     varian_c += dat[1];

                    // }


                });

                let _id = id_produk + cluster_id + ukuran;
                let product_id = id_produk + cluster_id + ukuran;
                let sku = nm_produk.split(" ").join("") + cluster.split(" ").join("") + ukuran.split(
                    " ").join("");

                await ecomCart.addItem({
                    _id: _id,
                    product_id: product_id,
                    sku: sku,
                    name: nm_produk,
                    quantity: parseInt(qty),
                    price: parseInt(harga),
                    keep_item_price: false,
                    id_bujur: id_produk,
                    cluster_id: cluster_id,
                    cluster: cluster,
                    ukuran: ukuran,
                    diskon: 0,
                    harga_normal: parseInt(harga),
                    dp: 0,
                });

                console.log(ecomCart.data.items);

                loadCart();

                $('.modal-cart').modal('hide');



            });

            $(document).on('click', '.delete_cart', function(event) {
                var rowId = $(this).attr("rowId");

                ecomCart.removeItem(rowId);

                loadCart();

            });

            $(document).on('click', '.min_cart', function() {
                const rowId = $(this).attr("rowId");
                const qty = $(this).attr("qty");

                ecomCart.increaseItemQnt(rowId, -1);
                loadCart();

            });

            $(document).on('click', '.plus_cart', function() {
                const rowId = $(this).attr("rowId");
                const qty = $(this).attr("qty");

                ecomCart.increaseItemQnt(rowId, 1);
                loadCart();

            });

        });
    </script>
@endsection
@endsection
