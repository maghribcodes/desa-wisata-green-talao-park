<?php

namespace App\Models;

use CodeIgniter\Model;

class GalleryEventModel extends Model
{
    protected $DBGroup = 'default';
    protected $table = 'gallery_event';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields    = ['id', 'event_id', 'url'];

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

    public function get_gallery($event_id = null)
    {
        $query = $this->db->table($this->table)
            ->select('url')
            ->where('event_id', $event_id)
            ->get();
        return $query;
    }
}
