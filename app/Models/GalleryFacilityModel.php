<?php

namespace App\Models;

use CodeIgniter\Model;

class GalleryFacilityModel extends Model
{
    protected $DBGroup = 'default';
    protected $table = 'gallery_facility';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields    = ['id', 'facility_id', 'url'];

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

    public function get_gallery($facility_id = null)
    {
        $query = $this->db->table($this->table)
            ->select('url')
            ->where('facility_id', $facility_id)
            ->get();
        return $query;
    }
}
