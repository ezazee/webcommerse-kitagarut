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
                <h4 class="text-themecolor"><?= $judul; ?> || <?= $App; ?> </h4>
            </div>
            <div class="col-md-7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0)">Home</a>
                        </li>
                        <li class="breadcrumb-item active"><?= $judul; ?></li>
                    </ol>
                    <!-- <button type="button" class="btn btn-info d-none d-lg-block m-l-15">
                                <i class="fa fa-plus-circle"></i> Create New
                            </button> -->
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <!-- Row -->

        <div class="card-group">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-flex no-block align-items-center">
                                <div>
                                    <h3><i class="icon-tag"></i></h3>
                                    <p class="text-muted">TOTAL PESANAN</p>
                                </div>
                                <div class="ml-auto">
                                    <h2 class="counter text-info"><?= $jumlah_pesanan->jumlah; ?></h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="progress">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 85%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <!-- Column -->
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-flex no-block align-items-center">
                                <div>
                                    <h3><i class="icon-basket"></i></h3>
                                    <p class="text-muted">PESANAN SELESAI</p>
                                </div>
                                <div class="ml-auto">
                                    <h2 class="counter text-success"><?= $pesanan_selesai->jumlah; ?></h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="progress">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 85%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <!-- Column -->
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-flex no-block align-items-center">
                                <div>
                                    <h3><i class="icon-basket-loaded"></i></h3>
                                    <p class="text-muted">PESANAN BERJALAN</p>
                                </div>
                                <div class="ml-auto">
                                    <h2 class="counter text-warning"><?= $pesanan_berjalan->jumlah; ?></h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 85%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <!-- Column -->
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-flex no-block align-items-center">
                                <div>
                                    <h3><i class="icon-cup"></i></h3>
                                    <p class="text-muted">PESANAN DI BATALKAN</p>
                                </div>
                                <div class="ml-auto">
                                    <h2 class="counter text-danger"><?= $pesanan_batal->jumlah; ?></h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="progress">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 85%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-3 col-lg-3 col-sm-12">
                <div class="card">
                    <div class="box bg-info text-center">
                        <h1 class="font-light text-white"><?= $jumlah_pelanggan['0']['id_pel']; ?></h1>
                        <h6 class="text-white">Jumlah Pelanggan</h6>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-lg-3 col-sm-12">
                <div class="card">
                    <div class="box bg-success text-center">
                        <h1 class="font-light text-white"><?= $jumlah_merchant['0']['id_merchant']; ?></h1>
                        <h6 class="text-white">Jumlah Merchant</h6>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-lg-3 col-sm-12">
                <div class="card">
                    <div class="box bg-primary text-center">
                        <h1 class="font-light text-white"><?= $jumlah_produk['0']['id_produk']; ?></h1>
                        <h6 class="text-white">Jumlah Produk</h6>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-lg-3 col-sm-12">
                <div class="card">
                    <div class="box bg-danger text-center">
                        <h1 class="font-light text-white"><?= $jumlah_pelanggan_baru->jumlah; ?></h1>
                        <h6 class="text-white">Pelanggan Baru</h6>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <!-- Column -->
            <div class="col-lg-4 col-xlg-3 col-md-5">
                <div class="card">
                    <div class="card-body">
                        <center class="m-t-30">
                            <img src="<?= base_url('assets/images/profile/' . $user['foto_peserta']) ?>" class="img-circle" width="150" />
                            <h4 class="card-title m-t-10"><?= $user['nama_peserta']; ?></h4>
                            <h6 class="card-subtitle"></h6>
                            <br>
                            <a href="/profil" class="btn btn-info">
                                Update Profil
                            </a>
                        </center>
                    </div>
                    <div>
                        <hr />
                    </div>
                    <div class="card-body">
                        <small class="text-muted">Email address </small>
                        <h6><?= $user['email_peserta']; ?></h6>
                        <small class="text-muted p-t-30 db">Phone</small>
                        <h6><?= $user['no_hp_peserta']; ?></h6>
                        <small class="text-muted p-t-30 db">Address</small>
                        <h6><?= $user['alamat_peserta']; ?></h6>
                    </div>
                </div>
            </div>
            <!-- column -->
            <!-- column -->
            <div class="col-lg-8 col-xlg-3 col-md-7">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Grafik Jumlah Transaksi Bulan ini</h4>
                        <div>
                            <canvas id="chart2" height="150"></canvas>
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

<script>
    <?php if ($grafik_pesanan != 0) : ?>
        <?php
        foreach ($grafik_pesanan as $result) {
            $tanggal[] = $result->tanggal; //ambil bulan
            $total[] = (float) $result->total; //ambil nilai
        }
        /* end mengambil query*/
        ?>

        new Chart(document.getElementById("chart2"), {
            "type": "line",
            "data": {
                "labels": <?php echo json_encode($tanggal); ?>,
                "datasets": [{
                    "label": "Jumlah Pendapatan",
                    "data": <?php echo json_encode($total); ?>,
                    "fill": false,
                    "borderColor": "rgb(75, 192, 192)",
                    "lineTension": 0.1
                }]
            },
            "options": {
                responsive: true,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: !0,
                            userCallback: function(value, index, values) {
                                // Convert the number to a string and splite the string every 3 charaters from the end
                                value = value.toString();
                                value = value.split(/(?=(?:...)*$)/);


                                // Convert the array to a string and format the output
                                value = value.join('.');
                                return ' Rp. ' + value;
                            }
                        }
                    }]
                },
                tooltips: {
                    callbacks: {
                        label: function(t, d) {
                            var xLabel = d.datasets[t.datasetIndex].label;
                            var yLabel = t.yLabel >= 1000 ? 'Rp.' + t.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") : '$' + t.yLabel;
                            return xLabel + ': ' + yLabel;
                        }
                    },
                    bodySpacing: 4,
                    mode: "nearest",
                    intersect: 0,
                    position: "nearest",
                    xPadding: 10,
                    yPadding: 10,
                    caretPadding: 10
                },
                layout: {
                    padding: {
                        left: 15,
                        right: 15,
                        top: 15,
                        bottom: 15
                    }
                }
            }
        });
    <?php endif; ?>


    function startTime() {
        var today = new Date();
        var h = today.getHours();
        var m = today.getMinutes();
        var s = today.getSeconds();
        m = checkTime(m);
        s = checkTime(s);
        document.getElementById('txt').innerHTML =
            h + ":" + m + ":" + s;
        var t = setTimeout(startTime, 500);
        document.getElementById('absen_masuk').innerHTML =
            "sekarang : " + h + ":" + m + ":" + s;
        var t = setTimeout(startTime, 500);
        document.getElementById('absen_pulang').innerHTML =
            "sekarang : " + h + ":" + m + ":" + s;
        var t = setTimeout(startTime, 500);
    }

    function checkTime(i) {
        if (i < 10) {
            i = "0" + i
        }; // add zero in front of numbers < 10
        return i;
    }
</script>
<?= $this->endSection(); ?>