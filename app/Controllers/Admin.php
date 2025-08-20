<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\GroceryCrud;

class Admin extends BaseController
{
    public function index()
    {
        return view('admin_dashboard');
    }

    private function _handle_slug($stateParameters, $slug_generator_method)
    {
        // $stateParameters est un objet stdClass, et les données sont dans $stateParameters->data (qui est un tableau)
        if (empty($stateParameters->data['slug'])) {
            $stateParameters->data['slug'] = $this->{$slug_generator_method}($stateParameters->data['name']);
        }
        return $stateParameters;
    }

    private function _handle_timestamps($stateParameters, $is_insert = false)
    {
        $field = $is_insert ? 'created_at' : 'updated_at';
        // $stateParameters est un objet stdClass, et les données sont dans $stateParameters->data (qui est un tableau)
        if (empty($stateParameters->data[$field])) {
            $stateParameters->data[$field] = date('Y-m-d H:i:s');
        }
        return $stateParameters;
    }

    private function _handle_job_slug($stateParameters)
    {
        // $stateParameters est un objet stdClass, et les données sont dans $stateParameters->data (qui est un tableau)
        if (empty($stateParameters->data['slug'])) {
            $stateParameters->data['slug'] = $this->generateSlug($stateParameters->data['title']);
        }
        return $stateParameters;
    }

    public function users()
    {
        $crud = new GroceryCrud();
        $crud->setTable('users');
        $crud->setSubject('Utilisateur', 'Utilisateurs');
        $crud->columns(['username', 'email', 'created_at']);
        $crud->requiredFields(['username', 'email']);
        $crud->callbackBeforeInsert(function($post_array) { return $this->_handle_timestamps($post_array, true); });
        $crud->callbackBeforeUpdate(function($post_array) { return $this->_handle_timestamps($post_array, false); });
        $crud->displayAs('first_name', 'Prénom')->displayAs('last_name', 'Nom')->displayAs('updated_at', 'Dernière modification');
        $crud->addFields(['username', 'email', 'first_name', 'last_name']);
        $crud->editFields(['username', 'email', 'first_name', 'last_name']);
        $output = $crud->render();
        return view('admin_view', (array)$output);
    }

    public function jobs()
    {
        $crud = new GroceryCrud();
        $crud->setTable('jobs');
        $crud->setSubject('Emploi', 'Emplois');
        $crud->columns(['title', 'company_id', 'category_id', 'location', 'contract_type', 'status', 'created_at']);
        $crud->requiredFields(['title', 'description', 'location', 'company_id', 'category_id']);
        $crud->fieldType('status', 'dropdown', ['draft' => 'Brouillon', 'published' => 'Publié', 'closed' => 'Fermé', 'archived' => 'Archivé']);
        $crud->fieldType('contract_type', 'dropdown', ['cdi' => 'CDI', 'cdd' => 'CDD', 'freelance' => 'Freelance', 'stage' => 'Stage', 'alternance' => 'Alternance']);
        $crud->fieldType('experience_level', 'dropdown', ['junior' => 'Junior', 'mid' => 'Intermédiaire', 'senior' => 'Senior', 'expert' => 'Expert']);
        $crud->fieldType('location_type', 'dropdown', ['remote' => 'Télétravail', 'hybrid' => 'Hybride', 'onsite' => 'Sur site']);
        $crud->setRelation('company_id', 'companies', 'name');
        $crud->setRelation('category_id', 'job_categories', 'name');
        $crud->fieldType('description', 'text');
        $crud->fieldType('requirements', 'text');
        $crud->fieldType('benefits', 'text');
        $crud->fieldType('skills_required', 'text');
        $crud->fieldType('technologies', 'text');
        $crud->fieldType('slug', 'hidden');
        $crud->fieldType('salary_currency', 'dropdown', ['EUR' => 'Euros', 'USD' => 'Dollars', 'GBP' => 'Livres']);
        $crud->fieldType('salary_period', 'dropdown', ['annuel' => 'Annuel', 'mensuel' => 'Mensuel', 'horaire' => 'Horaire']);
        $crud->displayAs('created_at', 'Date de création')
              ->displayAs('company_id', 'Entreprise')
              ->displayAs('category_id', 'Catégorie')
              ->displayAs('experience_level', 'Niveau d\'expérience')
              ->displayAs('location_type', 'Type de localisation')
              ->displayAs('salary_currency', 'Devise du salaire')
              ->displayAs('salary_period', 'Période du salaire');
        $crud->addFields(['title', 'slug', 'description', 'requirements', 'benefits', 'company_id', 'category_id', 'location', 'location_type', 'contract_type', 'experience_level', 'salary_min', 'salary_max', 'salary_currency', 'salary_period', 'skills_required', 'technologies', 'status']);
        $crud->editFields(['title', 'slug', 'description', 'requirements', 'benefits', 'company_id', 'category_id', 'location', 'location_type', 'contract_type', 'experience_level', 'salary_min', 'salary_max', 'salary_currency', 'salary_period', 'skills_required', 'technologies', 'status']);
        $crud->callbackBeforeInsert(function($post_array) { 
            $post_array = $this->_handle_timestamps($post_array, true);
            return $this->_handle_job_slug($post_array);
        });
        $crud->callbackBeforeUpdate(function($post_array) { 
            $post_array = $this->_handle_timestamps($post_array, false);
            return $this->_handle_job_slug($post_array);
        });
        $output = $crud->render();
        return view('admin_view', (array)$output);
    }

