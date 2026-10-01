<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class ApiController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->call->library('api');
        $this->call->model('ProductModel');
    }

    public function create()
    {
        $this->api->require_method('POST');

        $input = $this->api->body();

        $this->db->raw(
            "INSERT INTO users (username, email, password, role, created_at)
             VALUES (?, ?, ?, ?, NOW())",
            [
                $input['username'],
                $input['email'],
                password_hash($input['password'], PASSWORD_BCRYPT),
                $input['role'] ?? 'user',
            ]
        );

        $this->api->respond(['message' => 'User created'], 201);
    }

    public function login()
    {
        $this->api->require_method('POST');

        $input = $this->api->body();

        $username = $input['username'] ?? '';
        $password = $input['password'] ?? '';

        $stmt = $this->db->raw(
            'SELECT * FROM users WHERE username = ?',
            [$username]
        );

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {

            $tokens = $this->api->issue_tokens([
                'id'   => $user['id'],
                'role' => $user['role'],
            ]);

            $this->api->respond($tokens);
        }

        $this->api->respond_error('Invalid credentials', 401);
    }

    public function products()
    {
        $this->api->require_jwt();
        $this->api->require_method('GET');

        $products = $this->ProductModel->all();

        $this->api->respond($products);
    }

    public function create_product()
    {
        $this->api->require_jwt();
        $this->api->require_method('POST');

        $input = $this->api->body();

        $data = [
            'product_name' => $input['product_name'],
            'description'  => $input['description'],
            'price'        => $input['price'],
            'quantity'     => $input['quantity']
        ];

        $this->ProductModel->create($data);

        $this->api->respond(['message' => 'Product created'], 201);
    }

    public function update_product($id)
    {
        $this->api->require_jwt();
        $this->api->require_method('PUT');

        $input = $this->api->body();

        $data = [
            'product_name' => $input['product_name'],
            'description'  => $input['description'],
            'price'        => $input['price'],
            'quantity'     => $input['quantity']
        ];

        $this->ProductModel->update($id, $data);

        $this->api->respond(['message' => 'Product updated']);
    }

    public function delete_product($id)
    {
        $this->api->require_jwt();
        $this->api->require_method('DELETE');

        $this->ProductModel->delete($id);

        $this->api->respond(['message' => 'Product deleted']);
    }
}