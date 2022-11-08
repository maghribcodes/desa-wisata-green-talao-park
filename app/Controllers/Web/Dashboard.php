<?php

namespace App\Controllers\Web;

use App\Models\AttractionModel;
use App\Models\EventModel;
use App\Models\PackageModel;
use App\Models\FacilityModel;
use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    protected $attractionModel;
    protected $eventModel;
    protected $packageModel;
    protected $facilityModel;

    public function __construct()
    {
        $this->attractionModel = new AttractionModel();
        $this->eventModel = new EventModel();
        $this->packageModel = new PackageModel();
        $this->facilityModel = new FacilityModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Dashboard',
        ];
        return view('dashboard/analytics', $data);
    }

    public function attraction()
    {
        $contents = $this->attractionModel->get_list_attraction()->getResultArray();

        $data = [
            'title' => 'Manage Attraction',
            'manage' => 'Attraction',
            'data' => $contents,
        ];
        return view('dashboard/manage-page', $data);
    }

    public function event()
    {
        $contents = $this->eventModel->get_list_event()->getResultArray();

        $data = [
            'title' => 'Manage Event',
            'manage' => 'Event',
            'data' => $contents,
        ];
        return view('dashboard/manage-page', $data);
    }

    public function package()
    {
        $contents = $this->packageModel->get_list_package()->getResultArray();

        $data = [
            'title' => 'Manage Package',
            'manage' => 'Package',
            'data' => $contents,
        ];
        return view('dashboard/manage-page', $data);
    }

    public function facility()
    {
        $contents = $this->facilityModel->get_list_facility()->getResultArray();

        $data = [
            'title' => 'Manage Facility',
            'manage' => 'Facility',
            'data' => $contents,
        ];
        return view('dashboard/manage-page', $data);
    }
}
