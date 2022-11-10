<?php

namespace App\Controllers\Web;

use App\Models\PackageModel;
use App\Models\GalleryPackageModel;
use App\Models\PackageTypeModel;
use CodeIgniter\RESTful\ResourcePresenter;
use CodeIgniter\Files\File;

class Package extends ResourcePresenter
{
    protected $packageModel;
    protected $galleryPackageModel;
    protected $packageTypeModel;

    /**
     * Instance of the main Request object.
     *
     * @var HTTP\IncomingRequest
     */
    protected $request;

    protected $helpers = ['auth', 'url', 'filesystem'];

    public function __construct()
    {
        $this->packageModel = new PackageModel();
        $this->galleryPackageModel = new GalleryPackageModel();
        $this->packageTypeModel = new PackageTypeModel();
    }

    /**
     * Present a view of resource objects
     *
     * @return mixed
     */
    public function index()
    {
        $contents = $this->packageModel->get_list_package()->getResultArray();
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
        $package = $this->packageModel->get_package_by_id($id)->getRowArray();
        if (empty($package)) {
            return redirect()->to(substr(current_url(), 0, -strlen($id)));
        }

        $list_gallery = $this->galleryPackageModel->get_gallery($id)->getResultArray();
        $galleries = array();
        foreach ($list_gallery as $gallery) {
            $galleries[] = $gallery['url'];
        }
        $package['gallery'] = $galleries;

        $data = [
            'title' => $package['name'],
            'data' => $package,
            'folder' => 'package'
        ];

        if (url_is('*dashboard*')) {
            return view('dashboard/detail_package', $data);
        }
        return view('web/detail_package', $data);
    }

    /**
     * Present a view to present a new single resource object
     *
     * @return mixed
     */
    public function new()
    {
        $type = $this->packageTypeModel->get_list_type()->getResultArray();
        $data = [
            'title' => 'New Package',
            'type' => $type
        ];
        return view('dashboard/package-form', $data);
    }

    /**
     * Process the creation/insertion of a new resource object.
     * This should be a POST.
     *
     * @return mixed
     */
    public function create()
    {
        $request = $this->request->getPost();

        $id = $this->packageModel->get_new_id();

        $requestData = [
            'id' => $id,
            'name' => $request['name'],
            'type_id' => $request['type'],
            'price' => $request['price'],
            'description' => $request['description'],
            'contact_person' => $request['contact_person'],
        ];
        foreach ($requestData as $key => $value) {
            if (empty($value)) {
                unset($requestData[$key]);
            }
        }

        $geom = $request['multipolygon'];
        $geojson = $request['geo-json'];

        if (isset($request['video'])) {
            $folder = $request['video'];
            $filepath = WRITEPATH . 'uploads/' . $folder;
            $filenames = get_filenames($filepath);
            $vidFile = new File($filepath . '/' . $filenames[0]);
            $vidFile->move(FCPATH . 'media/videos');
            delete_files($filepath);
            rmdir($filepath);
            $requestData['video_url'] = $vidFile->getFilename();
        }
        $addPA = $this->packageModel->add_new_package($requestData, $geom);

        if (isset($request['gallery'])) {
            $folders = $request['gallery'];
            $gallery = array();
            foreach ($folders as $folder) {
                $filepath = WRITEPATH . 'uploads/' . $folder;
                $filenames = get_filenames($filepath);
                $fileImg = new File($filepath . '/' . $filenames[0]);
                $fileImg->move(FCPATH . 'media/photos/package');
                delete_files($filepath);
                rmdir($filepath);
                $gallery[] = $fileImg->getFilename();
            }
            $this->galleryPackageModel->add_new_gallery($id, $gallery);
        }

        if ($addPA) {
            return redirect()->to(base_url('dashboard/package') . '/' . $id);
        } else {
            return redirect()->back()->withInput();
        }
    }

    public function edit($id = null)
    {
        $package = $this->packageModel->get_package_by_id($id)->getRowArray();
        if (empty($package)) {
            return redirect()->to('dashboard/package');
        }

        $list_gallery = $this->galleryPackageModel->get_gallery($id)->getResultArray();
        $galleries = array();
        foreach ($list_gallery as $gallery) {
            $galleries[] = $gallery['url'];
        }
        $package['gallery'] = $galleries;

        $type = $this->packageTypeModel->get_list_type()->getResultArray();

        $data = [
            'title' => 'Edit package',
            'data' => $package,
            'type' => $type
        ];
        return view('dashboard/package-form', $data);
    }

    /**
     * Process the updating, full or partial, of a specific resource object.
     * This should be a POST.
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function update($id = null)
    {
        $request = $this->request->getPost();
        $requestData = [
            'id' => $id,
            'name' => $request['name'],
            'type_id' => $request['type'],
            'price' => $request['price'],
            'description' => $request['description'],
            'contact_person' => $request['contact_person']
        ];
        foreach ($requestData as $key => $value) {
            if (empty($value)) {
                unset($requestData[$key]);
            }
        }

        $geom = $request['multipolygon'];
        // $geojson = $request['geo-json'];

        if (isset($request['video'])) {
            $folder = $request['video'];
            $filepath = WRITEPATH . 'uploads/' . $folder;
            $filenames = get_filenames($filepath);
            $vidFile = new File($filepath . '/' . $filenames[0]);
            $vidFile->move(FCPATH . 'media/videos');
            delete_files($filepath);
            rmdir($filepath);
            $requestData['video_url'] = $vidFile->getFilename();
        } else {
            $requestData['video_url'] = null;
        }
        $updatePA = $this->packageModel->update_package($id, $requestData);
        $updateGeom = $this->packageModel->update_geom($id, $geom);

        if (isset($request['gallery'])) {
            $folders = $request['gallery'];
            $gallery = array();
            foreach ($folders as $folder) {
                $filepath = WRITEPATH . 'uploads/' . $folder;
                $filenames = get_filenames($filepath);
                $fileImg = new File($filepath . '/' . $filenames[0]);
                $fileImg->move(FCPATH . 'media/photos/package');
                delete_files($filepath);
                rmdir($filepath);
                $gallery[] = $fileImg->getFilename();
            }
            $this->galleryPackageModel->update_gallery($id, $gallery);
        } else {
            $this->galleryPackageModel->delete_gallery($id);
        }

        if ($updatePA) {
            return redirect()->to(base_url('dashboard/package') . '/' . $id);
        } else {
            return redirect()->back()->withInput();
        }
    }
}
