<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class ProductController extends Controller
{
    public function __construct()
    {
        // --- CORS HEADERS & OPTIONS PREFLIGHT CHECK ---
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Authorization");

        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            http_response_code(200);
            exit();
        }
        // ----------------------------------------------

        parent::__construct();

        // Load session
        $this->call->library('session');

        // Load URL helper
        $this->call->helper('url');

        // Load Product Model
        $this->call->model('ProductModel');

        // Check if user is authenticated (support session or API Bearer token)
        $headers = function_exists('apache_request_headers') ? apache_request_headers() : [];
        $authHeader = $headers['Authorization'] ?? $_SERVER['HTTP_AUTHORIZATION'] ?? '';

        if (!$this->session->userdata('logged_in') && empty($authHeader)) {
            header('HTTP/1.1 401 Unauthorized');
            header('Content-Type: application/json');
            echo json_encode(['status' => false, 'message' => 'Unauthorized access']);
            exit();
        }
    }

    // PRODUCT LIST (GET)
    public function index()
    {
        $products = $this->ProductModel->get_all();
        
        header('Content-Type: application/json');
        echo json_encode($products);
        exit();
    }

    // CREATE / STORE PRODUCT (POST)
    public function create()
    {
        $input = json_decode(trim(file_get_contents('php://input')), true);
        if (empty($input)) {
            $input = $_POST;
        }
        
        $name = $input['name'] ?? $input['product_name'] ?? $this->io->post('name') ?? $this->io->post('product_name');
        $description = $input['description'] ?? $this->io->post('description');
        $price = $input['price'] ?? $this->io->post('price');
        $quantity = $input['quantity'] ?? $this->io->post('quantity');

        if (!empty($name)) {
            $data = [
                'product_name' => $name,
                'description'  => $description,
                'price'        => $price,
                'quantity'     => $quantity
            ];

            $this->ProductModel->insert($data);

            header('Content-Type: application/json');
            echo json_encode(['status' => true, 'message' => 'Product created successfully']);
            exit();
        } else {
            header('HTTP/1.1 400 Bad Request');
            header('Content-Type: application/json');
            echo json_encode(['status' => false, 'message' => 'Product name is required']);
            exit();
        }
    }

    // STORE (Alias para sa create)
    public function store()
    {
        $this->create();
    }

    // UPDATE PRODUCT
    public function update($id = null)
    {
        // Kung walang $id sa parameter, hanapin sa URI segments o input body
        if (!$id) {
            $uri_segments = array_values(array_filter(explode('/', trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'))));
            $id = end($uri_segments);
        }

        $input = json_decode(trim(file_get_contents('php://input')), true);
        if (empty($input)) {
            $input = $_POST;
        }

        if (!$id && isset($input['id'])) {
            $id = $input['id'];
        }

        if ($id && is_numeric($id)) {
            $name = $input['name'] ?? $input['product_name'] ?? null;
            $description = $input['description'] ?? null;
            $price = $input['price'] ?? null;
            $quantity = $input['quantity'] ?? null;

            $data = [];
            if ($name !== null) $data['product_name'] = $name;
            if ($description !== null) $data['description'] = $description;
            if ($price !== null) $data['price'] = $price;
            if ($quantity !== null) $data['quantity'] = $quantity;

            $this->ProductModel->update($id, $data);

            header('Content-Type: application/json');
            echo json_encode(['status' => true, 'message' => 'Product updated successfully']);
            exit();
        }

        header('HTTP/1.1 400 Bad Request');
        header('Content-Type: application/json');
        echo json_encode(['status' => false, 'message' => 'Product ID is missing or invalid']);
        exit();
    }

    // DELETE PRODUCT
    public function delete($id = null)
    {
        if (!$id) {
            $uri_segments = array_values(array_filter(explode('/', trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'))));
            $id = end($uri_segments);
        }

        if (!$id) {
            $input = json_decode(trim(file_get_contents('php://input')), true);
            $id = $input['id'] ?? $_POST['id'] ?? null;
        }

        if ($id && is_numeric($id)) {
            $this->ProductModel->delete($id);

            header('Content-Type: application/json');
            echo json_encode(['status' => true, 'message' => 'Product deleted successfully']);
            exit();
        }

        header('HTTP/1.1 400 Bad Request');
        header('Content-Type: application/json');
        echo json_encode(['status' => false, 'message' => 'Product ID is missing or invalid']);
        exit();
    }
}