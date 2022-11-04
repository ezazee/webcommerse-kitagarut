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

                            </div>
                        </div>
                        <hr>
                        <div class="m-t-40">
                            <table id="tabelku" class="table display table-bordered table-striped info-bordered-table">

                                <thead>
                                    <tr>
                                        <th class="text-center font-weight-bolder">No</th>
                                        <th class="text-center font-weight-bolder">Tanggal</th>
                                        <th class="text-center font-weight-bolder">No Transaksi</th>
                                        <th class="text-center font-weight-bolder">Nama Pelanggan</th>
                                        <th class="text-center font-weight-bolder">Ongkir</th>
                                        <th class="text-center font-weight-bolder">Total Pembelian</th>
                                        <th class="text-center font-weight-bolder">Total Pembayaran</th>
                                        <th class="text-center font-weight-bolder">Status</th>
                                        <th class="text-center font-weight-bolder">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($pesanan as $row) : ?>
                                        <tr>
                                            <td class="text-center"><?= $no++; ?></td>
                                            <td class="text-center"><?= longdate_indo($row['tgl_trans']); ?></td>
                                            <td class="text-center"><?= $row['no_trans']; ?></td>
                                            <td class="text-center"><?= $row['nama_pel']; ?></td>
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
                                                <a href="/backend/transaksi/detail_pesanan/<?= $row['no_trans']; ?>" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Lihat detail pesanan">Detail</a>

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

            // Set data to Form Edit
            $('#id_merchant').val(id);
            $('#nama_seller2').val(nama_seller);
            $('#nama_toko2').val(nama_toko);
            $('#alamat_merchant2').val(alamat_merchant);
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