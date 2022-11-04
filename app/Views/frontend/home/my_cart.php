<?= $this->extend('layout/template_depan'); ?>
<?= $this->section('konten_depan'); ?>
<!-- pages-title-start -->
<section class="contact-img-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="con-text">
                    <h2 class="page-title">Keranjang Saya</h2>
                    <p><a href="#">Home</a> | Keranjang Saya</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- pages-title-end -->
<!-- shopping-cart content section start -->
<div class="shopping-cart-area s-cart-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-xs-12">

                <div class="s-cart-all">
                    <div class="cart-form table-responsive">
                        <?php if (session()->getFlashdata('pesan')) : ?>
                            <div class="alert alert-info alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <strong><?= session()->getFlashdata('pesan'); ?></strong>
                            </div>
                        <?php endif; ?>
                        <table id="shopping-cart-table" class="data-table cart-table">
                            <tr>
                                <th class="low1">No</th>
                                <th class="low1">Nama Produk</th>
                                <th class="low7">QTY</th>
                                <th class="low7">Harga</th>
                                <th class="low7">Subtotal</th>
                                <th class="low7">Aksi</th>
                            </tr>
                            <?php if (empty($keranjang)) : ?>
                                <tr>
                                    <td colspan="6" class="low1">Keranjang belanja kosong</td>
                                </tr>
                                <br>
                                <br>
                            <?php else : ?>
                                <?php $total = 0; ?>
                                <?php $i = 1; ?>
                                <?php foreach ($keranjang as $key => $value) : ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td class="sop-cart an-shop-cart low1" style="align-content: center;">
                                            <a href="/frontend/home/produkDetail/<?= $value['id']; ?>"><img class="primary-image" style="width:80px;" alt="" src="<?= base_url('/assets/images/produk/' . $value['options']['foto_1']) ?>"></a>
                                            <br>
                                            <a href="/frontend/home/produkDetail/<?= $value['id']; ?>"><?= $value['name']; ?></a>
                                        </td>
                                        <td class="sop-cart an-sh">
                                            <div class="quantity ray">
                                                <input class="input-text qty text" type="number" size="4" title="Qty" value="<?= $value['qty']; ?>" min="0" step="1">
                                            </div>

                                        </td>
                                        <td class="sop-cart">
                                            <div class="tb-product-price font-noraure-3">
                                                <span class="amount"><?= rupiah($value['price']); ?></span>
                                            </div>
                                        </td>
                                        <td class="cen">
                                            <span class="amount"><?= rupiah($value['subtotal']); ?></span>
                                        </td>
                                        <td class="cen">
                                            <a href="/frontend/home/hapus_cart/<?= $value['rowid']; ?>" class="btn btn-danger">Hapus</a>
                                        </td>
                                    </tr>
                                    <?php $i++; ?>
                                    <?php $total += $value['subtotal']; ?>
                                <?php endforeach; ?>

                            <?php endif; ?>
                        </table>
                    </div>


                </div>
            </div>
        </div>
        <?php if (!empty($keranjang)) : ?>
            <div class="row">
                <div class="second-all-class">
                    <div class="col-md-7 col-sm-12 col-xs-12">

                    </div>
                    <div class="col-md-5 col-sm-12 col-xs-12">
                        <div class="sub-total">
                            <table>
                                <tbody>
                                    <tr class="col-xs-12 cart-subtotal">
                                        <th>Subtotal:</th>
                                        <td>
                                            <span class="amount"><?= rupiah($total); ?></span>
                                        </td>
                                    </tr>
                                    <tr class="col-xs-12 order-total">
                                        <th>Total:</th>
                                        <td>
                                            <strong>
                                                <span class="amount"><?= rupiah($total); ?></span>
                                            </strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="wc-proceed-to-checkout">
                            <p class="return-to-shop">
                                <a class="button wc-backward" href="/frontend/home/all_produk">Continue Shopping</a>
                            </p>
                            <a class="wc-forward" href="#">Confirm Order</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<!-- shopping-cart  content section end -->


<?= $this->include('layout/footer_depan'); ?>

<script>
    function rupiah(angka) {
        var reverse = angka.toString().split('').reverse().join(''),
            ribuan = reverse.match(/\d{1,3}/g);
        ribuan = ribuan.join('.').split('').reverse().join('');
        return ribuan;
    }
</script>
<?= $this->endSection(); ?>