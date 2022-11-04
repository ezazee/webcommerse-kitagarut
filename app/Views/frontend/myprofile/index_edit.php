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
                                <li class="active"><a href="#">Informasi Akun</a></li>
                                <li><a href="/frontend/my_profile/pesananku">Pesanan Saya</a></li>

                            </ul>
                        </div>
                        <div class="ps-block__right">

                        </div>
                    </div>
                    <div class="flash-data" data-flashdata="<?php echo session()->getFlashdata('success'); ?>"></div>
                    <div class="flashdata_gagal" data-flashdata_gagal="<?php echo session()->getFlashdata('gagal'); ?>"></div>
                    <?= form_open(base_url('frontend/my_profile/UpdateProfil'), 'id="msform" class="form-horizontal"'); ?>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ">
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" placeholder="Johnathan Doe" value="<?= $user['nama_pel']; ?>" class="form-control form-control-line <?= ($validation->hasError('nama_pel')) ? 'is-invalid' : ''; ?>" name="nama_pel" />
                                <div class="invalid-feedback">
                                    <?= $validation->getError('nama_pel'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ">
                            <label>Email</label>
                            <input type="text" placeholder="Johnathan Doe" value="<?= $user['email_pel']; ?>" class="form-control form-control-line <?= ($validation->hasError('email_pel')) ? 'is-invalid' : ''; ?>" name="email_pel" />
                            <div class="invalid-feedback">
                                <?= $validation->getError('email_pel'); ?>
                            </div>
                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                            <div class="form-group">
                                <label>No. Handphone</label>
                                <input type="text" placeholder="Johnathan Doe" value="<?= $user['no_hp_pel']; ?>" class="form-control form-control-line <?= ($validation->hasError('no_hp_pel')) ? 'is-invalid' : ''; ?>" name="no_hp_pel" />
                                <div class="invalid-feedback">
                                    <?= $validation->getError('no_hp_pel'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                            <div class="form-group">
                                <label>Alamat</label>
                                <textarea rows="5" value="<?= $user['alamat_pel']; ?>" class="form-control form-control-line" name="alamat_pel"><?= $user['alamat_pel']; ?></textarea>
                            </div>
                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                            <div class="form-group">
                                <label>Provinsi</label>
                                <select id="provinsi" name="provinsi" class="form-control">
                                    <option></option>
                                    <?php foreach ($provinsi as $row) : ?>
                                        <option value="<?= $row->id_prov; ?>" <?= $row->id_prov == $user['provinsi'] ? "selected" : null ?>><?= $row->jmh; ?></option>
                                    <?php endforeach; ?>

                                </select>
                                <img src="<?= base_url(); ?>/assets/loading.gif" width="25" id="load1" style="display:none;" />
                            </div>
                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                            <div class="form-group">
                                <label>Kota/Kabupaten</label>
                                <select id="kota" name="kota" class="form-control">
                                    <option></option>
                                </select>
                                <img src="<?= base_url(); ?>/assets/loading.gif" width="25" id="load2" style="display:none;" />

                            </div>
                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                            <div class="form-group">
                                <label>Kecamatan</label>
                                <select id="kecamatan" name="kecamatan" class="form-control">
                                    <option></option>
                                </select>
                                <img src="<?= base_url(); ?>/assets/loading.gif" width="25" id="load3" style="display:none;" />

                            </div>
                        </div>

                    </div>
                    <div class="form-group submit">
                        <input type="hidden" value="<?= $user['id_pel']; ?>" name="id_pel">
                        <button type="submit" class="ps-btn">Simpan</button>
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
        get_data_edit();
        $('#provinsi').change(function() {
            $("img#load1").show();
            var id = $(this).val();
            var kota = "<?php echo $user['kota']; ?>";
            $.ajax({
                url: "<?php echo site_url('frontend/my_profile/get_kabupaten'); ?>",
                method: "POST",
                data: {
                    id: id
                },
                async: true,
                dataType: 'json',
                success: function(data) {

                    $('select[name="kota"]').empty();

                    $.each(data, function(key, value) {
                        if (kota == value.id_kab) {
                            $('select[name="kota"]').append('<option value="' + value.id_kab + '" selected>' + value.nama_kab + '</option>').trigger('change');
                        } else {
                            $('select[name="kota"]').append('<option value="' + value.id_kab + '">' + value.nama_kab + '</option>');
                        }
                    });
                    $("img#load1").hide();
                }
            });
            return false;
        });


        $('#kota').change(function() {
            $("img#load2").show();
            var kecamatan = "<?php echo $user['kecamatan']; ?>";
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
                    $('select[name="kecamatan"]').empty();

                    $.each(data, function(key, value) {
                        if (kecamatan == value.id_kec) {
                            $('select[name="kecamatan"]').append('<option value="' + value.id_kec + '" selected>' + value.nama_kec + '</option>').trigger('change');
                        } else {
                            $('select[name="kecamatan"]').append('<option value="' + value.id_kec + '">' + value.nama_kec + '</option>');
                        }
                    });
                    $("img#load2").hide();
                }
            });
            return false;
        });



        function get_data_edit() {
            var id_pel = $('[name="id_pel"]').val();
            $.ajax({
                url: "<?php echo site_url('/frontend/my_profile/get_data_edit'); ?>",
                method: "POST",
                data: {
                    id_pel: id_pel
                },
                async: true,
                dataType: 'json',
                success: function(data) {
                    $.each(data, function(i, item) {
                        $('[name="provinsi"]').val(data.provinsi).trigger('change');
                        $('[name="kota"]').val(data.kota).trigger('change');
                        $('[name="kecamatan"]').val(data.kecamatan).trigger('change');

                    });
                }

            });
        }


    });
</script>

<?= $this->endSection(); ?>