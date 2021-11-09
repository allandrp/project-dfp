<?php

namespace App\Controllers;

use App\Models\BarangModel;
use App\Models\CartModel;
use App\Models\UserModel;

class RegisterController extends BaseController
{

    public function __construct()
    {
    }

    public function register()
    {
        $session = session();
        if ($session->get('email')) {
            return base_url('HomeController/index');
            exit();
        }

        $rules = [
            'inputnama'          => 'required',
            'inputemail'         => 'valid_email|is_unique[user.email]',
            'inputpassword'      => 'required|min_length[6]|max_length[200]',
            'inputalamat'  => 'required'
        ];

        if ($this->validate($rules)) {
            $model = new UserModel();
            $data = [
                'nama'     => $this->request->getVar('inputnama'),
                'email'    => $this->request->getVar('inputemail'),
                'password' => password_hash($this->request->getVar('inputpassword'), PASSWORD_DEFAULT),
                'alamat' => $this->request->getVar('inputalamat')
            ];

            $model->insert($data);
            return view('login');
        } else {
            return view('login');
        }
    }

    public function viewRegister()
    {
        return view('register');
    }
}
