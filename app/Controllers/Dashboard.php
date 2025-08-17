<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\Shield\Exceptions\LogicException;

class Dashboard extends Controller
{
    public function __construct()
    {
        // Charger le helper d'authentification
        helper('auth');
        
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
        // Utiliser le helper pour récupérer un utilisateur valide
        $user = require_valid_user();
        
        if ($user === null) {
            return redirect()->to('/connexion');
        }
        
        $data = [
            'title' => 'Tableau de bord - JobBoard',
            'user' => $user
        ];

        return view('dashboard/index', $data);
    }

    /**
     * Profil utilisateur
     */
    public function profile()
    {
        $user = require_valid_user();
        
        if ($user === null) {
            return redirect()->to('/connexion');
        }
        
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
        $user = require_valid_user();
        
        if ($user === null) {
            return redirect()->to('/connexion');
        }
        
        $data = [
            'title' => 'Paramètres - JobBoard',
            'user' => $user
        ];

        return view('dashboard/settings', $data);
    }
}
