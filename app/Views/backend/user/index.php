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
                                        <th class="text-left align-middle">Foto</th>
                                        <th class="text-left align-middle">Nama</th>
                                        <th class="text-left align-middle">Email</th>
                                        <th class="text-left align-middle">Nama Mitra</th>
                                        <th class="text-left align-middle" style="width: 30%;">Alamat</th>
                                        <th class="text-left align-middle">Kontak</th>
                                        <th class="text-left align-middle">level Akses</th>
                                        <th class="text-center align-middle">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($userAkun as $row) : ?>
                                        <tr>
                                            <td class="text-center align-middle"><?= $no++; ?></td>
                                            <td class="text-left align-middle"><img src="<?= base_url('/assets/images/profile/' . $row['foto_peserta']) ?>" alt="user" class="img-circle" width="50px" /></td>
                                            <td class="text-left align-middle"><?= $row['nama_peserta']; ?></td>
                                            <td class="text-left align-middle"><?= $row['email_peserta']; ?></td>
                                            <?php if ($row['id_mitra_pes'] == 0) : ?>
                                                <td class="text-left align-middle">Kitagarut</td>
                                            <?php else : ?>
                                                <td class="text-left align-middle"><?= $row['nama_mitra']; ?></td>
                                            <?php endif; ?>
                                            <td class="text-left align-middle" style="width: 30%;"><?= $row['alamat_peserta']; ?></td>
                                            <td class="text-left align-middle"><?= $row['no_hp_peserta']; ?></td>
                                            <td class="text-center align-middle">
                                                <?php if ($row['role_id'] == 1) : ?>
                                                    <span class="badge badge-pill badge-success text-white ml-auto">Admin</span>
                                                <?php else : ?>
                                                    <span class="badge badge-pill badge-info text-white ml-auto">Mitra</span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-center align-middle">
                                                <div class="btn-group mr-2" role="group" aria-label="First group">
                                                    <a type="button" class="btn btn-success btn-edit" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Data" data-id="<?= $row['id_peserta']; ?>" data-nama_peserta="<?= $row['nama_peserta']; ?>" data-email_peserta="<?= $row['email_peserta']; ?>" data-id_mitra_pes="<?= $row['id_mitra_pes']; ?>" data-alamat_peserta="<?= $row['alamat_peserta']; ?>" data-no_hp_peserta="<?= $row['no_hp_peserta']; ?>" data-role_id="<?= $row['role_id']; ?>">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                    <a type="button" class="btn btn-danger btn-delete" data-toggle="tooltip" data-id="<?= $row['id_peserta']; ?>" data-placement="top" title="" data-original-title="Hapus Data"><i class="fas fa-trash-alt"></i>
                                                    </a>
                                                    <a type="button" class="btn btn-primary btn-reset" data-toggle="tooltip" data-id="<?= $row['id_peserta']; ?>" data-placement="top" title="" data-original-title="Reset Password"><i class="fas fa-lock-open"></i></a>

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
                <?= form_open('/backend/user/tambahPengguna'); ?>
                <div class="form-group">
                    <label for="recipient-name" class="control-label">Nama :</label>
                    <input type="text" class="form-control" name="nama_peserta" id="nama_peserta" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="control-label">Email :</label>
                    <input type="email" class="form-control" name="email_peserta" id="email_peserta" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <label class="control-label">Pilih Mitra</label>
                    <select class="dept form-control custom-select" style=" width: 100%; height:36px;" name="id_mitra_pes" id="id_mitra_pes">
                        <option value="" disabled selected hidden>Pilih Mitra</option>
                        <option value="0">KitaGarut</option>
                        <?php foreach ($mitra as $d) : ?>
                            <option value="<?= $d['id_mitra']; ?>"><?= $d['nama_mitra']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="control-label">Alamat :</label>
                    <textarea type="text" rows="3" class="form-control" name="alamat_peserta" id="alamat_peserta" autocomplete="off" required></textarea>
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="control-label">Kontak :</label>
                    <input type="text" class="form-control" name="no_hp_peserta" id="no_hp_peserta" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <label class="control-label">Level Akses</label>
                    <select class="dept form-control custom-select kategori style=" width: 100%; height:36px;" name="role_id" id="role_id">
                        <option value="1">Admin</option>
                        <option value="2">Mitra</option>
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
                <?= form_open('/backend/user/updatePengguna'); ?>
                <div class="form-group">
                    <label for="recipient-name" class="control-label">Nama :</label>
                    <input type="text" class="form-control" name="nama_peserta2" id="nama_peserta2" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="control-label">Email :</label>
                    <input type="email" class="form-control" name="email_peserta2" id="email_peserta2" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <label class="control-label">Pilih Mitra</label>
                    <select class="dept form-control custom-select" style="width: 100%; height:36px;" name="id_mitra_pes2" id="id_mitra_pes2">
                        <option value="" disabled selected hidden>Pilih Mitra</option>
                        <option value="0">KitaGarut</option>
                        <?php foreach ($mitra as $d) : ?>
                            <option value="<?= $d['id_mitra']; ?>"><?= $d['nama_mitra']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="control-label">Alamat :</label>
                    <textarea type="text" rows="3" class="form-control" name="alamat_peserta2" id="alamat_peserta2" autocomplete="off" required></textarea>
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="control-label">Kontak :</label>
                    <input type="text" class="form-control" name="no_hp_peserta2" id="no_hp_peserta2" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <label class="control-label">Level Akses</label>
                    <select class="dept form-control custom-select kategori style=" width: 100%; height:36px;" name="role_id2" id="role_id2">
                        <option value="1">Admin</option>
                        <option value="2">Mitra</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" class="form-control" name="id_peserta2" id="id_peserta2">
                <input type="hidden" class="form-control" value="<?= $user['id_peserta']; ?>" name="id_login2" id="id_login2">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-success">Edit</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- /.modal -->

