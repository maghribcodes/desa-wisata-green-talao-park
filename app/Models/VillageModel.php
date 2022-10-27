<?php

namespace App\Models;

use CodeIgniter\Model;

class VillageModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'gtp';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'id', 'name', 'type_of_tourism', 'address', 'open', 'close', 'ticket_price',
        'contact_person', 'description', 'geom'
    ];

    // Dates
    protected $useTimestamps = false;

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // API
    public function get_ulakan_api()
    {
        $coords = "ST_Y(ST_Centroid({$this->table}.geom)) AS lat, ST_X(ST_Centroid({$this->table}.geom)) AS lng";
        $query = $this->db->table($this->table)
            ->select("id, name, {$coords}")
            ->where('id', 'U0001')
            ->get();
        return $query;
    }

    public function get_desa_wisata_api()
    {
        $coords = "ST_Y(ST_Centroid({$this->table}.geom)) AS lat, ST_X(ST_Centroid({$this->table}.geom)) AS lng";
        $query = $this->db->table($this->table)
            ->select("id, name, {$coords}")
            ->where('id', 'GTP01')
            ->get();
        return $query;
    }

    public function get_gtp()
    {
        $query = $this->db->table($this->table)
            ->get();
        return $query;
    }

    public function get_geoJson_api($id = null)
    {
        $geoJson = "ST_AsGeoJSON({$this->table}.geom) AS geoJson";
        $query = $this->db->table($this->table)
            ->select("{$geoJson}")
            ->where('id', $id)
            ->get();
        return $query;
    }
}
