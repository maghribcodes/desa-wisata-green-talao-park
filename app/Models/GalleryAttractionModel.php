<?php

namespace App\Models;

use CodeIgniter\Model;

class GalleryAttractionModel extends Model
{
    protected $DBGroup = 'default';
    protected $table = 'gallery_attraction';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields    = ['id', 'attraction_id', 'url'];

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

    public function get_gallery($attraction_id = null)
    {
        $query = $this->db->table($this->table)
            ->select('url')
            ->orderBy('id', 'ASC')
            ->where('attraction_id', $attraction_id)
            ->get();
        return $query;
    }

    public function get_gallery2()
    {
        $query = $this->db->table($this->table)
            ->select('*')
            ->notLike('attraction_id', 'A0001')
            ->orderBy('id', 'ASC')
            // ->where('attraction_id', $attraction_id)
            ->get();
        return $query;
    }
}
