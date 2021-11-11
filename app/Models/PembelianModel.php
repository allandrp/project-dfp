<?php

namespace App\Models;

use CodeIgniter\Model;

class PembelianModel extends Model
{
    protected $table = 'pembelian';
    protected $primaryKey = 'id_pembelian';
    protected $allowedFields = ['id_pembelian', 'email', 'tanggal_pembelian', 'jumlah_barang', 'status_pembelian', 'total_pembelian'];
}
