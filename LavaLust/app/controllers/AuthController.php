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
        $this->call->view('auth/login');
    }

    public function authenticate()
    {
        $input = json_decode(trim(file_get_contents('php://input')), true);
        
        $username = $input['username'] ?? $this->io->post('username');
        $password = $input['password'] ?? $this->io->post('password');

        $user = $this->UserModel->get_user($username);

        // Sinusuri kung tama ang password (sumusuporta sa naka-hash o plain text)
        $isPasswordValid = false;
        if ($user) {
            // Kung naka-hash ang password sa database
            if (!empty($user['password']) && password_get_info($user['password'])['algo'] !== 0) {
                $isPasswordValid = password_verify($password, $user['password']);
            } else {
                // Kung plain text ang password sa database
                $isPasswordValid = ($user['password'] === $password);
            }
        }

        if ($user && $isPasswordValid) {
            $token = bin2hex(random_bytes(32));

            $this->session->set_userdata([
                'user_id' => $user['id'],
                'username' => $user['username'],
                'logged_in' => TRUE,
                'token' => $token
            ]);

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
        
        header('Content-Type: application/json');
        echo json_encode([
            'status' => true,
            'message' => 'Logged out successfully'
        ]);
        exit();
    }
}

