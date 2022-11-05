<?php

namespace App\Controllers\Api;

use App\Models\PackageModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class Package extends ResourceController
{
    use ResponseTrait;

    protected $packageModel;

    public function __construct()
    {
        $this->packageModel = new PackageModel();
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
}
