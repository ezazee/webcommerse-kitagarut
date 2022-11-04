<?= $this->extend('layout/template_new'); ?>
<?= $this->section('konten_new'); ?>

<!-- <nav class="navigation--mobile-product"><a class="ps-btn ps-btn--black" href="shopping-cart.html">Add to cart</a><a class="ps-btn" href="checkout.html">Buy Now</a></nav> -->
<div class="ps-breadcrumb">
    <div class="ps-container">
        <ul class="breadcrumb">
            <li><a href=""><?= $menu; ?></a></li>
            <li><a href=""><?= $submenu; ?></a></li>
            <li><a href=""><?= $produkdetail['nama_produk']; ?></a></li>

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
                                        <div class="item"><a href="<?= base_url('/assets/images/produk/' . $produkdetail['foto_1']) ?>"><img src="<?= base_url('/assets/images/produk/' . $produkdetail['foto_1']) ?>" alt=""></a>
                                        </div>
                                        <?php if ($produkdetail['foto_2'] != null) : ?>
                                            <div class="item"><a href="<?= base_url('/assets/images/produk/' . $produkdetail['foto_2']) ?>"><img src="<?= base_url('/assets/images/produk/' . $produkdetail['foto_2']) ?>" alt=""></a>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ($produkdetail['foto_3'] != null) : ?>
                                            <div class="item"><a href="<?= base_url('/assets/images/produk/' . $produkdetail['foto_3']) ?>"><img src="<?= base_url('/assets/images/produk/' . $produkdetail['foto_3']) ?>" alt=""></a>
                                            </div>
                                        <?php endif; ?>

                                    </div>
                                </div>
                            </figure>
                            <div class="ps-product__variants" data-item="4" data-md="4" data-sm="4" data-arrow="false">
                                <div class="item"><img src="<?= base_url('/assets/images/produk/' . $produkdetail['foto_1']) ?>" alt=""></div>
                                <?php if ($produkdetail['foto_2'] != null) : ?>
                                    <div class="item"><img src="<?= base_url('/assets/images/produk/' . $produkdetail['foto_2']) ?>" alt=""></div>
                                <?php endif; ?>
                                <?php if ($produkdetail['foto_3'] != null) : ?>
                                    <div class="item"><img src="<?= base_url('/assets/images/produk/' . $produkdetail['foto_3']) ?>" alt=""></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="ps-product__info">
                            <h1><?= $produkdetail['nama_produk']; ?></h1>
                            <div class="ps-product__meta">

                                <div class="ps-product__rating">

                                </div>
                            </div>
                            <h4 class="ps-product__price"><?= rupiah($produkdetail['harga_seller']); ?></h4>
                            <div class="ps-product__desc">

                            </div>

                            <div class="ps-product__shopping">
                                <figure>
                                    <figcaption>Quantity</figcaption>
                                    <div class="form-group--number">
                                        <button class="up"><i class="fa fa-plus"></i></button>
                                        <button class="down"><i class="fa fa-minus"></i></button>
                                        <input class="form-control" name="qty" id="<?= $produkdetail['id_produk']; ?>" value="1" type="text" placeholder="1">
                                    </div>
                                </figure>

                                <button class="add_cart ps-btn ps-btn--black" data-id_produk="<?= $produkdetail['id_produk']; ?>" data-harga_seller="<?= $produkdetail['harga_seller']; ?>" data-nama_produk="<?= $produkdetail['nama_produk']; ?>" data-foto_1="<?= $produkdetail['foto_1']; ?>"><i class="fa fa-shopping-cart"></i> Tambah</button>

                                <a class="ps-btn" href="#">Buy Now</a>

                            </div>

                            <div class="ps-product__specification">
                                <p><strong>SKU:</strong> <?= $produkdetail['SKU']; ?></p>
                                <p class="categories"><strong> Categories:</strong><a href="#"><?= $produkdetail['nama_kat']; ?></a>
                            </div>
                            <div class="ps-product__sharing"><a class="facebook" href="#"><i class="fa fa-facebook"></i></a><a class="twitter" href="#"><i class="fa fa-twitter"></i></a><a class="google" href="#"><i class="fa fa-google-plus"></i></a><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a><a class="instagram" href="#"><i class="fa fa-instagram"></i></a></div>
                        </div>

                    </div>

                    <div class="ps-product__content ps-tab-root">
                        <ul class="ps-tab-list">
                            <li class="active"><a href="#tab-1">Description</a></li>
                            <li><a href="#tab-4">Reviews (1)</a></li>
                        </ul>
                        <div class="ps-tabs">
                            <div class="ps-tab active" id="tab-1">
                                <div class="ps-document">
                                    <?= $produkdetail['desc_produk']; ?>
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
                    <p><i class="icon-network"></i> Shipping worldwide</p>
                    <p><i class="icon-3d-rotate"></i> Free 7-day return if eligible, so easy</p>
                    <p><i class="icon-receipt"></i> Supplier give bills for this product.</p>
                    <p><i class="icon-credit-card"></i> Pay online or when receiving goods</p>
                </aside>
                <aside class="widget widget_sell-on-site">
                    <p><i class="icon-store"></i> Sell on Martfury?<a href="#"> Register Now !</a></p>
                </aside>
                <aside class="widget widget_ads"><a href="#"><img src="img/ads/product-ads.png" alt=""></a></aside>
                <aside class="widget widget_same-brand">
                    <h3>Same Brand</h3>
                    <div class="widget__content">
                        <?php $diskon = 10; ?>
                        <?php foreach ($produk_samping2 as $row) : ?>
                            <div class="ps-product">
                                <div class="ps-product__thumbnail"><a href="/frontend/new_home/singleProduk/<?= $row['id_produk']; ?>"><img src="<?= base_url('/assets/images/produk/' . $row['foto_1']) ?>" alt=""></a>
                                    <div class="ps-product__badge">- <?= $diskon; ?> %</div>
                                    <ul class="ps-product__actions">

                                    </ul>
                                </div>
                                <div class="ps-product__container"><a class="ps-product__vendor" href="#">Robert's Store</a>
                                    <div class="ps-product__content"><a class="ps-product__title" href="/frontend/new_home/singleProduk/<?= $row['id_produk']; ?>"><?= $row['nama_produk']; ?></a>
                                        <div class="ps-product__rating">

                                        </div>
                                        <?php $nominal_diskon = ($row['harga_seller'] * $diskon) / 100; ?>
                                        <p class="ps-product__price sale"><?= rupiah($row['harga_seller']); ?> <del><?= rupiah($row['harga_seller'] + $nominal_diskon); ?> </del></p>
                                    </div>
                                    <div class="ps-product__content hover"><a class="ps-product__title" href="/frontend/new_home/singleProduk/<?= $row['id_produk']; ?>"><?= $row['nama_produk']; ?></a>
                                        <p class="ps-product__price sale"><?= rupiah($row['harga_seller']); ?> <del><?= rupiah($row['harga_seller'] + $nominal_diskon); ?> </del></p>
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
                            <div class="ps-product__thumbnail"><a href="/frontend/new_home/singleProduk/<?= $row['id_produk']; ?>"><img src="<?= base_url('/assets/images/produk/' . $row['foto_1']) ?>" alt=""></a>
                                <ul class="ps-product__actions">

                                </ul>
                            </div>
                            <div class="ps-product__container"><a class="ps-product__vendor" href="/frontend/new_home/singleProduk/<?= $row['id_produk']; ?>">KitaGarut</a>
                                <div class="ps-product__content"><a class="ps-product__title" href="/frontend/new_home/singleProduk/<?= $row['id_produk']; ?>"><?= $row['nama_produk']; ?></a>
                                    <div class="ps-product__rating">
                                        <br>
                                    </div>
                                    <p class="ps-product__price"><?= rupiah($row['harga_seller']); ?></p>
                                </div>
                                <div class="ps-product__content hover"><a class="ps-product__title" href="/frontend/new_home/singleProduk/<?= $row['id_produk']; ?>"><?= $row['nama_produk']; ?></a>
                                    <p class="ps-product__price"><?= rupiah($row['harga_seller']); ?></p>
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
        $('.add_cart').click(function() {
            var id_produk = $(this).data("id_produk");
            var nama_produk = $(this).data("nama_produk");
            var harga_seller = $(this).data("harga_seller");
            var qty = $('#' + id_produk).val();
            $.ajax({
                url: "<?php echo base_url(); ?>frontend/new_home/tambah_cart",
                method: "POST",
                data: {
                    id_produk: id_produk,
                    nama_produk: nama_produk,
                    harga_seller: harga_seller,
                    qty: qty
                },
                success: function(data) {
                    $('#detail_cart').html(data);
                }
            });
        });

        // Load shopping cart
        $('#detail_cart').load("<?php echo base_url(); ?>index.php/cart/load_cart");

        //Hapus Item Cart
        $(document).on('click', '.hapus_cart', function() {
            var row_id = $(this).attr("id"); //mengambil row_id dari artibut id
            $.ajax({
                url: "<?php echo base_url(); ?>cart/hapus_cart",
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
</script>
<?= $this->endSection(); ?>