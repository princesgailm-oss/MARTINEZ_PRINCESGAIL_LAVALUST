<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Welcome extends Controller {
	public function index() {
    $data['page_title'] = "Welcome to Princes LavaLust";
    $this->call->view('welcome_page', $data);
}
}
?>