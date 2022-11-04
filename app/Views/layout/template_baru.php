<!DOCTYPE html>
<html lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?= $judul; ?> || UMKM Online</title>
    <meta name='title' content='KitaGarut, GKD'>
    <meta name='description' content='PT. Graha Kara Digital menghadirkan Kita Garut sebagai salah satu langkah untuk membantu pelaku usaha mikro kecil dan menengah (UMKM) agar bisa bertahan di tengah pandemi COVID-19.'>
    <meta name='keyword' content='umkm,ukm, bisnis ukm,usaha kecil,perkembangan ukm, ukm umkm, peluang usaha,usaha kecil menengah,perkembangan ukm di indonesia,apa itu ukm umkm, UMKM, Kitagarut, PT. GRAHA KARA DIGITAL, GARUT, DIGITALISASI UMKM, IT Garut, Garut teknologi, digitalisasi UMKM, konfenia.com, infornations'>
    <meta name="keywords" content="umkm,ukm, bisnis ukm,usaha kecil,perkembangan ukm, ukm umkm, peluang usaha,usaha kecil menengah,perkembangan ukm di indonesia,apa itu ukm umkm, UMKM, Kitagarut, PT. GRAHA KARA DIGITAL, GARUT, DIGITALISASI UMKM, IT Garut, Garut teknologi, digitalisasi UMKM, konfenia.com, infornations">
    <meta name="author" content="KitaGarut, GKD">
    <meta property='og:type' content='article'>
    <meta property='og:title' content='Kita Garut Hadirkan Toko Online Bagi Para Pelaku UMKM'>
    <meta property='og:description' content='PT. Graha Kara Digital menghadirkan Kita Garut sebagai salah satu langkah untuk membantu pelaku usaha mikro kecil dan menengah (UMKM) agar bisa bertahan di tengah pandemi COVID-19.'>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="English">
    <meta name="robots" content="index, follow">
    <meta name="revisit-after" content="1 days">

    <link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700&amp;amp;subset=latin-ext" rel="stylesheet">
    <link rel="stylesheet" href="/new/plugins/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/new/fonts/Linearicons/Linearicons/Font/demo-files/demo.css">
    <link rel="stylesheet" href="/new/plugins/bootstrap4/css/bootstrap.min.css">
    <link rel="stylesheet" href="/new/plugins/owl-carousel/assets/owl.carousel.css">
    <link rel="stylesheet" href="/new/plugins/slick/slick/slick.css">
    <link rel="stylesheet" href="/new/plugins/lightGallery-master/dist/css/lightgallery.min.css">
    <link rel="stylesheet" href="/new/plugins/jquery-bar-rating/dist/themes/fontawesome-stars.css">
    <link rel="stylesheet" href="/new/plugins/jquery-ui/jquery-ui.min.css">
    <link rel="stylesheet" href="/new/plugins/select2/dist/css/select2.min.css">
    <link rel="stylesheet" href="/new/css/style.css">
    <link rel="stylesheet" href="/new/css/autopart.css">
    <link rel="stylesheet" href="/new/css/furniture.css">


    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-180482433-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-180482433-1');
    </script>

    <?= $this->renderSection('head'); ?>

</head>

