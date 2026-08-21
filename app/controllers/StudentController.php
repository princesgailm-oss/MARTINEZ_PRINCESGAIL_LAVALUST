<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class StudentController extends Controller
{
    private function studentData()
    {
        return [
            'title'               => 'My Personal Profile',
            'student_id'          => 'MCC2024-00155',
            'name'                => 'Princes Gail E. Martinez',
            'course'              => 'BS Information Technology',
            'year'                => '3rd Year',
            'section'             => '3-F4',
            'email'               => 'princesgailm@gmail.com',
            'address'             => 'Tigkan Naujan Oriental Mindoro',
            'contact'             => '09941518738',
            'hobbies'             => 'Watching Vlogs',
            'profile_description' => 'I am a motivated and hardworking Information Technology student who is passionate about learning new technologies and developing creative solutions.',
            'facebook'            => 'https://www.facebook.com/princessgail.martinez.1',
            'instagram'           => 'https://www.instagram.com/princes_gail03'
        ];
    }

    public function index()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $data = $this->studentData();
        $data['notice'] = $_SESSION['student_notice'] ?? null;
        unset($_SESSION['student_notice']);

        $this->call->view('student/home', $data);
    }

    public function openProfile()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION['student_profile_pass'] = bin2hex(random_bytes(16));
        $_SESSION['student_profile_pass_time'] = time();

        header('Location: ' . site_url('student/profile'));
        exit;
    }

    public function profile()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $data = $this->studentData();
        $data['title'] = 'My Personal Profile';
        $data['middleware_message'] = $_SESSION['middleware_message'] ?? 'Access verified by StudentMiddleware.';
        unset($_SESSION['middleware_message']);

        $this->call->view('student/profile', $data);
    }
}
?>