<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Test extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Test Shield',
            'auth_service' => service('auth'),
            'is_logged_in' => service('auth')->loggedIn(),
            'current_user' => service('auth')->getUser(),
            'session_data' => session()->get(),
        ];

        return view('test/index', $data);
    }

    public function auth()
    {
        if (!service('auth')->loggedIn()) {
            return redirect()->to('connexion');
        }

        $data = [
            'title' => 'Test Authentification',
            'user' => service('auth')->getUser(),
            'permissions' => [
                'admin.access' => service('auth')->getUser()->can('admin.access'),
                'user.read' => service('auth')->getUser()->can('user.read'),
            ],
            'groups' => service('auth')->getUser()->getGroups(),
        ];

        return view('test/auth', $data);
    }
    
    public function layout()
    {
        $data = [
            'page_title' => 'Test Layout Refactorisé',
            'page_description' => 'Test de la nouvelle structure modulaire du layout',
            'auth_service' => service('auth'),
            'is_logged_in' => service('auth')->loggedIn(),
            'current_user' => service('auth')->getUser(),
        ];
        
        return view('test_layout', $data);
    }
    
    public function dropdown()
    {
        $data = [
            'page_title' => 'Test Dropdown',
            'page_description' => 'Test du menu dropdown utilisateur',
            'auth_service' => service('auth'),
            'is_logged_in' => service('auth')->loggedIn(),
            'current_user' => service('auth')->getUser(),
        ];
        
        return view('test_dropdown', $data);
    }
}
