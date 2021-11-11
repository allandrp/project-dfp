<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailPembelianModel extends Model
{
    protected $table = 'detail_pembelian';
    protected $primaryKey = 'id_pembelian';
    protected $allowedFields = ['id_pembelian', 'nama_barang', 'jumlah_barang', 'harga'];
}
