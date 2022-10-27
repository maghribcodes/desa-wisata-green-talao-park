<?php

namespace App\Controllers\Web;

use App\Models\PackageModel;
use CodeIgniter\RESTful\ResourcePresenter;

class Package extends ResourcePresenter
{
    protected $packageModel;

    protected $helpers = ['auth', 'url', 'filesystem'];

    public function __construct()
    {
        $this->packageModel = new PackageModel();
    }

    /**
     * Present a view of resource objects
     *
     * @return mixed
     */
    public function index()
    {
        $contents = $this->packageModel->get_list_package_api()->getResultArray();
        $data = [
            'title' => 'Package',
            'data' => $contents,
        ];

        return view('web/list_package', $data);
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
        $package = $this->packageModel->get_package_by_id_api($id)->getRowArray();
        if (empty($package)) {
            return redirect()->to(substr(current_url(), 0, -strlen($id)));
        }

        $data = [
            'title' => $package['name'],
            'data' => $package,
        ];

        if (url_is('*dashboard*')) {
            return view('dashboard/detail_package', $data);
        }
        return view('web/detail_package', $data);
    }
}
