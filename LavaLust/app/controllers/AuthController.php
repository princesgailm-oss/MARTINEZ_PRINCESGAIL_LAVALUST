
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

    /*
    |--------------------------------------------------------------------------
    | LOGIN
    |--------------------------------------------------------------------------
    */

    public function login()
    {
        if ($this->io->method() == 'post') {

            $username = $this->io->post('username');
            $password = $this->io->post('password');

            if ($username === 'admin' && $password === 'password123') {

                $this->session->set_userdata([
                    'logged_in' => true,
                    'username'  => $username
                ]);

                redirect(site_url('products'));
                return;

            } else {

                $data['error'] = 'Invalid username or password';

                $this->call->view('login', $data);
                return;
            }
        }

        $this->call->view('login');
    }


    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */

    public function logout()
    {
        $this->session->sess_destroy();

        redirect(site_url('login'));
        return;
    }
}
?>

