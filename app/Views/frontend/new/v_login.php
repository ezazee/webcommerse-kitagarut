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
            <form class="ps-form--account ps-tab-root pt-0" action="/frontend/new_home/check_login" method="post">
                <ul class="ps-tab-list">
                    <li class="active"><a href="#sign-in">Login</a></li>
                    <li><a href="#register">Daftar</a></li>
                </ul>
                <?php if ($validation->getErrors()) : ?>
                    <div class="alert alert-info text-center">Pendaftaran Gagal !<br> <?= $validation->listErrors(); ?> <br> Atau silahkan coba lagi atau hubungi CS KitaGarut </div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('success')) : ?>
                    <div class="alert alert-success text-center"><?= session()->getFlashdata('success'); ?></div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('gagal')) : ?>
                    <div class="alert alert-danger text-center"><?= session()->getFlashdata('gagal'); ?></div>
                <?php endif; ?>
                <div class="alert alert-info alert-dismissible" role="alert">
                    <div class="text-center">
                        <strong>Ini adalah halaman login/daftar untuk konsumen kitaGarut.com</strong>
                        <p>Untuk pendaftaran menjadi merchant/seller kitaGarut.com, silahkan hubungi Kontak Hotline</p>
                    </div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                </div>
                <div class="ps-tabs">
                    <div class="ps-tab active" id="sign-in">
                        <div class="ps-form__content">
                            <h5>Masuk Akun KitaGarut</h5>
                            <div class="form-group">
                                <input class="form-control" type="text" name="email_pel" placeholder="Masukan Alamat Email" value="<?= old('email_pel'); ?>" autofocus>
                            </div>
                            <div class="form-group form-forgot">
                                <input class="form-control" type="password" name="password" placeholder="Masukan Password">
                            </div>
                            <div class="row">
                                <!-- <div class="col-md-6">
                                    <div class="form-group submit">
                                        <a href="javascript:void" class="ps-btn ps-btn--fullwidth" style="background-color: #4CAF50;">Aktifasi</a>
                                    </div>
                                </div> -->
                                <div class="col-md-12">
                                    <div class="form-group submit">
                                        <button type="submit" class="ps-btn ps-btn--fullwidth">Login</button>
                                    </div>
                                </div>
                            </div>

                        </div>


            </form>
            <br>
        </div>
        <div class="ps-tab" id="register">
            <form action="/frontend/new_home/proses_register" method="post">
                <div class="ps-form__content">
                    <h5>Pendaftaran Akun Baru</h5>
                    <div class="form-group">
                        <input class="form-control" type="text" name="email_pel" placeholder="Masukan Alamat Email" value="<?= old('email_pel'); ?>" autofocus>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" name="nama_pel" value="<?= old('nama_pel'); ?>" placeholder="Masukan Nama">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" name="no_hp_pel" value="<?= old('no_hp_pel'); ?>" placeholder="Masukan No Handphone/WA">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" type="text" name="alamat_pel" value="<?= old('alamat_pel'); ?>" placeholder="Masukan Alamat"><?= old('alamat_pel'); ?></textarea>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="password1" placeholder="Masukan Password">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="password2" placeholder="Konfirmasi Password">
                    </div>
                    <div class="form-group submtit">
                        <button type="submit" class="ps-btn ps-btn--fullwidth">Daftar</button>
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