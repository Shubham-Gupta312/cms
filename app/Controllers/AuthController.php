<?php

namespace App\Controllers;

use App\Libraries\PassHash;

class AuthController extends BaseController
{

    public function register()
    {
        if ($this->request->getMethod() == 'get') {
            return view('auth/register');
        } else if ($this->request->getMethod() == 'post') {
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            $data = [
                'email' => esc($email),
                'password' => PassHash::pass_enc($password)
            ];

            $adminModel = new \App\Models\AdminModel();
            try {
                $query = $adminModel->insert($data);

                if ($query) {
                    $response = ['status' => 'true', 'message' => 'Admin added Successfully!'];
                } else {
                    $response = ['status' => 'false', 'message' => 'Something went wrong!'];
                }
                return $this->response->setJSON($response);
            } catch (\Exception $e) {
                // Log the exception
                // log_message('error', 'Exception: ' . $e->getMessage());

                // Return error response with specific error message
                $message = ['status' => 'false', 'message' => 'An unexpected error occurred. Please try again later.'];
                return $this->response->setStatusCode(500)->setJSON($message);
            }
        }
    }
    public function login()
    {
        if ($this->request->getMethod() == 'get') {
            return view('auth/login');
        } else if ($this->request->getMethod() == 'post') {
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            $adminLogin = new \App\Models\AdminModel();
            $userData = $adminLogin->where('email', esc($email))->first();

            if (is_null($userData)) {
                $response = ['status' => 'false', 'message' => 'Email not found!'];
                return $this->response->setJSON($response);
            }

            $verifyPass = PassHash::pass_dec($password, $userData['password']);
            if (!$verifyPass) {
                $response = ['status' => 'false', 'message' => 'You Entered wrong Password!!'];
            } else {
                if (!is_null($userData)) {
                    $sessionData = [
                        'email' => $userData['email'],
                        'loggedin' => 'loggedin'
                    ];
                    session()->set($sessionData);
                }
                $response = ['status' => 'true', 'message' => 'LoggedIn!'];
            }
            return $this->response->setJSON($response);
        }
    }

    public function logout(){
        session_unset();
        session()->destroy();
        return redirect()->to(base_url('admin/login'));
    }
}
