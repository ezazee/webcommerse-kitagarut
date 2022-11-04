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
                                        <th class="text-left align-middle">Nama Seller</th>
                                        <th class="text-left align-middle">Nama Toko</th>
                                        <th class="text-left align-middle" style="width: 30%;">Alamat</th>
                                        <th class="text-left align-middle">Koordinat</th>
                                        <th class="text-left align-middle">Kontak</th>
                                        <th class="text-left align-middle">Tanggal Bergabung</th>
                                        <th class="text-center align-middle">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($merchant as $row) : ?>
                                        <tr>
                                            <td class="text-center align-middle"><?= $no++; ?></td>
                                            <td class="text-left align-middle"><?= $row['nama_seller']; ?></td>
                                            <td class="text-left align-middle"><?= $row['nama_toko']; ?></td>
                                            <td class="text-left align-middle" style="width: 30%;"><?= $row['alamat_merchant']; ?></td>
                                            <td class="text-left align-middle"><?= $row['koordinat_merchant']; ?></td>
                                            <td class="text-left align-middle"><?= $row['no_hp_merchant']; ?></td>
                                            <td class="text-left align-middle"><?= longdate_indo($row['tgl_join']); ?></td>
                                            <td class="text-center align-middle">
                                                <div class="btn-group mr-2" role="group" aria-label="First group">
                                                    <a type="button" class="btn btn-success btn-edit" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Data" data-id="<?= $row['id_merchant']; ?>" data-nama_seller="<?= $row['nama_seller']; ?>" data-nama_toko="<?= $row['nama_toko']; ?>" data-alamat_merchant="<?= $row['alamat_merchant']; ?>" data-no_hp_merchant="<?= $row['no_hp_merchant']; ?>" data-koordinat_merchant="<?= $row['koordinat_merchant']; ?>" data-tgl_join="<?= $row['tgl_join']; ?>">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                    <a type="button" class="btn btn-danger btn-delete" data-toggle="tooltip" data-id="<?= $row['id_merchant']; ?>" data-placement="top" title="" data-original-title="Hapus Data"><i class="fas fa-trash-alt"></i></a>

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
                <?= form_open('/backend/master/tambahMerchant'); ?>
                <div class="form-group">
                    <label for="recipient-name" class="control-label">Nama seller :</label>
                    <input type="text" class="form-control" name="nama_seller" id="nama_seller" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="control-label">Nama Toko :</label>
                    <input type="text" class="form-control" name="nama_toko" id="nama_toko" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="control-label">Alamat Merchant :</label>
                    <textarea type="text" rows="3" class="form-control" name="alamat_merchant" id="alamat_merchant" autocomplete="off" required></textarea>
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="control-label">Koordinat Merchant :</label>
                    <input type="text" class="form-control" name="koordinat_merchant" id="koordinat_merchant" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="control-label">Kontak Merchant :</label>
                    <input type="text" class="form-control" name="no_hp_merchant" id="no_hp_merchant" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="control-label">Tanggal Bergabung :</label>
                    <div class="input-group">
                        <input type="text" class="form-control mydatepicker2" data-date-format='dd/mm/yyyy' name="tgl_join" id="tgl_join" placeholder="dd/mm/yyyy" autocomplete="off" required>
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="icon-calender"></i></span>
                        </div>
                    </div>
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
                <?= form_open('/backend/master/updateMerchant'); ?>
                <div class="form-group">
                    <label for="recipient-name" class="control-label">Nama seller :</label>
                    <input type="text" class="form-control" name="nama_seller2" id="nama_seller2" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="control-label">Nama Toko :</label>
                    <input type="text" class="form-control" name="nama_toko2" id="nama_toko2" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="control-label">Alamat Merchant :</label>
                    <textarea type="text" rows="3" class="form-control" name="alamat_merchant2" id="alamat_merchant2" autocomplete="off" required></textarea>
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="control-label">Koordinat Merchant :</label>
                    <input type="text" class="form-control" name="koordinat_merchant2" id="koordinat_merchant2" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="control-label">Kontak Merchant :</label>
                    <input type="text" class="form-control" name="no_hp_merchant2" id="no_hp_merchant2" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="control-label">Tanggal Bergabung :</label>
                    <div class="input-group">
                        <input type="text" class="form-control mydatepicker" data-date-format='dd/mm/yyyy' name="tgl_join2" id="tgl_join2" placeholder="dd/mm/yyyy" autocomplete="off" required>
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="icon-calender"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" class="form-control" name="id_merchant" id="id_merchant">
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
                <?= form_open('/backend/master/deleteMerchant'); ?>
                <h4>Anda yakin akan menghapus data ini ?</h4>
            </div>
            <div class="modal-footer">
                <input type="hidden" class="form-control" name="id_merchant2" id="id_merchant2">
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

    //focus modal add
    $(document).ready(function() {
        $('#exampleModal').on('shown.bs.modal', function() {
            $('#nama_seller').trigger('focus');
        });
    });
    $(document).ready(function() {
        $('#editModal').on('shown.bs.modal', function() {
            $('#nama_seller2').trigger('focus');
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
            const nama_seller = $(this).data('nama_seller');
            const nama_toko = $(this).data('nama_toko');
            const alamat_merchant = $(this).data('alamat_merchant');
            const no_hp_merchant = $(this).data('no_hp_merchant');
            const tgl_join = $(this).data('tgl_join');
            const koordinat_merchant = $(this).data('koordinat_merchant');

            // Set data to Form Edit
            $('#id_merchant').val(id);
            $('#nama_seller2').val(nama_seller);
            $('#nama_toko2').val(nama_toko);
            $('#alamat_merchant2').val(alamat_merchant);
            $('#koordinat_merchant2').val(koordinat_merchant);
            $('#no_hp_merchant2').val(no_hp_merchant);
            $('#tgl_join2').val(tgl_join);

            // Call Modal Edit
            $('#editModal').modal('show');
        });

        // get Delete Product
        $('#tabelku').on('click', '.btn-delete', function() {
            // get data from button edit
            const id = $(this).data('id');
            // Set data to Form Edit
            $('#id_merchant2').val(id);
            // Call Modal Edit
            $('#deleteModal').modal('show');
        });

    });
</script>

<?= $this->endSection(); ?>