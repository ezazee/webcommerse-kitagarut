<?= $this->extend('layout/template_depan'); ?>
<?= $this->section('konten_depan'); ?>
<?= $this->include('layout/slider_home'); ?>
<section class="featured-products single-products section-padding-top">
    <div class="container">


        <div class="row">
            <div class="col-xs-12">
                <div class="section-title">
                    <h3>Kategori Produk</h3>
                    <div class="section-icon">
                        <i class="fa fa-dot-circle-o" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="product-tab nav nav-tabs">
                    <ul>
                        <li class="active"><a data-toggle="tab" href="#all">Semua</a></li>
                        <?php foreach ($kategori as $row) : ?>
                            <li><a data-toggle="tab" href="#<?= str_replace(' ', '', $row['nama_kat']); ?>"><?= $row['nama_kat']; ?></a></li>

                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row tab-content">
            <div class="tab-pane  fade in active" id="all">
                <div id="tab-carousel-1" class="re-owl-carousel owl-carousel product-slider owl-theme">
                    <?php foreach ($all_produk as $row) : ?>
                        <div class="col-xs-12">
                            <?php
                            echo form_open('/frontend/home/tambah_cart');
                            echo form_hidden('id', $row['id_produk']);
                            echo form_hidden('price', $row['harga_seller']);
                            echo form_hidden('name', $row['nama_produk']);
                            //option
                            echo form_hidden('foto_1', $row['foto_1']);
                            echo form_hidden('kategori', $row['nama_kat']);

                            ?>
                            <div class="single-product" id="single-product">
                                <div class="product-img">
                                    <div class="pro-type">
                                        <span>sale</span>
                                    </div>
                                    <a href="/frontend/home/produkDetail/<?= $row['id_produk']; ?>">
                                        <img src="<?= base_url('/assets/images/produk/' . $row['foto_1']) ?>" alt="Product Title" />
                                        <img class="secondary-image" alt="Product Title" src="<?= base_url('/assets/images/produk/' . $row['foto_1']) ?>">
                                    </a>
                                </div>
                                <div class="product-dsc">
                                    <h3><a href="/frontend/home/produkDetail/<?= $row['id_produk']; ?>"><?= $row['nama_produk']; ?></a></h3>
                                    <div class="star-price">
                                        <span class="price-left"><?= rupiah($row['harga_seller']); ?></span>
                                        <span class="star-right">
                                            <a href="javascript:void(0)" class="btn btn-info btn-quickview" data-placement="top" data-id="<?= $row['id_produk']; ?>" data-desc_produk="<?= $row['desc_produk']; ?>" data-nama_produk="<?= $row['nama_produk']; ?>" data-SKU="<?= $row['SKU']; ?>" data-harga_seller="<?= $row['harga_seller']; ?>" data-foto_1="<?= $row['foto_1']; ?>" data-trigger="hover" data-original-title="Quick View"><i class="fa fa-eye"></i></a>

                                            <button class="btn btn-success add_cart" data-toggle="tooltip" data-placement="top" title="Masukan Keranjang"><i class="fa fa-shopping-cart"></i> Tambah</button>
                                        </span>
                                    </div>
                                </div>
                                <div class="actions-btn">

                                </div>
                            </div>
                            <?= form_close(); ?>

                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <!-- all shop product end -->
            <div class="tab-pane  fade in" id="KebunKita">
                <div id="tab-carousel-2" class="owl-carousel product-slider owl-theme">
                    <?php foreach ($produk_kebun as $row) : ?>
                        <div class="col-xs-12">
                            <?php
                            echo form_open('/frontend/home/tambah_cart');
                            echo form_hidden('id', $row['id_produk']);
                            echo form_hidden('price', $row['harga_seller']);
                            echo form_hidden('name', $row['nama_produk']);
                            //option
                            echo form_hidden('foto_1', $row['foto_1']);
                            echo form_hidden('kategori', $row['nama_kat']);

                            ?>
                            <div class="single-product">
                                <div class="product-img">
                                    <a href="/frontend/home/produkDetail/<?= $row['id_produk']; ?>">
                                        <img src="<?= base_url('/assets/images/produk/' . $row['foto_1']) ?>" alt="Product Title" />
                                        <img class="secondary-image" alt="Product Title" src="<?= base_url('/assets/images/produk/' . $row['foto_1']) ?>">
                                    </a>
                                </div>
                                <div class="product-dsc">
                                    <h3><a href="/frontend/home/produkDetail/<?= $row['id_produk']; ?>"><?= $row['nama_produk']; ?></a></h3>
                                    <div class="star-price">
                                        <span class="price-left"><?= rupiah($row['harga_seller']); ?></span>
                                        <span class="star-right">
                                            <a href="javascript:void(0)" class="btn btn-info btn-quickview" data-placement="top" data-id="<?= $row['id_produk']; ?>" data-desc_produk="<?= $row['desc_produk']; ?>" data-nama_produk="<?= $row['nama_produk']; ?>" data-SKU="<?= $row['SKU']; ?>" data-harga_seller="<?= $row['harga_seller']; ?>" data-foto_1="<?= $row['foto_1']; ?>" data-trigger="hover" data-original-title="Quick View"><i class="fa fa-eye"></i></a>

                                            <button class="btn btn-success add_cart" data-toggle="tooltip" data-placement="top" title="Masukan Keranjang"><i class="fa fa-shopping-cart"></i> Tambah</button>
                                        </span>
                                    </div>
                                </div>
                                <div class="actions-btn">

                                </div>
                            </div>
                            <?= form_close(); ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <!-- clothings product end -->
            <div class="tab-pane  fade in" id="KerajinanKita">
                <div id="tab-carousel-3" class="owl-carousel product-slider owl-theme">
                    <?php foreach ($produk_kerajinan as $row) : ?>
                        <div class="col-xs-12">
                            <?php
                            echo form_open('/frontend/home/tambah_cart');
                            echo form_hidden('id', $row['id_produk']);
                            echo form_hidden('price', $row['harga_seller']);
                            echo form_hidden('name', $row['nama_produk']);
                            //option
                            echo form_hidden('foto_1', $row['foto_1']);
                            echo form_hidden('kategori', $row['nama_kat']);

                            ?>
                            <div class="single-product">
                                <div class="product-img">
                                    <div class="pro-type">
                                        <span>sale</span>
                                    </div>
                                    <a href="/frontend/home/produkDetail/<?= $row['id_produk']; ?>">
                                        <img src="<?= base_url('/assets/images/produk/' . $row['foto_1']) ?>" alt="Product Title" />
                                        <img class="secondary-image" alt="Product Title" src="<?= base_url('/assets/images/produk/' . $row['foto_1']) ?>">
                                    </a>
                                </div>
                                <div class="product-dsc">
                                    <h3><a href="/frontend/home/produkDetail/<?= $row['id_produk']; ?>"><?= $row['nama_produk']; ?></a></h3>
                                    <div class="star-price">
                                        <span class="price-left"><?= rupiah($row['harga_seller']); ?></span>
                                        <span class="star-right">
                                            <a href="javascript:void(0)" class="btn btn-info btn-quickview" data-placement="top" data-id="<?= $row['id_produk']; ?>" data-desc_produk="<?= $row['desc_produk']; ?>" data-nama_produk="<?= $row['nama_produk']; ?>" data-SKU="<?= $row['SKU']; ?>" data-harga_seller="<?= $row['harga_seller']; ?>" data-foto_1="<?= $row['foto_1']; ?>" data-trigger="hover" data-original-title="Quick View"><i class="fa fa-eye"></i></a>

                                            <button class="btn btn-success add_cart" data-toggle="tooltip" data-placement="top" title="Masukan Keranjang"><i class="fa fa-shopping-cart"></i> Tambah</button>
                                        </span>
                                    </div>
                                </div>
                                <div class="actions-btn">

                                </div>
                            </div>
                            <?= form_close(); ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <!-- shoes product end -->
            <div class="tab-pane  fade in" id="TernakKita">
                <div id="tab-carousel-4" class="owl-carousel product-slider owl-theme">
                    <?php foreach ($produk_ternak as $row) : ?>
                        <div class="col-xs-12">
                            <?php
                            echo form_open('/frontend/home/tambah_cart');
                            echo form_hidden('id', $row['id_produk']);
                            echo form_hidden('price', $row['harga_seller']);
                            echo form_hidden('name', $row['nama_produk']);
                            //option
                            echo form_hidden('foto_1', $row['foto_1']);
                            echo form_hidden('kategori', $row['nama_kat']);

                            ?>
                            <div class="single-product">
                                <div class="product-img">
                                    <div class="pro-type">
                                        <span>new</span>
                                    </div>
                                    <a href="/frontend/home/produkDetail/<?= $row['id_produk']; ?>">
                                        <img src="<?= base_url('/assets/images/produk/' . $row['foto_1']) ?>" alt="Product Title" />
                                        <img class="secondary-image" alt="Product Title" src="<?= base_url('/assets/images/produk/' . $row['foto_1']) ?>">
                                    </a>
                                </div>
                                <div class="product-dsc">
                                    <h3><a href="/frontend/home/produkDetail/<?= $row['id_produk']; ?>"><?= $row['nama_produk']; ?></a></h3>
                                    <div class="star-price">
                                        <span class="price-left"><?= rupiah($row['harga_seller']); ?></span>
                                        <span class="star-right">
                                            <a href="javascript:void(0)" class="btn btn-info btn-quickview" data-placement="top" data-id="<?= $row['id_produk']; ?>" data-desc_produk="<?= $row['desc_produk']; ?>" data-nama_produk="<?= $row['nama_produk']; ?>" data-SKU="<?= $row['SKU']; ?>" data-harga_seller="<?= $row['harga_seller']; ?>" data-foto_1="<?= $row['foto_1']; ?>" data-trigger="hover" data-original-title="Quick View"><i class="fa fa-eye"></i></a>

                                            <button class="btn btn-success add_cart" data-toggle="tooltip" data-placement="top" title="Masukan Keranjang"><i class="fa fa-shopping-cart"></i> Tambah</button>
                                        </span>
                                    </div>
                                </div>
                                <div class="actions-btn">

                                </div>
                            </div>
                            <?= form_close(); ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <!-- bags product end -->
            <div class="tab-pane  fade in" id="KulinerKita">
                <div id="tab-carousel-5" class="owl-carousel product-slider owl-theme">
                    <?php foreach ($produk_kuliner as $row) : ?>
                        <div class="col-xs-12">
                            <?php
                            echo form_open('/frontend/home/tambah_cart');
                            echo form_hidden('id', $row['id_produk']);
                            echo form_hidden('price', $row['harga_seller']);
                            echo form_hidden('name', $row['nama_produk']);
                            //option
                            echo form_hidden('foto_1', $row['foto_1']);
                            echo form_hidden('kategori', $row['nama_kat']);

                            ?>
                            <div class="single-product">
                                <div class="product-img">
                                    <div class="pro-type">
                                        <span>sale</span>
                                    </div>
                                    <a href="/frontend/home/produkDetail/<?= $row['id_produk']; ?>">
                                        <img src="<?= base_url('/assets/images/produk/' . $row['foto_1']) ?>" alt="Product Title" />
                                        <img class="secondary-image" alt="Product Title" src="<?= base_url('/assets/images/produk/' . $row['foto_1']) ?>">
                                    </a>
                                </div>
                                <div class="product-dsc">
                                    <h3><a href="/frontend/home/produkDetail/<?= $row['id_produk']; ?>"><?= $row['nama_produk']; ?></a></h3>
                                    <div class="star-price">
                                        <span class="price-left"><?= rupiah($row['harga_seller']); ?></span>
                                        <span class="star-right">
                                            <a href="javascript:void(0)" class="btn btn-info btn-quickview" data-placement="top" data-id="<?= $row['id_produk']; ?>" data-desc_produk="<?= $row['desc_produk']; ?>" data-nama_produk="<?= $row['nama_produk']; ?>" data-SKU="<?= $row['SKU']; ?>" data-harga_seller="<?= $row['harga_seller']; ?>" data-foto_1="<?= $row['foto_1']; ?>" data-trigger="hover" data-original-title="Quick View"><i class="fa fa-eye"></i></a>

                                            <button class="btn btn-success add_cart" data-toggle="tooltip" data-placement="top" title="Masukan Keranjang"><i class="fa fa-shopping-cart"></i> Tambah</button>
                                        </span>
                                    </div>
                                </div>
                                <div class="actions-btn">

                                </div>
                            </div>
                            <?= form_close(); ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <!-- accessories product end -->
        </div>
    </div>
