<?php

namespace App\Models;

use CodeIgniter\Model;

class Company extends Model
{
    protected $table = 'companies';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    
    protected $allowedFields = [
        'name', 'slug', 'description', 'logo', 'website', 'industry', 
        'size', 'location', 'is_active'
    ];
    
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    
    // Validation
    protected $validationRules = [
        'name' => 'required|min_length[2]|max_length[200]',
        'slug' => 'required|min_length[2]|max_length[200]|is_unique[companies.slug,id,{id}]',
        'description' => 'permit_empty|min_length[10]',
        'industry' => 'permit_empty|max_length[100]',
        'location' => 'permit_empty|max_length[200]'
    ];
    
    // Callbacks
    protected $beforeInsert = ['generateSlug'];
    protected $beforeUpdate = ['generateSlug'];
    
    protected function generateSlug(array $data)
    {
        if (isset($data['data']['name']) && empty($data['data']['slug'])) {
            $data['data']['slug'] = url_title($data['data']['name'], '-', true);
        }
        return $data;
    }
    
    public function getActiveCompanies()
    {
        return $this->where('is_active', true)
                    ->orderBy('name', 'ASC')
                    ->findAll();
    }
    
    public function getCompanyWithJobs($id)
    {
        return $this->select('companies.*, COUNT(jobs.id) as jobs_count')
                    ->join('jobs', 'jobs.company_id = companies.id', 'left')
                    ->where('companies.id', $id)
                    ->groupBy('companies.id')
                    ->first();
    }
}
