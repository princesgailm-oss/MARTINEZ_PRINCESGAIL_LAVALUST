<?php

defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AuthController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        // Session
        $this->call->library('session');

        // URL helper
        $this->call->helper('url');
    }

    /*
    |--------------------------------------------------------------------------
    | LOGIN
    |--------------------------------------------------------------------------
    */

    public function login()
    {
        // If form was submitted
        if ($this->io->method() === 'post') {

            $username = trim($this->io->post('username'));
            $password = $this->io->post('password');

            /*
            |--------------------------------------------------------------------------
            | CHECK LOGIN
            |--------------------------------------------------------------------------
            */

            if ($username === 'admin' && $password === 'password123') {

                // Save login session
                $this->session->set_userdata([
                    'logged_in' => true,
                    'username'  => $username
                ]);

                /*
                |--------------------------------------------------------------------------
                | REDIRECT TO PRODUCTS
                |--------------------------------------------------------------------------
                */

                header('Location: ' . site_url('products'));
                exit;

            }

            /*
            |--------------------------------------------------------------------------
            | INVALID LOGIN
            |--------------------------------------------------------------------------
            */

            $data = [
                'error' => 'Invalid username or password.'
            ];

            $this->call->view('login', $data);
            return;
        }

        /*
        |--------------------------------------------------------------------------
        | SHOW LOGIN PAGE
        |--------------------------------------------------------------------------
        */

        $this->call->view('login');
    }


    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */

    public function logout()
    {
        // Destroy session
        $this->session->sess_destroy();

        // Return to login
        header('Location: ' . site_url('login'));
        exit;
    }
}
?>
