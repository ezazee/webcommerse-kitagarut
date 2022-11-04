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
                                            <?php $berat = 0; ?>
                                            <?php $total = 0; ?>
                                            <?php $i = 1; ?>
                                            <?php foreach ($keranjang as $key => $value) : ?>
                                                <tr>
                                                    <td class="text-center" colspan="5"> Merchant : <strong> <?= $value['options']['nama_merchant']; ?></strong></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="ps-product--cart">
                                                            <div class="ps-product__thumbnail"><a href="/produk/detail-produk/<?= $value['options']['slug']; ?>"><img src="<?= base_url('/assets/images/produk/' . $value['options']['foto_1']) ?>" alt=""></a></div>
                                                            <div class="ps-product__content">
                                                                <a href="/produk/detail-produk/<?= $value['options']['slug']; ?>"><?= $value['name']; ?>
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
                                                <?php $berat = $value['options']['berat_produk'] * $value['qty']; ?>
                                                <?php $id_merchant = $value['options']['id_merchant'] * $value['qty']; ?>
                                            <?php endforeach; ?>

                                        <?php endif; ?>

                                    </tbody>
                                </table>
                            </div>
                            <br><br>

                            <?php if (in_array($user['kecamatan'], array(0, '', null))) : ?>
                                <div class="alert alert-danger" role="alert">
                                    <h4 class="alert-heading">Alamatmu Belum di isi kak .</h4>
                                    <hr>
                                    <p>Mohon Lengkapi dulu Alamat pada menu Profile, klik <a class="text-primary" href="/frontend/my_profile">disini !</a></p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ps-section__footer" data-select2-id="6">
                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 ">
                        <form action="/frontend/checkout/simpan_penjualan" method="post">
                            <div class="ps-block--shopping-total">
                                <div class="ps-block__header">
                                    <h3>Alamat Pengiriman <span></span></h3>
                                    <input type="hidden" id="subtotal" name="subtotal" value="<?= $total; ?>">
                                </div>
                                <div class="ps-block__header">
                                    <p for="latitude"><?= $user['alamat_pel']; ?> <span></span></p>
                                </div>
                                <div class="ps-block__header">
                                    <p>Provinsi : <span><?= $pelanggan['nama_prov']; ?></span></p>
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
                            <?php if (in_array($user['kecamatan'], array(0, '', null))) : ?>
                                <div class="form-group">
                                    <select id="kurir" name="kurir" class="form-control" disabled>
                                        <option value="">alamat belum di isi</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select id="servis" name="servis" class="form-control" disabled>
                                        <option value="">alamat belum di isi</option>
                                    </select>
                                </div>
                            <?php else : ?>

                                <div class="form-group">
                                    <select id="kurir" name="kurir" class="form-control">
                                        <option value=""></option>
                                        <option value="jne">JNE</option>
                                        <option value="pos">POS Indonesia</option>
                                        <option value="tiki">TIKI</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select id="servis" name="servis" class="form-control">
                                        <option value=""></option>
                                    </select>
                                </div>
                            <?php endif; ?>


                        </figure>
                        <img src="<?= base_url(); ?>/assets/loading.gif" width="25" id="load1" style="display:none;" />
                    </div>

                    <?php if (session()->getFlashdata('gagal')) : ?>
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong><?= session()->getFlashdata('gagal'); ?></strong>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($keranjang)) : ?>
                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 ">
                            <form action="/frontend/checkout/simpan_penjualan" method="post">
                                <div class="ps-block--shopping-total">

                                    <input type="hidden" id="ongkir_input" name="ongkir_input">
                                    <input type="hidden" id="estimasi_input" name="estimasi_input">
                                    <input type="hidden" id="total_input" name="total_input">
                                    <input type="hidden" id="kurir_input" name="kurir_input">
                                    <input type="hidden" id="ekspedisi_input" name="ekspedisi_input">
                                    <input type="hidden" id="berat" name="berat" value="<?= $berat; ?>">
                                    <div class="ps-block__header">
                                        <p>Subtotal <span> <?= rupiah($total); ?></span></p>
                                        <input type="hidden" id="subtotal" name="subtotal" value="<?= $total; ?>">
                                    </div>
                                    <?php $ongkir = '15000'; ?>
                                    <div class="ps-block__header">
                                        <p>Berat:<span><?= $berat; ?> Gr</span></p>
                                    </div>
                                    <?php if (in_array($user['kecamatan'], array(0, '', null))) : ?>
                                        <div class="ps-block__header">
                                            <p>Ongkir:<span id="ongkir">Lengkapi Alamat Dulu</span></p>
                                        </div>
                                        <div class="ps-block__header">
                                            <p>Estimasi:<span id="estimasi">Lengkapi Alamat Dulu</span></p>
                                        </div>
                                        <div class="ps-block__content">
                                            <h3>Total <span id="total">Lengkapi Alamat</span></h3>
                                        </div>
                                    <?php else : ?>
                                        <div class="ps-block__header">
                                            <p>Ongkir:<span id="ongkir">Pilih Ekspedisi</span></p>
                                        </div>
                                        <div class="ps-block__header">
                                            <p>Estimasi:<span id="estimasi">Pilih Ekspedisi</span></p>
                                        </div>
                                        <div class="ps-block__content">
                                            <h3>Total <span id="total">Pilih Ekspedisi</span></h3>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <?php if ($user['kota'] == 126) : ?>
                                    <div class="alert alert-info" role="alert">
                                        <p>Lokasi Anda mendukung pengiriman sameday dengan kurir Carlos, klik tombol Hubungi Admin dibawah, untuk melakukan pengiriman di hari yang sama </p>
                                    </div>
                                    <a href="https://wa.me/6289623624255?text=*>>>* _KitaGarut_ *<<<*%0A%0AOngkir%20pengiriman%20produk%20ini%20ke%20alamat%20saya,%20 berapa%20ya%20kak%20?%0ANama Produk : <?= $value['name']; ?>%20%0AHarga : <?= rupiah($value['price']); ?>%0AAlamat Pengiriman : <?= $user['alamat_pel']; ?>%0A%0AKitaGarut.com%20" class="ps-btn ps-btn--fullwidth" target="_blank" style="background-color: green;"><i class="fa fa-whatsapp" aria-hidden="true"></i> Hubungi Admin</a>
                                    <br> <br>
                                <?php endif; ?>
                                <?php if (in_array($user['kecamatan'], array(0, '', null))) : ?>
                                    <a href="/frontend/my_profile" class="ps-btn ps-btn--fullwidth" style="background-color: green;">Lengkapi Alamat</a>
                                    <br> <br>
                                    <button id="submit" type="submit" class="ps-btn ps-btn--fullwidth" style="cursor: not-allowed;
                                background-color: rgb(229, 229, 229) !important;pointer-events:none;">Checkout</button>
                                <?php else : ?>
                                    <button id="submit" type="submit" class="ps-btn ps-btn--fullwidth">Checkout</button>
                                <?php endif; ?>
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

    function rupiah(angka) {
        var reverse = angka.toString().split('').reverse().join(''),
            ribuan = reverse.match(/\d{1,3}/g);
        ribuan = ribuan.join('.').split('').reverse().join('');
        return ribuan;
    }

    $('document').ready(function() {
        $('#kurir').select2({
            placeholder: 'Pilih Ekspedisi',
        });
        $('#sameday').select2({
            placeholder: 'Pilih Waktu Pengiriman',
        });
        $('#servis').select2({
            placeholder: 'Pilih Ekspedisi Dulu',
        });
        $('#servis').on('change', function() {
            $("img#load1").show();

            var estimasi = $('option:selected', this).attr('etd');
            var servis = $('option:selected', this).attr('servis');
            var ekspedisi = $('option:selected', this).attr('kurir');
            var total = <?= $total; ?>;
            ongkir = parseInt($(this).val());
            $("#ongkir").html("Rp. " + rupiah(ongkir));
            $("#ongkir_input").val(ongkir);
            $("#estimasi").html(estimasi + " Hari");
            $("#estimasi_input").val(estimasi + " Hari");
            var total_harga = total + ongkir;
            $("#total").html("Rp. " + rupiah(total_harga));
            $("#total_input").val(total_harga);
            $("#kurir_input").val(servis);

            $("img#load1").hide();

        })
    });

    $("#kurir").on('change', function() {
        $("img#load1").show();
        var kurir = $(this).val();
        var origin = 126;
        var berat = <?= $berat; ?>;
        var destination = <?= $pelanggan['kota']; ?>;
        console.log(destination);
        $.ajax({
            url: "<?= site_url('frontend/checkout/getcost'); ?>",
            type: "GET",
            data: {
                'origin': origin,
                'destination': destination,
                'weight': berat,
                'courier': kurir
            },
            datatType: 'json',
            success: function(data) {
                var results = data["rajaongkir"]["results"][0]["costs"];
                var ekspedisi = data["rajaongkir"]["results"][0]["code"];
                var servis = data["rajaongkir"]["results"][0]["costs"]["service"];

                $('select[name="servis"]').empty();
                var html = '<option>Pilih Servis</option>';
                for (var i = 0; i < results.length; i++) {
                    var text = results[i]["description"] + "(" + results[i]["service"] + ")";

                    html += '<option value=' + results[i]["cost"][0]["value"] + ' etd=' + results[i]["cost"][0]["etd"] + ' servis=' + results[i]["service"] + '>' + text + '</option>';
                    console.log(html);
                    $('#servis').html(html);

                    $("#ekspedisi_input").val(ekspedisi);
                    $("img#load1").hide();
                }
            },
        });
    });
</script>

<?= $this->endSection(); ?>