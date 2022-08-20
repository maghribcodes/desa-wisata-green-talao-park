<?php

namespace App\Controllers;

use App\Models\TalaoModel;

class Home extends BaseController
{
    // public function __construct()
    // {

    // }

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

    public function web()
    {
        // $talaoModel = new TalaoModel();
        // $talao = $talaoModel->findAll();

        $db = \Config\Database::connect();
        $builder1 = $db->table('test');
        $builder2 = $db->table('test');
        $builder2->select('id, name, St_AsGeoJSON(geom) AS geom, ST_X(ST_Centroid(geom)) AS lng, ST_Y(ST_CENTROID(geom)) AS lat');
        $builder1->select('id, name, ST_X(ST_Centroid(geom)) AS lng, ST_Y(ST_CENTROID(geom)) AS lat');
        $query2 = $builder2->get();
        $query = $builder1->get();
        $result2 = $query2->getResultArray();
        $result = $query->getResultArray();
        // $r = json_encode($result);
        // dd($r);
        $json = array(
            'type'    => 'FeatureCollection',
            'features' => array()
        );

        foreach($result2 as $re) {
            $features = array(
                'type' => 'Feature',
                'geometry' => json_decode($re['geom']),

                'properties' => array(
                    'id' => $re['id'],
                    'name' => $re['name'],

                    'lat' => $re['lat'],
                    'lng' => $re['lng']
                )
            );
            array_push($json['features'], $features);
        }
        $eee = json_encode($json);
        // dd($e);
        
        foreach($result as $r) {
            $id   = $r['id'];
            $nama = $r['name'];
            $lng  = $r['lng'];
            $lat  = $r['lat'];
        }
        $dataarray[] = array('id'=>$id,'name'=>$nama,'lng'=>$lng,'lat'=>$lat);
        $ee = json_encode($dataarray);
        // dd($e);
        $data = [
            'title' => 'Home',
            'json' => $ee,
            'digitasi' => $eee
        ];
        
        // return view('web/testing', $data);

        // $data = [
        //     'title' => 'Home'
        // ];

        return view('web/home', $data);
    }

    public function attraction()
    {
        $data = [
            'title' => 'Tes',
        ];
        return view('web/list_attraction', $data);
    }

    public function object()
    {
        // $talaoModel = new TalaoModel();
        // $talao = $talaoModel->findAll();

        $data = [
            'title' => 'Object',
            // 'talao' => $talao
        ];
        return view('web/list_object', $data);
    }

    public function objectDetail()
    {
        $data = [
            'title' => 'Detail Object',
            'data' => ['id' => 'Detail'],
        ];
        return view('web/detail_object', $data);
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
