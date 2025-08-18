<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\Shield\Models\UserModel;
use App\Validation\AuthValidation;

class Auth extends BaseController
{
    protected $auth;

    public function __construct()
    {
        $this->auth = auth();
    }

    /**
     * Affiche le formulaire de connexion
     */
    public function login(): string
    {
        // Si l'utilisateur est déjà connecté, le rediriger
        if ($this->auth->loggedIn()) {
            return redirect()->to('/');
        }

        return view('auth/login', [
            'page_title' => 'Connexion - Kladriva',
            'page_description' => 'Connectez-vous à votre espace personnel Kladriva'
        ]);
    }

    /**
     * Traite la connexion
     */
    public function attemptLogin(): RedirectResponse
    {
        $credentials = [
            'email' => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
        ];

        // Tentative de connexion
        if ($this->auth->attempt($credentials)) {
            return redirect()->to('/');
        }

        // Échec de connexion
        return redirect()->back()
            ->with('error', 'Email ou mot de passe incorrect')
            ->withInput();
    }

    /**
     * Affiche le formulaire d'inscription
     */
    public function register(): string
    {
        // Si l'utilisateur est déjà connecté, le rediriger
        if ($this->auth->loggedIn()) {
            return redirect()->to('/');
        }

        return view('auth/register', [
            'page_title' => 'Inscription - Kladriva',
            'page_description' => 'Créez votre compte Kladriva et rejoignez notre communauté'
        ]);
    }

    /**
     * Traite l'inscription
     */
    public function attemptRegister(): RedirectResponse
    {
        // Utiliser notre classe de validation personnalisée
        $validation = new AuthValidation();
        $rules = $validation->getRegistrationRules();
        
        // Validation des données
        if (!$this->validate($rules)) {
            return redirect()->back()
                ->with('error', 'Veuillez corriger les erreurs ci-dessous')
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $userModel = new UserModel();
        
        // Créer l'utilisateur avec Shield (seulement username dans la table users)
        $user = new \CodeIgniter\Shield\Entities\User([
            'username' => $this->request->getPost('username'),
        ]);

        try {
            // Sauvegarder l'utilisateur (cela va déclencher saveEmailIdentity automatiquement)
            $userModel->save($user);
            
            // Récupérer l'utilisateur complet avec son ID depuis la base de données
            $user = $userModel->findById($userModel->getInsertID());
            
            // Créer l'identité email/mot de passe
            $user->createEmailIdentity([
                'email' => $this->request->getPost('email'),
                'password' => $this->request->getPost('password'),
            ]);

            // Connecter automatiquement l'utilisateur
            $this->auth->login($user);

            return redirect()->to('/')
                ->with('success', 'Compte créé avec succès !');
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Erreur lors de la création du compte. Veuillez réessayer.')
                ->withInput();
        }
    }

    /**
     * Déconnexion
     */
    public function logout(): RedirectResponse
    {
        $this->auth->logout();
        
        return redirect()->to('/')
            ->with('success', 'Vous avez été déconnecté avec succès.');
    }

    /**
     * Profil utilisateur
     */
    public function profile(): string
    {
        if (!$this->auth->loggedIn()) {
            return redirect()->to('login');
        }

        $user = $this->auth->getUser();
        
        return view('auth/profile', [
            'page_title' => 'Mon Profil - Kladriva',
            'page_description' => 'Gérez votre profil personnel Kladriva',
            'user' => $user
        ]);
    }
}
