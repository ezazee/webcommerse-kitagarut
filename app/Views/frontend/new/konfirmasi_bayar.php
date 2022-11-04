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


<div class="ps-section--shopping ps-shopping-cart">
    <div class="container">
        <a href="/frontend/new_home/pesananku" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Kembali"><i class="fa fa-arrow-left" aria-hidden="true"></i></i> Kembali</a><br>

        <div class="ps-section__content">

            <div class="ps-section__footer">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 ">
                        <?php if ($validation->getErrors()) : ?>
                            <br>
                            <div class="alert alert-danger text-center">Konfirmasi Gagal !<br> Silahkan coba lagi dan upload ulang bukti atau hubungi CS KitaGarut <?= $validation->listErrors(); ?> </div>
                        <?php endif; ?>
                        <br>
                        <div class="alert alert-info alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>Pengisian Nominal Pembayaran tidak boleh pake titik "." </strong>
                        </div>
                        <?= form_open_multipart('/frontend/new_home/konfirmasi_bayar'); ?>
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
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 ">
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
    </div>
</div>

<br>


<?= $this->include('layout/footer_new2'); ?>


<script>
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>

<?= $this->endSection(); ?>