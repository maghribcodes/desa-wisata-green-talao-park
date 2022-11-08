<?php

namespace App\Controllers;

use CodeIgniter\Session\Session;
use Myth\Auth\Config\Auth as AuthConfig;

class Home extends BaseController
{
        protected $auth;

        /**
         * @var AuthConfig
         */
        protected $config;

        /**
         * @var Session
         */
        protected $session;

    public function __construct()
    {
        $this->session = service('session');
        $this->config = config('Auth');
        $this->auth = service('authentication');
    }

    public function index()
    {
        return view('welcome_message');
    }

    public function landingPage()
    {
        return view('landing_page');
    }

    public function error403()
    {
        return view('errors/html/error_403');
    }

    public function login()
    {
        $data = [
            'title' => 'Login',
            'config' => $this->config,
        ];
        return view('auth/login', $data);
    }

    public function register()
    {
        $data = [
            'title' => 'Register',
            'config' => $this->config,
        ];
        return view('auth/register', $data);
    }

    // public function profile()
    // {
    //     $data = [
    //         'title' => 'My Profile',
    //     ];
    //     return view('profile/manage_profile', $data);
    // }

    // public function update()
    // {
    //     $data = [
    //         'title' => 'Update Profile',
    //     ];
    //     return view('profile/update_profile', $data);
    // }

    // public function changePassword()
    // {
    //     $data = [
    //         'title' => 'Change Password',
    //     ];
    //     return view('profile/change_password', $data);
    // }
}
