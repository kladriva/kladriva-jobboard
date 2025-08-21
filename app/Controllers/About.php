<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class About extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'À propos de Kladriva - Nos Solutions IT',
            'description' => 'Découvrez Kladriva, votre partenaire pour le recrutement IT, le conseil en croissance et le mentoring. Solutions sur mesure pour entreprises et talents.',
            'page' => 'about'
        ];
        
        return view('about', $data);
    }
}