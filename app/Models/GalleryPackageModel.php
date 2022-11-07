<?php

namespace App\Models;

use CodeIgniter\Model;

class GalleryPackageModel extends Model
{
    protected $DBGroup = 'default';
    protected $table = 'gallery_package';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields    = ['id', 'package_id', 'url'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    public function get_gallery($package_id = null)
    {
        $query = $this->db->table($this->table)
            ->select('url')
            ->where('package_id', $package_id)
            ->orderBy('id', 'ASC')
            ->get();
        return $query;
    }
}
