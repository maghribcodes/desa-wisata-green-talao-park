<?php

namespace App\Controllers\Web;

use App\Models\EventModel;
use CodeIgniter\RESTful\ResourcePresenter;

class Event extends ResourcePresenter
{
    protected $eventModel;

    protected $helpers = ['auth', 'url', 'filesystem'];

    public function __construct()
    {
        $this->eventModel = new EventModel();
    }

    /**
     * Present a view of resource objects
     *
     * @return mixed
     */
    public function index()
    {
        $contents = $this->eventModel->get_list_event_api()->getResultArray();
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
        $event = $this->eventModel->get_event_by_id_api($id)->getRowArray();
        if (empty($event)) {
            return redirect()->to(substr(current_url(), 0, -strlen($id)));
        }

        $data = [
            'title' => $event['name'],
            'data' => $event,
        ];

        if (url_is('*dashboard*')) {
            return view('dashboard/detail_event', $data);
        }
        return view('web/detail_event', $data);
    }
}
