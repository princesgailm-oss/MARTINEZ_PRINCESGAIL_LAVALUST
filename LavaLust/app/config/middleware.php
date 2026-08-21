<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

$config['middlewares'] = [
    'student' => load_class('StudentMiddleware', 'middlewares')
];
