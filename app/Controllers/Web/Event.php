<?php

namespace App\Controllers\Web;

use App\Models\EventModel;
use App\Models\GalleryEventModel;
use CodeIgniter\RESTful\ResourcePresenter;

class Event extends ResourcePresenter
{
    protected $eventModel;
    protected $galleryEventModel;

    protected $helpers = ['auth', 'url', 'filesystem'];

    public function __construct()
    {
        $this->eventModel = new EventModel();
        $this->galleryEventModel = new GalleryEventModel();
    }

    /**
     * Present a view of resource objects
     *
     * @return mixed
     */
    public function index()
    {
        $contents = $this->eventModel->get_list_event()->getResultArray();
        $data = [
            'title' => 'Event',
            'data' => $contents,
        ];

        return view('web/list_event', $data);
    }

    /**
     * Present a view to present a specific resource object
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $event = $this->eventModel->get_event_by_id($id)->getRowArray();

        if (empty($event)) {
            return redirect()->to(substr(current_url(), 0, -strlen($id)));
        }

        $list_gallery = $this->galleryEventModel->get_gallery($id)->getResultArray();
        $galleries = array();
        foreach ($list_gallery as $gallery) {
            $galleries[] = $gallery['url'];
        }
        $event['gallery'] = $galleries;

        $data = [
            'title' => $event['name'],
            'data' => $event,
            'folder' => 'event'
        ];

        if (url_is('*dashboard*')) {
            return view('dashboard/detail_event', $data);
        }
        return view('web/detail_event', $data);
    }
}
