<?php

namespace App\Controllers;

use App\Models\BarangModel;
use App\Models\CartModel;
use App\Models\UserModel;

class KategoriController extends BaseController
{

    public function __construct()
    {
    }

    public function index()
    {
        $session = session();
        $ModelBarang = new BarangModel();
        $ModelCart = new CartModel();
        $kategori = $this->request->getVar('kategori');
        $Barang = $ModelBarang->where('kategori', $kategori)->findAll();
        // dd($Barang);

        $cart = $ModelCart->Where('email', $session->get('email'))->findAll();
        $jumlah_barang = 0;
        foreach ($cart as $c) {
            $jumlah_barang = $jumlah_barang + $c['jumlah_barang'];
        }

        $data['jumlah_barang'] = $jumlah_barang;
        $data['barang'] = $Barang;
        $data['kategori'] = $kategori;
        return view('kategori', $data);
    }
}
