<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AuthController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        
        // --- CORS HEADERS & OPTIONS PREFLIGHT CHECK ---
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Authorization");

        // Kung OPTIONS request, tapusin agad para sa preflight check
        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            http_response_code(200);
            exit();
        }
        // ----------------------------------------------

        $this->call->library('session');
        $this->call->model('UserModel');
        $this->call->helper('url');
    }

    public function login()
    {
        // Para sa web view kung meron man
        $this->call->view('auth/login');
    }

    public function authenticate()
    {
        // Kung galing sa React frontend (JSON request), kunin ang input gamit ang file_get_contents o io->post
        $input = json_decode(trim(file_get_contents('php://input')), true);
        
        $username = $input['username'] ?? $this->io->post('username');
        $password = $input['password'] ?? $this->io->post('password');

        $user = $this->UserModel->get_user($username);

        if ($user && $user['password'] === $password) {
            // Gumawa ng token para sa API / React authentication
            $token = bin2hex(random_bytes(32));

            // I-save din sa session para kung may web view ka pa ring ginagamit
            $this->session->set_userdata([
                'user_id' => $user['id'],
                'username' => $user['username'],
                'logged_in' => TRUE,
                'token' => $token
            ]);

            // Kung galing sa React/API ang request, mag-return ng JSON response kasama ang token
            header('Content-Type: application/json');
            echo json_encode([
                'status' => true,
                'message' => 'Login successful',
                'token' => $token,
                'user' => [
                    'id' => $user['id'],
                    'username' => $user['username']
                ]
            ]);
            exit();
        } else {
            // Kung nag-fail, mag-return ng 401 Unauthorized JSON response para sa React
            header('HTTP/1.1 401 Unauthorized');
            header('Content-Type: application/json');
            echo json_encode([
                'status' => false,
                'message' => 'Invalid username or password'
            ]);
            exit();
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        
        // Response para sa API logout
        header('Content-Type: application/json');
        echo json_encode([
            'status' => true,
            'message' => 'Logged out successfully'
        ]);
        exit();
    }
}