<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class ProductController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->call->model('ProductModel');
        $this->call->library('session');
        $this->call->helper('url');
    }

    /*
    |--------------------------------------------------------------------------
    | PRODUCT LIST
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $data['products'] = $this->ProductModel->all();

        $this->call->view('products/index', $data);
    }


    /*
    |--------------------------------------------------------------------------
    | CREATE PRODUCT
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
        if ($this->io->method() !== 'post') {
            redirect('products');
            return;
        }

        $data = array(
            'name'        => $this->io->post('name'),
            'description' => $this->io->post('description'),
            'price'       => $this->io->post('price')
        );

        $this->ProductModel->create($data);

        redirect('products');
    }


    /*
    |--------------------------------------------------------------------------
    | EDIT PRODUCT
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        $data['product'] = $this->ProductModel->find($id);

        if (!$data['product']) {
            redirect('products');
            return;
        }

        $this->call->view('products/edit', $data);
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE PRODUCT
    |--------------------------------------------------------------------------
    */

    public function update($id)
    {
        if ($this->io->method() !== 'post') {
            redirect('products');
            return;
        }

        $data = array(
            'name'        => $this->io->post('name'),
            'description' => $this->io->post('description'),
            'price'       => $this->io->post('price')
        );

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