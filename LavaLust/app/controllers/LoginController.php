<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Logincontroller extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        // 1. Kunin ang raw JSON data na ipinadala galing sa React
        $json_data = file_get_contents('php://input');
        $input = json_decode($json_data, true);

        $username = $input['username'] ?? '';
        $password = $input['password'] ?? '';

        // 2. Pansamantalang validation (Palitan mamaya ng query sa database kung kinakailangan)
        $isValid = ($username === 'admin' && $password === '123456');

        // 3. I-set ang header para maging JSON ang response
        header('Content-Type: application/json');

        if ($isValid) {
            echo json_encode([
                'status' => true,
                'token' => 'sample-jwt-token-12345',
                'message' => 'Login successful'
            ]);
        } else {
            echo json_encode([
                'status' => false,
                'message' => 'Invalid credentials'
            ]);
        }
        exit();
    }
}