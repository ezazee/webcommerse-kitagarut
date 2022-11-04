<?= $this->extend('layout/template_new'); ?>

<?= $this->section('head'); ?>
<script src="<?= base_url('leaflet/leaflet.js'); ?>"></script>
<link rel="stylesheet" href="<?= base_url('leaflet/leaflet.css'); ?>" />
<link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
<script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
<style>
    #maps {
        height: 350px;
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
            <h2>Tentukan Lokasi Pengiriman</h2>
        </div>

        <div class="ps-section__content">
            <div class="row">
                <div class="col-md-12">
                    <!-- <div class="alert alert-info" role="alert">
                        <h4 class="alert-heading">Untuk Sementara KitaGarut.com hanya tersedia untuk pengiriman Area Garut !</h4>
                        <hr>
                        <p>Biaya Pengiriman akan tampil setelah penentuan lokasi pengiriman, pada halaman ini </p>

                    </div> -->
                    <div class="row">
                        <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12 mb-3 ">
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
                            <div class="alert alert-info" role="alert">
                                <h4 class="alert-heading">Rute Pengiriman !</h4>

                                <p></p>
                            </div>
                            <div id="maps"></div>

                        </div>
                        <?php if (!empty($keranjang)) : ?>
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 ">
                                <form action="/frontend/new_home/simpan_penjualan" method="post" onsubmit="return validasi_input(this)">
                                    <div class=" ps-block--shopping-total">

                                        <input type="hidden" id="lat" name="lat">
                                        <input type="hidden" id="koordinat_merchant" name="koordinat_merchant" value="<?= $koordinat_merchant; ?>">
                                        <input type="hidden" id="ongkir_input" name="ongkir_input">
                                        <input type="hidden" id="jarak_input" name="jarak_input">
                                        <input type="hidden" id="total_input" name="total_input">
                                        <input type="hidden" id="total_i" name="total_i" value="<?= $total; ?>">
                                        <div class="ps-block__header">
                                            <p>Subtotal <span> <?= rupiah($total); ?></span></p>
                                            <input type="hidden" id="subtotal" name="subtotal" value="<?= $total; ?>">
                                        </div>
                                        <?php $ongkir = '15000'; ?>
                                        <div class="ps-block__header">
                                            <p>Ongkos kirim <span id="ongkir"></span></p>
                                        </div>
                                        <div class="ps-block__header">
                                            <p>Jarak Pengiriman <span id="jarak"></span></p>
                                        </div>
                                        <div class="ps-block__content">
                                            <h3>Total <span id="total"></span></h3>
                                        </div>
                                    </div>
                                    <!-- <div class="alert alert-success" role="alert">
                                    <h4 class="alert-heading">Pastikan alamat benar !</h4>
                                    <hr>
                                    <p>Sebelum menekan tombol checkout pastikan penetuan lokasi benar . </p>
                                    <p>Latitude dan Longitude adalah koordinat peta dari marker yang Anda tentukan . </p>

                                </div> -->
                                    <h4>Pilih Metode Pembayaran</h4>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <input type="radio" name="metode_bayar" id="metode_bayar" aria-label="Radio button for following text input" value="Transfer Bank">
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" aria-label="Text input with radio button" value="Transfer Bank" readonly>
                                    </div>
                                    <br>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <input type="radio" name="metode_bayar" id="metode_bayar" aria-label="Radio button for following text input" value="COD">
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" aria-label="Text input with radio button" value="COD" readonly>
                                    </div>
                                    <br>
                                    <button id="submit" type="submit" class="ps-btn ps-btn--fullwidth">Konfirmasi</button>
                                </form>
                            </div>
                        <?php endif; ?>
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
    $('#submit').click(function() {
        if ($('#ongkir_input').val() == '') {
            alert('Maaf seller belum menetukan lokasi pengiriman ! Silahkan pilih produk lain');
            return false;
        }
    });

    function validasi_input(form) {
        function check_radio(radio) {
            // memeriksa apakah radio button sudah ada yang dipilih
            for (i = 0; i < radio.length; i++) {
                if (radio[i].checked === true) {
                    return radio[i].value;
                }
            }
            return false;
        }
        var radio_val = check_radio(form.metode_bayar);
        if (radio_val === false) {
            alert("Anda belum memilih Metode Pembayaran !");
            return false;
        }
        return (true);
    }

    var mymap = L.map('maps').setView([-7.201257, 107.887293], 11);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(mymap);
    // L.marker([-7.201257, 107.887293]).bindPopup('PT. GRAHA KARA DIGITAL !').addTo(mymap);

    // var new_popup = L.popup({
    //     "autoClose": false,
    //     "closeOnClick": null
    // }).setContent("I am a text that will stay open until closed");
    // L.marker([-7.201257, 107.887293]).bindPopup(new_popup).addTo(mymap);

    var popup1 = new L.Popup({
        'autoClose': false
    });
    popup1.setLatLng([<?= $koordinat_merchant; ?>]);
    popup1.setContent('<div class="text-center">Merchant KitaGarut.com <br> Berangkat dari sini</div>');

    var popup2 = new L.Popup({
        'autoClose': false
    });
    popup2.setLatLng([-7.219610, 107.897353]);
    popup2.setContent('<div class="text-center">Konsumen KitaGarut.com <br> Menuju ke sini</div>');

    L.marker([<?= $koordinat_merchant; ?>]).addTo(mymap)
        .bindPopup(popup1).openPopup();

    L.marker([<?= $latlon; ?>]).addTo(mymap)
        .bindPopup(popup2).openPopup();

    var greenIcon = new L.Icon({
        iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png',
        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
    });
    var redIcon = new L.Icon({
        iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
    });


    var routeControl = L.Routing.control({
        waypoints: [
            L.latLng(<?= $koordinat_merchant; ?>),
            L.latLng(<?= $latlon; ?>),
        ],
        lineOptions: {
            styles: [{
                color: '#242c81',
                weight: 2
            }]
        },
        lineOptions: {
            addWaypoints: false
        },
        fitSelectedRoutes: true,
        draggableWaypoints: false,
        routeWhileDragging: false,
        createMarker: function(i, wp, nWps) {
            if (i === 0 || i === nWps - 1) {
                // here change the starting and ending icons
                return L.marker(wp.latLng, {
                    icon: greenIcon // here pass the custom marker icon instance
                });
            } else {
                // here change all the others
                return L.marker(wp.latLng, {
                    icon: redIcon
                });
            }
        }

    }).addTo(mymap);



    function rupiah(angka) {
        var reverse = angka.toString().split('').reverse().join(''),
            ribuan = reverse.match(/\d{1,3}/g);
        ribuan = ribuan.join('.').split('').reverse().join('');
        return ribuan;
    }
    routeControl.hide();
    var ongkir1 = 10000;
    var ongkir2 = 1500;
    var subtotal = document.getElementById("subtotal").value;
    var ongkir_5 = (ongkir1 + parseInt(subtotal));

    routeControl.on('routesfound', function(e) {
        var routes = e.routes;
        var summary = routes[0].summary;
        var jarak = (summary.totalDistance / 1000).toFixed(2);
        // alert distance and time in km and minutes
        document.getElementById("jarak").textContent = jarak + ' km';
        document.getElementById("jarak_input").value = jarak;
        coordinates = e.routes[0].coordinates;
        destination = coordinates[coordinates.length - 1];


        console.log(destination);
        if (jarak <= 5) {
            document.getElementById("ongkir").textContent = 'Rp. ' + rupiah(ongkir1);
            document.getElementById("ongkir_input").value = ongkir1;
            document.getElementById("total").textContent = 'Rp. ' + rupiah(ongkir_5);
            document.getElementById("total_input").value = ongkir_5;

        } else {
            var jarak_lebih = Math.ceil(jarak) - 5;
            ongkir_total = jarak_lebih * 1500;
            ongkir_semua = ongkir1 + ongkir_total;
            document.getElementById("ongkir").textContent = 'Rp. ' + rupiah(ongkir_semua);
            document.getElementById("ongkir_input").value = ongkir_semua;
            document.getElementById("total").textContent = 'Rp. ' + rupiah(ongkir_semua + parseInt(subtotal));
            document.getElementById("total_input").value = ongkir_semua + parseInt(subtotal);
        }
        document.getElementById("lat").value = destination;


    });
</script>

<?= $this->endSection(); ?>