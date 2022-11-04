<?= $this->extend('layout/template_single_jasa'); ?>
<?= $this->section('konten_new'); ?>

<!-- <nav class="navigation--mobile-product"><a class="ps-btn ps-btn--black" href="shopping-cart.html">Add to cart</a><a class="ps-btn" href="checkout.html">Buy Now</a></nav> -->
<div class="ps-breadcrumb">
    <div class="ps-container">
        <ul class="breadcrumb">
            <li><a href=""><?= $menu; ?></a></li>
            <li><a href=""><?= $submenu; ?></a></li>
            <li><a href=""><?= $jasadetail['nama_jasa']; ?></a></li>

        </ul>
    </div>
</div>

<div class="ps-page--product">
    <div class="ps-container">
        <?php if (session()->getFlashdata('pesan')) : ?>

            <div class="alert alert-info alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong><?= session()->getFlashdata('pesan'); ?></strong>
            </div>
            <br>
        <?php endif; ?>
        <div class="ps-page__container">
            <div class="ps-page__left">
                <div class="ps-product--detail ps-product--fullwidth">
                    <div class="ps-product__header">
                        <div class="ps-product__thumbnail" data-vertical="true">
                            <figure>
                                <div class="ps-wrapper">
                                    <div class="ps-product__gallery" data-arrow="true">
                                        <div class="item"><a href="<?= base_url('/assets/images/jasa/' . $jasadetail['foto_jasa']) ?>"><img src="<?= base_url('/assets/images/jasa/' . $jasadetail['foto_jasa']) ?>" alt=""></a>
                                        </div>
                                    </div>
                                </div>
                            </figure>
                            <div class="ps-product__variants" data-item="4" data-md="4" data-sm="4" data-arrow="false">
                                <div class="item"><img src="<?= base_url('/assets/images/jasa/' . $jasadetail['foto_jasa']) ?>" alt=""></div>
                            </div>
                        </div>

                        <div class="ps-product__info">
                            <h1><?= $jasadetail['nama_jasa']; ?></h1>
                            <div class="ps-product__meta">

                                <div class="ps-product__rating">

                                </div>
                            </div>
                            <h4 class="ps-product__price"><?= rupiah($jasadetail['harga_jual']); ?></h4>
                            <hr>
                            <div class="ps-product__desc">

                                <aside class="widget widget_product widget_features">
                                    <p><i class="fa fa-car"></i> <?= $jasadetail['transmisi']; ?></p>
                                    <p><i class="fa fa-wheelchair"></i> <?= $jasadetail['sopir']; ?></p>

                                </aside>
                            </div>
                            <?php
                            echo form_open(base_url('frontend/new_home/tambah_cart_qty'));
                            echo form_hidden('id', $jasadetail['id_jasa']);
                            echo form_hidden('price', $jasadetail['harga_jual']);
                            echo form_hidden('name', $jasadetail['nama_jasa']);
                            //option
                            echo form_hidden('foto_jasa', $jasadetail['foto_jasa']);
                            echo form_hidden('harga_produk', $jasadetail['harga_jual']);
                            echo form_hidden('nama_merchant', $jasadetail['nama_toko']);
                            echo form_hidden('id_merchant', $jasadetail['id_penyedia']);
                            ?>
                            <div class="ps-product__shopping">

                                <div class="col-6 ">
                                    <p class="categories"><strong> Kategori:</strong><a href="#"><?= $jasadetail['nama_kat']; ?></a>
                                        <p class="categories"><strong> Sub Kategori:</strong><a href="#"><?= $jasadetail['nama_sub_kategori']; ?></a>
                                            <p class="categories"><strong> Penyedia:</strong><a href="#"><?= $jasadetail['nama_toko']; ?></a>
                                </div>
                                <div class="col-6 align-self-center">
                                    <a href="https://wa.me/6289623624255?text=Saya%20ingin%20memesan%20<?= $jasadetail['nama_jasa']; ?>%20di kitaGarut%20.." target="_blank" class="ps-btn align-middle" style="background-color: #4FCE5D;"><i class="fa fa-whatsapp" aria-hidden="true"></i> Pesan</a>
                                    <!-- <a class="ps-btn" href="#">Buy Now</a> -->
                                </div>

                            </div>
                            <?= form_close(); ?>

                        </div>

                    </div>

                    <div class="ps-product__content ps-tab-root col-sm-12">
                        <ul class="ps-tab-list">
                            <li class="active"><a href="#tab-1">Syarat & Ketentuan Rental</a></li>
                            <li><a href="#tab-4">Reviews (1)</a></li>
                        </ul>
                        <div class="ps-tabs">
                            <div class="ps-tab active col-sm-12" id="tab-1">
                                <div class="ps-document">
                                    <?= $jasadetail['syarat']; ?>
                                </div>
                            </div>
                            <div class="ps-tab" id="tab-4">
                                <div class="row">
                                    <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 col-12 ">
                                        <div class="ps-block--average-rating">
                                            <div class="ps-block__header">
                                                <h3>4.00</h3>
                                                <select class="ps-rating" data-read-only="true">
                                                    <option value="1">1</option>
                                                    <option value="1">2</option>
                                                    <option value="1">3</option>
                                                    <option value="1">4</option>
                                                    <option value="2">5</option>
                                                </select><span>1 Review</span>
                                            </div>
                                            <div class="ps-block__star"><span>5 Star</span>
                                                <div class="ps-progress" data-value="100"><span></span></div><span>100%</span>
                                            </div>
                                            <div class="ps-block__star"><span>4 Star</span>
                                                <div class="ps-progress" data-value="0"><span></span></div><span>0</span>
                                            </div>
                                            <div class="ps-block__star"><span>3 Star</span>
                                                <div class="ps-progress" data-value="0"><span></span></div><span>0</span>
                                            </div>
                                            <div class="ps-block__star"><span>2 Star</span>
                                                <div class="ps-progress" data-value="0"><span></span></div><span>0</span>
                                            </div>
                                            <div class="ps-block__star"><span>1 Star</span>
                                                <div class="ps-progress" data-value="0"><span></span></div><span>0</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12 col-12 ">
                                        <form class="ps-form--review" action="http://nouthemes.net/html/martfury/index.html" method="get">
                                            <h4>Submit Your Review</h4>
                                            <p>Your email address will not be published. Required fields are marked<sup>*</sup></p>
                                            <div class="form-group form-group__rating">
                                                <label>Your rating of this product</label>
                                                <select class="ps-rating" data-read-only="false">
                                                    <option value="0">0</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <textarea class="form-control" rows="6" placeholder="Write your review here"></textarea>
                                            </div>
                                            <div class="row">
                                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12  ">
                                                    <div class="form-group">
                                                        <input class="form-control" type="text" placeholder="Your Name">
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12  ">
                                                    <div class="form-group">
                                                        <input class="form-control" type="email" placeholder="Your Email">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group submit">
                                                <button class="ps-btn">Submit Review</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="ps-page__right">
                <aside class="widget widget_product widget_features">
                    <p><i class="icon-tags"></i> Kembalikan Bensin seperti semula</p>
                    <p><i class="icon-ticket"></i> Penggunaan hingga 24 jam perhari rental</p>
                    <p><i class="icon-smile"></i> Customer Services</p>
                    <p><i class="icon-credit-card"></i> Pembayaran Online </p>
                </aside>
                <aside class="widget widget_sell-on-site">
                    <p><i class="icon-store"></i> Pasang Jasa di KitaGarut?<a href="#"> Daftar Sekarang !</a></p>
                </aside>
                <aside class="widget widget_ads"><a href="#"><img src="img/ads/product-ads.png" alt=""></a></aside>
                <aside class="widget widget_same-brand">
                    <h3>Diskon</h3>
                    <div class="widget__content">
                        <?php $diskon = 10; ?>
                        <?php foreach ($produk_samping2 as $row) : ?>
                            <div class="ps-product">
                                <div class="ps-product__thumbnail"><a href="/jasa/detail-jasa/<?= $row['slug_jasa']; ?>"><img src="<?= base_url('/assets/images/jasa/' . $row['foto_jasa']) ?>" alt=""></a>
                                    <div class="ps-product__badge">- <?= $diskon; ?> %</div>
                                    <ul class="ps-product__actions">

                                    </ul>
                                </div>
                                <div class="ps-product__container"><a class="ps-product__vendor" href="#">KitaGarut</a>
                                    <div class="ps-product__content"><a class="ps-product__title" href="/jasa/detail-jasa/<?= $row['slug_jasa']; ?>"><?= $row['nama_jasa']; ?></a>
                                        <div class="ps-product__rating">

                                        </div>
                                        <?php $nominal_diskon = ($row['harga_jual'] * $diskon) / 100; ?>
                                        <p class="ps-product__price sale"><?= rupiah($row['harga_jual']); ?> <del><?= rupiah($row['harga_jual'] + $nominal_diskon); ?> </del></p>
                                    </div>
                                    <div class="ps-product__content hover"><a class="ps-product__title" href="/jasa/detail-jasa/<?= $row['slug_jasa']; ?>"><?= $row['nama_jasa']; ?></a>
                                        <p class="ps-product__price sale"><?= rupiah($row['harga_jual']); ?> <del><?= rupiah($row['harga_jual'] + $nominal_diskon); ?> </del></p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </aside>
            </div>
        </div>

        <div class="ps-section--default">
            <div class="ps-section__header">
                <h3>Produk Sejenis</h3>
            </div>
            <div class="ps-section__content">
                <div class="ps-carousel--nav owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="10000" data-owl-gap="30" data-owl-nav="true" data-owl-dots="true" data-owl-item="6" data-owl-item-xs="2" data-owl-item-sm="2" data-owl-item-md="3" data-owl-item-lg="4" data-owl-item-xl="5" data-owl-duration="1000" data-owl-mousedrag="on">
                    <?php foreach ($produk_samping as $row) : ?>
                        <div class="ps-product">
                            <div class="ps-product__thumbnail"><a href="/jasa/detail-jasa/<?= $row['slug_jasa']; ?>"><img src="<?= base_url('/assets/images/jasa/' . $row['foto_jasa']) ?>" alt=""></a>
                                <ul class="ps-product__actions">

                                </ul>
                            </div>
                            <div class="ps-product__container"><a class="ps-product__vendor" href="/jasa/detail-jasa/<?= $row['slug_jasa']; ?>">KitaGarut</a>
                                <div class="ps-product__content"><a class="ps-product__title" href="/jasa/detail-jasa/<?= $row['slug_jasa']; ?>"><?= $row['nama_jasa']; ?></a>
                                    <div class="ps-product__rating">
                                        <br>
                                    </div>
                                    <p class="ps-product__price"><?= rupiah($row['harga_jual']); ?></p>
                                </div>
                                <div class="ps-product__content hover"><a class="ps-product__title" href="/jasa/detail-jasa/<?= $row['slug_jasa']; ?>"><?= $row['nama_jasa']; ?></a>
                                    <p class="ps-product__price"><?= rupiah($row['harga_jual']); ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
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
                var product_name = $(this).data("nama_jasa");
                var product_price = $(this).data("harga_jual");
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
            const nama_jasa = $(this).data('nama_jasa');
            const SKU = $(this).data('SKU');
            const harga_jual = $(this).data('harga_jual');
            const foto_jasa = $(this).data('foto_jasa');

            // Set data to Form Edit
            $('#id_jasa').val(id);
            $('#nama_jasa').text(nama_jasa);
            $('#desc_produk').html(desc_produk);
            $('#SKU').val(SKU);
            $('#harga_jual').text('Rp. ' + rupiah(harga_jual));
            $('#foto_jasaa').attr('src', '/assets/images/produk/' + foto_jasa);
            $('#foto_jasab').attr('src', '/assets/images/produk/' + foto_jasa);


            // Call Modal Edit
            $('#quick-view').modal('show');
        });

    });
</script>
<?= $this->endSection(); ?>