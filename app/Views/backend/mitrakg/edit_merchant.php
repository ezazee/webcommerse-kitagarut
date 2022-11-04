<?= $this->extend('layout/template'); ?>
<?= $this->section('konten'); ?>
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor"><?= $judul; ?></h4>
            </div>
            <div class="col-md-7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0)"><?= $menu; ?></a>
                        </li>
                        <li class="breadcrumb-item active"><?= $judul; ?></li>
                    </ol>
                    <!-- <button type="button" class="btn btn-info d-none d-lg-block m-l-15">

                                <i class="fa fa-plus-circle"></i> Create New

                            </button> -->
                </div>
            </div>
        </div>
        <!-- <div class="alert alert-info">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
            <h3 class="text-info"><i class="fa fa-exclamation-circle"></i> Informasi !</h3> yang teliti ya <br>

        </div> -->
        <div class="row">
            <div class="flash-data" data-flashdata="<?php echo session()->getFlashdata('success'); ?>"></div>
            <div class="flashdata_gagal" data-flashdata_gagal="<?php echo session()->getFlashdata('gagal'); ?>"></div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><a href="<?= base_url('/backend/mitrakg'); ?>" class="btn waves-effect waves-light btn-dark"><i class="fas fa-arrow-circle-left"></i> Kembali</a> &nbsp;<br><br><?= $judul; ?></h4>
                        <ul class="nav nav-tabs profile-tab" role="tablist">
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane active" id="home" role="tabpanel">
                                <div class="card-body">
                                    <?= form_open(base_url('/backend/mitrakg/update_merchant_act'), 'class="mt-4"'); ?>
                                    <?php if ($validation->getErrors()) : ?>
                                        <div class="alert alert-danger">Gagal menambah produk ! Ulangi dan upload ulang file (jika ada) <?= $validation->listErrors(); ?> </div>
                                    <?php endif; ?>

                                    <div class="row">
                                        <div class="form-group col-md-6 col-sm-12">
                                            <label class="col-md-12 text-info">No. KTP</label>
                                            <div class="col-md-12">
                                                <input type="text" placeholder="No. KTP" class="form-control form-control-line <?= ($validation->hasError('no_ktp')) ? 'is-invalid' : ''; ?>" name="no_ktp" id="no_ktp" autocomplete="off" required value="<?= $merchant['no_ktp']; ?>" />
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('no_ktp'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6 col-sm-12">
                                            <label class="col-md-12 text-info">Nama Seller</label>
                                            <div class="col-md-12">
                                                <input type="text" placeholder="Nama Seller" class="form-control form-control-line <?= ($validation->hasError('nama_seller')) ? 'is-invalid' : ''; ?>" name="nama_seller" id="nama_seller" autocomplete="off" required value="<?= $merchant['nama_seller']; ?>" />
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('nama_seller'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6 col-sm-12">
                                            <label class="col-md-12 text-info">Nama Toko</label>
                                            <div class="col-md-12">
                                                <input type="text" placeholder="Nama Toko" class="form-control form-control-line <?= ($validation->hasError('nama_toko')) ? 'is-invalid' : ''; ?>" name="nama_toko" autocomplete="off" value="<?= $merchant['nama_toko']; ?>" />
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('nama_toko'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6 col-sm-12">
                                            <label class="col-md-12 text-info">Koordinat</label>
                                            <div class="col-md-12">
                                                <input type="text" placeholder="Koordinat" class="form-control form-control-line <?= ($validation->hasError('koordinat_merchant')) ? 'is-invalid' : ''; ?>" name="koordinat_merchant" autocomplete="off" value="<?= $merchant['koordinat_merchant']; ?>" />
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('koordinat_merchant'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6 col-sm-12">
                                            <label class="col-md-12 text-info">Kontak Merchant</label>
                                            <div class="col-md-12">
                                                <input type="number" placeholder="Kontak Merchant" class="form-control form-control-line <?= ($validation->hasError('no_hp_merchant')) ? 'is-invalid' : ''; ?>" name="no_hp_merchant" autocomplete="off" value="<?= $merchant['no_hp_merchant']; ?>" />
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('no_hp_merchant'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6 col-sm-12">
                                            <label class="col-md-12 text-info">Tanggal Bergabung :</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control col-md-12 mydatepicker" data-date-format='dd/mm/yyyy' name="tgl_join" id="tgl_join" placeholder="dd/mm/yyyy" autocomplete="off" value="<?= date('d/m/Y', strtotime(str_replace('-', '/', $merchant['tgl_join']))); ?>" required>
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="icon-calender"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-4 col-sm-12">
                                            <label class="col-md-12 text-info">Provinsi</label>
                                            <div class="col-md-12">
                                                <select class="dept form-control custom-select kategori <?= ($validation->hasError('provinsi')) ? 'is-invalid' : ''; ?>" id="provinsi" name="provinsi" value="<?= $merchant['provinsi_merchant']; ?>" style="width: 100%; height:36px;">
                                                    <option value=""></option>
                                                    <?php foreach ($provinsi as $row) : ?>
                                                        <option value="<?= $row->id_prov; ?>"><?= $row->jmh; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-4 col-sm-12">
                                            <img src="<?= base_url(); ?>/assets/loading.gif" width="25" id="load1" style="display:none;" />
                                            <label class="col-md-12 text-info">Kota</label>
                                            <div class="col-md-12">
                                                <select class="dept form-control custom-select kategori <?= ($validation->hasError('kota')) ? 'is-invalid' : ''; ?>" id="kota" name="kota" value="<?= $merchant['kota_merchant']; ?>" style="width: 100%; height:36px;">
                                                    <option value=""></option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4 col-sm-12">
                                            <img src="<?= base_url(); ?>/assets/loading.gif" width="25" id="load2" style="display:none;" />
                                            <label class="col-md-12 text-info">Kecamatan</label>
                                            <div class="col-md-12">
                                                <select class="dept form-control custom-select kategori <?= ($validation->hasError('kecamatan')) ? 'is-invalid' : ''; ?>" id="kecamatan" name="kecamatan" value="<?= $merchant['kecamatan_merchant']; ?>" style="width: 100%; height:36px;">
                                                    <option value=""></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-md-12 col-sm-12">
                                            <label class="col-md-12 text-info">Alamat Lengkap</label>
                                            <div class="col-md-12">
                                                <textarea id="alamat_merchant" name="alamat_merchant"><?= $merchant['alamat_merchant']; ?></textarea>
                                                <?php if ($validation->hasError('alamat_merchant')) : ?>
                                                    <small>
                                                        <div class="text-danger">
                                                            <?= $validation->getError('alamat_merchant'); ?>
                                                        </div>
                                                    </small>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                    </div>

                                    <hr>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <input type="hidden" value="<?= $merchant['id_merchant']; ?>" name="id_merchant">
                                            <input type="hidden" class="form-control" value="<?= $user['id_peserta']; ?>" name="id_created" id="id_created">
                                            <input type="hidden" class="form-control" value="<?= $user['id_mitra_pes']; ?>" name="id_mitra_merchant" id="id_mitra_merchant">
                                            <button type="submit" class="btn btn-success">
                                                Update Merchant
                                            </button>
                                        </div>
                                    </div>
                                    <?= form_close() ?>
                                </div>

                            </div>



                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>
</div>

<?= $this->include('layout/footer'); ?>
<script src="/assets/node_modules/dropify/dist/js/dropify.min.js"></script>

<script>
    $(function() {
        jQuery('.mydatepicker').datepicker({
            autoclose: true,
            todayHighlight: true,
            dateFormat: "dd-mm-yy",

        });
    });

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
            var kota = "<?php echo $merchant['kota_merchant']; ?>";
            $.ajax({
                url: "<?php echo site_url('backend/mitrakg/get_kabupaten'); ?>",
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
            var kecamatan = "<?php echo $merchant['kecamatan_merchant']; ?>";
            var id = $(this).val();
            $.ajax({
                url: "<?php echo base_url("backend/mitrakg/get_kecamatan") ?>",
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
            var id_merchant = $('[name="id_merchant"]').val();

            $.ajax({
                url: "<?php echo site_url('/backend/mitrakg/get_data_edit_merchant'); ?>",
                method: "POST",
                data: {
                    id_merchant: id_merchant
                },
                async: true,
                dataType: 'json',
                success: function(data) {
                    $.each(data, function(i, item) {
                        $('[name="provinsi"]').val(data.provinsi_merchant).trigger('change');
                        $('[name="kota"]').val(data.kota_merchant).trigger('change');
                        $('[name="kecamatan"]').val(data.kecamatan_merchant).trigger('change');

                    });
                }

            });
        }


    });


    $(document).ready(function() {

        if ($("#alamat_merchant").length > 0) {
            tinymce.init({
                selector: "textarea#alamat_merchant",
                theme: "modern",
                height: 150,
                plugins: [
                    "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                    "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                    "save table contextmenu directionality emoticons template paste textcolor"
                ],
                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",

            });
        }
    });



    const flashData = $('.flash-data').data('flashdata');
    const flashData_gagal = $('.flashdata_gagal').data('flashdata_gagal');
    if (flashData) {
        $.toast({
            heading: 'Berhasil !',
            text: '' + flashData,
            position: 'top-center',
            loaderBg: '#ff6849',
            icon: 'success',
            hideAfter: 3500
        });
    }

    if (flashData_gagal) {
        $.toast({
            heading: 'Gagal !',
            text: '' + flashData_gagal,
            position: 'top-center',
            loaderBg: '#ff6849',
            icon: 'error',
            hideAfter: 3500
        });
    }
</script>
<?= $this->endSection(); ?>