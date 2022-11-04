<?= $this->extend('layout/template_new'); ?>
<?= $this->section('konten_new'); ?>


<div class="ps-page--shop">
    <div class="ps-container">
        <div class="ps-breadcrumb">
            <div class="ps-container">
                <ul class="breadcrumb">
                    <li><a href="index-2.html"><?= $menu; ?></a></li>
                    <li><?= $submenu; ?></li>
                </ul>
            </div>
        </div>
        <br>

        <div class="ps-layout--shop">
            <div class="ps-layout__left">
                <aside class="widget widget_shop">
                    <h4 class="widget-title">Kategori</h4>
                    <ul class="ps-list--categories">
                        <!-- <li class="current-menu-item menu-item-has-children"><a href="shop-default.html">Clothing &amp; Apparel</a><span class="sub-toggle"><i class="fa fa-angle-down"></i></span>
                            <ul class="sub-menu">
                                <li class="current-menu-item "><a href="shop-default.html">Womens</a>
                                </li>
                            </ul>
                        </li> -->
                        <?php foreach ($kategori as $row) : ?>
                            <li class="current-menu-item "><a href="/frontend/new_home/produkkategori/<?= $row['id_kat']; ?>"><?= $row['nama_kat']; ?></a></li>

                        <?php endforeach; ?>
                    </ul>
                </aside>

            </div>
            <div class=" ps-layout__right">
                <?php if (!empty($keyword)) : ?>
                    <div class="alert alert-info alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        Hasil Pencarian untuk : <strong> <?= $keyword; ?></strong>
                    </div>
                <?php endif; ?>
                <?php if (empty($keyword)) : ?>
                    <div class="ps-block--shop-features">

                        <div class="ps-block__header">
                            <h3>Produk Terlaris</h3>
                            <div class="ps-block__navigation"><a class="ps-carousel__prev" href="#recommended1"><i class="icon-chevron-left"></i></a><a class="ps-carousel__next" href="#recommended1"><i class="icon-chevron-right"></i></a></div>
                        </div>
                        <div class="ps-block__content">
                            <div class="owl-slider" id="recommended1" data-owl-auto="true" data-owl-loop="true" data-owl-speed="10000" data-owl-gap="30" data-owl-nav="false" data-owl-dots="false" data-owl-item="6" data-owl-item-xs="2" data-owl-item-sm="2" data-owl-item-md="3" data-owl-item-lg="4" data-owl-item-xl="5" data-owl-duration="1000" data-owl-mousedrag="on">
                                <?php foreach ($BestSeller as $row) : ?>
                                    <div class="ps-product">
                                        <div class="ps-product__thumbnail"><a href="/produk/detail-produk/<?= $row['slug']; ?>"><img src="<?= base_url('/assets/images/produk/' . $row['foto_1']) ?>" alt=""></a>
                                            <ul class="ps-product__actions">
                                            </ul>
                                        </div>
                                        <div class="ps-product__container"><a class="ps-product__vendor" href="#">KitaGarut</a>
                                            <div class="ps-product__content"><a class="ps-product__title" href="/produk/detail-produk/<?= $row['slug']; ?>"><?= $row['nama_produk']; ?></a>
                                                <div class="ps-product__rating">
                                                    <br>
                                                </div>
                                                <p class="ps-product__price"><?= rupiah($row['harga_seller']); ?></p>
                                            </div>
                                            <div class="ps-product__content hover"><a class="ps-product__title" href="/produk/detail-produk/<?= $row['slug']; ?>"><?= $row['nama_produk']; ?></a>
                                                <p class="ps-product__price"><?= rupiah($row['harga_seller']); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="ps-shopping ps-tab-root">
                    <div class="ps-shopping__header">
                        <p>Jumlah Produk <strong><?= $numRows['jumlah']; ?> Data</strong> | Kategori<strong> <?= $id['nama_kat']; ?></strong></p>
                        <div class="ps-shopping__actions">
                            <!-- <select class="ps-select" data-placeholder="Sort Items">
                                <option>Sort by latest</option>
                                <option>Sort by popularity</option>
                                <option>Sort by average rating</option>
                                <option>Sort by price: low to high</option>
                                <option>Sort by price: high to low</option>
                            </select> -->
                            <div class="ps-shopping__view">
                                <p>View</p>
                                <ul class="ps-tab-list">
                                    <li class="active"><a href="#tab-1"><i class="icon-grid"></i></a></li>
                                    <li><a href="#tab-2"><i class="icon-list4"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="ps-tabs">
                        <div class="ps-tab active" id="tab-1">
                            <div class="ps-shopping-product">
                                <div class="row">
                                    <?php foreach ($produk_kategori as $row) : ?>
                                        <div class="col-xl-2 col-lg-4 col-md-4 col-sm-6 col-6 ">
                                            <div class="ps-product">
                                                <div class="ps-product__thumbnail"><a href="/produk/detail-produk/<?= $row['slug']; ?>"><img src="<?= base_url('/assets/images/produk/' . $row['foto_1']) ?>" alt=""></a>
                                                    <ul class="ps-product__actions">
                                                    </ul>
                                                </div>
                                                <div class="ps-product__container"><a class="ps-product__vendor" href="#">KitaGarut</a>
                                                    <div class="ps-product__content"><a class="ps-product__title" href="/produk/detail-produk/<?= $row['slug']; ?>"><?= $row['nama_produk']; ?></a>
                                                        <p class="ps-product__price"><?= rupiah($row['harga_seller']); ?></p>
                                                    </div>
                                                    <div class="ps-product__content hover"><a class="ps-product__title" href="/produk/detail-produk/<?= $row['slug']; ?>"><?= $row['nama_produk']; ?></a>
                                                        <p class="ps-product__price"><?= rupiah($row['harga_seller']); ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>

                                </div>
                            </div>
                            <div class="ps-pagination">
                                <ul class="pagination">
                                    <?= $pager->links(); ?>
                                </ul>
                            </div>
                        </div>
                        <div class="ps-tab" id="tab-2">
                            <div class="ps-shopping-product">
                                <?php foreach ($produk_kategori as $row) : ?>
                                    <div class="ps-product ps-product--wide">
                                        <div class="ps-product__thumbnail"><a href="/produk/detail-produk/<?= $row['slug']; ?>"><img src="<?= base_url('/assets/images/produk/' . $row['foto_1']) ?>" alt=""></a>
                                        </div>
                                        <div class="ps-product__container">
                                            <div class="ps-product__content"><a class="ps-product__title" href="/produk/detail-produk/<?= $row['slug']; ?>"><?= $row['nama_produk']; ?></a>
                                                <p class="ps-product__vendor">Sold by:<a href="#">KitaGarut</a></p>
                                                <?= $row['desc_produk']; ?>
                                            </div>
                                            <div class="ps-product__shopping">
                                                <p class="ps-product__price"><?= rupiah($row['harga_seller']); ?></p><a class="ps-btn" href="#">Masukan Keranjang</a>
                                                <ul class="ps-product__actions">
                                                    <!-- <li><a href="#"><i class="icon-heart"></i> Wishlist</a></li>
                                                        <li><a href="#"><i class="icon-chart-bars"></i> Compare</a></li> -->
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>

                            </div>
                            <div class="ps-pagination">
                                <ul class="pagination">
                                    <?= $pager->links(); ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal" id="shop-filter-lastest" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="list-group"><a class="list-group-item list-group-item-action" href="#">Sort by</a><a class="list-group-item list-group-item-action" href="#">Sort by average rating</a><a class="list-group-item list-group-item-action" href="#">Sort by latest</a><a class="list-group-item list-group-item-action" href="#">Sort by price: low to high</a><a class="list-group-item list-group-item-action" href="#">Sort by price: high to low</a><a class="list-group-item list-group-item-action text-center" href="#" data-dismiss="modal"><strong>Close</strong></a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->include('layout/footer_new2'); ?>
<?= $this->endSection(); ?>