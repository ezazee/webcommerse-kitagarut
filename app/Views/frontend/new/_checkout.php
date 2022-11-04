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
<!-- <nav class="navigation--mobile-product"><a class="ps-btn ps-btn--black" href="shopping-cart.html">Add to cart</a><a class="ps-btn" href="checkout.html">Buy Now</a></nav> -->
<div class="ps-breadcrumb">
    <div class="ps-container">
        <ul class="breadcrumb">
            <li><a href=""><?= $menu; ?></a></li>
            <li><a href=""><?= $submenu; ?></a></li>

        </ul>
    </div>
</div>

<div class="ps-section--shopping ps-shopping-cart">
    <div class="container">
        <div class="ps-section__header">
            <h2>Cek Pemesanan</h2>
        </div>

        <div class="ps-section__content">
            <div class="row">
                <div class="col-md-12">
                    <?php if (session()->getFlashdata('gagal')) : ?>
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong><?= session()->getFlashdata('gagal'); ?></strong>
                        </div>
                    <?php endif; ?>
                    <!-- <div class="alert alert-info" role="alert">
                        <h4 class="alert-heading">Untuk Sementara KitaGarut.com hanya tersedia untuk pengiriman Area Garut !</h4>
                        <hr>
                        <p>Biaya Pengiriman akan tampil setelah penentuan lokasi pengiriman, pada halaman ini </p>

                    </div> -->
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3 ">
                            <?php if (session()->getFlashdata('pesan')) : ?>
                                <div class="alert alert-danger alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <strong><?= session()->getFlashdata('pesan'); ?></strong>
                                </div>
                            <?php endif; ?>
                            <div class="table-responsive">
                                <table class="table ps-table--shopping-cart">
                                    <thead>
                                        <tr>
                                            <th>Nama Produk</th>
                                            <th>Harga</th>
                                            <th>QTY</th>
                                            <th>Subtotal</th>
                                            <th>Hapus</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (empty($keranjang)) : ?>
                                            <tr>
                                                <td colspan="5">Keranjang belanja kosong</td>
                                            </tr>
                                            <br>
                                            <br>
                                        <?php else : ?>
                                            <?php $total = 0; ?>
                                            <?php $i = 1; ?>
                                            <?php foreach ($keranjang as $key => $value) : ?>
                                                <tr>
                                                    <td class="text-center" colspan="5"> Merchant : <strong> <?= $value['options']['nama_merchant']; ?></strong></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="ps-product--cart">
                                                            <div class="ps-product__thumbnail"><a href="/frontend/new_home/singleproduk/<?= $value['id']; ?>"><img src="<?= base_url('/assets/images/produk/' . $value['options']['foto_1']) ?>" alt=""></a></div>
                                                            <div class="ps-product__content">
                                                                <a href="/frontend/new_home/singleproduk/<?= $value['id']; ?>"><?= $value['name']; ?>
                                                                </a>
                                                                <p>
                                                                    <?= rupiah($value['price']); ?> x <?= $value['qty']; ?>
                                                                    <strong> = <?= rupiah($value['subtotal']); ?></strong><br>Berat <strong> = <?= $value['options']['berat_produk']; ?> gr</strong>
                                                                </p>


                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="price text-center"><?= rupiah($value['price']); ?></td>
                                                    <td class="text-center"><?= $value['qty']; ?>
                                                    </td>
                                                    <td class="text-center"><?= rupiah($value['subtotal']); ?></td>
                                                    <td class="text-center"><a href="/frontend/new_home/hapus_cart/<?= $value['rowid']; ?>"><i class="icon-cross"></i></a></td>
                                                </tr>
                                                <?php $i++; ?>
                                                <?php $total += $value['subtotal']; ?>
                                            <?php endforeach; ?>

                                        <?php endif; ?>

                                    </tbody>
                                </table>
                            </div>
                            <br><br>
                            <!-- <div class="alert alert-danger" role="alert">
                                <h4 class="alert-heading">Cara penetuan lokasi !</h4>
                                <hr>
                                <p>Cari lokasi Anda pada Peta dengan menggunakan tombol perbesar/perkecil , setelah Anda menemukan lokasi yang tepat, tekan pada lokasi tersebut pada Peta </p>

                            </div> -->


                        </div>
                    </div>
                </div>
            </div>
            <div class="ps-section__footer" data-select2-id="6">
                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 ">
                        <form action="/frontend/new_home/konfirmasi_pesanan" method="post">
                            <div class="ps-block--shopping-total">

                                <input type="hidden" id="lat" name="lat_input">
                                <input type="hidden" id="lon" name="lon_input">
                                <div class="ps-block__header">
                                    <h3>Alamat Pengiriman <span></span></h3>
                                    <input type="hidden" id="subtotal" name="subtotal" value="<?= $total; ?>">
                                </div>
                                <div class="ps-block__header">
                                    <p for="latitude"><?= $user['alamat_pel']; ?> <span></span></p>
                                </div>
                                <div class="ps-block__header">
                                    <p>Kab/Kota : <span><?= $pelanggan['nama_kab']; ?></span></p>
                                </div>
                                <div class="ps-block__header">
                                    <p>Kecamatan : <span><?= $pelanggan['nama_kec']; ?></span></p>
                                </div>


                            </div>

                        </form>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 ">
                        <figure data-select2-id="5">
                            <figcaption>Pilih Ekspedisi</figcaption>
                            <div class="form-group">
                                <select class="ps-select select2-hidden-accessible" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                    <option value="1" data-select2-id="3">JNE</option>
                                    <option value="2" data-select2-id="7">Italia</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <select id="servis" name="servis" class="form-control">
                                    <option>Reguler</option>

                                </select>
                            </div>

                        </figure>
                    </div>

                    <?php if (session()->getFlashdata('gagal')) : ?>
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong><?= session()->getFlashdata('gagal'); ?></strong>
                        </div>
                    <?php endif; ?>
                    <!-- <div class="alert alert-info" role="alert">
                        <h4 class="alert-heading">Untuk Sementara KitaGarut.com hanya tersedia untuk pengiriman Area Garut !</h4>
                        <hr>
                        <p>Biaya Pengiriman akan tampil setelah penentuan lokasi pengiriman, pada halaman ini </p>

                    </div> -->

                    <?php if (!empty($keranjang)) : ?>
                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 ">
                            <form action="/frontend/new_home/konfirmasi_pesanan" method="post">
                                <div class="ps-block--shopping-total">

                                    <input type="hidden" id="lat" name="lat_input">
                                    <input type="hidden" id="lon" name="lon_input">
                                    <div class="ps-block__header">
                                        <p>Subtotal <span> <?= rupiah($total); ?></span></p>
                                        <input type="hidden" id="subtotal" name="subtotal" value="<?= $total; ?>">
                                    </div>
                                    <?php $ongkir = '15000'; ?>
                                    <div class="ps-block__header">
                                        <p>Ongkir:<span>Rp. 22.000</span></p>
                                    </div>
                                    <div class="ps-block__content">
                                        <h3>Total <span id="total">Rp. 39.000</span></h3>
                                    </div>
                                </div>
                                <button id="submit" type="submit" class="ps-btn ps-btn--fullwidth">Checkout</button>
                            </form>
                        </div>
                    <?php endif; ?>


                </div>
            </div>

        </div>
    </div>
