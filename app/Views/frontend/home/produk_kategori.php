<?= $this->extend('layout/template_depan'); ?>
<?= $this->section('konten_depan'); ?>
<!-- pages-title-start -->
<section class="contact-img-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="con-text">
                    <h2 class="page-title">Shop</h2>
                    <p><a href="#">Home</a> | shop</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- pages-title-end -->

<div class="row newsletter-area">
    <div class="signup-newsletter">
        <h2>Pencarian Produk</h2>
        <div class="blog-search">
            <form action="/frontend/home/produkSearch/" method="post">
                <input type="text" name="search" placeholder="Pencarian Produk">
                <button type="submit">Cari</button>
            </form>
        </div>
    </div>
</div>

<!-- shop-style content section start -->
<section class="pages products-page section-padding-top">
    <div class="container">
        <div class="alert alert-info alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Kategori : <?= $id['nama_kat']; ?></strong>
        </div>
        <br>
        <div class="row">
            <div class="col-md-4 col-lg-3 col-sm-12">
                <div class="all-shop-sidebar">
                    <div class="top-shop-sidebar">
                        <h3 class="wg-title">SHOP BY</h3>
                    </div>
                    <div class="shop-one">
                        <h3 class="wg-title2">Kategori</h3>
                        <ul class="product-categories">
                            <?php foreach ($kategori as $row) : ?>
                                <li class="cat-item <?php echo $row['id_kat'] == $id['id_kat'] ? 'current-cat' : ''; ?>">
                                    <a href="/frontend/home/produkkategori/<?= $row['id_kat']; ?>"><?= $row['nama_kat']; ?></a>
                                    <!-- <span class="count">(10)</span> -->
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <br><br>

                    <div class="top-shop-sidebar an-shop">
                        <h3 class="wg-title">Terlaris</h3>
                        <ul>
                            <?php foreach ($BestSeller as $row) : ?>
                                <li class="b-none">
                                    <div class="tb-recent-thumbb">
                                        <a href="/frontend/home/produkDetail/<?= $row['id_produk']; ?>">
                                            <img class="attachment" src="<?= base_url('/assets/images/produk/' . $row['foto_1']) ?>" alt="">
                                        </a>
                                    </div>
                                    <div class="tb-recentb">
                                        <div class="tb-beg">
                                            <a href="/frontend/home/produkDetail/<?= $row['id_produk']; ?>"><?= $row['nama_produk']; ?></a>
                                        </div>
                                        <div class="tb-product-price font-noraure-3">
                                            <span class="amount"><?= rupiah($row['harga_seller']); ?></span>
                                        </div>
                                    </div>
                                </li>
                            <?php endforeach; ?>

                        </ul>
                    </div>
                    <br><br>
                    <div class="ro-info-box-wrap tpl3 st">
                        <div class="tb-image">
                            <img src="/front/img/products/4.jpg" alt="">
                        </div>
                        <div class="tb-content">
                            <div class="tb-content-inner an-inner">
                                <h5>UMKM</h5>
                                <h3>KITA GARUT</h3>
                                <h6>
                                    <a href="#">BELANJA SEKARANG</a>
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br><br>
            <div class="col-md-8 col-lg-9 col-sm-12">
                <div class="row">

                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="features-tab">
                            <!-- Nav tabs -->
                            <div class="shop-all-tab">
                                <div class="two-part">
                                    <ul class="nav tabs" role="tablist">
                                        <li class="vali">View as:</li>
                                        <li role="presentation" class="active"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab"><i class="fa fa-align-justify"></i></a></li>
                                        <li role="presentation"><a href="#home" aria-controls="home" role="tab" data-toggle="tab"><i class="fa fa-th-large"></i></a></li>
                                    </ul>
                                </div>
                                <!-- <div class="re-shop">
                                    <div class="sort-by">
                                        <div class="shop6">
                                            <label>Sort By :</label>
                                            <select>
                                                <option value="">Default sorting</option>
                                                <option value="">Sort by popularity</option>
                                                <option value="">Sort by average rating</option>
                                                <option value="">Sort by newness</option>
                                                <option value="">Sort by price: low to high</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="shop5">
                                        <label>Show :</label>
                                        <select>
                                            <option value="">12</option>
                                            <option value="">24</option>
                                            <option value="">36</option>
                                        </select>
                                    </div>
                                </div> -->
                            </div>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane" id="home">
                                    <div class="row">
                                        <div class="shop-tab">
                                            <?php foreach ($produk_kategori as $row) : ?>
                                                <div class="col-md-4 col-lg-4 col-sm-6">
                                                    <?php
                                                    echo form_open('/frontend/home/tambah_cart');
                                                    echo form_hidden('id', $row['id_produk']);
                                                    echo form_hidden('price', $row['harga_seller']);
                                                    echo form_hidden('name', $row['nama_produk']);
                                                    //option
                                                    echo form_hidden('foto_1', $row['foto_1']);


                                                    ?>
                                                    <div class="single-product s-res sha s-non s-top">
                                                        <div class="product-img">

                                                            <a href="/frontend/home/produkDetail/<?= $row['id_produk']; ?>">
                                                                <img src="<?= base_url('/assets/images/produk/' . $row['foto_1']) ?>" alt="Product Title" />
                                                                <img class="secondary-image" alt="Product Title" src="<?= base_url('/assets/images/produk/' . $row['foto_1']) ?>">
                                                            </a>
                                                        </div>
                                                        <div class="product-dsc">
                                                            <h3><a href="/frontend/home/produkDetail/<?= $row['id_produk']; ?>" data-toggle="tooltip" data-placement="top" title="<?= $row['nama_produk']; ?>"><?= substr($row['nama_produk'], 0, 25); ?></a></h3>
                                                            <div class="star-price">
                                                                <span class="price-left"><?= rupiah($row['harga_seller']); ?></span>
                                                                <span class="star-right">
                                                                    <a href="javascript:void(0)" class="btn btn-info btn-quickview" data-placement="top" data-id="<?= $row['id_produk']; ?>" data-desc_produk='<?= $row['desc_produk']; ?>' data-nama_produk="<?= $row['nama_produk']; ?>" data-SKU="<?= $row['SKU']; ?>" data-harga_seller="<?= $row['harga_seller']; ?>" data-foto_1="<?= $row['foto_1']; ?>" data-trigger="hover" data-original-title="Quick View"><i class="fa fa-eye"></i></a>

                                                                    <button class="btn btn-success add_cart" data-toggle="tooltip" data-placement="top" title="Masukan Keranjang"><i class="fa fa-shopping-cart"></i> Tambah</button>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="actions-btn">

                                                        </div>
                                                    </div>
                                                </div>
                                                <?= form_close(); ?>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane active" id="profile">
                                    <div class="row">
                                        <?php foreach ($produk_kategori as $row) : ?>
                                            <?php
                                            echo form_open('/frontend/home/tambah_cart');
                                            echo form_hidden('id', $row['id_produk']);
                                            echo form_hidden('price', $row['harga_seller']);
                                            echo form_hidden('name', $row['nama_produk']);
                                            //option
                                            echo form_hidden('foto_1', $row['foto_1']);


                                            ?>
                                            <div class="li-item">
                                                <div class="col-md-4 col-sm-4">
                                                    <div class="tb-product-item-inner tb2 pct-last">

                                                        <div class="re-img">
                                                            <a href="/frontend/home/produkDetail/<?= $row['id_produk']; ?>"><img alt="" src="<?= base_url('/assets/images/produk/' . $row['foto_1']) ?>"></a>
                                                        </div>
                                                        <div class="actions-btn">

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 col-sm-8">
                                                    <div class="f-fix">
                                                        <div class="tb-beg">
                                                            <a href="/frontend/home/produkDetail/<?= $row['id_produk']; ?>"><?= $row['nama_produk']; ?></a>
                                                        </div>
                                                        <div class="tb-product-wrap-price-rating">
                                                            <div class="tb-product-price font-noraure-3">
                                                                <span class="amount2 ana"><?= rupiah($row['harga_seller']); ?></span>

                                                            </div>
                                                        </div>
                                                        <div class="desc">
                                                            <?= substr($row['desc_produk'], 0, 150); ?> ...
                                                        </div>
                                                        <div class="last-cart l-mrgn ns">
                                                            <button class="btn btn-success add_cart" data-toggle="tooltip" data-placement="top" title="Masukan Keranjang"><i class="fa fa-shopping-cart"></i> Masukan Keranjang</button>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <?= form_close(); ?>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                            <br><br><br>
                            <div class="shop-all-tab-cr shop-bottom">
                                <div class="two-part">
                                    <div class="shop5 page">
                                        <?= $pager->links(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- shop-style  content section end -->


<?= $this->include('layout/footer_depan'); ?>

<script>
    function rupiah(angka) {
        var reverse = angka.toString().split('').reverse().join(''),
            ribuan = reverse.match(/\d{1,3}/g);
        ribuan = ribuan.join(' .').split('').reverse().join('');
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
                }); // QuickView $('.shop-tab').on('click', '.btn-quickview' , function() { // get data from button edit const id=$(this).data('id'); const desc_produk=$(this).data('desc_produk'); const nama_produk=$(this).data('nama_produk'); const SKU=$(this).data('SKU'); const harga_seller=$(this).data('harga_seller'); const foto_1=$(this).data('foto_1'); // Set data to Form Edit $('#id_produk').val(id); $('#nama_produk').text(nama_produk); $('#desc_produk').html(desc_produk); $('#SKU').val(SKU); $('#harga_seller').text('Rp. ' + rupiah(harga_seller));
                $(' #foto_1a').attr('src', '/assets/images/produk/' + foto_1);
                $('#foto_1b').attr('src', '/assets/images/produk/' + foto_1); // Call Modal Edit $('#quick-view').modal('show'); }); }); 
</script> <?= $this->endSection(); ?>