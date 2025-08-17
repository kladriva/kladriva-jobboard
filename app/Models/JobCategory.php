<?php

namespace App\Models;

use CodeIgniter\Model;

class JobCategory extends Model
{
    protected $table = 'job_categories';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    
    protected $allowedFields = [
        'name', 'slug', 'description', 'icon', 'color', 'is_active'
    ];
    
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    
    // Validation
    protected $validationRules = [
        'name' => 'required|min_length[2]|max_length[100]',
        'slug' => 'required|min_length[2]|max_length[100]|is_unique[job_categories.slug,id,{id}]',
        'color' => 'permit_empty|regex_match[/^#[0-9A-Fa-f]{6}$/]'
    ];
    
    // Callbacks
    protected $beforeInsert = ['generateSlug', 'setDefaultColor'];
    protected $beforeUpdate = ['generateSlug', 'setDefaultColor'];
    
    protected function generateSlug(array $data)
    {
        if (isset($data['data']['name']) && empty($data['data']['slug'])) {
            $data['data']['slug'] = url_title($data['data']['name'], '-', true);
        }
        return $data;
    }
    
    protected function setDefaultColor(array $data)
    {
        if (isset($data['data']['name']) && empty($data['data']['color'])) {
            // Couleurs par défaut basées sur votre charte graphique
            $defaultColors = [
                'var(--primary-500)', 'var(--secondary-500)', 'var(--accent-500)', 
                'var(--tertiary-500)', 'var(--info-500)'
            ];
            $data['data']['color'] = $defaultColors[array_rand($defaultColors)];
        }
        return $data;
    }
    
    public function getActiveCategories()
    {
        return $this->where('is_active', true)
                    ->orderBy('name', 'ASC')
                    ->findAll();
    }
    
    public function getCategoryWithJobCount()
    {
        return $this->select('job_categories.*, COUNT(jobs.id) as jobs_count')
                    ->join('jobs', 'jobs.category_id = job_categories.id', 'left')
                    ->where('job_categories.is_active', true)
                    ->groupBy('job_categories.id')
                    ->orderBy('jobs_count', 'DESC')
                    ->findAll();
    }
}
