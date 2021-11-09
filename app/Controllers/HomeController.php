<?php

namespace App\Controllers;

use App\Models\BarangModel;
use App\Models\CartModel;
use App\Models\UserModel;
use CodeIgniter\Session\Session;

class HomeController extends BaseController
{

    protected $barangModel;
    protected $cartModel;

    public function __construct()
    {
    }

    public function index()
    {
        $session = session();
        if ($session->get('email') === null) {
            return view('login');
            exit();
        }

        $barangModel = new BarangModel();
        $cartModel = new CartModel();
        $barang = $barangModel->findAll();
        $cart = $cartModel->Where('email', $session->get('email'))->findAll();
        $jumlah_barang = 0;
        foreach ($cart as $c) {
            $jumlah_barang = $jumlah_barang + $c['jumlah_barang'];
        }
        $data['barang'] = $barang;
        $data['jumlah_barang'] = $jumlah_barang;
        return view('home', $data);
    }

    public function ajaxtambahcart()
    {
        $session = session();
        $ModelCart = new CartModel();
        $ModelBarang = new BarangModel();
        $id_barang = $this->request->getVar('id_barang');
        // dd($id_barang);
        $syarat = ['email' => $session->get('email'), 'id_barang' => $id_barang];
        $CartModel =  $ModelCart->where($syarat)->first();
        // dd($CartModel);
        $BarangModel =  $ModelBarang->find($id_barang);
        // dd($id_barang);

        if ($CartModel) {
            $update = ([
                'jumlah_barang' => $CartModel['jumlah_barang'] + 1,
                'total_harga' => ($CartModel['jumlah_barang'] + 1) * $BarangModel['harga']
            ]);
            $ModelCart->update($CartModel['id_kart'], $update);
            $jumlah_barang = $ModelCart->selectSum('jumlah_barang')->where('kart.email', $session->get('email'))->first();
            echo $jumlah_barang['jumlah_barang'];
        } else {

            $ModelCart->insert([
                'id_barang' => $id_barang,
                'email' => $session->get('email'),
                'jumlah_barang' => 1,
                'total_harga' => $BarangModel['harga']
            ]);
            $jumlah_barang = $ModelCart->selectSum('jumlah_barang')->where('kart.email', $session->get('email'))->first();
            echo $jumlah_barang['jumlah_barang'];
        }
    }
}