</section>
<!-- new-products section end -->

<!-- new-products section start -->
<section class="new-products single-products section-padding-top">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="section-title">
                    <h3>terbaru di upload</h3>
                    <div class="section-icon">
                        <i class="fa fa-dot-circle-o" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div id="new-products" class="owl-carousel product-slider owl-theme">
                <?php foreach ($produkTerbaru as $row) : ?>
                    <div class="col-xs-12">
                        <?php
                        echo form_open('/frontend/home/tambah_cart');
                        echo form_hidden('id', $row['id_produk']);
                        echo form_hidden('price', $row['harga_seller']);
                        echo form_hidden('name', $row['nama_produk']);
                        //option
                        echo form_hidden('foto_1', $row['foto_1']);
                        echo form_hidden('kategori', $row['nama_kat']);

                        ?>
                        <div class="single-product">
                            <div class="product-img">
                                <div class="pro-type">
                                    <span>NEW</span>
                                </div>
                                <a href="/frontend/home/produkDetail/<?= $row['id_produk']; ?>">
                                    <img src="<?= base_url('/assets/images/produk/' . $row['foto_1']) ?>" alt="Product Title" />
                                    <img class="secondary-image" alt="Product Title" src="<?= base_url('/assets/images/produk/' . $row['foto_1']) ?>">
                                </a>
                            </div>
                            <div class="product-dsc">
                                <h3><a href="/frontend/home/produkDetail/<?= $row['id_produk']; ?>"><?= $row['nama_produk']; ?></a></h3>
                                <div class="star-price">
                                    <span class="price-left"><?= rupiah($row['harga_seller']); ?></span>
                                    <span class="star-right">
                                        <a href="javascript:void(0)" class="btn btn-info btn-quickview" data-placement="top" data-id="<?= $row['id_produk']; ?>" data-desc_produk="<?= $row['desc_produk']; ?>" data-nama_produk="<?= $row['nama_produk']; ?>" data-SKU="<?= $row['SKU']; ?>" data-harga_seller="<?= $row['harga_seller']; ?>" data-foto_1="<?= $row['foto_1']; ?>" data-trigger="hover" data-original-title="Quick View"><i class="fa fa-eye"></i></a>

                                        <button class="btn btn-success add_cart" data-toggle="tooltip" data-placement="top" title="Masukan Keranjang"><i class="fa fa-shopping-cart"></i> Tambah</button>
                                    </span>
                                </div>
                            </div>
                            <div class="actions-btn">

                            </div>
                        </div>
                        <?= form_close(); ?>
                    </div>

                <?php endforeach; ?>

            </div>
        </div>
    </div>
