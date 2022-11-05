<?php

namespace App\Controllers\Api;

use App\Models\FacilityModel;
use App\Models\GalleryFacilityModel;
use App\Models\DetailFacilityModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class Facility extends ResourceController
{
    use ResponseTrait;

    protected $facilityModel;
    protected $galleryFacilityModel;
    protected $detailFacilityModel;

    public function __construct()
    {
        $this->facilityModel = new FacilityModel();
        $this->galleryFacilityModel = new GalleryFacilityModel();
        $this->detailFacilityModel = new DetailFacilityModel();
    }

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $contents = $this->facilityModel->get_list_facility()->getResult();
        $response = [
            'data' => $contents,
            'status' => 200,
            'message' => [
                "Success get list of Facility"
            ]
        ];
        return $this->respond($response);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $facility = $this->facilityModel->get_facility_by_id($id)->getRowArray();

        $list_gallery = $this->galleryFacilityModel->get_gallery($id)->getResultArray();
        $galleries = array();
        foreach ($list_gallery as $gallery) {
            $galleries[] = $gallery['url'];
        }

        $facility['gallery'] = $galleries;

        $response = [
            'data' => $facility,
            'status' => 200,
            'message' => [
                "Success display detail information of Facility"
            ]
        ];
        return $this->respond($response);
    }

    public function findByTrack()
    {
        $request = $this->request->getPost();
        $contents = $this->detailFacilityModel->get_facility_by_track($request)->getResult();

        $response = [
            'data' => $contents,
            'status' => 200,
            'message' => [
                "Success find facility by track"
            ]
        ];
        return $this->respond($response);
    }

    public function findByRadius()
    {
        $request = $this->request->getPost();
        $contents = $this->facilityModel->get_facility_by_radius($request)->getResult();

        $response = [
            'data' => $contents,
            'status' => 200,
            'message' => [
                "Success find facility by radius"
            ]
        ];
        return $this->respond($response);
    }
}
