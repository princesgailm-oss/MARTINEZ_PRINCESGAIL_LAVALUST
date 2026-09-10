<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class ProductController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        // Load helpers, libraries, and models
        $this->call->library('session');
        $this->call->helper('url');
        $this->call->model('ProductModel');

        // Proteksyon: Kapag hindi naka-login, ibabalik sa login screen
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
            exit;
        }
    }

    public function index()
    {
        $data['products'] = $this->ProductModel->get_all();

        // Loads views/products/index.php
        $this->call->view('products/index', $data);
    }

    public function create()
    {
        $this->call->view('products/create');
    }

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

    public function delete($id)
    {
        $this->ProductModel->delete($id);

        redirect('products');
    }
}
?>