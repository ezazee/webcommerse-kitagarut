<?= $this->extend('layout/template'); ?>
<?= $this->section('konten'); ?>
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor"><?= $judul; ?></h4>
            </div>
            <div class="col-md-7 col-xs-12 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)"><?= $menu; ?></a></li>
                        <li class="breadcrumb-item active"><?= $judul; ?></li>

                    </ol>


                </div>
            </div>
        </div>
        <div class="row">
            <!-- Column -->
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><a href="/backend/master/produk" class="btn waves-effect waves-light btn-dark"><i class="fas fa-arrow-circle-left"></i> Kembali</a> &nbsp;<br></h4>
                        <h2 class="font-weight-bold"><?= $produk['nama_produk']; ?></h2>
                        <h6 class="card-subtitle"><?= $produk['nama_kat']; ?> | <?= $produk['nama_sub_kategori']; ?></h6>
                        <br><br>
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-6">

                                <div class="white-box text-center"> <img src="<?= base_url('/assets/images/produk/' . $produk['foto_1']) ?>" alt="user" class="img-responsive" width="300px" /> </div>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-6">
                                <h3 class="box-title m-t-40 font-weight-bold">Deskripsi Produk</h3><br>
                                <h4> <?= $produk['desc_produk']; ?></h4>
                                <h2 class="m-t-40"><?= rupiah($produk['harga_seller']); ?> </h2>
                                <!-- <button class="btn btn-dark btn-rounded m-r-5" data-toggle="tooltip" title="" data-original-title="Add to cart"><i class="ti-shopping-cart"></i> </button>
                                <button class="btn btn-primary btn-rounded"> Buy Now </button> -->
                                <br>
                                <h3 class="box-title m-t-40">Di input Oleh :</h3>
                                <ul class="list-unstyled">
                                    <li><i class="fa fa-check text-success"></i> <?= $produk['nama_peserta']; ?></li>

                                </ul>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <h3 class="box-title m-t-40 font-weight-bold">Informasi Lainnya</h3><br>
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td width="390">Nama Merchant/Seller</td>
                                                <td>: <?= $produk['nama_seller']; ?></td>
                                            </tr>
                                            <tr>
                                                <td width="390">Kategori</td>
                                                <td>: <?= $produk['nama_kat']; ?></td>
                                            </tr>
                                            <tr>
                                                <td width="390">Sub Kategori</td>
                                                <td>: <?= $produk['nama_sub_kategori']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>SKU</td>
                                                <td>: <?= $produk['SKU']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Nama Produk</td>
                                                <td>: <?= $produk['nama_produk']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Harga dari Seller</td>
                                                <td>: <?= rupiah($produk['harga_seller']); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Harga Jual</td>
                                                <td>: <?= rupiah($produk['harga_produk']); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Satuan Produk</td>
                                                <td>: <?= $produk['nama_satuan']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Berat Produk</td>
                                                <td>: <?= $produk['berat_produk']; ?> gram</td>
                                            </tr>
                                            <tr>
                                                <td>Expired</td>
                                                <td>: <?= $produk['expired']; ?> Hari</td>
                                            </tr>
                                            <tr>
                                                <td>Komposisi Produk</td>
                                                <td><?= $produk['komposisi']; ?></td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Column -->
        </div>

        <?= $this->include('layout/footer'); ?>

        <?= $this->endSection(); ?>