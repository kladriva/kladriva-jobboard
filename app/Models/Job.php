<?php

namespace App\Models;

use CodeIgniter\Model;

class Job extends Model
{
    protected $table = 'jobs';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    
    protected $allowedFields = [
        'title', 'slug', 'company_id', 'category_id', 'description', 'requirements',
        'benefits', 'salary_min', 'salary_max', 'salary_currency', 'salary_period',
        'location', 'location_type', 'contract_type', 'experience_level',
        'skills_required', 'technologies', 'status', 'is_featured', 'is_urgent',
        'published_at', 'expires_at'
    ];
    
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    
    // Validation
    protected $validationRules = [
        'title' => 'required|min_length[10]|max_length[200]',
        'company_id' => 'required|integer',
        'category_id' => 'required|integer',
        'description' => 'required|min_length[50]',
        'location' => 'required|min_length[3]',
        'contract_type' => 'required|in_list[cdi,cdd,freelance,stage,alternance]'
    ];
    
    // Relations
    public function getJobWithRelations($id)
    {
        return $this->select('jobs.*, companies.name as company_name, companies.logo as company_logo, 
                              companies.industry as company_industry, job_categories.name as category_name, 
                              job_categories.color as category_color')
                    ->join('companies', 'companies.id = jobs.company_id')
                    ->join('job_categories', 'job_categories.id = jobs.category_id')
                    ->where('jobs.id', $id)
                    ->where('jobs.status', 'published')
                    ->first();
    }
    
    public function getPublishedJobs($filters = [])
    {
        $builder = $this->select('jobs.*, companies.name as company_name, companies.logo as company_logo, 
                                  job_categories.name as category_name, job_categories.color as category_color')
                        ->join('companies', 'companies.id = jobs.company_id')
                        ->join('job_categories', 'job_categories.id = jobs.category_id')
                        ->where('jobs.status', 'published')
                        ->where('jobs.published_at <=', date('Y-m-d H:i:s'));
        
        // Filtres
        if (!empty($filters['category'])) {
            $builder->where('jobs.category_id', $filters['category']);
        }
        if (!empty($filters['location'])) {
            $builder->like('jobs.location', $filters['location']);
        }
        if (!empty($filters['contract_type'])) {
            $builder->where('jobs.contract_type', $filters['contract_type']);
        }
        if (!empty($filters['experience'])) {
            $builder->where('jobs.experience_level', $filters['experience']);
        }
        if (!empty($filters['search'])) {
            $builder->groupStart()
                    ->like('jobs.title', $filters['search'])
                    ->orLike('jobs.description', $filters['search'])
                    ->orLike('jobs.skills_required', $filters['search'])
                    ->groupEnd();
        }
        
        return $builder->orderBy('jobs.is_featured', 'DESC')
                      ->orderBy('jobs.published_at', 'DESC')
                      ->paginate(12);
    }
    
    public function incrementViews($id)
    {
        return $this->set('views_count', 'views_count + 1', false)
                    ->where('id', $id)
                    ->update();
    }
}
