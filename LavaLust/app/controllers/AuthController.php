<?php

defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AuthController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->call->library('session');
        $this->call->helper('url');
    }

    public function login()
    {
        if ($this->io->method() === 'post') {

            $username = trim($this->io->post('username'));
            $password = $this->io->post('password');

            // Check username and password
            if ($username === 'admin' && $password === 'password123') {

                // Save login session
                $this->session->set_userdata([
                    'logged_in' => true,
                    'username'  => $username
                ]);

                // CORRECTION: Direct path lang ang ilagay sa redirect(), huwag site_url()
                redirect('products');
                return;
            }

            // Invalid login
            $data = [
                'error' => 'Invalid username or password.'
            ];

            $this->call->view('login', $data);
            return;
        }

        // Show login page
        $this->call->view('login');
    }

    public function logout()
    {
        $this->session->sess_destroy();

        // CORRECTION: Direct path lang din dito
        redirect('login');
        return;
    }
}
?>