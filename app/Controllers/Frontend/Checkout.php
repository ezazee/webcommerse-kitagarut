<?php

namespace App\Controllers\Frontend;

use App\Models\FrontModel;
use App\Models\AkunModel;

class Checkout extends BaseController
{
    protected $helper = [];
    private $url = "https://api.rajaongkir.com/starter/";
    private $apiKey = "3024cc07e417958b2b4e265b57a3f515";

    public function __construct()
    {
        helper(['form']);
        helper(['Tanggal']);
        $this->cek_login();
        $this->Front_mod = new FrontModel();
        $this->Akun_mod = new AkunModel();
        ini_set('max_execution_time', 300);
    }

    public function index()

    {
        if ($this->user_aktif() != null) {
            $builder = $this->user_aktif();
        } else {
            return redirect()->to(base_url('/frontend/new_home/login'))->with('gagal', 'Untuk melakukan Pemesanan Anda harus Login ! <br> Jika Anda belum mempunyai akun KitaGarut Silahkan Daftar terlebih dahulu .');
        }

        $cart = \Config\Services::cart();
        $id_pel = $builder['id_pel'];
        $pelanggan = $this->Akun_mod->getPelanggan($id_pel)->get()->getRowArray();
        $keranjang = $cart->contents();

        $data = [
            'judul' => 'Keranjang Belanja',
            'menu' => 'KitaGarut',
            'submenu' => 'Keranjang Belanja',
            'keranjang' => $keranjang,
            'kategori' => $this->Front_mod->getKategori()->get()->getResultArray(),
            'user' => $builder,
            'pelanggan' => $pelanggan,
            'cart' => \Config\Services::cart()
        ];

        return view('frontend/checkout/index', $data);
    }

    function ambil_alamat_merchant($id_merchant)
    {
        $this->Akun_mod->getAlamatMerchant($id_merchant)->get()->getRowArray();
    }

    function rajaongkir($method, $id_province = null)
    {
        $endPoint = $this->url . $method;

        if ($id_province != null) {
            $endPoint = $endPoint . "?province" . $id_province;
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $endPoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: " . $this->apiKey
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo $response;
        }
    }

    public function getCost()
    {
        $origin = $this->request->getGET('origin');
        $destination = $this->request->getGET('destination');
        $weight = $this->request->getGET('weight');
        $courier = $this->request->getGET('courier');
        $data = $this->rajaongkircost($origin, $destination, $weight, $courier);

        return $this->response->setJSON($data);
    }

