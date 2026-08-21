<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class StudentMiddleware {
    public function run() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['student_profile_pass'])) {
            $_SESSION['student_notice'] = 'Please open profile through the home action first.';
            header('Location: ' . site_url('student'));
            exit;
        }

        $_SESSION['middleware_message'] = 'Access verified by StudentMiddleware.';
    }
}