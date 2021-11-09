<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'email';
    protected $allowedFields = ['password', 'email', 'alamat', 'nama'];

    public function ambildata()
    {
        return $this->findAll();
    }
}
