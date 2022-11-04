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
                        <div class="ps-section__footer">
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                    <?php if ($validation->getErrors()) : ?>
                                        <br>
                                        <div class="alert alert-danger text-center">Konfirmasi Gagal !<br> Silahkan coba lagi dan upload ulang bukti atau hubungi CS KitaGarut <?= $validation->listErrors(); ?> </div>
                                    <?php endif; ?>
                                    <br>
                                    <div class="alert alert-info alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <strong>Pengisian Nominal Pembayaran tidak boleh pake titik "." </strong>
                                    </div>
                                    <?= form_open_multipart('/frontend/my_profile/bukti_bayar'); ?>
                                    <figure>
                                        <figcaption>Konfirmasi Pembayaran</figcaption>
                                        <div class="form-group">
                                            <label>Nominal Pembayaran</label>
                                            <input type="hidden" name="no_trans" value="<?= $inv; ?>">
                                            <input class="form-control" type="number" name="nominal" value="<?= old('nominal'); ?>" placeholder="isi angka saja">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlFile1">Upload bukti</label>
                                            <input type="file" class="form-control-file" name="bukti" id="exampleFormControlFile1" value="<?= old('bukti'); ?>">
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <button type="submit" class="ps-btn ps-btn--outline">Konfirmasi</button>
                                        </div>
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
                                            <h3>Total Pembayaran <span><?= rupiah($detail_pesanan['0']['total_belanja_ongkir']); ?></span></h3>
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