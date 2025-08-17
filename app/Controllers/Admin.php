<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\GroceryCrud;

/**
 * Contrôleur d'administration pour la gestion des emplois
 * Utilise GroceryCRUD pour une interface d'administration intuitive
 */
class Admin extends BaseController
{
    /**
     * Page d'accueil de l'administration
     * Affiche un tableau de bord simple
     */
    public function index()
    {
        return view('admin_dashboard');
    }

    // ===== GESTION DES UTILISATEURS =====
    
    /**
     * Gestion des utilisateurs avec GroceryCRUD
     * Permet de gérer les comptes utilisateurs et leurs rôles
     */
    public function users()
    {
        $crud = new GroceryCrud();

        $crud->setTable('users');
        $crud->setSubject('Utilisateur', 'Utilisateurs');
        // $crud->setPrimaryKey('id', 'users'); // Commenté si non supporté
        
        // Colonnes affichées (selon la structure de CodeIgniter Shield)
        $crud->columns(['username', 'email', 'created_at']);
        
        // Champs requis
        $crud->requiredFields(['username', 'email']);

        // Champs de texte long
        $crud->fieldType('first_name', 'text');
        $crud->fieldType('last_name', 'text');
        
        // Champs de date
        $crud->fieldType('created_at', 'datetime');
        $crud->fieldType('updated_at', 'datetime');
        
        // Callbacks automatiques
        $crud->callbackBeforeInsert(function ($stateParameters) {
            if (empty($stateParameters['data']['created_at'])) {
                $stateParameters['data']['created_at'] = date('Y-m-d H:i:s');
            }
            return $stateParameters;
        });
        
        $crud->callbackBeforeUpdate(function ($stateParameters) {
            if (empty($stateParameters['data']['updated_at'])) {
                $stateParameters['data']['updated_at'] = date('Y-m-d H:i:s');
            }
            return $stateParameters;
        });
        
        // Personnalisation des labels
        $crud->displayAs('first_name', 'Prénom');
        $crud->displayAs('last_name', 'Nom');
        $crud->displayAs('updated_at', 'Dernière modification');

    $output = $crud->render();
    return view('admin_view', (array)$output);
}

    // ===== GESTION DES EMPLOIS =====
    
    /**
     * CRUD complet pour la gestion des emplois
     * Permet de créer, modifier, supprimer et publier des offres d'emploi
     */
    public function jobs()
    {
        try {
            $crud = new GroceryCrud();

            // Configuration de base minimale
            $crud->setTable('jobs');
            $crud->setSubject('Emploi', 'Emplois');
            
            // Colonnes affichées (simplifiées)
            $crud->columns(['title', 'location', 'contract_type', 'status', 'created_at']);
            
            // Champs requis minimaux
            $crud->requiredFields(['title', 'description', 'location']);
            
            // Configuration des champs de type enum
            $crud->fieldType('status', 'dropdown', [
                'draft' => 'Brouillon',
                'published' => 'Publié',
                'closed' => 'Fermé',
                'archived' => 'Archivé'
            ]);
            
            $crud->fieldType('contract_type', 'dropdown', [
                'cdi' => 'CDI',
                'cdd' => 'CDD',
                'freelance' => 'Freelance',
                'stage' => 'Stage',
                'alternance' => 'Alternance'
            ]);
            
            // Configuration des champs de texte
            $crud->fieldType('description', 'text');
            
            // Personnalisation des labels
            $crud->displayAs('created_at', 'Date de création');
            
            // Rendu final
            $output = $crud->render();
            return view('admin_view', (array)$output);
            
        } catch (Exception $e) {
            // En cas d'erreur, afficher un message d'erreur dans le tableau de bord
            log_message('error', 'Erreur dans la gestion des emplois : ' . $e->getMessage());
            
            $data = [
                'error' => true,
                'message' => 'Erreur lors du chargement de la gestion des emplois',
                'details' => $e->getMessage(),
                'suggestion' => 'Vérifiez que la table "jobs" existe dans votre base de données et que GroceryCRUD est correctement installé.'
            ];
            
            return view('admin_dashboard', $data);
        }
    }

