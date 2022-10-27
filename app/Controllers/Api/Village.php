<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\VillageModel;
use App\Models\AttractionModel;
use CodeIgniter\API\ResponseTrait;

class Village extends BaseController
{
    use ResponseTrait;
    protected $villageModel;
    protected $attractionModel;

    public function __construct()
    {
        $this->villageModel = new VillageModel();
        $this->attractionModel = new AttractionModel();
    }

    public function getData()
    {
        $request = $this->request->getPost();
        $village = $request['village'];
        if ($village == 'V0001') {
            $vilProperty = $this->villageModel->get_ulakan_api()->getRowArray();
            $geoJson = json_decode($this->villageModel->get_geoJson_api($village)->getRowArray()['geoJson']);
            $content = [
                'type' => 'Feature',
                'geometry' => $geoJson,
                'properties' => [
                    'id' => $vilProperty['id'],
                    'name' => $vilProperty['name'],
                    'lat' => $vilProperty['lat'],
                    'lng' => $vilProperty['lng'],
                ]
            ];
            $response = [
                'data' => $content,
                'status' => 200,
                'message' => [
                    "Success display data of Ulakan"
                ]
            ];
            return $this->respond($response);
        } elseif ($village == 'GTP01') {
            $vilProperty = $this->villageModel->get_desa_wisata_api()->getRowArray();
            $geoJson = json_decode($this->villageModel->get_geoJson_api($village)->getRowArray()['geoJson']);
            $content = [
                'type' => 'Feature',
                'geometry' => $geoJson,
                'properties' => [
                    'id' => $vilProperty['id'],
                    'name' => $vilProperty['name'],
                    'lat' => $vilProperty['lat'],
                    'lng' => $vilProperty['lng'],
                ]
            ];
            $response = [
                'data' => $content,
                'status' => 200,
                'message' => [
                    "Success display data of Desa Wisata"
                ]
            ];
            return $this->respond($response);
        }
    }
}
