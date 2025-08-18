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

        // Configuration de base COMPLÈTE pour l'ajout/édition
        $crud->setTable('users');
        $crud->setSubject('Utilisateur', 'Utilisateurs');
        $crud->setPrimaryKey('id', 'users');
        
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

        // ACTIVER les opérations CRUD
        $crud->addFields(['username', 'email', 'first_name', 'last_name']);
        $crud->editFields(['username', 'email', 'first_name', 'last_name']);

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

            // Configuration de base COMPLÈTE pour l'ajout/édition
            $crud->setTable('jobs');
            $crud->setSubject('Emploi', 'Emplois');
            $crud->setPrimaryKey('id', 'jobs');
            
            // Colonnes affichées (simplifiées)
            $crud->columns(['title', 'company_id', 'category_id', 'location', 'contract_type', 'status', 'created_at']);
            
            // Champs requis minimaux
            $crud->requiredFields(['title', 'description', 'location', 'company_id', 'category_id']);
            
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
            
            // Configuration des relations (entreprises et catégories)
            $crud->setRelation('company_id', 'companies', 'name');
            $crud->setRelation('category_id', 'job_categories', 'name');
            
            // Configuration des champs de texte
            $crud->fieldType('description', 'text');
            
            // Personnalisation des labels
            $crud->displayAs('created_at', 'Date de création');
            $crud->displayAs('company_id', 'Entreprise');
            $crud->displayAs('category_id', 'Catégorie');
            
            // ACTIVER les opérations CRUD avec le champ slug
            $crud->addFields(['title', 'slug', 'description', 'company_id', 'category_id', 'location', 'contract_type', 'status']);
            $crud->editFields(['title', 'slug', 'description', 'company_id', 'category_id', 'location', 'contract_type', 'status']);
            
            // Callback simple pour générer le slug
            $crud->callbackBeforeInsert(function ($stateParameters) {
                if (empty($stateParameters['data']['slug'])) {
                    $stateParameters['data']['slug'] = $this->generateSlug($stateParameters['data']['title']);
                }
                return $stateParameters;
            });
            
            $crud->callbackBeforeUpdate(function ($stateParameters) {
                if (empty($stateParameters['data']['slug'])) {
                    $stateParameters['data']['slug'] = $this->generateSlug($stateParameters['data']['title']);
                }
                return $stateParameters;
            });
            
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
    
    /**
     * Génère un slug à partir d'un titre
     */
    private function generateSlug($title)
    {
        // Convertir en minuscules et remplacer les espaces par des tirets
        $slug = strtolower(trim($title));
        $slug = preg_replace('/[^a-z0-9\s-]/', '', $slug);
        $slug = preg_replace('/[\s-]+/', '-', $slug);
        $slug = trim($slug, '-');
        
        // Ajouter un timestamp si le slug est vide
        if (empty($slug)) {
            $slug = 'emploi-' . time();
        }
        
        return $slug;
    }
    
    /**
     * Génère un slug à partir du nom d'une entreprise
     */
    private function generateCompanySlug($companyName)
    {
        // Convertir en minuscules et remplacer les espaces par des tirets
        $slug = strtolower(trim($companyName));
        $slug = preg_replace('/[^a-z0-9\s-]/', '', $slug);
        $slug = preg_replace('/[\s-]+/', '-', $slug);
        $slug = trim($slug, '-');
        
        // Ajouter un timestamp si le slug est vide
        if (empty($slug)) {
            $slug = 'entreprise-' . time();
        }
        
        return $slug;
    }
    
    /**
     * Génère un slug à partir du nom d'une catégorie
     */
    private function generateCategorySlug($categoryName)
    {
        // Convertir en minuscules et remplacer les espaces par des tirets
        $slug = strtolower(trim($categoryName));
        $slug = preg_replace('/[^a-z0-9\s-]/', '', $slug);
        $slug = preg_replace('/[\s-]+/', '-', $slug);
        $slug = trim($slug, '-');
        
        // Ajouter un timestamp si le slug est vide
        if (empty($slug)) {
            $slug = 'categorie-' . time();
        }
        
        return $slug;
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

            // Configuration de base avec slug
            $crud->setTable('companies');
            $crud->setSubject('Entreprise', 'Entreprises');
            
            // Colonnes affichées
            $crud->columns(['name', 'slug', 'industry', 'location', 'created_at']);
            
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
            $crud->displayAs('slug', 'Slug URL');
            
            // Configuration avec slug
            $crud->addFields(['name', 'slug', 'description', 'industry', 'size', 'location']);
            $crud->editFields(['name', 'slug', 'description', 'industry', 'size', 'location']);
            
            // Callback simple pour générer le slug automatiquement
            $crud->callbackBeforeInsert(function ($stateParameters) {
                // Générer le slug si vide
                if (empty($stateParameters['data']['slug'])) {
                    $stateParameters['data']['slug'] = $this->generateCompanySlug($stateParameters['data']['name']);
                }
                return $stateParameters;
            });
            
            $crud->callbackBeforeUpdate(function ($stateParameters) {
                // Générer le slug si vide
                if (empty($stateParameters['data']['slug'])) {
                    $stateParameters['data']['slug'] = $this->generateCompanySlug($stateParameters['data']['name']);
                }
                return $stateParameters;
            });
            
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

            // Configuration de base COMPLÈTE pour l'ajout/édition
            $crud->setTable('job_categories');
            $crud->setSubject('Catégorie d\'emploi', 'Catégories d\'emplois');
            $crud->setPrimaryKey('id', 'job_categories');
            
            // Colonnes affichées (simplifiées)
            $crud->columns(['name', 'slug', 'icon', 'color', 'created_at']);
            
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
            $crud->displayAs('slug', 'Slug URL');
            
            // ACTIVER les opérations CRUD avec le champ slug
            $crud->addFields(['name', 'slug', 'icon', 'color', 'is_active']);
            $crud->editFields(['name', 'slug', 'icon', 'color', 'is_active']);
            
            // Callback pour générer automatiquement le slug
            $crud->callbackBeforeInsert(function ($stateParameters) {
                if (empty($stateParameters['data']['slug'])) {
                    $stateParameters['data']['slug'] = $this->generateCategorySlug($stateParameters['data']['name']);
                }
                return $stateParameters;
            });
            
            $crud->callbackBeforeUpdate(function ($stateParameters) {
                if (empty($stateParameters['data']['slug'])) {
                    $stateParameters['data']['slug'] = $this->generateCategorySlug($stateParameters['data']['name']);
                }
                return $stateParameters;
            });
            
            $output = $crud->render();
            return view('admin_view', $output);
            
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

    /**
     * Met à jour les slugs des entreprises existantes qui n'en ont pas
     */
    public function updateCompanySlugs()
    {
        try {
            $db = \Config\Database::connect();
            
            // Récupérer toutes les entreprises sans slug
            $companies = $db->table('companies')
                           ->where('slug IS NULL OR slug = ""')
                           ->get()
                           ->getResultArray();
            
            $updated = 0;
            foreach ($companies as $company) {
                $slug = $this->generateCompanySlug($company['name']);
                
                // Vérifier l'unicité
                $existingSlug = $db->table('companies')
                                  ->where('slug', $slug)
                                  ->where('id !=', $company['id'])
                                  ->get()
                                  ->getRow();
                
                if ($existingSlug) {
                    $slug = $slug . '-' . $company['id'];
                }
                
                $db->table('companies')
                   ->where('id', $company['id'])
                   ->update(['slug' => $slug]);
                
                $updated++;
            }
            
            return "✅ $updated entreprises mises à jour avec des slugs";
            
        } catch (Exception $e) {
            return "❌ Erreur : " . $e->getMessage();
        }
    }
}
