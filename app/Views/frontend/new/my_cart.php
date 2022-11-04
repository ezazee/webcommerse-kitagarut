<?= $this->extend('layout/template_new'); ?>

<?= $this->section('head'); ?>
<script src="<?= base_url('leaflet/leaflet.js'); ?>"></script>
<link rel="stylesheet" href="<?= base_url('leaflet/leaflet.css'); ?>" />
<link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
<script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
<style>
    #maps {
        height: 500px;
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
            <h2>Keranjang Belanja</h2>
        </div>
        <div class="ps-section__content">
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong><?= session()->getFlashdata('pesan'); ?></strong>
                </div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('success')) : ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong><?= session()->getFlashdata('success'); ?></strong>
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
                                    <td>
                                        <div class="ps-product--cart">
                                            <div class="ps-product__thumbnail"><a href="/produk/detail-produk/<?= $value['options']['slug']; ?>"><img src="<?= base_url('/assets/images/produk/' . $value['options']['foto_1']) ?>" alt=""></a></div>
                                            <div class="ps-product__content"><a href="/produk/detail-produk/<?= $value['options']['slug']; ?>"><?= $value['name']; ?></a>
                                                <p><?= rupiah($value['price']); ?> x <?= $value['qty']; ?><strong> = <?= rupiah($value['subtotal']); ?></strong></p>

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
            <div class="ps-section__cart-actions"><a class="ps-btn" href="/frontend/new_home/all_produk"><i class="icon-arrow-left"></i> Kembali Belanja</a><a class="ps-btn ps-btn--outline" href="/frontend/checkout"><i class="icon-sync"></i> Checkout </a></div>
        </div>

    </div>
</div>

<br>


<?= $this->include('layout/footer_new2'); ?>


<script>
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
    popup1.setLatLng([-7.201257, 107.887293]);
    popup1.setContent('KitaGarut.com <br> Lokasi Pengiriman');

    var popup2 = new L.Popup({
        'autoClose': false
    });
    popup2.setLatLng([-7.219610, 107.897353]);
    popup2.setContent('Tentukan tujuan pengiriman ');

    L.marker([-7.201257, 107.887293]).addTo(mymap)
        .bindPopup(popup1).openPopup();


    var routeControl = L.Routing.control({
        waypoints: [
            L.latLng(-7.201257, 107.887293),
            L.latLng(-7.219610, 107.897353),
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

        routeWhileDragging: false,

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