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

<div class="ps-page--single" id="contact-us">
    <div class="ps-breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href=""><?= $menu; ?></a></li>
                <li><a href=""><?= $submenu; ?></a></li>
            </ul>
        </div>
    </div>
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-2 " id="maps">

    </div>
    <br>
    <div class="ps-contact-info">
        <div class="container">
            <div class="ps-section__header">
                <h3>Kontak</h3>
            </div>
            <div class="ps-section__content">
                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 ">
                        <div class="ps-block--contact-info">
                            <h4>Alamat Kantor 1</h4>
                            <p><a href="#"><span>Jalan Pembangunan No. 250, Desa Sukagalih,</span></a><span>Kec. Tarogong Kidul Kabupaten Garut, Jawa Barat 44151.</span></p>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 ">
                        <div class="ps-block--contact-info">
                            <h4>Alamat Kantor 2</h4>
                            <p><a href="#"><span>Jalan Merdeka No. 250,</span></a><span>Kec. Tarogong Kidul Kabupaten Garut, Jawa Barat 44151.</span></p>
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 ">
                        <div class="ps-block--contact-info">
                            <h4>Kontak</h4>
                            <p><span></span><a href="#"><span>0821-1747-4002</span></a></p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="ps-contact-form">
        <div class="container">
            <form class="ps-form--contact-us" action="#" method="get">
                <h3>Hubungi Kami</h3>
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ">
                        <div class="form-group">
                            <input class="form-control" type="text" placeholder="Name *">
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ">
                        <div class="form-group">
                            <input class="form-control" type="text" placeholder="Email *">
                        </div>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                        <div class="form-group">
                            <input class="form-control" type="text" placeholder="Subject *">
                        </div>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                        <div class="form-group">
                            <textarea class="form-control" rows="5" placeholder="Message"></textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group submit">
                    <button class="ps-btn">Send message</button>
                </div>
            </form>
        </div>
    </div>
</div>

<br>


<?= $this->include('layout/footer_new2'); ?>


<script>
    var mymap = L.map('maps').setView([-7.201257, 107.887293], 16);
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
    popup1.setContent('<strong>KitaGarut.com</strong> ');

    var popup2 = new L.Popup({
        'autoClose': false
    });
    popup2.setLatLng([-7.219610, 107.897353]);
    popup2.setContent('Tentukan tujuan pengiriman ');

    L.marker([-7.201257, 107.887293]).addTo(mymap)
        .bindPopup(popup1).openPopup();
</script>

<?= $this->endSection(); ?>