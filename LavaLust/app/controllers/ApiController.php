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

    public function products()
    {
        $this->api->require_jwt();
        $this->api->require_method('GET');

        $products = $this->ProductModel->get_all();

        $this->api->respond($products);
    }

    public function create_product()
    {
        $this->api->require_jwt();
        $this->api->require_method('POST');

        $input = $this->api->body();

        $name = $input['product_name'] ?? $input['name'] ?? '';

        if (trim($name) === '') {
            $this->api->respond_error('Product name is required', 400);
            return;
        }

        $data = [
            'product_name' => $name,
            'description' => $input['description'] ?? '',
            'price' => $input['price'] ?? 0,
            'quantity' => $input['quantity'] ?? 0
        ];

        $this->ProductModel->insert($data);

        $this->api->respond([
            'status' => true,
            'message' => 'Product created successfully'
        ], 201);
    }

    public function update_product($id)
    {
        $this->api->require_jwt();
        $this->api->require_method('PUT');

        $input = $this->api->body();

        $name = $input['product_name'] ?? $input['name'] ?? '';

        if (trim($name) === '') {
            $this->api->respond_error('Product name is required', 400);
            return;
        }

        $data = [
            'product_name' => $name,
            'description' => $input['description'] ?? '',
            'price' => $input['price'] ?? 0,
            'quantity' => $input['quantity'] ?? 0
        ];

        $this->ProductModel->update($id, $data);

        $this->api->respond([
            'status' => true,
            'message' => 'Product updated successfully'
        ]);
    }

    public function delete_product($id)
    {
        $this->api->require_jwt();
        $this->api->require_method('DELETE');

        $this->ProductModel->delete($id);

        $this->api->respond([
            'status' => true,
            'message' => 'Product deleted successfully'
        ]);
    }
}