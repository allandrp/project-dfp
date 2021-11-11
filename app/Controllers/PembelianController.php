<?php

namespace App\Controllers;

use App\Models\BarangModel;
use App\Models\CartModel;
use App\Models\DetailPembelianModel;
use App\Models\PembelianModel;
use App\Models\UserModel;

// Set your Merchant Server Key
\Midtrans\Config::$serverKey = 'SB-Mid-server-TrtH9rgau3tx06BkSe5WGNf1';
// Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
\Midtrans\Config::$isProduction = false;
// Set sanitization on (default)
\Midtrans\Config::$isSanitized = true;
// Set 3DS transaction for credit card to true
\Midtrans\Config::$is3ds = false;

class PembelianController extends BaseController
{
    public function __construct()
    {
    }

    public function index()
    {

        $session = session();
        if ($session->get('email') == null) {
            // dd($session->get('email'));
            return redirect()->to(base_url('LoginController/viewLogin'));
        }

        $ModelPembelian = new PembelianModel();
        $ModelDetail = new DetailPembelianModel();
        $ModelCart = new CartModel();

        $pembelian = $ModelPembelian->select('*')->where('email', $session->get('email'))->orderBy('tanggal_pembelian', 'DESC')->findAll();
        $ModelDetail = $ModelPembelian->select('*')->where('email', $session->get('email'))->findAll();
        $jumlah_barang = $ModelCart->selectSum('jumlah_barang')->where('kart.email', $session->get('email'))->first();

        foreach ($pembelian as $p) {
            $status = \Midtrans\Transaction::status($p['id_pembelian']);
            if ($p['status_pembelian'] != $status->transaction_status) {
                $update = ([
                    'status_pembelian' => $status->transaction_status
                ]);
                $ModelPembelian->update($p['id_pembelian'], $update);
            }
        }


        $data['pembelian'] = $pembelian;
        $data['jumlah_barang_cart'] = $jumlah_barang;
        // dd($jumlah_barang);

        // dd($pembelian);
        return view('history', $data);
        exit();
    }
}
