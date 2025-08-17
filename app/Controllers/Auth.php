<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\Shield\Authentication\Authenticators\Session;
use CodeIgniter\Shield\Models\UserModel;

class Auth extends Controller
{
    protected $auth;

    public function __construct()
    {
        $this->auth = service('auth');
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

        return view('auth/login');
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

        return view('auth/register');
    }

    /**
     * Traite l'inscription
     */
    public function attemptRegister(): RedirectResponse
    {
        $userModel = new UserModel();
        
        $user = new \CodeIgniter\Shield\Entities\User([
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
        ]);

        $userModel->save($user);

        // Connecter automatiquement l'utilisateur
        $this->auth->login($user);

        return redirect()->to('/')
            ->with('success', 'Compte créé avec succès !');
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
            'user' => $user
        ]);
    }
}
