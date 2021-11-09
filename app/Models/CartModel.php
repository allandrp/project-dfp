<?php

namespace App\Models;

use CodeIgniter\Model;

class CartModel extends Model
{
    protected $table = 'kart';
    protected $primaryKey = 'id_kart';
    protected $allowedFields = ['id_kart', 'id_barang', 'email', 'jumlah_barang', 'total_harga'];

    public function ambildata()
    {
        return $this->findAll();
    }
}