    public function rajaongkircost($origin, $destination, $weight, $courier)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "origin=" . $origin . "&destination=" . $destination . "&weight=" . $weight . "&courier=" . $courier,
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded",
                "key: " . $this->apiKey,
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        return $response;
    }

    public function simpan_penjualan()
    {
        $keranjang = \Config\Services::cart();

        if ($this->user_aktif() != null) {
            $builder = $this->user_aktif();
        } else {
            return redirect()->to(base_url('/frontend/new_home/login'))->with('gagal', 'Untuk melakukan Pemesanan Anda harus Login ! <br> Jika Anda belum mempunyai akun KitaGarut Silahkan Daftar terlebih dahulu .');
        }
        $ongkir_input = $this->request->getPost('ongkir_input');
        $metode_bayar = 'Transfer';
        $total_belanja_ongkir = $this->request->getPost('total_input');
        $estimasi_input = $this->request->getPost('estimasi_input');
        $kurir_input = $this->request->getPost('kurir_input');
        $ekspedisi_input = $this->request->getPost('ekspedisi_input');
        $berat = $this->request->getPost('berat');
        $total_belanja = $this->request->getPost('subtotal');
        $no_trans = $this->Front_mod->get_no_invoice();
        $tgl = date("Y-m-d H:i:s");
        $nama_pelanggan = $builder['nama_pel'];
        $id = $builder['id_pel'];
        $pelanggan = $this->Akun_mod->getPelanggan($id)->get()->getRowArray();

        $kota = $pelanggan['nama_kab'];
        $kecamatan = $pelanggan['nama_kec'];
        $alamat_pelanggan = $builder['alamat_pel'];

        $data = [
            'estimasi'             =>    $estimasi_input,
            'kurir'             =>    $kurir_input,
            'ekspedisi'             =>    $ekspedisi_input,
            'berat'             =>    $berat,
            'metode_bayar'             =>    $metode_bayar,
            'no_trans'             =>    $no_trans,
            'tgl_trans'             =>    date("Y-m-d"),
            'ongkir_trans'             =>    $ongkir_input,
            'total_belanja_ongkir'             =>    $total_belanja_ongkir,
            'total_belanja'             =>    $total_belanja,
            'id_pelanggan_trans'             =>    $builder['id_pel'],
            'status_bayar'             =>    0,
            'status_trans'             =>    0,
            'date_created'          => $tgl,
        ];
        $this->Front_mod->simpan_transaksi($data);

        if ($cart = $keranjang->contents()) :
            foreach ($cart as $key => $value) :
                $data2 = [
                    'no_trns'             =>    $no_trans,
                    'id_prod_trns'             =>    $value['id'],
                    'nama_produk_trns'             =>    $value['name'],
                    'qty_trns'             =>    $value['qty'],
                    'harga_jual'             =>    $value['price'],
                    'subtotal'             =>    $value['subtotal'],
                    'nama_merchant'             =>    $value['options']['nama_merchant'],
                    'harga_modal'             =>    $value['options']['harga_produk'],
                ];
                $this->Front_mod->simpan_detail_transaksi($data2);
            endforeach;
        endif;

        $keranjang->destroy();

        $this->sendMessage($tgl, $no_trans, $nama_pelanggan, $ongkir_input, $total_belanja, $total_belanja_ongkir, $metode_bayar, $alamat_pelanggan, $ekspedisi_input, $estimasi_input, $kota, $kecamatan, $kurir_input);

        return redirect()->to(base_url('/frontend/my_profile/pesananku'))->with('success', 'Checkout Berhasil, Silahkan lakukan Pembayaran ');
    }

    function sendMessage($tgl, $no_trans, $nama_pelanggan, $ongkir_input, $total_belanja, $total_belanja_ongkir, $metode_bayar, $alamat_pelanggan, $ekspedisi_input, $estimasi_input, $kota, $kecamatan, $kurir_input)
    {
        $telegram_id = '-1001453263810';
        $message_text = 'Waktu : ' . $tgl . ' ' . "\n" . 'No. Transaksi : * ' . $no_trans . ' ' . "*\n" . 'Nama Pelanggan  : *' . $nama_pelanggan . ' ' . "*\n" . 'Total Pembelian : *' . rupiah($total_belanja) . ' ' . "*\n" . 'Ongkir : *' . rupiah($ongkir_input) . ' ' . "*\n" . 'Total Pembayaran : *' . rupiah($total_belanja_ongkir) . ' ' . "*\n" . 'Metode Pembayaran : *' . $metode_bayar . ' ' . "*\n" . 'Alamat Pengiriman : *' . $alamat_pelanggan . ', *' . $kota . ', *' . $kecamatan . '' . "*\n" . 'Ekspedisi : *' . $ekspedisi_input . '' . "*\n" . 'Servis : *' . $kurir_input . '' . "*\n" . 'Estimasi : *' . $estimasi_input . '' . "*\n" . 'Status  : *menunggu pembayaran' . "*\n\n\n*>>>* _Laporan Transaksi KitaGarut_ *<<<*" . '';

        /*--------------------------------
        Isi TOKEN dibawah ini: 
        --------------------------------*/
        $secret_token = "1288932506:AAFR58Evq7KXOFI78leAV0rbPuR4zlRpJus";

        $url = "https://api.telegram.org/bot" . $secret_token . "/sendMessage?parse_mode=markdown&chat_id=" . $telegram_id;
        $url = $url . "&text=" . urlencode($message_text);
        $ch = curl_init();
        $optArray = array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true
        );
        curl_setopt_array($ch, $optArray);
        $result = curl_exec($ch);
        curl_close($ch);
    }
}
