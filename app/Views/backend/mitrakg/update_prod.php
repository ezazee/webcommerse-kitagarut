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
                        <h4 class="card-title"><a href="/backend/mitrakg/produk" class="btn waves-effect waves-light btn-dark"><i class="fas fa-arrow-circle-left"></i> Kembali</a> &nbsp;<br><br><?= $judul; ?></h4>
                        <ul class="nav nav-tabs profile-tab" role="tablist">
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane active" id="home" role="tabpanel">
                                <div class="card-body">
                                    <?= form_open_multipart(base_url('/backend/mitrakg/update_pro_act'), 'class="mt-4"'); ?>
                                    <?php if ($validation->getErrors()) : ?>
                                        <div class="alert alert-danger">Gagal menambah produk ! Ulangi dan upload ulang file (jika ada) <?= $validation->listErrors(); ?> </div>
                                    <?php endif; ?>
                                    <div class="row">
                                        <div class="form-group  col-md-12 col-sm-12">
                                            <label class="col-md-12 text-info">Foto Produk</label>
                                            <div class="col-md-12">
                                                <input type="file" id="input-file-now-custom-1" class="dropify" data-default-file="<?= base_url('assets/images/produk/' . $produk['foto_1']) ?>" name="foto_produk[]" multiple />
                                                <span class="help-block text-danger"><small>Bisa upload multiple gambar/foto</small></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6 col-sm-12">
                                            <label class="col-md-12 text-info">SKU</label>
                                            <div class="col-md-12">
                                                <input type="text" placeholder="SKU" class="form-control form-control-line <?= ($validation->hasError('SKU')) ? 'is-invalid' : ''; ?>" name="SKU" autocomplete="off" value="<?= $produk['SKU']; ?>" />
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('SKU'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6 col-sm-12">
                                            <label class="col-md-12 text-info">Nama Produk</label>
                                            <div class="col-md-12">
                                                <input type="text" placeholder="Nama Produk" class="form-control form-control-line <?= ($validation->hasError('nama_produk')) ? 'is-invalid' : ''; ?>" name="nama_produk" autocomplete="off" value="<?= $produk['nama_produk']; ?>" />
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('nama_produk'); ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6 col-sm-12">
                                            <label class="col-md-12 text-info">Berat Produk</label>
                                            <div class="col-md-12">
                                                <input type="number" placeholder="Berat Produk" class="form-control form-control-line <?= ($validation->hasError('berat_produk')) ? 'is-invalid' : ''; ?>" name="berat_produk" autocomplete="off" value="<?= $produk['berat_produk']; ?>" />
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('berat_produk'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6 col-sm-12">
                                            <label class="col-md-12 text-info">Expired :</label>
                                            <div class="input-group col-md-12">
                                                <input type="text" class="form-control form-control-line " name="expired" id="expired" placeholder="Hari" autocomplete="off" value="<?= $produk['expired']; ?>">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">Hari</i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6 col-sm-12">
                                            <label class="col-md-12 text-info">Satuan Produk</label>
                                            <div class="col-md-12">
                                                <select class="dept form-control custom-select satuan <?= ($validation->hasError('satuan_produk')) ? 'is-invalid' : ''; ?>" name="satuan_produk" id="satuan_produk" value="<?= old('satuan_produk'); ?>" style="width: 100%; height:36px;">
                                                    <option value=""></option>
                                                    <?php foreach ($satuan as $row) : ?>
                                                        <option value="<?= $row['id_satuan']; ?>" <?= $row['id_satuan'] == $produk['satuan_produk'] ? "selected" : null ?>><?= $row['nama_satuan']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6 col-sm-12">
                                            <label class="col-md-12 text-info">Merchant</label>
                                            <div class="col-md-12">
                                                <select class="dept form-control custom-select merchant <?= ($validation->hasError('id_merchant_prod')) ? 'is-invalid' : ''; ?>" name="id_merchant_prod" id="id_merchant_prod" value="<?= old('id_merchant_prod'); ?>" style="width: 100%; height:36px;">
                                                    <option value=""></option>
                                                    <?php foreach ($merchant as $row) : ?>
                                                        <option value="<?= $row['id_merchant']; ?>" <?= $row['id_merchant'] == $produk['id_merchant_prod'] ? "selected" : null ?>><?= $row['nama_seller']; ?> | <?= $row['nama_toko']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <?php if ($validation->hasError('id_merchant_prod')) : ?>
                                                <small>
                                                    <div class="text-danger">
                                                        <?= $validation->getError('id_merchant_prod'); ?>
                                                    </div>
                                                </small>
                                            <?php endif; ?>
                                        </div>
                                        <div class="form-group col-md-6 col-sm-12">
                                            <label class="col-md-12 text-info">Kategori Produk</label>
                                            <div class="col-md-12">
                                                <select class="dept form-control custom-select kategori <?= ($validation->hasError('id_kat_prod')) ? 'is-invalid' : ''; ?>" name="id_kat_prod" id="id_kat_prod" value="<?= old('id_kat_prod'); ?>" style="width: 100%; height:36px;">
                                                    <option value=""></option>
                                                    <?php foreach ($kategori as $row) : ?>
                                                        <option value="<?= $row['id_kat']; ?>" <?= $row['id_kat'] == $produk['id_kat_prod'] ? "selected" : null ?>><?= $row['nama_kat']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6 col-sm-12">
                                            <label class="col-md-12 text-info">Sub kategori Produk</label>
                                            <div class="col-md-12">
                                                <select class="dept form-control custom-select kategori <?= ($validation->hasError('id_sub_kat_prod')) ? 'is-invalid' : ''; ?>" name="id_sub_kat_prod" id="id_sub_kat_prod" style="width: 100%; height:36px;">
                                                    <option value=""></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-3 col-sm-12">
                                            <label class="col-md-12 text-info">Harga Modal</label>
                                            <div class="col-md-12">
                                                <input type="number" placeholder="Harga Seller" class="form-control form-control-line <?= ($validation->hasError('harga_produk')) ? 'is-invalid' : ''; ?>" name="harga_produk" id="harga_produk" autocomplete="off" value="<?= $produk['harga_produk']; ?>" />
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('harga_produk'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3 col-sm-12">
                                            <label class="col-md-12 text-info">Harga Jual</label>
                                            <div class="input-group col-md-12">
                                                <input type="number" class="form-control form-control-line <?= ($validation->hasError('harga_seller')) ? 'is-invalid' : ''; ?>" name="harga_seller" id="harga_seller" placeholder="Terisi Otomatis" value="<?= $produk['harga_seller']; ?>" autocomplete="off" readonly>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">+ 20%</i></span>
                                                </div>
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('harga_seller'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3 col-sm-12">
                                            <label class="col-md-12 text-info">Fee KitaGarut</label>
                                            <div class="input-group col-md-12">
                                                <input type="number" class="form-control form-control-line <?= ($validation->hasError('fee_kg')) ? 'is-invalid' : ''; ?>" name="fee_kg" id="fee_kg" value="<?= $produk['fee_kg']; ?>" placeholder="Terisi Otomatis" autocomplete="off" readonly>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">10%</i></span>
                                                </div>
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('fee_kg'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3 col-sm-12">
                                            <label class="col-md-12 text-info">Fee OkeOce Milegar</label>
                                            <div class="input-group col-md-12">
                                                <input type="number" class="form-control form-control-line <?= ($validation->hasError('fee_mitra')) ? 'is-invalid' : ''; ?>" name="fee_mitra" id="fee_mitra" value="<?= $produk['fee_mitra']; ?>" placeholder="Terisi Otomatis" autocomplete="off" readonly>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">10%</i></span>
                                                </div>
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('fee_mitra'); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6 col-sm-12">
                                            <label class="col-md-12 text-info">Deskripsi Produk</label>
                                            <div class="col-md-12">
                                                <textarea id="desc_produk" name="desc_produk"><?= $produk['desc_produk']; ?></textarea>
                                                <?php if ($validation->hasError('desc_produk')) : ?>
                                                    <small>
                                                        <div class="text-danger">
                                                            <?= $validation->getError('desc_produk'); ?>
                                                        </div>
                                                    </small>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6 col-sm-12">
                                            <label class="col-md-12 text-info">Komposisi Produk</label>
                                            <div class="col-md-12">
                                                <textarea id="komposisi" name="komposisi"><?= $produk['komposisi']; ?></textarea>
                                                <?php if ($validation->hasError('komposisi')) : ?>
                                                    <small>
                                                        <div class="text-danger">
                                                            <?= $validation->getError('komposisi'); ?>
                                                        </div>
                                                    </small>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>

                                    <hr>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <input type="hidden" class="form-control" value="<?= $user['id_peserta']; ?>" name="id_created" id="id_created">
                                            <input type="hidden" class="form-control" value="<?= $product_id; ?>" name="product_id" id="product_id">
                                            <input type="hidden" class="form-control" value="<?= $user['id_mitra_pes']; ?>" name="id_mitra_produk" id="id_mitra_produk">
                                            <button type="submit" class="btn btn-success">
                                                Update Produk
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

            <!-- Column -->

        </div>

        <!-- Row -->

        <!-- ============================================================== -->

        <!-- End PAge Content -->

        <!-- ============================================================== -->

        <!-- ============================================================== -->

        <!-- Right sidebar -->

        <!-- ============================================================== -->

        <!-- .right-sidebar -->



    </div>

    <!-- ============================================================== -->

    <!-- End Container fluid  -->

    <!-- ============================================================== -->

</div>

<?= $this->include('layout/footer'); ?>
<script src="/assets/node_modules/dropify/dist/js/dropify.min.js"></script>

<script>
    $(document).ready(function() {
        $('.dropify').dropify();
    });

    $("#id_kat_prod").select2({
        placeholder: 'Pilih Kategori',
        orientation: 'bottom',
    });
    $("#id_sub_kat_prod").select2({
        placeholder: 'Pilih Kategori dulu',
        orientation: 'bottom',
    });
    $(".merchant").select2({
        placeholder: 'Pilih Merchant',
        orientation: 'bottom',
    });
    $(".satuan").select2({
        placeholder: 'Pilih Satuan',
        orientation: 'bottom',
    });


    $(function() {
        jQuery('.mydatepicker').datepicker({
            autoclose: true,
            todayHighlight: true,
            dateFormat: "dd-mm-yy",

        });
    });

    $(document).ready(function() {
        //call function get data edit
        get_data_edit();

        $('#id_kat_prod').change(function() {
            var id = $(this).val();
            var subcategory_id = "<?php echo $produk['id_sub_kat_prod']; ?>";
            $.ajax({
                url: '/backend/mitrakg/ambilSubKategori',
                method: "POST",
                data: {
                    id: id
                },
                async: true,
                dataType: 'json',
                success: function(data) {

                    $('select[name="id_sub_kat_prod"]').empty();

                    $.each(data, function(key, value) {
                        if (subcategory_id == value.id_sub_kat) {
                            $('select[name="id_sub_kat_prod"]').append('<option value="' + value.id_sub_kat + '" selected>' + value.nama_sub_kategori + '</option>').trigger('change');
                        } else {
                            $('select[name="id_sub_kat_prod"]').append('<option value="' + value.id_sub_kat + '">' + value.nama_sub_kategori + '</option>');
                        }
                    });

                }
            });
            return false;
        });



        //load data for edit
        function get_data_edit() {
            var product_id = $('[name="product_id"]').val();

            $.ajax({
                url: "<?php echo site_url('/backend/mitrakg/get_data_edit'); ?>",
                method: "POST",
                data: {
                    product_id: product_id
                },
                async: true,
                dataType: 'json',
                success: function(data) {

                    $.each(data, function(i, item) {
                        $('[name="id_kat_prod"]').val(data.id_kat_prod).trigger('change');
                        $('[name="id_sub_kat_prod"]').val(data.id_sub_kat_prod).trigger('change');
                    });
                }

            });
        }

    });

    $(document).ready(function() {
        $("#harga_produk, #fee_kg, #fee_mitra, #harga_seller").keyup(function() {
            var harga_produk = $("#harga_produk").val();
            var persen = 10;

            var total = (parseInt(harga_produk) / 100) * persen;
            $("#fee_kg").val(total);
            $("#fee_mitra").val(total);
            var fee_total = total + total;
            var harga_jual = fee_total + parseInt(harga_produk);

            $("#harga_seller").val(harga_jual);

        });
    });
    $(document).ready(function() {

        if ($("#desc_produk").length > 0) {
            tinymce.init({
                selector: "textarea#desc_produk",
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

    $(document).ready(function() {

        if ($("#komposisi").length > 0) {
            tinymce.init({
                selector: "textarea#komposisi",
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