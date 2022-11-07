<?php

namespace App\Controllers;

use App\Models\GtpModel;
use App\Models\GalleryGtpModel;

class Home extends BaseController
{
    protected $gtpModel;
    protected $galleryGtpModel;

    protected $helpers = ['auth', 'url', 'filesystem'];

    public function __construct()
    {
        $this->gtpModel = new GtpModel();
        $this->galleryGtpModel = new GalleryGtpModel();
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
        ];
        return view('auth/login', $data);
    }

    public function register()
    {
        $data = [
            'title' => 'Register',
        ];
        return view('auth/register', $data);
    }

    public function profile()
    {
        $data = [
            'title' => 'My Profile',
        ];
        return view('profile/manage_profile', $data);
    }

    public function update()
    {
        $data = [
            'title' => 'Update Profile',
        ];
        return view('profile/update_profile', $data);
    }

    public function changePassword()
    {
        $data = [
            'title' => 'Change Password',
        ];
        return view('profile/change_password', $data);
    }
}
