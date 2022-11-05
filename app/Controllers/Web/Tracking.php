<?php

namespace App\Controllers\Web;

use App\Models\AttractionModel;
use App\Models\GalleryAttractionModel;
use CodeIgniter\RESTful\ResourcePresenter;

class Tracking extends ResourcePresenter
{
    protected $attractionModel;
    protected $galleryAttractionModel;

    protected $helpers = ['auth', 'url', 'filesystem'];

    public function __construct()
    {
        $this->attractionModel = new AttractionModel();
        $this->galleryAttractionModel = new GalleryAttractionModel();
    }

    /**
     * Present a view of resource objects
     *
     * @return mixed
     */
    public function index()
    {
        $contents = $this->attractionModel->get_tracking()->getResultArray();

        for ($index = 0; $index < count($contents); $index++) {
            $list_gallery = $this->galleryAttractionModel->get_gallery($contents[$index]['id'])->getResultArray();
            $galleries = array();
            foreach ($list_gallery as $gallery) {
                $galleries[] = $gallery['url'];
            }
            $contents[$index]['gallery'] = $galleries;
        }

        $data = [
            'title' => 'Tracking Mangrove',
            'folder' => 'tracking',
            'data' => $contents
        ];

        return view('web/tracking_mangrove', $data);
    }
}
