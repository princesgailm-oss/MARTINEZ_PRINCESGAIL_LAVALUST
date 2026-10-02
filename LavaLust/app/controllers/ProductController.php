<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class ProductController extends Controller
{
    public function __construct()
    {
        // ---------------------------------------------------------
        // CORS
        // ---------------------------------------------------------
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Authorization");

        // OPTIONS / CORS preflight
        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            http_response_code(200);
            exit();
        }

        parent::__construct();

        // ---------------------------------------------------------
        // LOAD LIBRARIES / HELPERS / MODEL
        // ---------------------------------------------------------
        $this->call->library('session');
        $this->call->helper('url');
        $this->call->model('ProductModel');

        // ---------------------------------------------------------
        // AUTHENTICATION
        // ---------------------------------------------------------
        $headers = function_exists('apache_request_headers')
            ? apache_request_headers()
            : [];

        $authHeader =
            $headers['Authorization']
            ?? $headers['authorization']
            ?? $_SERVER['HTTP_AUTHORIZATION']
            ?? '';

        /*
         * Allow access if:
         * 1. Session is logged in
         * OR
         * 2. Authorization Bearer token exists
         */
        if (
            !$this->session->userdata('logged_in')
            && empty($authHeader)
        ) {
            header('HTTP/1.1 401 Unauthorized');
            header('Content-Type: application/json');

            echo json_encode([
                'status' => false,
                'message' => 'Unauthorized access'
            ]);

            exit();
        }
    }


    /*
    |--------------------------------------------------------------------------
    | GET PRODUCTS
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $products = $this->ProductModel->get_all();

        header('Content-Type: application/json');

        echo json_encode($products);

        exit();
    }


    /*
    |--------------------------------------------------------------------------
    | CREATE PRODUCT
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $input = json_decode(
            trim(file_get_contents('php://input')),
            true
        );

        if (!is_array($input)) {
            $input = $_POST;
        }

        $name =
            $input['name']
            ?? $input['product_name']
            ?? $this->io->post('name')
            ?? $this->io->post('product_name');

        $description =
            $input['description']
            ?? $this->io->post('description');

        $price =
            $input['price']
            ?? $this->io->post('price');

        $quantity =
            $input['quantity']
            ?? $this->io->post('quantity');


        // Product name required
        if (empty($name)) {

            header('HTTP/1.1 400 Bad Request');
            header('Content-Type: application/json');

            echo json_encode([
                'status' => false,
                'message' => 'Product name is required'
            ]);

            exit();
        }


        $data = [
            'product_name' => $name,
            'description'  => $description,
            'price'        => $price,
            'quantity'     => $quantity
        ];


        $this->ProductModel->insert($data);


        header('Content-Type: application/json');

        echo json_encode([
            'status' => true,
            'message' => 'Product created successfully'
        ]);

        exit();
    }


    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */

    public function store()
    {
        $this->create();
    }


    /*
    |--------------------------------------------------------------------------
    | EDIT PRODUCT
    |--------------------------------------------------------------------------
    */

    public function edit($id = null)
    {
        if (!$id) {

            header('HTTP/1.1 400 Bad Request');
            header('Content-Type: application/json');

            echo json_encode([
                'status' => false,
                'message' => 'Product ID is missing'
            ]);

            exit();
        }


        $product = $this->ProductModel->find($id);


        if (!$product) {

            header('HTTP/1.1 404 Not Found');
            header('Content-Type: application/json');

            echo json_encode([
                'status' => false,
                'message' => 'Product not found'
            ]);

            exit();
        }


        header('Content-Type: application/json');

        echo json_encode($product);

        exit();
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE PRODUCT
    |--------------------------------------------------------------------------
    */

    public function update($id = null)
    {
        /*
         * Get ID from route.
         */
        if (!$id) {

            $uri_segments = explode(
                '/',
                trim(
                    parse_url(
                        $_SERVER['REQUEST_URI'],
                        PHP_URL_PATH
                    ),
                    '/'
                )
            );

            $id = end($uri_segments);
        }


        /*
         * Make sure ID exists.
         */
        if (!$id) {

            header('HTTP/1.1 400 Bad Request');
            header('Content-Type: application/json');

            echo json_encode([
                'status' => false,
                'message' => 'Product ID is missing'
            ]);

            exit();
        }


        /*
         * Get JSON body.
         */
        $rawInput = trim(
            file_get_contents('php://input')
        );

        $input = json_decode(
            $rawInput,
            true
        );


        /*
         * If JSON is not available,
         * use normal POST.
         */
        if (!is_array($input)) {
            $input = $_POST;
        }


        /*
         * Get product fields.
         */
        $name =
            $input['name']
            ?? $input['product_name']
            ?? $this->io->post('name')
            ?? $this->io->post('product_name');

        $description =
            $input['description']
            ?? $this->io->post('description');

        $price =
            $input['price']
            ?? $this->io->post('price');

        $quantity =
            $input['quantity']
            ?? $this->io->post('quantity');


        /*
         * Build update data.
         */
        $data = [
            'product_name' => $name,
            'description'  => $description,
            'price'        => $price,
            'quantity'     => $quantity
        ];


        /*
         * Remove null values only.
         */
        $data = array_filter(
            $data,
            function ($value) {
                return $value !== null;
            }
        );


        /*
         * Check if there is something to update.
         */
        if (empty($data)) {

            header('HTTP/1.1 400 Bad Request');
            header('Content-Type: application/json');

            echo json_encode([
                'status' => false,
                'message' => 'No product data received'
            ]);

            exit();
        }


        /*
         * UPDATE DATABASE
         */
        $result = $this->ProductModel->update(
            $id,
            $data
        );


        /*
         * Return success.
         */
        header('Content-Type: application/json');

        echo json_encode([
            'status' => true,
            'message' => 'Product updated successfully',
            'id' => $id,
            'data' => $data,
            'result' => $result
        ]);

        exit();
    }


    /*
    |--------------------------------------------------------------------------
    | DELETE PRODUCT
    |--------------------------------------------------------------------------
    */

    public function delete($id = null)
    {
        /*
         * Get ID from route.
         */
        if (!$id) {

            $uri_segments = explode(
                '/',
                trim(
                    parse_url(
                        $_SERVER['REQUEST_URI'],
                        PHP_URL_PATH
                    ),
                    '/'
                )
            );

            $id = end($uri_segments);
        }


        /*
         * Check ID.
         */
        if (!$id) {

            header('HTTP/1.1 400 Bad Request');
            header('Content-Type: application/json');

            echo json_encode([
                'status' => false,
                'message' => 'Product ID is missing'
            ]);

            exit();
        }


        /*
         * Delete product.
         */
        $result = $this->ProductModel->delete($id);


        header('Content-Type: application/json');

        echo json_encode([
            'status' => true,
            'message' => 'Product deleted successfully',
            'id' => $id,
            'result' => $result
        ]);

        exit();
    }
}