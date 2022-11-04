<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/images/favicon.png">
    <link rel="shortcut icon" type="image/png" sizes="16x16" href="/assets/images/favicon.png">
    <link rel="apple-touch-icon-precomposed" href="assets/images/pangling-icon-57-precomposed.png"> <!-- For iPhone -->
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/images/pangling-icon-114-precomposed.png"> <!-- For iPhone 4 Retina display -->
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/images/pangling-icon-72-precomposed.png"> <!-- For iPad -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/images/pangling-icon-144-precomposed.png"> <!-- For iPad Retina display -->

    <title><?= $judul; ?></title>
    <link href="/assets/node_modules/register-steps/steps.css" rel="stylesheet" />
    <link href="/dist/css/pages/register3.css" rel="stylesheet" />
    <link rel="stylesheet" href="/assets/node_modules/dropify/dist/css/dropify.min.css">
    <link href="/dist/css/style.min.css" rel="stylesheet" />

</head>

<body class="skin-default card-no-border">

    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">Pendaftaran Merchant KitaGarut</p>
        </div>
    </div>

    <section id="wrapper" class="step-register">
        <div class="register-box mb-4">
            <div class="text-center">
                <a href="javascript:void(0)" class="text-center m-b-20">
                    <img src="/assets/images/logo-icon.png" alt="Home" width="80px" /><br />
                    <img src="/assets/images/logo-text.png" alt="Home" width="80px" />
                </a>
                <div class="row text-left">
                    <div class="col-md-4 ml-4 ">
                        <a href="/auth" class="btn waves-effect waves-light btn-sm btn-success"> <i class="fas fa-arrow-alt-circle-left"></i> <b>Ke halaman Login</b></a>
                    </div>
                </div>
                <?= form_open_multipart(base_url('seller/auth/proses_register'), 'id="msform"'); ?>

                <!-- progressbar -->
                <ul id="eliteregister">
                    <li class="active">Akun Login</li>
                    <li>Informasi Toko</li>
                    <li>Informasi lainnya</li>
                </ul>

                <!-- fieldsets -->
                <fieldset>
                    <h2 class="fs-title">Pendaftaran</h2>
                    <h3 class="fs-subtitle">Merchant KitaGarut</h3>
                    <input type="text" id="email_merchant" name="email_merchant" placeholder="Email" OnClick="CheckValue()" required autocomplete="off" />
                    <input type="password" id="password1" name="password1" placeholder="Password" OnClick="CheckValue()" required autocomplete="off" />
                    <input type="password" id="password2" name="password2" placeholder="Konfirmasi Password" OnClick="CheckValue()" required />
                    <input type="button" name="next" class="next action-button lanjut1" value="Lanjut" />
                </fieldset>
                <fieldset>
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Informasi Toko</h4>
                                <input type="text" id="nama_toko" name="nama_toko" placeholder="Nama Toko" />
                            </div>
                        </div>
                    </div>

                    <input type="button" name="previous" class="previous action-button" value="Kembali" />
                    <input type="button" name="next" class="next action-button" value="Lanjut" />
                </fieldset>
                <fieldset>
                    <h2 class="fs-title"></h2>
                    <h3 class="fs-subtitle"></h3>
                    <input type="text" name="nama_seller" placeholder="Nama" />
                    <input type="text" name="no_hp_merchant" placeholder="No. Handphone" />
                    <textarea name="alamat_merchant" placeholder="Alamat"></textarea>
                    <input type="button" name="previous" class="previous action-button" value="Kembali" />
                    <input type="submit" name="submit" class="action-button" value="Submit" />
                </fieldset>
                <?= form_close() ?>
                <div class="clear"></div>
            </div>
        </div>
        <br />
    </section>
    <br />
    <br />
    <script src="/assets/node_modules/jquery/jquery-3.2.1.min.js"></script>
    <script src="/assets/node_modules/popper/popper.min.js"></script>
    <script src="/assets/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/assets/node_modules/register-steps/jquery.easing.min.js"></script>
    <script src="/assets/node_modules/register-steps/register-init.js"></script>
    <script src="/assets/node_modules/dropify/dist/js/dropify.min.js"></script>
    <script type="text/javascript">
        $(function() {
            $(".preloader").fadeOut();
        });

        $(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });

        $("#to-recover").on("click", function() {
            $("#loginform").slideUp();
            $("#recoverform").fadeIn();
        });

        function CheckValue() {
            var userName = $("#email_merchant").val();
            if (userName == '') {
                alert('user Name is empty');
            }

        }
    </script>

</body>



</html>