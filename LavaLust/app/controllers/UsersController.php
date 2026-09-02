<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UsersController extends Controller {

    public function index() {
        $this->call->model('UsersModel');
        
        // Gamitin ang $this->UsersModel->all() batay sa iyong model
        $data['users'] = $this->UsersModel->all();
        
        $this->call->view('users', $data);
    }

}
?>