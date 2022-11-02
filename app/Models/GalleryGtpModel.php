<?php

namespace App\Models;

use CodeIgniter\Model;

class GalleryGtpModel extends Model
{
    protected $DBGroup = 'default';
    protected $table = 'gallery_gtp';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields    = ['id', 'gtp_id', 'url'];

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

    public function get_gallery($gtp_id = null)
    {
        $query = $this->db->table($this->table)
            ->select('url')
            ->orderBy('id', 'ASC')
            ->where('gtp_id', $gtp_id)
            ->get();
        return $query;
    }
}
