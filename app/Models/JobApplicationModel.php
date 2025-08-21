<?php

namespace App\Models;

use CodeIgniter\Model;

class JobApplicationModel extends Model
{
    protected $table = 'job_applications';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'user_id',
        'job_id',
        'cv_filename',
        'cv_path',
        'cover_letter',
        'status',
        'notes'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Validation
    protected $validationRules = [
        'user_id' => 'required|integer',
        'job_id' => 'required|integer',
        'cv_filename' => 'required|max_length[255]',
        'cv_path' => 'required|max_length[500]',
    ];

    protected $validationMessages = [
        'user_id' => [
            'required' => 'L\'identifiant utilisateur est requis.',
            'integer' => 'L\'identifiant utilisateur doit être un nombre entier.',
        ],
        'job_id' => [
            'required' => 'L\'identifiant de l\'emploi est requis.',
            'integer' => 'L\'identifiant de l\'emploi doit être un nombre entier.',
        ],
        'cv_filename' => [
            'required' => 'Le nom du fichier CV est requis.',
            'max_length' => 'Le nom du fichier CV ne peut pas dépasser 255 caractères.',
        ],
        'cv_path' => [
            'required' => 'Le chemin du fichier CV est requis.',
            'max_length' => 'Le chemin du fichier CV ne peut pas dépasser 500 caractères.',
        ],
    ];

    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    /**
     * Vérifie si un utilisateur a déjà postulé à un emploi
     */
    public function hasUserApplied(int $userId, int $jobId): bool
    {
        return $this->where('user_id', $userId)
                    ->where('job_id', $jobId)
                    ->countAllResults() > 0;
    }

    /**
     * Récupère toutes les candidatures d'un utilisateur
     */
    public function getUserApplications(int $userId): array
    {
        return $this->select('job_applications.*, jobs.title as job_title, jobs.slug as job_slug, companies.name as company_name')
                    ->join('jobs', 'jobs.id = job_applications.job_id')
                    ->join('companies', 'companies.id = jobs.company_id')
                    ->where('job_applications.user_id', $userId)
                    ->orderBy('job_applications.created_at', 'DESC')
                    ->findAll();
    }

    /**
     * Récupère toutes les candidatures pour un emploi
     */
    public function getJobApplications(int $jobId): array
    {
        return $this->select('job_applications.*, users.username, users.first_name, users.last_name, users.email')
                    ->join('users', 'users.id = job_applications.user_id')
                    ->where('job_applications.job_id', $jobId)
                    ->orderBy('job_applications.created_at', 'DESC')
                    ->findAll();
    }

    /**
     * Met à jour le statut d'une candidature
     */
    public function updateStatus(int $applicationId, string $status, ?string $notes = null): bool
    {
        $data = ['status' => $status];
        if ($notes !== null) {
            $data['notes'] = $notes;
        }
        
        return $this->update($applicationId, $data);
    }
}