<body>
    <div id="WAButton"></div>
    <header class="header header--standard header--autopart" data-sticky="true">
        <div class="header__top">
            <div class="container">
                <div class="header__left">
                    <p><strong>GRATIS ONGKIR</strong> untuk pembelian diatas 250.000</p>
                </div>
                <div class="header__right">
                    <ul class="header__top-links">

                        <li><a href="#">Lacak Pengiriman</a></li>
                        <!-- <li>
                            <div class="ps-dropdown"><a href="#">US Dollar</a>
                                <ul class="ps-dropdown-menu">
                                    <li><a href="#">Us Dollar</a></li>
                                    <li><a href="#">Euro</a></li>
                                </ul>
                            </div>
                        </li> -->
                        <li>
                            <?php if (session()->email_pel != null) : ?>
                                <div class="ps-block--user-header">
                                    <div class="ps-block__left"><i class="icon-user"></i></div>
                                    <div class="ps-block__right"><a href="#"><?= $user['nama_pel']; ?></a><a href="/frontend/new_home/logout">Logout</a></div>
                                </div>
                            <?php else : ?>
                                <div class="ps-block--user-header">
                                    <div class="ps-block__left"><i class="icon-user"></i></div>
                                    <div class="ps-block__right"><a href="/frontend/new_home/login">Login</a><a href="/frontend/new_home/login" class="text-danger">Register</a></div>
                                </div>
                            <?php endif; ?>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="header__content">
            <div class="container">
                <div class="header__content-left"><a class="ps-logo" href="/"><img src="/new/img/logo.png" alt=""></a>
                    <div class="menu--product-categories">
                        <div class="menu__toggle"><i class="icon-menu"></i><span>Pilih Kategori Produk</span></div>
                        <div class="menu__content">
                            <ul class="menu--dropdown">
                                <?php foreach ($kategori as $row) : ?>
                                    <li class="current-menu-item "><a href="/frontend/new_home/produkkategori/<?= $row['id_kat']; ?>"><?= $row['nama_kat']; ?></a></li>
                                <?php endforeach; ?>

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="header__content-center">
                    <form class="ps-form--quick-search" action="/frontend/new_home/all_produk" method="get">
                        <div class="form-group--icon"><i class="icon-magnifier"></i>
                        </div>
                        <input class="form-control" type="text" placeholder="Cari Produk ... " name="keyword">
                        <button type="submit">Cari</button>
                    </form>
                </div>
                <div class="header__content-right">
                    <div class="header__actions">
                        <div class="ps-block--header-hotline">
                            <div class="ps-block__left"><i class="icon-telephone"></i></div>
                            <div class="ps-block__right">
                                <p>Hotline<strong>0821-1747-4002</strong></p>
                            </div>
                        </div>
                        <?php
                        $keranjang = $cart->contents();
                        $jml_item = 0;

                        foreach ($keranjang as $key => $value) {
                            $jml_item = $jml_item + $value['qty'];
                        } ?>
                        <div class="ps-cart--mini"><a class="header__extra" href="#"><i class="icon-bag2"></i><span><i><?= $jml_item; ?></i></span></a>
                            <div class="ps-cart__content">
                                <?php if (empty($keranjang)) : ?>
                                    <div class="ps-cart__items">
                                        <div class="text-center">
                                            <p>Keranjang belanja kosong</p>
                                        </div>
                                    </div>
                                <?php else : ?>
                                    <div class=" ps-cart__items">
                                        <?php $total = 0; ?>
                                        <?php foreach ($keranjang as $key => $value) : ?>
                                            <div class="ps-product--cart-mobile">
                                                <div class="ps-product__thumbnail"><a href="/frontend/new_home/singleproduk/<?= $value['id']; ?>"><img src="<?= base_url('/assets/images/produk/' . $value['options']['foto_1']) ?>" width="50px"" alt=""></a></div>
                                        <div class=" ps-product__content"><a class="ps-product__remove" href="/frontend/new_home/hapus_cart/<?= $value['rowid']; ?>"><i class="icon-cross"></i></a><a href="/frontend/new_home/singleproduk/<?= $value['id']; ?>"><?= $value['name']; ?></a>
                                                        <br><small><?= rupiah($value['price']); ?> x <?= $value['qty']; ?> = <?= rupiah($value['subtotal']); ?></small>
                                                </div>
                                            </div>
                                            <?php $total += $value['subtotal']; ?>
                                        <?php endforeach; ?>
                                    </div>
                                    <div class="ps-cart__footer">
                                        <h3>Sub Total:<strong><?= rupiah($total); ?></strong></h3>
                                        <figure><a class="ps-btn" href="/frontend/new_home/load_cart"><i class="fa fa-shopping-cart"></i> Lihat</a><a class="ps-btn" href="/frontend/new_home/load_cart">Bayar</a></figure>
                                    </div>
                            </div>
                        <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <nav class="navigation">
            <div class="container">
                <ul class="menu menu--technology">
                    <li class="current-menu-item active"><a href="/frontend/new_home">Home</a></li>
                    <li class="current-menu-item "><a href="/frontend/new_home/all_produk">mulai belanja</a></li>
                    <li class="current-menu-item "><a href="/frontend/new_home/load_cart">keranjang</a></li>
                    <li class="current-menu-item "><a href="/frontend/new_home/syaratketentuan">Syarat &amp; Ketentuan</a></li>
                    <li class="current-menu-item "><a href="/frontend/new_home/kontak">KONTAK</a></li>
                    <?php if (session()->get('id_pel') == FALSE) : ?>
                        <li class="current-menu-item active"><a href="/frontend/new_home/login">LOGIN</a></li>
                    <?php endif; ?>
                    <?php if (session()->get('id_pel') == TRUE) : ?>
                        <li class="current-menu-item "><a href="/frontend/new_home/pesananku">PESANAN SAYA</a></li>
                    <?php endif; ?>

                </ul>
            </div>
        </nav>
    </header>
    <header class="header header--mobile autopart" data-sticky="true">
        <div class="header__top">
            <div class="header__left">
                <p>Selamat Datang di KitaGarut.com !</p>
            </div>
            <div class="header__right">
                <ul class="navigation__extra">
                    <li><a href="#">Lacak Kiriman</a></li>
                </ul>
            </div>
        </div>
        <div class="navigation--mobile">
            <div class="navigation__left"><a class="ps-logo" href="/"><img src="/new/img/logo.png" alt="" width="150px"></a></div>
            <div class="navigation__right">
                <div class="header__actions">
                    <div class="ps-cart--mini">
                        <a class="header__extra  ps-toggle--sidebar" href="#cart-mobile">
                            <i class="icon-bag2"></i>
                            <span><i><?= $jml_item; ?></i></span>
                        </a>

                    </div>
                    <?php if (session()->email_pel != null) : ?>
                        <div class="ps-block--user-header">
                            <div class="ps-block__left"><i class="icon-user"></i></div>
                            <div class="ps-block__right"><a href="#"><?= $user['nama_pel']; ?></a></div>
                        </div>
                    <?php else : ?>
                        <div class="ps-block--user-header">
                            <div class="ps-block__left"><i class="icon-user"></i></div>
                            <div class="ps-block__right"><a href="/frontend/new_home/login">Login</a><a href="/frontend/new_home/login">Register</a></div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="ps-search--mobile">
            <form class="ps-form--search-mobile" action="/frontend/new_home/all_produk" method="get">
                <div class="form-group--nest">
                    <input class="form-control" type="text" placeholder="Cari Produk ..." name="keyword">
                    <button type="submit"><i class="icon-magnifier"></i></button>
                </div>
            </form>
        </div>
    </header>
    <div class="ps-panel--sidebar" id="cart-mobile">
        <div class="ps-panel__header">
            <div class="row">
                <div class="col-3 text-left">
                    <h3><a class="text-left header__extra btn btn-info ps-toggle--sidebar" href="#cart-mobile"><i class="fa fa-arrow-left"></i> Back</a></h3>
                </div>
                <div class="col-9 text-left">
                    <h3>Keranjang Belanja</h3>
                </div>
            </div>
        </div>
        <div class="navigation__content">
            <div class="ps-cart--mobile">

                <div class="ps-cart__content">

                    <?php $total = 0; ?>
                    <?php foreach ($keranjang as $key => $value) : ?>
                        <div class="ps-product--cart-mobile">
                            <div class="ps-product__thumbnail"><a href="/frontend/new_home/singleproduk/<?= $value['id']; ?>"><img src="<?= base_url('/assets/images/produk/' . $value['options']['foto_1']) ?>" alt=""></a></div>
                            <div class="ps-product__content"><a class="ps-product__remove" href="/frontend/new_home/hapus_cart/<?= $value['rowid']; ?>"><i class="icon-cross"></i></a><a href="/frontend/new_home/singleproduk/<?= $value['id']; ?>"><?= $value['name']; ?></a>
                                <br><small><?= rupiah($value['price']); ?> x <?= $value['qty']; ?> = <?= rupiah($value['subtotal']); ?></small>
                            </div>
                        </div>
                        <br>
                        <?php $total += $value['subtotal']; ?>
                    <?php endforeach; ?>
                </div>

                <div class="ps-cart__footer">
                    <h3>Sub Total:<strong><?= rupiah($total); ?></strong></h3>
                    <figure><a class="ps-btn" href="/frontend/new_home/load_cart"><i class="fa fa-shopping-cart"></i> Lihat</a><a class="ps-btn" href="/frontend/new_home/load_cart">Bayar</a></figure>
                </div>
            </div>
        </div>
    </div>
    <div class="ps-panel--sidebar" id="navigation-mobile">
        <div class="ps-panel__header">
            <h3>Kategori</h3>
        </div>
        <div class="ps-panel__content">
            <ul class="menu--mobile">
                <?php foreach ($kategori as $row) : ?>
                    <li class="current-menu-item "><a href="/frontend/new_home/produkkategori/<?= $row['id_kat']; ?>"><?= $row['nama_kat']; ?></a></li>

                <?php endforeach; ?>

                <!-- <li class="current-menu-item menu-item-has-children has-mega-menu"><a href="#">Computer &amp; Technology</a><span class="sub-toggle"></span>
                    <div class="mega-menu">
                        <div class="mega-menu__column">
                            <h4>Computer &amp; Technologies<span class="sub-toggle"></span></h4>
                            <ul class="mega-menu__list">
                                <li class="current-menu-item "><a href="#">Computer &amp; Tablets</a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </li> -->

            </ul>
        </div>
    </div>
    <div class="navigation--list">
        <div class="navigation__content">
            <a class="navigation__item ps-toggle--sidebar" href="#menu-mobile">
                <i class="icon-menu"></i>
                <span> Menu</span>
            </a>
            <a class="navigation__item ps-toggle--sidebar" href="#navigation-mobile">
                <i class="icon-list4"></i>
                <span> Kategori</span>
            </a>
            <a class="navigation__item ps-toggle--sidebar" href="#search-sidebar">
                <i class="icon-magnifier"></i>
                <span> Cari</span>
            </a>
            <a class="navigation__item ps-toggle--sidebar" href="#cart-mobile">
                <i class="icon-bag2"></i>
                <span> Keranjang</span>
            </a>
        </div>
    </div>
    <div class="ps-panel--sidebar" id="search-sidebar">
        <div class="ps-panel__header">
            <form class="ps-form--search-mobile" action="/frontend/new_home/all_produk" method="get">
                <div class="form-group--nest">
                    <input class="form-control" type="text" placeholder="Cari Produk ..." name="keyword">
                    <button type="submit"><i class="icon-magnifier"></i></button>
                </div>
            </form>
        </div>
        <div class="navigation__content"></div>
    </div>
    <div class="ps-panel--sidebar" id="menu-mobile">
        <div class="ps-panel__header">
            <h3>Menu</h3>
        </div>
        <div class="ps-panel__content">
            <ul class="menu--mobile">
                <li class="menu-item"><a href="/frontend/new_home">Home</a></li>
                <li class="menu-item"><a href="/frontend/new_home/all_produk">Mulai Belanja</a>
                <li class="menu-item"><a href="/frontend/new_home/load_cart">Keranjang</a>
                <li class="menu-item "><a href="/frontend/new_home/syaratketentuan">Syarat &amp; Ketentuan</a></li>
                <li class="menu-item"><a href="/frontend/new_home/kontak">Kontak</a></li>
                <?php if (session()->get('id_pel') == FALSE) : ?>
                    <li class="menu-item active"><a href="/frontend/new_home/login">LOGIN</a></li>
                <?php endif; ?>
                <?php if (session()->get('id_pel') == TRUE) : ?>
                    <li class="menu-item "><a href="/frontend/new_home/pesananku">PESANAN SAYA</a></li>
                <?php endif; ?>
                <!-- <li class="menu-item-has-children has-mega-menu"><a href="shop-default.html">Shop</a><span class="sub-toggle"></span>
                    <div class="mega-menu">
                        <div class="mega-menu__column">
                            <h4>Catalog Pages<span class="sub-toggle"></span></h4>
                            <ul class="mega-menu__list">
                                <li class="current-menu-item "><a href="shop-default.html">Shop Default</a>
                                </li>

                            </ul>
                        </div>

                    </div>
                </li> -->

            </ul>
        </div>
    </div>

    <?= $this->renderSection('konten_new'); ?>