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
                        <h4 class="card-title"><a href="<?= base_url('/backend/master/produk'); ?>" class="btn waves-effect waves-light btn-dark"><i class="fas fa-arrow-circle-left"></i> Kembali</a> &nbsp;<br><br><?= $judul; ?></h4>
                        <ul class="nav nav-tabs profile-tab" role="tablist">
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane active" id="home" role="tabpanel">
                                <div class="card-body">
                                    <?= form_open_multipart(base_url('/backend/jasa/inputjasa'), 'class="mt-4"'); ?>
                                    <?php if ($validation->getErrors()) : ?>
                                        <div class="alert alert-danger">Gagal menambah jasa ! Ulangi dan upload ulang file (jika ada) <?= $validation->listErrors(); ?> </div>
                                    <?php endif; ?>
                                    <div class="row">
                                        <div class="form-group  col-md-12 col-sm-12">
                                            <label class="col-md-12 text-info">Foto Jasa</label>
                                            <div class="col-md-12">
                                                <input type="file" id="input-file-now-custom-1" class="dropify <?= ($validation->hasError('foto_jasa')) ? 'is-invalid' : ''; ?>" data-default-file="<?= base_url('assets/images/profile/' . $user['foto_peserta']) ?>" name="foto_jasa" />
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('foto_jasa'); ?>
                                                </div>
                                                <span class="help-block text-danger"><small>Upload 1 gambar/foto</small></span>
                                            </div>
                                        </div>
                                        <?php if ($validation->hasError('foto_jasa')) : ?>
                                            <small>
                                                <div class="text-danger">
                                                    <?= $validation->getError('foto_jasa'); ?>
                                                </div>
                                            </small>
                                        <?php endif; ?>

                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6 col-sm-12">
                                            <label class="col-md-12 text-info">Nama Jasa</label>
                                            <div class="col-md-12">
                                                <input type="text" placeholder="Nama Jasa" class="form-control form-control-line <?= ($validation->hasError('nama_jasa')) ? 'is-invalid' : ''; ?>" name="nama_jasa" autocomplete="off" value="<?= old('nama_jasa'); ?>" />
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('nama_jasa'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6 col-sm-12">
                                            <label class="col-md-12 text-info">Sopir</label>
                                            <div class="col-md-12">
                                                <select class="dept form-control custom-select sopir <?= ($validation->hasError('sopir')) ? 'is-invalid' : ''; ?>" name="sopir" id="sopir" value="<?= old('sopir'); ?>" style="width: 100%; height:36px;">
                                                    <option value=""></option>
                                                    <option value="Wajib Sopir">Wajib Sopir</option>
                                                    <option value="Lepas Kunci">Lepas Kunci</option>

                                                </select>
                                            </div>
                                            <?php if ($validation->hasError('sopir')) : ?>
                                                <small>
                                                    <div class="text-danger">
                                                        <?= $validation->getError('sopir'); ?>
                                                    </div>
                                                </small>
                                            <?php endif; ?>
                                        </div>
                                        <div class="form-group col-md-6 col-sm-12">
                                            <label class="col-md-12 text-info">Harga Modal</label>
                                            <div class="col-md-12">
                                                <input type="number" placeholder="Harga Modal" class="form-control form-control-line <?= ($validation->hasError('harga_modal')) ? 'is-invalid' : ''; ?>" name="harga_modal" autocomplete="off" value="<?= old('harga_modal'); ?>" />
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('harga_modal'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6 col-sm-12">
                                            <label class="col-md-12 text-info">Harga Jual</label>
                                            <div class="col-md-12">
                                                <input type="number" placeholder="Harga Jual" class="form-control form-control-line <?= ($validation->hasError('harga_jual')) ? 'is-invalid' : ''; ?>" name="harga_jual" autocomplete="off" value="<?= old('harga_jual'); ?>" />
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('harga_jual'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6 col-sm-12">
                                            <label class="col-md-12 text-info">Transmisi</label>
                                            <div class="col-md-12">
                                                <select class="dept form-control custom-select transmisi <?= ($validation->hasError('transmisi')) ? 'is-invalid' : ''; ?>" name="transmisi" id="transmisi" value="<?= old('transmisi'); ?>" style="width: 100%; height:36px;">
                                                    <option value=""></option>
                                                    <option value="Manual">Manual</option>
                                                    <option value="Otomatis">Otomatis</option>

                                                </select>
                                            </div>
                                            <?php if ($validation->hasError('transmisi')) : ?>
                                                <small>
                                                    <div class="text-danger">
                                                        <?= $validation->getError('transmisi'); ?>
                                                    </div>
                                                </small>
                                            <?php endif; ?>
                                        </div>
                                        <div class="form-group col-md-6 col-sm-12">
                                            <label class="col-md-12 text-info">Merchant</label>
                                            <div class="col-md-12">
                                                <select class="dept form-control custom-select merchant <?= ($validation->hasError('id_penyedia')) ? 'is-invalid' : ''; ?>" name="id_penyedia" id="id_penyedia" value="<?= old('id_penyedia'); ?>" style="width: 100%; height:36px;">
                                                    <option value=""></option>
                                                    <?php foreach ($merchant as $d) : ?>
                                                        <option value="<?= $d['id_merchant']; ?>"><?= $d['nama_seller']; ?> | <?= $d['nama_toko']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <?php if ($validation->hasError('id_penyedia')) : ?>
                                                <small>
                                                    <div class="text-danger">
                                                        <?= $validation->getError('id_penyedia'); ?>
                                                    </div>
                                                </small>
                                            <?php endif; ?>
                                        </div>
                                        <div class="form-group col-md-6 col-sm-12">
                                            <label class="col-md-12 text-info">Kategori Produk</label>
                                            <div class="col-md-12">
                                                <select class="dept form-control custom-select kategori <?= ($validation->hasError('id_kat_jasa')) ? 'is-invalid' : ''; ?>" name="id_kat_jasa" id="id_kat_jasa" value="<?= old('id_kat_jasa'); ?>" style="width: 100%; height:36px;">
                                                    <option value=""></option>
                                                    <?php foreach ($kategori as $d) : ?>
                                                        <option value="<?= $d['id_kat']; ?>"><?= $d['nama_kat']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <?php if ($validation->hasError('id_kat_jasa')) : ?>
                                                <small>
                                                    <div class="text-danger">
                                                        <?= $validation->getError('id_kat_jasa'); ?>
                                                    </div>
                                                </small>
                                            <?php endif; ?>
                                        </div>
                                        <div class="form-group col-md-6 col-sm-12">
                                            <label class="col-md-12 text-info">Sub kategori Produk</label>
                                            <div class="col-md-12">
                                                <select class="dept form-control custom-select kategori <?= ($validation->hasError('id_sub_kat_jasa')) ? 'is-invalid' : ''; ?>" name="id_sub_kat_jasa" id="id_sub_kat_jasa" style="width: 100%; height:36px;">
                                                    <option value=""></option>
                                                </select>
                                            </div>
                                            <?php if ($validation->hasError('id_sub_kat_jasa')) : ?>
                                                <small>
                                                    <div class="text-danger">
                                                        <?= $validation->getError('id_sub_kat_jasa'); ?>
                                                    </div>
                                                </small>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-12 col-sm-12">
                                            <label class="col-md-12 text-info">Syarat Ketentuan Jasa</label>
                                            <div class="col-md-12">
                                                <textarea id="syarat" name="syarat"><?= old('syarat'); ?></textarea>
                                                <?php if ($validation->hasError('syarat')) : ?>
                                                    <small>
                                                        <div class="text-danger">
                                                            <?= $validation->getError('syarat'); ?>
                                                        </div>
                                                    </small>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                    </div>

                                    <hr>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <input type="hidden" class="form-control" value="<?= $user['id_peserta']; ?>" name="id_buat" id="id_buat">
                                            <button type="submit" class="btn btn-success">
                                                Tambah Jasa
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

    $("#id_kat_jasa").select2({
        placeholder: 'Pilih Kategori',
        orientation: 'bottom',
    });
    $("#id_sub_kat_jasa").select2({
        placeholder: 'Pilih Kategori dulu',
        orientation: 'bottom',
    });
    $(".merchant").select2({
        placeholder: 'Pilih Merchant',
        orientation: 'bottom',
    });
    $(".sopir").select2({
        placeholder: 'Pilih Sopir',
        orientation: 'bottom',
    });
    $(".transmisi").select2({
        placeholder: 'Pilih Transmisi',
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

        $('#id_kat_jasa').change(function() {
            var id = $(this).val();
            $.ajax({
                url: '/backend/master/ambilSubKategori',
                method: "POST",
                data: {
                    id: id
                },
                async: true,
                dataType: 'json',
                success: function(data) {

                    var html = '';
                    var i;
                    for (i = 0; i < data.length; i++) {
                        html += '<option value=' + data[i].id_sub_kat + '>' + data[i].nama_sub_kategori + '</option>';
                    }
                    $('#id_sub_kat_jasa').html(html);

                }
            });
            return false;
        });

    });

    $(document).ready(function() {

        if ($("#syarat").length > 0) {
            tinymce.init({
                selector: "textarea#syarat",
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