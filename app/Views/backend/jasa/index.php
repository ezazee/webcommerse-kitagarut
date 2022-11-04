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
            <div class="alert alert-danger">Gagal, <?= session()->getFlashdata('gagal'); ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success">Berhasil, <?= session()->getFlashdata('success'); ?></div>
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
                                <a href="<?= base_url('/backend/jasa/tambahjasa'); ?>" class="btn waves-effect waves-light btn-info"><i class="fa fa-plus-circle"></i> Tambah Data</a>
                            </div>
                        </div>
                        <hr>
                        <div class="m-t-40">
                            <table id="tabelku" class="table display table-bordered table-striped info-bordered-table" style="width:100%;table-layout:auto">

                                <thead>
                                    <tr>
                                        <th class="text-center align-middle">No</th>
                                        <th class="text-left align-middle" style="width: 20%;">Foto Jasa</th>
                                        <th class="text-left align-middle">Nama Jasa</th>
                                        <th class="text-left align-middle" style="width: 10%;">Harga Modal</th>
                                        <th class="text-left align-middle" style="width: 10%;">Harga Jual</th>
                                        <th class="text-left align-middle">Transmisi</th>
                                        <th class="text-left align-middle">Sopir</th>
                                        <th class="text-left align-middle">Nama Jasa</th>
                                        <th class="text-left align-middle">Penyedia</th>
                                        <th class="text-left align-middle">di buat oleh</th>
                                        <th class="text-center align-middle" style="width:10%">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($jasa as $row) : ?>
                                        <tr>
                                            <td class="text-center align-middle"><?= $no++; ?></td>
                                            <td class="text-left align-middle"><img src="<?= base_url('/assets/images/jasa/' . $row['foto_jasa']) ?>" alt="user" class="img-circle" width="50px" /></td>

                                            <td class="text-left align-middle" style="width: 20%;"><?= $row['nama_jasa']; ?></td>

                                            <td class="text-left align-middle"><?= rupiah($row['harga_modal']); ?></td>
                                            <td class="text-left align-middle"><?= rupiah($row['harga_jual']); ?></td>
                                            <td class="text-left align-middle"><?= $row['transmisi']; ?></td>
                                            <td class="text-left align-middle"><?= $row['sopir']; ?></td>
                                            <td class="text-left align-middle"><?= $row['nama_sub_kategori']; ?></td>
                                            <td class="text-left align-middle"><?= $row['nama_seller']; ?> | <?= $row['nama_toko']; ?></td>
                                            <td class="text-left align-middle"><?= $row['nama_peserta']; ?></td>
                                            <td class="text-center align-middle">
                                                <div class="btn-group mr-2" role="group" aria-label="First group">
                                                    <a href="/backend/jasa/get_edit/<?= $row['id_jasa']; ?>" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="" data-original-title="Update Data">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                    <a style="pointer-events: none; display: inline-block;" type="button" class="btn btn-danger" data-toggle="tooltip" data-id="<?= $row['id_jasa']; ?>" data-placement="top" title="" data-original-title="Hapus Data"><i class="fas fa-trash-alt"></i></a>
                                                    <a display: inline-block;" href="/backend/jasa/detailjasa/<?= $row['id_jasa']; ?>" class="btn btn-info" data-toggle="tooltip" data-id="<?= $row['id_jasa']; ?>" data-placement="top" title="" data-original-title="Lihat Detail"><i class="fas fa-search"></i></a>

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


<div class="modal" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel1">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="deleteModalLabel1">Hapus Data <?= $judul; ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <?= form_open('master/deleteJab'); ?>
                <h4>Anda yakin akan menghapus data ini ?</h4>
            </div>
            <div class="modal-footer">
                <input type="hidden" class="form-control" name="id_jabatan2" id="id_jabatan2">
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
    $("#dept").select2({
        placeholder: 'Pilih Departemen',
        orientation: 'bottom',
    });
    $(".jabatan").select2({
        placeholder: 'Pilih Jabatan',
        orientation: 'bottom',
    });

    $("#akses").select2({
        placeholder: 'Pilih Level Akses',
        orientation: 'bottom',
    });
    // responsive table
    $('#tabelku').DataTable({
        responsive: true
    });

    //focus modal add
    $(document).ready(function() {
        $('#exampleModal').on('shown.bs.modal', function() {
            $('#nama_jabatan').trigger('focus');
        });
    });
    $(document).ready(function() {
        $('#editModal').on('shown.bs.modal', function() {
            $('#nama_jabatan2').trigger('focus');
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


        // get Delete Product
        $('#tabelku').on('click', '.btn-delete', function() {
            // get data from button edit
            const id = $(this).data('id');
            // Set data to Form Edit
            $('#id_jabatan2').val(id);
            // Call Modal Edit
            $('#deleteModal').modal('show');
        });

    });
</script>

<?= $this->endSection(); ?>