    // ===== GESTION DES ENTREPRISES =====
    
    /**
     * Gestion des entreprises avec GroceryCRUD
     * Version simplifiée pour la compatibilité
     */
    public function companies()
    {
        try {
            $crud = new GroceryCrud();

            $crud->setTable('companies');
            $crud->setSubject('Entreprise', 'Entreprises');
            
            // Colonnes affichées (simplifiées)
            $crud->columns(['name', 'industry', 'location', 'created_at']);
            
            // Champs requis
            $crud->requiredFields(['name']);
            
            // Configuration des tailles d'entreprise
            $crud->fieldType('size', 'dropdown', [
                'startup' => 'Startup (1-10)',
                'small' => 'Petite (11-50)',
                'medium' => 'Moyenne (51-200)',
                'large' => 'Grande (201-1000)',
                'enterprise' => 'Entreprise (1000+)'
            ]);
            
            // Champs de texte
            $crud->fieldType('description', 'text');
            
            // Personnalisation des labels
            $crud->displayAs('created_at', 'Date de création');
            
            $output = $crud->render();
            return view('admin_view', (array)$output);
            
        } catch (Exception $e) {
            log_message('error', 'Erreur dans la gestion des entreprises : ' . $e->getMessage());
            
            $data = [
                'error' => true,
                'message' => 'Erreur lors du chargement de la gestion des entreprises',
                'details' => $e->getMessage(),
                'suggestion' => 'Vérifiez que la table "companies" existe dans votre base de données.'
            ];
            
            return view('admin_dashboard', $data);
        }
    }

    // ===== GESTION DES CATÉGORIES D'EMPLOIS =====
    
    /**
     * Gestion des catégories d'emplois avec GroceryCRUD
     * Version simplifiée pour la compatibilité
     */
    public function jobCategories()
    {
        try {
            $crud = new GroceryCrud();

            $crud->setTable('job_categories');
            $crud->setSubject('Catégorie d\'emploi', 'Catégories d\'emplois');
            
            // Colonnes affichées (simplifiées)
            $crud->columns(['name', 'icon', 'color', 'created_at']);
            
            // Champs requis
            $crud->requiredFields(['name']);
            
            // Configuration des champs
            $crud->fieldType('is_active', 'dropdown', [
                '1' => 'Actif',
                '0' => 'Inactif'
            ]);
            $crud->fieldType('color', 'text');
            
            // Sélection des icônes FontAwesome
            $crud->fieldType('icon', 'dropdown', [
                'fas fa-code' => 'Code',
                'fas fa-laptop-code' => 'Développement',
                'fas fa-database' => 'Base de données',
                'fas fa-server' => 'Infrastructure',
                'fas fa-mobile-alt' => 'Mobile',
                'fas fa-cloud' => 'Cloud',
                'fas fa-robot' => 'IA/ML',
                'fas fa-shield-alt' => 'Sécurité',
                'fas fa-chart-line' => 'Data',
                'fas fa-users' => 'Management'
            ]);
            
            // Personnalisation des labels
            $crud->displayAs('created_at', 'Date de création');
            $crud->displayAs('color', 'Couleur');
            $crud->displayAs('icon', 'Icône');
            
            $output = $crud->render();
            return view('admin_view', (array)$output);
            
        } catch (Exception $e) {
            log_message('error', 'Erreur dans la gestion des catégories : ' . $e->getMessage());
            
            $data = [
                'error' => true,
                'message' => 'Erreur lors du chargement de la gestion des catégories',
                'details' => $e->getMessage(),
                'suggestion' => 'Vérifiez que la table "job_categories" existe dans votre base de données.'
            ];
            
            return view('admin_dashboard', $data);
        }
    }
}
