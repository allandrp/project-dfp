<?php

namespace App\Controllers;

use App\Models\BarangModel;
use App\Models\CartModel;
use App\Models\UserModel;

class LoginController extends BaseController
{
    public function __construct()
    {
    }

    public function viewLogin()
    {
        $session = session();
        if ($session->get('email')) {
            // dd($session->get('email'));
            return redirect()->to(base_url('HomeController/index'));
        }
        return view('login');
        exit();
    }

    public function login()
    {
        $session = session();
        $model = new UserModel();
        $email = $this->request->getVar('inputemail');
        $password = $this->request->getVar('inputpassword');
        $data = $model->where('email', $email)->first();
        if ($data) {
            $pass = $data['password'];
            $verify_pass = password_verify($password, $pass);
            if ($verify_pass) {
                $ses_data = [
                    'email'       => $data['email'],
                    'nama'     => $data['nama'],
                    'alamat'    => $data['alamat'],
                    'logged_in'     => TRUE
                ];
                $session->set($ses_data);
                return redirect()->to('HomeController/index');
            } else {
                $session->setFlashdata('msg', 'Wrong Password');
                return view('login');
            }
        } else {
            return view('login');
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('LoginController/viewLogin');
        exit();
    }
}
