<?php

namespace App\Models;

use CodeIgniter\Model;

class AttractionModel extends Model
{
    protected $DBGroup = 'default';
    protected $table = 'attraction';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields    = ['id', 'name', 'type', 'price', 'description', 'video_url', 'geom', 'geom_area'];

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

    public function get_tracking()
    {
        $coords = "ST_Y(ST_Centroid({$this->table}.geom)) AS lat, ST_X(ST_Centroid({$this->table}.geom)) AS lng";
        $columns = "{$this->table}.id,{$this->table}.name,{$this->table}.type,{$this->table}.price,{$this->table}.description,{$this->table}.video_url";
        $query = $this->db->table($this->table)
            ->select("{$columns}, {$coords}")
            ->where('id', 'A0001')
            ->get();
        return $query;
    }

    public function get_list_attraction()
    {
        $coords = "ST_Y(ST_Centroid({$this->table}.geom)) AS lat, ST_X(ST_Centroid({$this->table}.geom)) AS lng";
        $columns = "{$this->table}.id,{$this->table}.name,{$this->table}.type,{$this->table}.price,{$this->table}.description,{$this->table}.video_url";
        $query = $this->db->table($this->table)
            ->select("{$columns}, {$coords}")
            ->get();
        return $query;
    }

    public function get_talao()
    {
        $coords = "ST_Y(ST_Centroid({$this->table}.geom)) AS lat, ST_X(ST_Centroid({$this->table}.geom)) AS lng";
        $columns = "{$this->table}.id,{$this->table}.name,{$this->table}.type,{$this->table}.price,{$this->table}.description,{$this->table}.video_url";
        $query = $this->db->table($this->table)
            ->select("{$columns}, {$coords}")
            ->notLike('id', 'A0001')
            ->get();
        return $query;
    }

    public function get_attraction_by_id($id = null)
    {
        $coords = "ST_Y(ST_Centroid({$this->table}.geom)) AS lat, ST_X(ST_Centroid({$this->table}.geom)) AS lng";
        $columns = "{$this->table}.id,{$this->table}.name,{$this->table}.type,{$this->table}.price,{$this->table}.description,{$this->table}.video_url";
        $geoJson = "ST_AsGeoJSON({$this->table}.geom) AS geoJson";
        $query = $this->db->table($this->table)
            ->select("{$columns}, {$coords}, {$geoJson}")
            ->where('id', $id)
            ->get();
        return $query;
    }

    public function get_geoJson($id = null)
    {
        $geoJson = "ST_AsGeoJSON({$this->table}.geom_area) AS geoJson";
        $query = $this->db->table($this->table)
            ->select("{$geoJson}")
            ->where('id', $id)
            ->get();
        return $query;
    }
}
