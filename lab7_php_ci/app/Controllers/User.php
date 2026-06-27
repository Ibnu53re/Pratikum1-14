<?php
namespace App\Controllers;
use App\Models\UserModel;

class User extends BaseController
{
    public function login()
    {
        helper(['form']);
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        if (!$email) {
            return view('user/login');
        }

        $session = session();
        $model = new UserModel();
        $user = $model->where('useremail', $email)->first();

        if ($user) {
            if (password_verify($password, $user['userpassword'])) {
                $session->set([
                    'user_id'    => $user['id'],
                    'user_name'  => $user['username'],
                    'user_email' => $user['useremail'],
                    'logged_in'  => true
                ]);
                return redirect()->to('/admin/artikel');
            } else {
                $session->setFlashdata('flash_msg', 'Password salah.');
            }
        } else {
            $session->setFlashdata('flash_msg', 'Email tidak terdaftar.');
        }
        return redirect()->to('/user/login');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/user/login');
    }
}