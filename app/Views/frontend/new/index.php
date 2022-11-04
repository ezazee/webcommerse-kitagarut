<?= $this->extend('layout/template_new'); ?>
<?= $this->section('konten_new'); ?>

<div id="homepage-2">
    <div class="ps-home-banner">
        <div class="ps-carousel--nav-inside owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="5000" data-owl-gap="0" data-owl-nav="true" data-owl-dots="true" data-owl-item="1" data-owl-item-xs="1" data-owl-item-sm="1" data-owl-item-md="1" data-owl-item-lg="1" data-owl-duration="1000" data-owl-mousedrag="on" data-owl-animate-in="fadeIn" data-owl-animate-out="fadeOut">
            <div class="ps-banner--autopart" data-background="/new/img/slider/umkm-kitagarut.jpg"><img src="/new/img/slider/umkm-kitagarut.jpg" alt="">
                <div class="ps-banner__content">
                    <h4>KitaGarut.com</h4>
                    <h3>KITA BELA <br> KITA BELI</h3>

                    <p><strong>DUKUNG UMKM</strong></p><a class="ps-btn" href="<?= base_url('/frontend/new_home/all_produk'); ?>">Belanja Sekarang</a>
                </div>
            </div>
            <div class="ps-banner--autopart" data-background="/new/img/slider/Pertanian-Perkebunan-umkm-kitagarut.jpg"><img src="/new/img/slider/Pertanian-Perkebunan-umkm-kitagarut.jpg" alt="">
                <div class="ps-banner__content">
                    <h4>KitaGarut.com</h4>
                    <h3>KITA BELA <br> KITA BELI</h3>

                    <p><strong>DUKUNG UMKM</strong></p><a class="ps-btn" href="<?= base_url('/frontend/new_home/all_produk'); ?>">Belanja Sekarang</a>
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="ps-home-promotions">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 "><a class="ps-collection mb-30" href="#"><img src="/new/img/promotions/home-2-1.jpg" alt=""></a>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 "><a class="ps-collection mb-30" href="#"><img src="/new/img/promotions/home-2-2.jpg" alt=""></a>
                </div>
            </div>
        </div>
    </div> -->
    <br>

    <!-- <div class="ps-promotion ps-promotion--2">
        <div class="container"><a class="ps-collection" href="#"><img src="/new/img/promotions/home-2-3.jpg" alt=""></a></div>
    </div> -->
    <br>
    <div class="ps-home-categories ps-section--furniture">
        <div class="container">
            <div class="ps-section__header">
                <h3>KATEGORI</h3>
            </div>
            <div class="ps-section__content">
                <div class="row">
                    <?php foreach ($kategori as $row) : ?>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6 ">
                            <div class="ps-block--category">
                                <a href="<?= base_url('/frontend/new_home/produkkategori/' . $row['id_kat']); ?>"></a><img src="<?= base_url('/assets/images/kategori/' . $row['img_kat']); ?>" alt="">

                                <p><?= $row['nama_kat']; ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="ps-home-trending-products ps-section--furniture">
        <div class="container">
            <div class="ps-section__header">
                <h3>PRODUK REKOMENDASI</h3>
            </div>
            <div class="ps-section__content">
                <div class="ps-carousel--nav owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="5000" data-owl-gap="0" data-owl-nav="true" data-owl-dots="true" data-owl-item="5" data-owl-item-xs="2" data-owl-item-sm="3" data-owl-item-md="3" data-owl-item-lg="4" data-owl-duration="1000" data-owl-mousedrag="on">
                    <?php foreach ($all_produk as $row) : ?>
                        <div class="ps-product">
                            <?php
                            echo form_open('/frontend/home/tambah_cart');
                            echo form_hidden('id', $row['id_produk']);
                            echo form_hidden('price', $row['harga_seller']);
                            echo form_hidden('name', $row['nama_produk']);
                            //option
                            echo form_hidden('foto_1', $row['foto_1']);
                            echo form_hidden('kategori', $row['nama_kat']);

                            ?>
                            <div class="ps-product__thumbnail"><a href="/produk/detail-produk/<?= $row['slug']; ?>"><img src="<?= base_url('/assets/images/produk/' . $row['foto_1']) ?>" alt=""></a>
                                <ul class="ps-product__actions">

                                </ul>
                            </div>
                            <div class="ps-product__container"><a class="ps-product__vendor" href="#">KitaGarut</a>
                                <div class="ps-product__content"><a class="ps-product__title" href="product-default.html"><?= $row['nama_produk']; ?></a>
                                    <div class="ps-product__rating">
                                        <div class="ps-rating" data-read-only="true">
                                            <br>
                                        </div>
                                    </div>
                                    <p class="ps-product__price"><?= rupiah($row['harga_seller']); ?></p>
                                </div>
                                <div class="ps-product__content hover"><a class="ps-product__title" href="/produk/detail-produk/<?= $row['slug']; ?>"><?= $row['nama_produk']; ?></a>
                                    <p class="ps-product__price"><?= rupiah($row['harga_seller']); ?></p>
                                </div>
                            </div>
                            <?= form_close(); ?>
                        </div>
                    <?php endforeach; ?>

                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="ps-home-trending-products ps-section--furniture">
        <div class="container">
            <div class="ps-section__header">
                <h3>PRODUK TERBARU</h3>
            </div>
            <div class="ps-section__content">
                <div class="ps-carousel--nav owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="5000" data-owl-gap="0" data-owl-nav="true" data-owl-dots="true" data-owl-item="5" data-owl-item-xs="2" data-owl-item-sm="3" data-owl-item-md="3" data-owl-item-lg="4" data-owl-duration="1000" data-owl-mousedrag="on">
                    <?php foreach ($produkTerbaru as $row) : ?>
                        <div class="ps-product">
                            <?php
                            echo form_open('/frontend/home/tambah_cart');
                            echo form_hidden('id', $row['id_produk']);
                            echo form_hidden('price', $row['harga_seller']);
                            echo form_hidden('name', $row['nama_produk']);
                            //option
                            echo form_hidden('foto_1', $row['foto_1']);
                            echo form_hidden('kategori', $row['nama_kat']);

                            ?>
                            <div class="ps-product__thumbnail"><a href="/produk/detail-produk/<?= $row['slug']; ?>"><img src="<?= base_url('/assets/images/produk/' . $row['foto_1']) ?>" alt=""></a>

                                <div class="ps-product__badge area-garut">Khusus Area Garut</div>

                            </div>
                            <div class="ps-product__container"><a class="ps-product__vendor" href="#">KitaGarut</a>
                                <div class="ps-product__content"><a class="ps-product__title" href="/produk/detail-produk/<?= $row['slug']; ?>"><?= $row['nama_produk']; ?></a>

                                    <div class="ps-product__rating">
                                        <select class="ps-rating" data-read-only="true">
                                            <br>
                                        </select><span></span>
                                    </div>
                                    <p class="ps-product__price"><?= rupiah($row['harga_seller']); ?></p>
                                </div>
                                <div class="ps-product__content hover"><a class="ps-product__title" href="/produk/detail-produk/<?= $row['slug']; ?>"><?= $row['nama_produk']; ?></a>
                                    <p class="ps-product__price"><?= rupiah($row['harga_seller']); ?></p>
                                </div>
                            </div>
                            <?= form_close(); ?>
                        </div>
                    <?php endforeach; ?>

                </div>
            </div>
        </div>
    </div>

    <br>


    <?= $this->include('layout/footer_new2'); ?>

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