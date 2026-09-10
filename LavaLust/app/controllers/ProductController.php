<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class ProductController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        // Load session
        $this->call->library('session');

        // Load URL helper
        $this->call->helper('url');

        // Load Product Model
        $this->call->model('ProductModel');

        // Check if user is logged in
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
            exit;
        }
    }

    /*
    |--------------------------------------------------------------------------
    | PRODUCT LIST
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $data['products'] = $this->ProductModel->get_all();

        $this->call->view('products/index', $data);
    }


    /*
    |--------------------------------------------------------------------------
    | CREATE PRODUCT FORM
    |--------------------------------------------------------------------------
    */
    public function create()
    {
        $this->call->view('products/create');
    }


    /*
    |--------------------------------------------------------------------------
    | STORE PRODUCT
    |--------------------------------------------------------------------------
    */
    public function store()
    {
        // Tiyaking POST request lamang ang pwedeng pumasok dito
        if ($this->io->method() === 'post') {
            $product_name = $this->io->post('product_name') ?? $this->io->post('name');

            // Kapag may ipinadalang pangalan
            if (!empty($product_name)) {
                $data = [
                    'product_name' => $product_name,
                    'description'  => $this->io->post('description'),
                    'price'        => $this->io->post('price'),
                    'quantity'     => $this->io->post('quantity')
                ];

                $this->ProductModel->insert($data);
            }
        }

        redirect('products');
    }


    /*
    |--------------------------------------------------------------------------
    | EDIT PRODUCT
    |--------------------------------------------------------------------------
    */
    public function edit($id = null)
    {
        if (!$id) {
            redirect('products');
            return;
        }

        $product = $this->ProductModel->get_by_id($id);

        if (!$product) {
            redirect('products');
            return;
        }

        $data['product'] = $product;

        $this->call->view('products/edit', $data);
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE PRODUCT
    |--------------------------------------------------------------------------
    */
    public function update($id = null)
    {
        if ($this->io->method() === 'post' && $id) {
            $product_name = $this->io->post('product_name') ?? $this->io->post('name');

            $data = [
                'product_name' => $product_name,
                'description'  => $this->io->post('description'),
                'price'        => $this->io->post('price'),
                'quantity'     => $this->io->post('quantity')
            ];

            $this->ProductModel->update($id, $data);
        }

        redirect('products');
    }


    /*
    |--------------------------------------------------------------------------
    | DELETE PRODUCT
    |--------------------------------------------------------------------------
    */
    public function delete($id = null)
    {
        if ($id) {
            $this->ProductModel->delete($id);
        }

        redirect('products');
    }
}