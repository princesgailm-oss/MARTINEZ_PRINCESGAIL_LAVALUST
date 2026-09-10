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
        $data = [
            'product_name' => $this->io->post('product_name'),
            'description'  => $this->io->post('description'),
            'price'        => $this->io->post('price'),
            'quantity'     => $this->io->post('quantity')
        ];

        $this->ProductModel->insert($data);

        redirect('products');
    }


    /*
    |--------------------------------------------------------------------------
    | EDIT PRODUCT
    |--------------------------------------------------------------------------
    */
    public function edit($id)
    {
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
    public function update($id)
    {
        $data = [
            'product_name' => $this->io->post('product_name'),
            'description'  => $this->io->post('description'),
            'price'        => $this->io->post('price'),
            'quantity'     => $this->io->post('quantity')
        ];

        $this->ProductModel->update($id, $data);

        redirect('products');
    }


    /*
    |--------------------------------------------------------------------------
    | DELETE PRODUCT
    |--------------------------------------------------------------------------
    */
    public function delete($id)
    {
        $this->ProductModel->delete($id);

        redirect('products');
    }
}
?>