<!-- MODAL HAPUS -->
<div class="modal" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel1">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="deleteModalLabel1">Hapus Data <?= $judul; ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <?= form_open('/backend/user/deletePengguna'); ?>
                <h4>Anda yakin akan menghapus data ini ?</h4>
            </div>
            <div class="modal-footer">
                <input type="hidden" class="form-control" name="id_peserta3" id="id_peserta3">
                <button type="button" class="btn btn-info" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-danger">Hapus !</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- /.modal -->

<!-- MODAL RESET -->
<div class="modal" id="resetModal" tabindex="-1" role="dialog" aria-labelledby="resetModalLabel1">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="resetModalLabel1">Reset Password <?= $judul; ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <?= form_open('/backend/user/resetPassword'); ?>
                <h4>Anda yakin akan Mereset Password User ini ?</h4>
            </div>
            <div class="modal-footer">
                <input type="hidden" class="form-control" name="id_reset" id="id_reset">
                <button type="button" class="btn btn-info" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-danger">Reset Password !</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- MODAL RESET -->
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
            const nama_peserta = $(this).data('nama_peserta');
            const id_mitra_pes = $(this).data('id_mitra_pes');
            const email_peserta = $(this).data('email_peserta');
            const alamat_peserta = $(this).data('alamat_peserta');
            const no_hp_peserta = $(this).data('no_hp_peserta');
            const role_id = $(this).data('role_id');


            // Set data to Form Edit
            $('#id_peserta2').val(id);
            $('#nama_peserta2').val(nama_peserta);
            $('#id_mitra_pes2').val(id_mitra_pes);
            $('#email_peserta2').val(email_peserta);
            $('#alamat_peserta2').val(alamat_peserta);
            $('#no_hp_peserta2').val(no_hp_peserta);
            $('#role_id2').val(role_id);

            // Call Modal Edit
            $('#editModal').modal('show');
        });

        // get Delete Product
        $('#tabelku').on('click', '.btn-delete', function() {
            // get data from button edit
            const id = $(this).data('id');
            // Set data to Form Edit
            $('#id_peserta3').val(id);
            // Call Modal Edit
            $('#deleteModal').modal('show');
        });

        $('#tabelku').on('click', '.btn-reset', function() {
            // get data from button edit
            const id = $(this).data('id');
            // Set data to Form Edit
            $('#id_reset').val(id);
            // Call Modal Edit
            $('#resetModal').modal('show');
        });

    });
</script>

<?= $this->endSection(); ?>