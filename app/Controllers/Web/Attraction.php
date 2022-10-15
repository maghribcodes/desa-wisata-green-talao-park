<?php

namespace App\Controllers\Web;

use App\Models\AttractionModel;
use CodeIgniter\RESTful\ResourcePresenter;

class Attraction extends ResourcePresenter
{
    protected $attractionModel;

    protected $helpers = ['auth', 'url', 'filesystem'];

    public function __construct()
    {
        $this->attractionModel = new AttractionModel();
    }

    /**
     * Present a view of resource objects
     *
     * @return mixed
     */
    public function index()
    {
        $contents = $this->attractionModel->get_list_attraction_api()->getResultArray();
        $data = [
            'title' => 'Attraction',
            'data' => $contents,
        ];

        return view('web/list_attraction', $data);
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
        $attraction = $this->attractionModel->get_attraction_by_id_api($id)->getRowArray();
        if (empty($attraction)) {
            return redirect()->to(substr(current_url(), 0, -strlen($id)));
        }

        $data = [
            'title' => $attraction['name'],
            'data' => $attraction,
        ];

        if (url_is('*dashboard*')) {
            return view('dashboard/detail_attraction', $data);
        }
        return view('web/detail_attraction', $data);
    }
}
