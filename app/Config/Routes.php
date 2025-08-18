<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Route par défaut
$routes->get('/', 'Home::index');

// Route de débogage (temporaire)
$routes->get('debug', 'Debug::index');

// Routes principales
$routes->get('emplois', 'JobController::index');
$routes->get('emploi/(:segment)', 'JobController::show/$1');

// Redirection emplois/admin vers admin (pour éviter les 404)
$routes->get('emplois/admin', 'Admin::index');

// Routes en anglais pour les emplois
$routes->get('jobs', 'JobController::index');
$routes->get('job/(:segment)', 'JobController::show/$1');
$routes->get('consultants', 'Home::consultants');
$routes->get('mentoring', 'Home::mentoring');
$routes->get('entreprises', 'Home::entreprises');
$routes->get('contact', 'Home::contact');

// Routes d'authentification
$routes->get('connexion', 'Auth::login');
$routes->get('inscription', 'Auth::register');
$routes->post('auth/attemptLogin', 'Auth::attemptLogin');
$routes->post('auth/attemptRegister', 'Auth::attemptRegister');
$routes->get('auth/logout', 'Auth::logout');
$routes->get('auth/profile', 'Auth::profile');

// Routes du tableau de bord (protégées par authentification)
$routes->group('dashboard', ['namespace' => 'App\Controllers', 'filter' => 'auth'], function($routes) {
    $routes->get('/', 'Dashboard::index');
    $routes->get('profile', 'Dashboard::profile');
    $routes->get('settings', 'Dashboard::settings');
});

// Routes des pages de contenu
$routes->get('recrutement', 'Content::recrutement');
$routes->get('conseil', 'Content::conseil');
$routes->get('about', 'Content::about');

// Routes des pages légales
$routes->get('confidentialite', 'Legal::privacy');
$routes->get('conditions', 'Legal::terms');
$routes->get('mentions-legales', 'Legal::legal');

// Routes des ressources
$routes->get('opportunites', 'Resources::opportunities');
$routes->get('developpement', 'Resources::development');
$routes->get('reseau', 'Resources::network');
$routes->get('ressources', 'Resources::resources');

// Routes des services entreprises
$routes->get('recruter', 'Business::recruit');
$routes->get('conseil-entreprise', 'Business::consulting');
$routes->get('transformation', 'Business::transformation');
$routes->get('partenariats', 'Business::partnerships');

       

// Routes des erreurs
$routes->get('errors/404', 'Errors::notFound');
$routes->get('errors/500', 'Errors::serverError');

// service('auth')->routes($routes);

// Routes API (pour les agents IA et MCP)
$routes->group('api', ['namespace' => 'App\Controllers\Api'], function($routes) {
    $routes->get('jobs', 'Jobs::index');
    $routes->get('consultants', 'Consultants::index');
    $routes->post('contact', 'Contact::submit');
});

// Routes d'administration (à protéger)
$routes->group('admin', ['namespace' => 'App\Controllers', 'filter' => 'auth'], function($routes) {
    $routes->get('/', 'Admin::index');
    
    // Routes d'administration avec GroceryCRUD
    $routes->match(['get', 'post'], 'users(/.*)?', 'Admin::users');
    $routes->match(['get', 'post'], 'jobs(/.*)?', 'Admin::jobs');
    $routes->match(['get', 'post'], 'companies(/.*)?', 'Admin::companies');
    $routes->match(['get', 'post'], 'job-categories(/.*)?', 'Admin::jobCategories');
    
    // Route pour mettre à jour les slugs
    $routes->get('admin/update-slugs', 'Admin::updateCompanySlugs');
});

// Routes des agents IA et MCP
$routes->group('agents', ['namespace' => 'App\Controllers\Agents'], function($routes) {
    $routes->get('mcp', 'MCP::index');
    $routes->post('mcp/execute', 'MCP::execute');
    $routes->get('ai/chat', 'AI::chat');
    $routes->post('ai/process', 'AI::process');
});

