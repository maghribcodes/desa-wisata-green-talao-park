<?php

namespace App\Controllers\Api;

use App\Models\EventModel;
// use App\Models\GalleryEventModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class Event extends ResourceController
{
    use ResponseTrait;

    protected $eventModel;

    public function __construct()
    {
        $this->eventModel = new EventModel();
    }

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $contents = $this->eventModel->get_list_event()->getResult();
        $response = [
            'data' => $contents,
            'status' => 200,
            'message' => [
                "Success get list of Event"
            ]
        ];
        return $this->respond($response);
    }

    public function show($id = null)
    {
        $event = $this->eventModel->get_event_by_id($id)->getRowArray();

        $response = [
            'data' => $event,
            'status' => 200,
            'message' => [
                "Success display detail information of Event"
            ]
        ];
        return $this->respond($response);
    }
}
