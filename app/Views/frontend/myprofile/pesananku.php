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

<div class="ps-page--single">
    <div class="ps-breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="index-2.html"><?= $menu; ?></a></li>
                <li><?= $submenu; ?></li>
            </ul>
        </div>
    </div>
    <div class="ps-vendor-store">
        <div class="container">
            <div class="ps-section__container">
                <div class="ps-section__left">
                    <div class="ps-block--vendor">
                        <div class="ps-block__thumbnail"><img src="<?= base_url('/assets/images/profile/' . $user['foto_pel']) ?>" alt=""></div>
                        <div class="ps-block__container">
                            <div class="ps-block__header">
                                <h4><?= $user['nama_pel']; ?></h4>
                                <p><strong><?= $user['no_hp_pel']; ?></strong></p>
                            </div><span class="ps-block__divider"></span>
                            <div class="ps-block__content">
                                <p><strong>Alamat</strong>, <?= $user['alamat_pel']; ?></p><span class="ps-block__divider"></span>
                                <p><strong>Tanggal bergabung</strong> <?= $user['date_created']; ?></p>

                            </div>
                            <span class="ps-block__divider"></span>
                            <div class="ps-block__footer">
                                <a class="ps-btn ps-btn--fullwidth" href="#"></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ps-section__right">
                    <div class="ps-block--vendor-filter">
                        <div class="ps-block__left">
                            <ul>
                                <li><a href="#">Informasi Akun</a></li>
                                <li class="active"><a href="/frontend/my_profile/pesananku">Pesanan Saya</a></li>

                            </ul>
                        </div>
                        <div class="ps-block__right">

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
                                                            <a href="/frontend/my_profile/detail_pesanan/<?= $row['no_trans']; ?>" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Lihat detail pesanan">Detail</a>
                                                            <?php if ($row['status_trans'] == 0) : ?>
                                                                <a href="/frontend/my_profile/konfirmasi_bayar/<?= $row['no_trans']; ?>" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Lihat detail pesanan">Konfirmasi pembayaran</a>
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
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
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
                    </form>

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



    $('#provinsi').select2({

        placeholder: 'Pilih Provinsi',

    });
    $('#kota').select2({

        placeholder: 'Pilih Provinsi dulu',
        language: "id"
    });
    $('#kecamatan').select2({

        placeholder: 'Pilih Kota/Kabupaten dulu',
        language: "id"
    });
    $('#desa').select2({

        placeholder: 'Pilih Kecamatan dulu',
        language: "id"
    });


    $(document).ready(function() {

        $('#provinsi').change(function() {
            $("img#load1").show();
            var id = $(this).val();
            $.ajax({
                url: "<?php echo base_url("frontend/my_profile/get_kabupaten") ?>",
                method: "POST",
                data: {
                    id: id
                },
                async: true,
                dataType: 'json',
                success: function(data) {

                    var html = '<option>Pilih Kabupaten/Kota</option>';
                    var i;
                    for (i = 0; i < data.length; i++) {
                        html += '<option value=' + data[i].id_kab + '>' + data[i].nama_kab + '</option>';
                    }
                    $('#kota').html(html);
                    $("img#load1").hide();

                }
            });

            return false;
        });


        $('#kota').change(function() {
            $("img#load2").show();
            var id = $(this).val();
            $.ajax({
                url: "<?php echo base_url("frontend/my_profile/get_kecamatan") ?>",
                method: "POST",
                data: {
                    id: id
                },
                async: true,
                dataType: 'json',
                success: function(data) {

                    var html = '<option>Pilih Kecamatan</option>';
                    var i;
                    for (i = 0; i < data.length; i++) {
                        html += '<option value=' + data[i].id_kec + '>' + data[i].nama_kec + '</option>';
                    }
                    $('#kecamatan').html(html);
                    $("img#load2").hide();

                }
            });
            return false;
        });

        $('#kecamatan').change(function() {
            $("img#load3").show();
            var id = $(this).val();
            $.ajax({
                url: "<?php echo base_url("frontend/my_profile/get_desa") ?>",
                method: "POST",
                data: {
                    id: id
                },
                async: true,
                dataType: 'json',
                success: function(data) {

                    var html = '<option>Pilih Desa</option>';
                    var i;
                    for (i = 0; i < data.length; i++) {
                        html += '<option value=' + data[i].id_desa + '>' + data[i].nama_desa + '</option>';
                    }
                    $('#desa').html(html);
                    $("img#load3").hide();

                }
            });
            return false;
        });


    });
</script>

<?= $this->endSection(); ?>