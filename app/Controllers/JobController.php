<?php

namespace App\Controllers;

use App\Models\Job;
use App\Models\Company;
use App\Models\JobCategory;

class JobController extends BaseController
{
    protected $jobModel;
    protected $companyModel;
    protected $categoryModel;
    
    public function __construct()
    {
        $this->jobModel = new Job();
        $this->companyModel = new Company();
        $this->categoryModel = new JobCategory();
        
        // Charger le helper URL
        helper('url');
        
        // Vérifier l'authentification pour toutes les méthodes
        if (!auth()->loggedIn()) {
            // Rediriger vers la page de connexion si non connecté
            return redirect()->to('/login')->with('error', 'Vous devez être connecté pour accéder aux emplois.');
        }
    }
    
    public function index()
    {
        $filters = [
            'category' => $this->request->getGet('category'),
            'location' => $this->request->getGet('location'),
            'contract_type' => $this->request->getGet('contract_type'),
            'experience' => $this->request->getGet('experience'),
            'search' => $this->request->getGet('search')
        ];
        
        // Construire la requête avec filtres
        $builder = $this->jobModel->select('jobs.*, companies.name as company_name, companies.logo as company_logo, 
                                          job_categories.name as category_name, job_categories.color as category_color')
                                 ->join('companies', 'companies.id = jobs.company_id')
                                 ->join('job_categories', 'job_categories.id = jobs.category_id')
                                 ->where('jobs.status', 'published');
        
        // Appliquer les filtres
        if (!empty($filters['category'])) {
            $builder->where('jobs.category_id', $filters['category']);
        }
        
        if (!empty($filters['location'])) {
            $builder->like('jobs.location', $filters['location']);
        }
        
        if (!empty($filters['search'])) {
            $builder->groupStart()
                    ->like('jobs.title', $filters['search'])
                    ->orLike('jobs.description', $filters['search'])
                    ->orLike('jobs.skills_required', $filters['search'])
                    ->groupEnd();
        }
        
        if (!empty($filters['contract_type'])) {
            $builder->where('jobs.contract_type', $filters['contract_type']);
        }
        
        if (!empty($filters['experience'])) {
            $builder->where('jobs.experience_level', $filters['experience']);
        }
        
        // Exécuter la requête
        $jobs = $builder->orderBy('jobs.created_at', 'DESC')
                        ->findAll();
        
        // Récupérer les informations de l'utilisateur connecté
        $user = auth()->user();
        
        $data = [
            'page_title' => 'Emplois IT - Trouvez votre prochaine opportunité',
            'page_description' => 'Découvrez les meilleures offres d\'emploi dans le secteur IT. Développeurs, chefs de projet, consultants - trouvez votre place chez les entreprises qui innovent.',
            'jobs' => $jobs,
            'categories' => $this->categoryModel->where('is_active', true)->findAll(),
            'pager' => null,
            'filters' => $filters,
            'user' => $user // Passer l'utilisateur connecté à la vue
        ];
        
        return view('jobs/index', $data);
    }
    
    public function show($slug)
    {
        // Récupérer l'emploi avec toutes les relations (incluant company_name)
        $job = $this->jobModel->getJobWithRelations(null, $slug);
        
        if (!$job) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Emploi non trouvé');
        }
        
        // Incrémenter le compteur de vues (optionnel, ne pas bloquer l'affichage)
        try {
            $this->jobModel->incrementViews($job['id']);
        } catch (\Exception $e) {
            // Log l'erreur mais ne pas bloquer l'affichage de l'emploi
            log_message('error', 'Erreur lors de l\'incrémentation des vues: ' . $e->getMessage());
        }
        
        // Récupérer les informations de l'utilisateur connecté (optionnel)
        $user = auth()->user();
        
        $data = [
            'page_title' => $job['title'] . ' - ' . $job['company_name'],
            'page_description' => substr(strip_tags($job['description']), 0, 160),
            'job' => $job,
            'related_jobs' => $this->getRelatedJobs($job['id'], $job['category_id']),
            'user' => $user // Passer l'utilisateur connecté à la vue (peut être null)
        ];
        
        return view('jobs/show', $data);
    }
    
    private function getRelatedJobs($currentJobId, $categoryId, $limit = 3)
    {
        return $this->jobModel->select('jobs.*, companies.name as company_name, companies.slug as company_slug')
                             ->join('companies', 'companies.id = jobs.company_id')
                             ->where('jobs.id !=', $currentJobId)
                             ->where('jobs.category_id', $categoryId)
                             ->where('jobs.status', 'published')
                             ->limit($limit)
                             ->find();
    }
}
