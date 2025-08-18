<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Errors extends Controller
{
    public function notFound()
    {
        $data = [
            'page_title' => 'Page non trouvée - Kladriva',
            'page_description' => 'La page que vous recherchez n\'existe pas ou a été déplacée.'
        ];
        
        return view('errors/404', $data);
    }
    
    public function serverError()
    {
        $data = [
            'page_title' => 'Erreur serveur - Kladriva',
            'page_description' => 'Une erreur interne s\'est produite. Veuillez réessayer plus tard.'
        ];
        
        return view('errors/500', $data);
    }
}