    public function companies()
    {
        $crud = new GroceryCrud();
        $crud->setTable('companies');
        $crud->setSubject('Entreprise', 'Entreprises');
        $crud->columns(['name', 'slug', 'industry', 'location', 'created_at']);
        $crud->requiredFields(['name']);
        $crud->fieldType('slug', 'hidden');
        $crud->fieldType('size', 'dropdown', ['startup' => 'Startup (1-10)', 'small' => 'Petite (11-50)', 'medium' => 'Moyenne (51-200)', 'large' => 'Grande (201-1000)', 'enterprise' => 'Entreprise (1000+)']);
        $crud->fieldType('description', 'text');
        $crud->displayAs('created_at', 'Date de création')->displayAs('slug', 'Slug URL');
        $crud->addFields(['name', 'slug', 'description', 'industry', 'size', 'location']);
        $crud->editFields(['name', 'slug', 'description', 'industry', 'size', 'location']);
        $crud->callbackBeforeInsert(function($post_array) { 
            $post_array = $this->_handle_timestamps($post_array, true);
            return $this->_handle_slug($post_array, 'generateCompanySlug');
        });
        $crud->callbackBeforeUpdate(function($post_array) { 
            $post_array = $this->_handle_timestamps($post_array, false);
            return $this->_handle_slug($post_array, 'generateCompanySlug');
        });
        $output = $crud->render();
        return view('admin_view', (array)$output);
    }

    public function jobCategories()
    {
        $crud = new GroceryCrud();
        $crud->setTable('job_categories');
        $crud->setSubject('Catégorie d\'emploi', 'Catégories d\'emplois');
        $crud->columns(['name', 'slug', 'icon', 'color', 'created_at']);
        $crud->requiredFields(['name']);
        $crud->fieldType('is_active', 'dropdown', ['1' => 'Actif', '0' => 'Inactif']);
        $crud->fieldType('color', 'text');
        $crud->fieldType('icon', 'dropdown', ['fas fa-code' => 'Code', 'fas fa-laptop-code' => 'Développement', 'fas fa-database' => 'Base de données', 'fas fa-server' => 'Infrastructure', 'fas fa-mobile-alt' => 'Mobile', 'fas fa-cloud' => 'Cloud', 'fas fa-robot' => 'IA/ML', 'fas fa-shield-alt' => 'Sécurité', 'fas fa-chart-line' => 'Data', 'fas fa-users' => 'Management']);
        $crud->displayAs('created_at', 'Date de création')->displayAs('color', 'Couleur')->displayAs('icon', 'Icône')->displayAs('slug', 'Slug URL');
        $crud->addFields(['name', 'slug', 'icon', 'color', 'is_active']);
        $crud->editFields(['name', 'slug', 'icon', 'color', 'is_active']);
        $crud->callbackBeforeInsert(function($post_array) { 
            $post_array = $this->_handle_timestamps($post_array, true);
            return $this->_handle_slug($post_array, 'generateCategorySlug');
        });
        $crud->callbackBeforeUpdate(function($post_array) { 
            $post_array = $this->_handle_timestamps($post_array, false);
            return $this->_handle_slug($post_array, 'generateCategorySlug');
        });
        $output = $crud->render();
        return view('admin_view', (array) $output);
    }

    private function generateSlug($title){$slug=strtolower(trim($title));$slug=preg_replace('/[^a-z0-9\s-]/','',$slug);$slug=preg_replace('/[\s-]+/','-',$slug);$slug=trim($slug,'-');if(empty($slug)){$slug='emploi-'.time();}return $slug;}
    private function generateCompanySlug($companyName){$slug=strtolower(trim($companyName));$slug=preg_replace('/[^a-z0-9\s-]/','',$slug);$slug=preg_replace('/[\s-]+/','-',$slug);$slug=trim($slug,'-');if(empty($slug)){$slug='entreprise-'.time();}return $slug;}
    private function generateCategorySlug($categoryName){$slug=strtolower(trim($categoryName));$slug=preg_replace('/[^a-z0-9\s-]/','',$slug);$slug=preg_replace('/[\s-]+/','-',$slug);$slug=trim($slug,'-');if(empty($slug)){$slug='categorie-'.time();}return $slug;}

    public function updateCompanySlugs()
    {
        $db = \Config\Database::connect();
        $companies = $db->table('companies')->where('slug IS NULL OR slug = ""')->get()->getResultArray();
        $updated = 0;
        foreach ($companies as $company) {
            $slug = $this->generateCompanySlug($company['name']);
            $existingSlug = $db->table('companies')->where('slug', $slug)->where('id !=', $company['id'])->get()->getRow();
            if ($existingSlug) {
                $slug = $slug . '-' . $company['id'];
            }
            $db->table('companies')->where('id', $company['id'])->update(['slug' => $slug]);
            $updated++;
        }
        return "✅ $updated entreprises mises à jour avec des slugs";
    }
}