</section>

<?= $this->include('layout/footer_depan'); ?>

<script>
    function rupiah(angka) {
        var reverse = angka.toString().split('').reverse().join(''),
            ribuan = reverse.match(/\d{1,3}/g);
        ribuan = ribuan.join('.').split('').reverse().join('');
        return ribuan;
    }

    $(document).ready(function() {

        $(document).ready(function() {
            $('.single-product').on('click', '.add_cart', function() {

                var product_id = $(this).data("id");
                var product_name = $(this).data("nama_produk");
                var product_price = $(this).data("harga_seller");
                var quantity = $('#' + product_id).val();
                $.ajax({
                    url: '/frontend/home/add_to_cart',
                    method: "POST",
                    data: {
                        product_id: product_id,
                        product_name: product_name,
                        product_price: product_price,
                        quantity: quantity
                    },
                    success: function(data) {
                        $('#detail_cart').html(data);
                    }
                });
            });


            $('#detail_cart').load("<?php echo site_url('product/load_cart'); ?>");


            $(document).on('click', '.romove_cart', function() {
                var row_id = $(this).attr("id");
                $.ajax({
                    url: "<?php echo site_url('frontend/home/delete_cart'); ?>",
                    method: "POST",
                    data: {
                        row_id: row_id
                    },
                    success: function(data) {
                        $('#detail_cart').html(data);
                    }
                });
            });
        });

        // QuickView
        $('.single-product').on('click', '.btn-quickview', function() {
            // get data from button edit
            const id = $(this).data('id');
            const desc_produk = $(this).data('desc_produk');
            const nama_produk = $(this).data('nama_produk');
            const SKU = $(this).data('SKU');
            const harga_seller = $(this).data('harga_seller');
            const foto_1 = $(this).data('foto_1');

            // Set data to Form Edit
            $('#id_produk').val(id);
            $('#nama_produk').text(nama_produk);
            $('#desc_produk').html(desc_produk);
            $('#SKU').val(SKU);
            $('#harga_seller').text('Rp. ' + rupiah(harga_seller));
            $('#foto_1a').attr('src', '/assets/images/produk/' + foto_1);
            $('#foto_1b').attr('src', '/assets/images/produk/' + foto_1);


            // Call Modal Edit
            $('#quick-view').modal('show');
        });

    });
</script>
<?= $this->endSection(); ?>