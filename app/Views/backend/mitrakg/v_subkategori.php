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
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->

        <?php if (session()->getFlashdata('gagal')) : ?>
            <div class="alert alert-danger">Gagal ! <?= session()->getFlashdata('gagal'); ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success">Berhasil ! <?= session()->getFlashdata('success'); ?></div>
        <?php endif; ?>
        <div class="row">
            <div class="col-12">
                <div class="flash-data" data-flashdata="<?php echo session()->getFlashdata('success'); ?>"></div>
                <div class="flashdata_gagal" data-flashdata_gagal="<?php echo session()->getFlashdata('gagal'); ?>"></div>
                <div class="card">
                    <div class="card-body">
                        <div class="row col-md-12 col-xs-12 d-flex justify-content-between">
                            <h4 class="card-title">Data <?= $judul; ?></h4>
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn waves-effect waves-light btn-info" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap"><i class="fa fa-plus-circle"></i> Tambah Data</button>
                            </div>
                        </div>
                        <hr>
                        <div class="m-t-40">
                            <table id="tabelku" class="table display table-bordered table-striped info-bordered-table">

                                <thead>
                                    <tr>
                                        <th class="text-center align-middle" width="5%">No</th>
                                        <th class="text-left align-middle">Sub Kategori Produk</th>
                                        <th class="text-left align-middle">Kategori Produk</th>
                                        <th class="text-center align-middle">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($subkategori as $row) : ?>
                                        <tr>
                                            <td class="text-center align-middle"><?= $no++; ?></td>
                                            <td class="text-left align-middle"><?= $row['nama_sub_kategori']; ?></td>
                                            <td class="text-left align-middle"><?= $row['nama_kat']; ?></td>
                                            <td class="text-center align-middle">
                                                <div class="btn-group mr-2" role="group" aria-label="First group">
                                                    <a type="button" class="btn btn-success btn-edit" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Data" data-id="<?= $row['id_sub_kat']; ?>" data-nama_sub_kategori="<?= $row['nama_sub_kategori']; ?>" data-id_kat_s="<?= $row['id_kat_s']; ?>">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                    <a type="button" class="btn btn-danger btn-delete" data-toggle="tooltip" data-id="<?= $row['id_sub_kat']; ?>" data-placement="top" title="" data-original-title="Hapus Data"><i class="fas fa-trash-alt"></i></a>

                                                </div>
                                            </td>

                                        </tr>
                                    <?php endforeach; ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End PAge Content -->
        <!-- ============================================================== -->
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

<!-- MODAL ADD -->
<div class="modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel1">Tambah Data <?= $judul; ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <?= form_open('/backend/master/tambahSubKategori'); ?>
                <div class="form-group">
                    <label for="recipient-name" class="control-label">Nama SubKategori :</label>
                    <input type="text" class="form-control" placeholder="Nama Subkategori" name="nama_sub_kat" id="nama_sub_kat" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="control-label">Nama Kategori :</label>
                    <select class="dept form-control custom-select kategori" name="id_kat_prod" id="id_kat_prod" value="<?= old('id_kat_prod'); ?>" style="width: 100%; height:36px;">
                        <option value=""></option>
                        <?php foreach ($kategori as $d) : ?>
                            <option value="<?= $d['id_kat']; ?>"><?= $d['nama_kat']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

            </div>
            <div class="modal-footer">
                <input type="hidden" class="form-control" value="<?= $user['id_peserta']; ?>" name="id_login" id="id_login">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-success">Tambah</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- /.modal -->

<!-- MODAL EDIT -->
<div class="modal" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel1">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="editModalLabel1">Edit Data <?= $judul; ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <?= form_open('/backend/master/updateSubKategori'); ?>
                <div class="form-group">
                    <label for="recipient-name" class="control-label">Nama Kategori :</label>
                    <input type="text" class="form-control" name="nama_sub_kat2" id="nama_sub_kat2" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="control-label">Nama Kategori :</label>
                    <select class="dept form-control custom-select kategori" name="id_kat_prod2" id="id_kat_prod2" value="<?= old('id_kat_prod2'); ?>" style="width: 100%; height:36px;">
                        <option value=""></option>
                        <?php foreach ($kategori as $d) : ?>
                            <option value="<?= $d['id_kat']; ?>"><?= $d['nama_kat']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" class="form-control" name="id_sub_kat" id="id_sub_kat">
                <input type="hidden" class="form-control" value="<?= $user['id_peserta']; ?>" name="id_login2" id="id_login2">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-success">Edit</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- /.modal -->

<!-- MODAL EDIT -->
<div class="modal" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel1">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="deleteModalLabel1">Hapus Data <?= $judul; ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <?= form_open('/backend/master/deleteSubKategori'); ?>
                <h4>Anda yakin akan menghapus data ini ?</h4>
            </div>
            <div class="modal-footer">
                <input type="hidden" class="form-control" name="id_sub_kat2" id="id_sub_kat2">
                <button type="button" class="btn btn-info" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-danger">Hapus !</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- /.modal -->
<?= $this->include('layout/footer'); ?>

<script>
    // responsive table
    $('#tabelku').DataTable({
        responsive: true
    });
    $(function() {
        jQuery('.mydatepicker2').datepicker({
            autoclose: true,
            todayHighlight: true,
            dateFormat: "dd-mm-yy",
            orientation: 'top'

        });
    });
    $(function() {
        jQuery('.mydatepicker').datepicker({
            autoclose: true,
            todayHighlight: true,
            dateFormat: "dd-mm-yy",
            orientation: 'top'

        });
    });

    $("#id_kat_prod").select2({
        placeholder: 'Pilih Kategori',
        orientation: 'bottom',
    });
    $("#id_kat_prod2").select2({
        placeholder: 'Pilih Kategori',
        orientation: 'bottom',
    });

    //focus modal add
    $(document).ready(function() {
        $('#exampleModal').on('shown.bs.modal', function() {
            $('#nama_kat').trigger('focus');
        });
    });
    $(document).ready(function() {
        $('#editModal').on('shown.bs.modal', function() {
            $('#nama_kat2').trigger('focus');
        });
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

    $(document).ready(function() {

        // get Edit Product
        $('#tabelku').on('click', '.btn-edit', function() {
            // get data from button edit
            const id = $(this).data('id');
            const nama_sub_kategori = $(this).data('nama_sub_kategori');
            const id_kat_s = $(this).data('id_kat_s');


            // Set data to Form Edit
            $('#id_sub_kat').val(id);
            $('#nama_sub_kat2').val(nama_sub_kategori);
            $('#id_kat_prod2').val(id_kat_s).trigger('change');


            // Call Modal Edit
            $('#editModal').modal('show');


        });

        // get Delete Product
        $('#tabelku').on('click', '.btn-delete', function() {
            // get data from button edit
            const id = $(this).data('id');
            // Set data to Form Edit
            $('#id_sub_kat2').val(id);
            // Call Modal Edit
            $('#deleteModal').modal('show');
        });

    });
</script>

<?= $this->endSection(); ?>