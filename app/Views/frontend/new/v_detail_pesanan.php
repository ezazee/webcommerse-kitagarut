<?= $this->extend('layout/template_new'); ?>
<?= $this->section('head'); ?>
<script src="<?= base_url('leaflet/leaflet.js'); ?>"></script>
<link rel="stylesheet" href="<?= base_url('leaflet/leaflet.css'); ?>" />
<link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
<script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
<style>
    #maps {
        height: 300px;
    }

    .leaflet-control-container .leaflet-routing-container-hide {
        display: none;
    }
</style>
<?= $this->endSection(); ?>
<?= $this->section('konten_new'); ?>



<div class="ps-vendor-dashboard pro">
    <div class="container">

        <div class="ps-section__content">
            <ul class="ps-section__links">
                <li class="active"><a href="#">Detail Pesanan</a></li>
                <!-- <li><a href="#">Products</a></li> -->

            </ul>
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                    <figure class="ps-block--vendor-status">
                        <a href="/frontend/new_home/pesananku" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Lihat detail pesanan"><i class="fa fa-arrow-left" aria-hidden="true"></i></i> Kembali</a><br>
                        <br>
                        <div class="table-responsive">
                            <table class="table table table-bordered">
                                <tbody>
                                    <tr>
                                        <th class="text-center font-weight-bold">No</th>
                                        <th class="text-center font-weight-bold">Tanggal</th>
                                        <th class="text-center font-weight-bold">No Transaksi</th>
                                        <th class="text-left font-weight-bold">Nama Produk</th>
                                        <th class="text-center font-weight-bold">QTY</th>
                                        <th class="text-center font-weight-bold">Harga</th>
                                        <th class="text-center font-weight-bold">Subtotal</th>
                                    </tr>
                                    <?php $no = 1; ?>
                                    <?php $total = 0; ?>
                                    <?php foreach ($detail_pesanan as $row) : ?>
                                        <tr>
                                            <td class="text-center"><?= $no++; ?></td>
                                            <td class="text-center"><?= longdate_indo($row['tgl_trans']); ?></td>
                                            <td class="text-center"><?= $row['no_trans']; ?></td>
                                            <td class="text-left"><?= $row['nama_produk_trns']; ?></td>
                                            <td class="text-center"><?= $row['qty_trns']; ?></td>
                                            <td class="text-center"><?= rupiah($row['harga_jual']); ?></td>
                                            <td class="text-center"><?= rupiah($row['subtotal']); ?></td>
                                        </tr>
                                        <?php $total += $row['subtotal']; ?>
                                    <?php endforeach; ?>
                                    <tr>
                                        <td class="text-center font-weight-bold" colspan="6">
                                            Total
                                        </td>
                                        <td class="text-center font-weight-bold"><?= rupiah($total); ?></td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </figure>
                </div>


            </div>
        </div>
    </div>
</div>

<br>


<?= $this->include('layout/footer_new2'); ?>


<script>
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>

<?= $this->endSection(); ?>