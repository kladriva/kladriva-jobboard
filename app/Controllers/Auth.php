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

    /**
     * Affiche les informations de l'utilisateur connecté (pour debug)
     */
    public function userInfo(): string
    {
        if (!$this->auth->loggedIn()) {
            return redirect()->to('login');
        }

        $user = $this->auth->getUser();
        $identities = $user->identities();
        
        echo "<h2>Informations de l'utilisateur connecté</h2>";
        echo "<p><strong>ID:</strong> " . $user->id . "</p>";
        echo "<p><strong>Username:</strong> " . $user->username . "</p>";
        echo "<p><strong>Email:</strong> " . ($user->email ?? 'Non défini') . "</p>";
        echo "<p><strong>Date de création:</strong> " . $user->created_at . "</p>";
        
        echo "<h3>Identités :</h3>";
        if (!empty($identities)) {
            foreach ($identities as $identity) {
                echo "<p><strong>Type:</strong> " . $identity->type . "</p>";
                echo "<p><strong>Secret:</strong> " . $identity->secret . "</p>";
                echo "<p><strong>Date de création:</strong> " . $identity->identity->created_at . "</p>";
                echo "<hr>";
            }
        } else {
            echo "<p>Aucune identité trouvée</p>";
        }
        
        echo "<p><a href='" . base_url('/') . "'>Retour à l'accueil</a></p>";
        
        return '';
    }

    /**
     * Met à jour le profil utilisateur
     */
    public function updateProfile(): RedirectResponse
    {
        if (!$this->auth->loggedIn()) {
            return redirect()->to('login');
        }

        // Validation des données
        $rules = [
            'username' => 'required|min_length[3]|max_length[50]',
            'first_name' => 'permit_empty|max_length[100]',
            'last_name' => 'permit_empty|max_length[100]',
            'phone' => 'permit_empty|max_length[20]',
            'location' => 'permit_empty|max_length[200]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->with('error', 'Veuillez corriger les erreurs ci-dessous')
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        try {
            // Utiliser notre modèle User personnalisé
            $userModel = new \App\Models\UserModel();
            $user = $this->auth->getUser();
            
            // Debug : Afficher les données reçues
            log_message('info', 'Données reçues pour mise à jour profil : ' . json_encode($this->request->getPost()));
            
            // Préparer les données à mettre à jour
            $updateData = [
                'username' => $this->request->getPost('username'),
                'first_name' => $this->request->getPost('first_name'),
                'last_name' => $this->request->getPost('last_name'),
                'phone' => $this->request->getPost('phone'),
                'location' => $this->request->getPost('location')
            ];

            // Debug : Afficher les données préparées
            log_message('info', 'Données préparées pour mise à jour : ' . json_encode($updateData));
            log_message('info', 'ID utilisateur : ' . $user->id);

            // Mettre à jour l'utilisateur avec notre méthode personnalisée
            $success = $userModel->updateProfile($user->id, $updateData);

            if ($success) {
                // Log de la mise à jour
                log_message('info', 'Profil mis à jour pour l\'utilisateur : ' . $user->username . ' (ID: ' . $user->id . ')');
                
                return redirect()->to('auth/profile')
                    ->with('success', 'Profil mis à jour avec succès !');
            } else {
                throw new \Exception('Échec de la mise à jour en base de données');
            }

        } catch (\Exception $e) {
            log_message('error', 'Erreur lors de la mise à jour du profil : ' . $e->getMessage());
            
            return redirect()->back()
                ->with('error', 'Erreur lors de la mise à jour du profil : ' . $e->getMessage())
                ->withInput();
        }
    }
}
