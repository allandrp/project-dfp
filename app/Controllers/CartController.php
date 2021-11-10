<?php

namespace App\Controllers;

use App\Models\BarangModel;
use App\Models\CartModel;

class CartController extends BaseController
{
    protected $cartModel;
    protected $barangModel;

    public function __construct()
    {
        $cartModel = new CartModel();
        $barangModel = new BarangModel();
    }

    public function index()
    {
        // coba upload
        $session = session();

        // instansiasi Model
        $this->cartModel = new CartModel();
        $this->barangModel = new BarangModel();

        //mengambil data cart join dengan barang
        $cart = $this->cartModel->select('*')->join('barang', 'barang.id_barang = kart.id_barang')->where('kart.email', $session->get('email'))->findAll();

        // menagmbil data aggregat sum jumlah barang user (semua barang)
        $jumlah_barang = $this->cartModel->selectSum('jumlah_barang')->where('kart.email', $session->get('email'))->first();

        // mengambil data aggregat total harga user (semua barang)
        $total_harga = $this->cartModel->selectSum('total_harga')->where('kart.email', $session->get('email'))->first();

        $data['cart'] = $cart;
        $data['jumlah_barang'] = $jumlah_barang;
        $data['total_harga'] = $total_harga;

        return view('cart', $data);
    }



    // ajax untuk mengurangi barang
    public function ajaxminuscart()
    {
        $session = session();

        //instansiasi model
        $ModelCart = new CartModel();
        $ModelBarang = new BarangModel();

        // mengambil data id_barang yang dikirim
        $id_barang = $this->request->getVar('id_barang');

        // array untuk where
        $syarat = ['email' => $session->get('email'), 'id_barang' => $id_barang];

        // mengambil data cart dengan where pada variabel syarat
        $CartModel =  $ModelCart->where($syarat)->first();

        // mengambil data barang berdasarkan id yang dikirim
        $BarangModel =  $ModelBarang->find($id_barang);

        // melakukan cek apakah barang null atau tidak
        if ($CartModel['jumlah_barang'] == 1) {
            $ModelCart->delete(['id_kart', $CartModel['id_kart']]);
        } else {
            $update = ([
                'jumlah_barang' => $CartModel['jumlah_barang'] - 1,
                'total_harga' => ($CartModel['jumlah_barang'] - 1) * $BarangModel['harga']
            ]);
            $ModelCart->update($CartModel['id_kart'], $update);
        }

        // mengambil data jumlah barang keseluruhan user
        $jumlah_barang = $ModelCart->selectSum('jumlah_barang')->where('kart.email', $session->get('email'))->first();

        // mengambil data aggregat sum untuk jumlah barang (barang spesifik sesuai id)
        $jumlah_barang_satuan = $ModelCart->selectSum('jumlah_barang')->where($syarat)->first();

        // mengambil data total harga keseluruhan user
        $total_harga = $ModelCart->selectSum('total_harga')->where('kart.email', $session->get('email'))->first();

        $data = array();
        $data['jumlah_barang'] = $jumlah_barang['jumlah_barang'];
        $data['jumlah_barang_satuan'] = $jumlah_barang_satuan['jumlah_barang'];
        $data['total_harga'] = $total_harga['total_harga'];

        return json_encode($data);
    }

    public function ajaxpluscart()
    {
        $session = session();

        //instansiasi model
        $ModelCart = new CartModel();
        $ModelBarang = new BarangModel();

        // mengambil data id_barang yang dikirim
        $id_barang = $this->request->getVar('id_barang');

        // array untuk where
        $syarat = ['email' => $session->get('email'), 'id_barang' => $id_barang];

        // mengambil data cart dengan where pada variabel syarat
        $CartModel =  $ModelCart->where($syarat)->first();

        // mengambil data barang berdasarkan id yang dikirim
        $BarangModel =  $ModelBarang->find($id_barang);

        // melakukan cek apakah barang null atau tidak


        $update = ([
            'jumlah_barang' => $CartModel['jumlah_barang'] - 1,
            'total_harga' => ($CartModel['jumlah_barang'] - 1) * $BarangModel['harga']
        ]);

        $update = ([
            'jumlah_barang' => $CartModel['jumlah_barang'] + 1,
            'total_harga' => ($CartModel['jumlah_barang'] + 1) * $BarangModel['harga']
        ]);

        $ModelCart->update($CartModel['id_kart'], $update);

        // mengambil data jumlah barang keseluruhan user
        $jumlah_barang = $ModelCart->selectSum('jumlah_barang')->where('kart.email', $session->get('email'))->first();

        // mengambil data aggregat sum untuk jumlah barang (barang spesifik sesuai id)
        $jumlah_barang_satuan = $ModelCart->selectSum('jumlah_barang')->where($syarat)->first();

        // mengambil data total harga keseluruhan user
        $total_harga = $ModelCart->selectSum('total_harga')->where('kart.email', $session->get('email'))->first();

        $data = array();
        $data['jumlah_barang'] = $jumlah_barang['jumlah_barang'];
        $data['jumlah_barang_satuan'] = $jumlah_barang_satuan['jumlah_barang'];
        $data['total_harga'] = $total_harga['total_harga'];

        return json_encode($data);
    }
}