</div>
</div>

<br>


<?= $this->include('layout/footer_new2'); ?>


<script>
    $('#submit').click(function() {
        if ($('#lat').val() == '') {
            alert('Lokasi belum ditentukan pada peta !');
            return false;
        }
    });

    $('#servis').select2({

        placeholder: 'Pilih Servis',

    });

    var tileLayer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a> Contributors'
    });
    //remember last position
    var rememberLat = document.getElementById('latitude').value;
    var rememberLong = document.getElementById('longitude').value;
    if (!rememberLat || !rememberLong) {
        rememberLat = -7.201257;
        rememberLong = 107.887293;
    }
    var map = new L.Map('maps', {
        'center': [rememberLat, rememberLong],
        'zoom': 15,
        'layers': [tileLayer]
    });
    var marker = L.marker([rememberLat, rememberLong], {
        draggable: true
    }).addTo(map);
    marker.on('dragend', function(e) {
        updateLatLng(marker.getLatLng().lat, marker.getLatLng().lng);
    });
    map.on('click', function(e) {
        marker.setLatLng(e.latlng);
        updateLatLng(marker.getLatLng().lat, marker.getLatLng().lng);
    });

    function updateLatLng(lat, lng, reverse) {
        if (reverse) {
            marker.setLatLng([lat, lng]);
            map.panTo([lat, lng]);
        } else {
            document.getElementById('latitude').textContent = marker.getLatLng().lat.toFixed(6);
            document.getElementById('lat').value = marker.getLatLng().lat.toFixed(6);
            document.getElementById('longitude').textContent = marker.getLatLng().lng.toFixed(6);
            document.getElementById('lon').value = marker.getLatLng().lng.toFixed(6);
            map.panTo([lat, lng]);
        }
    }
    // var mymap = L.map('maps').setView([-7.201257, 107.887293], 11);
    // L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    //     maxZoom: 19,
    //     attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    // }).addTo(mymap);
    // // L.marker([-7.201257, 107.887293]).bindPopup('PT. GRAHA KARA DIGITAL !').addTo(mymap);

    // // var new_popup = L.popup({
    // //     "autoClose": false,
    // //     "closeOnClick": null
    // // }).setContent("I am a text that will stay open until closed");
    // // L.marker([-7.201257, 107.887293]).bindPopup(new_popup).addTo(mymap);

    // var marker = L.marker([-7.201257, 107.887293], {
    //     title: "Title",
    //     draggable: true
    // }, {
    //     draggable: 'true'
    // }).addTo(mymap);

    // marker.bindPopup("This is popup content");
    // marker.on('click', onClick);

    // function onClick(e) {
    //     var popup = e.target.getPopup();
    //     var content = popup.getContent();

    //     console.log(content);
    // }
</script>

<?= $this->endSection(); ?>