<?php

namespace App\Controllers\Api;

use App\Models\PackageModel;
use App\Models\PackageTypeModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class Package extends ResourceController
{
    use ResponseTrait;

    protected $packageModel;
    protected $packageTypeModel;

    public function __construct()
    {
        $this->packageModel = new PackageModel();
        $this->packageTypeModel = new PackageTypeModel();
    }

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $contents = $this->packageModel->get_list_package()->getResult();
        $response = [
            'data' => $contents,
            'status' => 200,
            'message' => [
                "Success get list of Package"
            ]
        ];
        return $this->respond($response);
    }

    public function show($id = null)
    {
        $package = $this->packageModel->get_package_by_id($id)->getRowArray();

        $response = [
            'data' => $package,
            'status' => 200,
            'message' => [
                "Success display detail information of Package"
            ]
        ];
        return $this->respond($response);
    }

    public function findByName()
    {
        $request = $this->request->getPost();
        $name = $request['name'];
        $contents = $this->packageModel->get_package_by_name($name)->getResult();
        $response = [
            'data' => $contents,
            'status' => 200,
            'message' => [
                "Success find package by name"
            ]
        ];
        return $this->respond($response);
    }

    public function type()
    {
        $contents = $this->packageTypeModel->get_list_type()->getResult();
        $response = [
            'data' => $contents,
            'status' => 200,
            'message' => [
                "Success get list of package type"
            ]
        ];
        return $this->respond($response);
    }

    public function findByType()
    {
        $request = $this->request->getPost();
        $type = $request['type'];
        $contents = $this->packageModel->get_package_by_type($type)->getResult();
        $response = [
            'data' => $contents,
            'status' => 200,
            'message' => [
                "Success find package by type"
            ]
        ];
        return $this->respond($response);
    }
}
