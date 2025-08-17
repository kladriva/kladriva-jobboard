<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Dashboard extends Controller
{
    public function __construct()
    {
        // Vérifier que l'utilisateur est connecté
        if (!service('auth')->loggedIn()) {
            return redirect()->to('connexion');
        }
    }

    /**
     * Tableau de bord principal
     */
    public function index()
    {
        $user = service('auth')->getUser();
        
        $data = [
            'title' => 'Tableau de bord - JobBoard',
            'user' => $user,
            'stats' => $this->getUserStats($user->id),
            'recent_activities' => $this->getRecentActivities($user->id),
            'recommendations' => $this->getRecommendations($user->id)
        ];

        return view('dashboard/index', $data);
    }

    /**
     * Profil utilisateur
     */
    public function profile()
    {
        $user = service('auth')->getUser();
        
        $data = [
            'title' => 'Mon Profil - JobBoard',
            'user' => $user
        ];

        return view('dashboard/profile', $data);
    }

    /**
     * Paramètres utilisateur
     */
    public function settings()
    {
        $user = service('auth')->getUser();
        
        $data = [
            'title' => 'Paramètres - JobBoard',
            'user' => $user
        ];

        return view('dashboard/settings', $data);
    }

    /**
     * Obtenir les statistiques de l'utilisateur
     */
    private function getUserStats($userId)
    {
        // Simulation de statistiques (à remplacer par de vraies données)
        return [
            'profile_completion' => 85,
            'applications_sent' => 12,
            'interviews_scheduled' => 3,
            'offers_received' => 1,
            'skills_verified' => 8,
            'connections_made' => 24
        ];
    }

    /**
     * Obtenir les activités récentes
     */
    private function getRecentActivities($userId)
    {
        // Simulation d'activités récentes (à remplacer par de vraies données)
        return [
            [
                'type' => 'application',
                'title' => 'Candidature envoyée',
                'description' => 'Développeur Full Stack chez TechCorp',
                'date' => 'Il y a 2 heures',
                'icon' => 'fas fa-paper-plane',
                'color' => 'primary'
            ],
            [
                'type' => 'interview',
                'title' => 'Entretien programmé',
                'description' => 'Entretien technique avec DataSoft',
                'date' => 'Il y a 1 jour',
                'icon' => 'fas fa-calendar-check',
                'color' => 'success'
            ],
            [
                'type' => 'skill',
                'title' => 'Compétence vérifiée',
                'description' => 'React.js certifié',
                'date' => 'Il y a 3 jours',
                'icon' => 'fas fa-certificate',
                'color' => 'warning'
            ],
            [
                'type' => 'connection',
                'title' => 'Nouvelle connexion',
                'description' => 'Marie Dupont, Senior Developer',
                'date' => 'Il y a 5 jours',
                'icon' => 'fas fa-user-plus',
                'color' => 'info'
            ]
        ];
    }

    /**
     * Obtenir les recommandations
     */
    private function getRecommendations($userId)
    {
        // Simulation de recommandations (à remplacer par de vraies données)
        return [
            [
                'type' => 'job',
                'title' => 'Développeur Backend Python',
                'company' => 'InnovTech',
                'location' => 'Paris, France',
                'salary' => '65k-80k €',
                'match' => 92,
                'logo' => 'fas fa-building'
            ],
            [
                'type' => 'skill',
                'title' => 'Certification AWS',
                'description' => 'Améliorez votre profil cloud',
                'duration' => '3 mois',
                'cost' => 'Gratuit',
                'match' => 88,
                'icon' => 'fab fa-aws'
            ],
            [
                'type' => 'mentor',
                'title' => 'Jean Martin',
                'role' => 'CTO chez ScaleUp',
                'expertise' => 'Architecture microservices',
                'rating' => 4.9,
                'match' => 85,
                'avatar' => 'fas fa-user-tie'
            ]
        ];
    }
}
