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



<div class="ps-section--shopping ps-shopping-cart">
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <div class="text-center">
                    <h4>Pesanan Saya</h4>
                </div>
            </div>
        </div>
        <div class="ps-section__content">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                    <?php if (session()->getFlashdata('success')) : ?>
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong><?= session()->getFlashdata('success'); ?></strong>
                        </div>
                    <?php endif; ?>
                    <figure class="ps-block--vendor-status">
                        <br>
                        <div class="table-responsive">
                            <table class="table table table-bordered">
                                <tbody>
                                    <tr>
                                        <th class="text-center font-weight-bolder">No</th>
                                        <th class="text-center font-weight-bolder">Tanggal</th>
                                        <th class="text-center font-weight-bolder">No Transaksi</th>
                                        <th class="text-center font-weight-bolder">Ongkir</th>
                                        <th class="text-center font-weight-bolder">Total Pembelian</th>
                                        <th class="text-center font-weight-bolder">Total Pembayaran</th>
                                        <th class="text-center font-weight-bolder">Status</th>
                                        <th class="text-center font-weight-bolder">Action</th>
                                    </tr>
                                    <?php $no = 1; ?>
                                    <?php foreach ($pesananku as $row) : ?>
                                        <tr>
                                            <td class="text-center"><?= $no++; ?></td>
                                            <td class="text-center"><?= longdate_indo($row['tgl_trans']); ?></td>
                                            <td class="text-center"><?= $row['no_trans']; ?></td>
                                            <td class="text-center"><?= rupiah($row['ongkir_trans']); ?></td>
                                            <td class="text-center"><?= rupiah($row['total_belanja']); ?></td>
                                            <td class="text-center"><?= rupiah($row['total_belanja_ongkir']); ?></td>
                                            <?php if ($row['status_trans'] == 0) : ?>
                                                <td class="text-center"><span class="badge badge-danger">Menunggu Pembayaran</span></td>
                                            <?php elseif ($row['status_trans'] == 1) : ?>
                                                <td class="text-center"><span class="badge badge-info">Menunggu Verifikasi</span></td>
                                            <?php elseif ($row['status_trans'] == 2) : ?>
                                                <td class="text-center"><span class="badge badge-warning">Pesanan Sedang diproses</span></td>
                                            <?php elseif ($row['status_trans'] == 6) : ?>
                                                <td class="text-center"><span class="badge badge-danger">Pembayaran ditolak</span></td>
                                            <?php elseif ($row['status_trans'] == 3) : ?>
                                                <td class="text-center"><span class="badge badge-success">Transaksi selesai</span></td>
                                            <?php endif; ?>
                                            <td class="text-center">
                                                <a href="/frontend/new_home/detail_pesanan/<?= $row['no_trans']; ?>" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Lihat detail pesanan">Detail</a>
                                                <?php if ($row['status_trans'] == 0) : ?>
                                                    <a href="/frontend/new_home/v_konfirmasi/<?= $row['no_trans']; ?>" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Lihat detail pesanan">Konfirmasi pembayaran</a>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>


                                </tbody>
                            </table>
                        </div>
                    </figure>
                </div>
            </div>
            <div class="ps-section__footer">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 ">

                        </figure>
                        </form>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 ">
                        <div class="ps-block--shopping-total">
                            <div class="ps-block__header">
                                <p>Untuk melakukan pembayaran silahkan transfer ke Rekening di bawah ini :</p>
                            </div>
                            <div class="ps-block__header">
                                <p><img src="/assets/images/bank/bank-bca-GKD.png" width="50px" alt=""> <span>1485414888 a/n PT.GRAHA KARA DIGITAL</span></p>

                            </div>
                            <div class="ps-block__content">

                            </div>
                        </div>
                    </div>
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