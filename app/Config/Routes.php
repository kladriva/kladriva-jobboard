<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Route par défaut
$routes->get('/', 'Home::index');

// Routes principales
$routes->get('emplois', 'Home::emplois');
$routes->get('consultants', 'Home::consultants');
$routes->get('mentoring', 'Home::mentoring');
$routes->get('entreprises', 'Home::entreprises');
$routes->get('contact', 'Home::contact');

// Routes d'authentification (à implémenter)
$routes->get('connexion', 'Auth::login');
$routes->get('inscription', 'Auth::register');

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

// Routes API (pour les agents IA et MCP)
$routes->group('api', ['namespace' => 'App\Controllers\Api'], function($routes) {
    $routes->get('jobs', 'Jobs::index');
    $routes->get('consultants', 'Consultants::index');
    $routes->post('contact', 'Contact::submit');
});

// Routes d'administration (à protéger)
$routes->group('admin', ['namespace' => 'App\Controllers\Admin', 'filter' => 'auth'], function($routes) {
    $routes->get('/', 'Dashboard::index');
    $routes->get('jobs', 'Jobs::index');
    $routes->get('consultants', 'Consultants::index');
    $routes->get('companies', 'Companies::index');
});

// Routes des agents IA et MCP
$routes->group('agents', ['namespace' => 'App\Controllers\Agents'], function($routes) {
    $routes->get('mcp', 'MCP::index');
    $routes->post('mcp/execute', 'MCP::execute');
    $routes->get('ai/chat', 'AI::chat');
    $routes->post('ai/process', 'AI::process');
});

