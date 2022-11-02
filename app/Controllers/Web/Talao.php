<?php

namespace App\Controllers\Web;

use App\Models\AttractionModel;
use App\Models\GalleryAttractionModel;
use CodeIgniter\RESTful\ResourcePresenter;

class Talao extends ResourcePresenter
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
    }

    public function detail()
    {
        $contents = $this->attractionModel->get_talao()->getResultArray();

        for ($index = 0; $index < count($contents); $index++) {
            $list_gallery = $this->galleryAttractionModel->get_gallery2()->getResultArray();
            $galleries = array();
            foreach ($list_gallery as $gallery) {
                $galleries[] = $gallery['url'];
            }
            $contents[$index]['gallery'] = $galleries;
        }

        $data = [
            'title' => 'Estuaria/Talao',
            'folder' => 'talao',
            'data' => $contents
        ];

        return view('web/talao', $data);
    }
}