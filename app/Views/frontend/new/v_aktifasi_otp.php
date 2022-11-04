<?= $this->extend('layout/template_new'); ?>
<?= $this->section('konten_new'); ?>

<div class="ps-page--my-account">
    <div class="ps-breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href=""><?= $menu; ?></a></li>
                <li><a href=""><?= $submenu; ?></a></li>
            </ul>
        </div>
    </div>
    <div class="ps-my-account">
        <div class="container">
            <form class="ps-form--account ps-tab-root pt-0" action="/frontend/new_home/validasi_otp" method="post">
                <ul class="ps-tab-list">
                    <li class="active"><a href="#sign-in">Aktifasi Akun</a></li>
                </ul>
                <div class="alert alert-info alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <div class="text-center">
                        <strong>Masukan kode otp yang di kirim ke Whatsapp ke kolom otp di bawah</strong>
                        <p></p>
                    </div>
                </div>
                <?php if ($validation->getErrors()) : ?>
                    <div class="alert alert-danger text-center"><?= $validation->listErrors(); ?> </div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('success')) : ?>
                    <div class="alert alert-success text-center"><?= session()->getFlashdata('success'); ?></div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('gagal')) : ?>
                    <div class="alert alert-danger text-center"><?= session()->getFlashdata('gagal'); ?></div>
                <?php endif; ?>
                <div class="ps-tabs">
                    <div class="ps-tab active" id="sign-in">
                        <div class="ps-form__content">
                            <h5>Aktifasi Akun KitaGarut</h5>
                            <input type="hidden" name="no_hp_pel" value="<?= urldecode($no_hp_pel); ?>">
                            <div class="form-group">
                                <input class="form-control" type="text" name="otp" placeholder="Masukan Kode OTP" value="<?= old('otp'); ?>" autofocus>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group submit">
                                        <button type="submit" class="ps-btn ps-btn--fullwidth">Lanjut</button>
                                    </div>
                                </div>
                            </div>

                        </div>
            </form>
            <br>
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

</script>

<?= $this->endSection(); ?>