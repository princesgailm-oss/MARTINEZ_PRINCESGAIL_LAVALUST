<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AuthController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        // --- LOAD DATABASE ---
        $this->call->database();

        // --- LOAD SESSION ---
        $this->call->library('session');

        // --- LOAD URL HELPER ---
        $this->call->helper('url');

        // --- CORS HEADERS ---
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Authorization");

        // --- OPTIONS / PREFLIGHT ---
        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            http_response_code(200);
            exit();
        }
    }


    /*
    |------------------------------------------------------------------
    | LOGIN PAGE
    |------------------------------------------------------------------
    */

    public function login()
    {
        $this->call->view('auth/login');
    }


    /*
    |------------------------------------------------------------------
    | API LOGIN
    |------------------------------------------------------------------
    */

    public function authenticate()
    {
        // Get JSON request body
        $rawInput = file_get_contents('php://input');

        $input = json_decode(trim($rawInput), true);

        // Make sure input is an array
        if (!is_array($input)) {
            $input = [];
        }

        // Get username and password
        $username = $input['username'] ?? $this->io->post('username');
        $password = $input['password'] ?? $this->io->post('password');

        // Check if credentials were provided
        if (empty($username) || empty($password)) {

            header('Content-Type: application/json');
            http_response_code(400);

            echo json_encode([
                'status' => false,
                'message' => 'Username and password are required'
            ]);

            exit();
        }


        /*
        |------------------------------------------------------------------
        | FIND USER
        |------------------------------------------------------------------
        */

        $query = $this->db
                     ->table('users')
                     ->where('username', $username)
                     ->get();


        /*
        |------------------------------------------------------------------
        | CHECK DATABASE QUERY
        |------------------------------------------------------------------
        */

        if (!is_array($query)) {

            header('Content-Type: application/json');
            http_response_code(500);

            echo json_encode([
                'status' => false,
                'message' => 'Database query failed. Please check the users table.'
            ]);

            exit();
        }


        /*
        |------------------------------------------------------------------
        | GET USER DATA
        |------------------------------------------------------------------
        */

        $user = null;

        if (!empty($query)) {

            // If get() returned multiple rows
            if (isset($query[0]) && is_array($query[0])) {

                $user = $query[0];

            }

            // If get() returned one associative row
            elseif (
                isset($query['id']) ||
                isset($query['username']) ||
                isset($query['password'])
            ) {

                $user = $query;
            }
        }


        /*
        |------------------------------------------------------------------
        | CHECK PASSWORD
        |------------------------------------------------------------------
        */

        $isPasswordValid = false;

        if ($user && isset($user['password'])) {

            // Hashed password
            if (
                !empty($user['password']) &&
                password_get_info($user['password'])['algo'] !== 0
            ) {

                $isPasswordValid = password_verify(
                    $password,
                    $user['password']
                );
            }

            // Plain text password
            else {

                $isPasswordValid = (
                    $user['password'] === $password
                );
            }
        }


        /*
        |------------------------------------------------------------------
        | SUCCESSFUL LOGIN
        |------------------------------------------------------------------
        */

        if ($user && $isPasswordValid) {

            // Generate authentication token
            $token = bin2hex(random_bytes(32));

            // Save login information in session
            $this->session->set_userdata([
                'user_id'   => $user['id'],
                'username'  => $user['username'],
                'logged_in' => TRUE,
                'token'     => $token
            ]);

            // Return JSON response
            header('Content-Type: application/json');
            http_response_code(200);

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
        }


        /*
        |------------------------------------------------------------------
        | INVALID LOGIN
        |------------------------------------------------------------------
        */

        header('Content-Type: application/json');
        http_response_code(401);

        echo json_encode([
            'status' => false,
            'message' => 'Invalid username or password'
        ]);

        exit();
    }


    /*
    |------------------------------------------------------------------
    | LOGOUT
    |------------------------------------------------------------------
    */

    public function logout()
    {
        $this->session->sess_destroy();

        header('Content-Type: application/json');
        http_response_code(200);

        echo json_encode([
            'status' => true,
            'message' => 'Logged out successfully'
        ]);

        exit();
    }
}