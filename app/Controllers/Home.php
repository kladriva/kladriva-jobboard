<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Home extends Controller
{
    public function index()
    {
        // Données pour la page d'accueil
        $data = [
            'page_title' => 'Kladriva - Plateforme de Recrutement IT & Conseil en Croissance',
            'page_description' => 'Kladriva accélère la croissance des entreprises IT via des consultants sur mesure et un système de mentoring innovant. Découvrez nos opportunités de carrière et nos solutions de conseil.',
            'stats' => [
                'entreprises' => '500+',
                'consultants' => '2000+',
                'satisfaction' => '95%',
                'delai' => '24h'
            ],
            'services' => [
                [
                    'title' => 'Recrutement IT',
                    'description' => 'Trouvez les meilleurs talents IT pour votre équipe grâce à notre plateforme de recrutement intelligente et notre réseau de consultants qualifiés.',
                    'icon' => 'fas fa-user-tie',
                    'link' => '/recrutement'
                ],
                [
                    'title' => 'Conseil en Croissance',
                    'description' => 'Bénéficiez de l\'expertise de consultants expérimentés pour accélérer votre développement et optimiser vos processus.',
                    'icon' => 'fas fa-chart-line',
                    'link' => '/conseil'
                ],
                [
                    'title' => 'Mentoring & Formation',
                    'description' => 'Développez vos compétences avec notre programme de mentoring personnalisé et nos formations continues en technologies émergentes.',
                    'icon' => 'fas fa-graduation-cap',
                    'link' => '/mentoring'
                ]
            ],
            'testimonials' => [
                [
                    'content' => 'Kladriva nous a permis de trouver des développeurs talentueux en seulement 2 semaines. Leur approche personnalisée a fait toute la différence.',
                    'author' => 'Marie Dubois',
                    'title' => 'CTO, TechStartup'
                ],
                [
                    'content' => 'Grâce au programme de mentoring de Kladriva, j\'ai pu développer mes compétences en IA et obtenir une promotion dans les 6 mois.',
                    'author' => 'Thomas Martin',
                    'title' => 'Développeur Senior'
                ],
                [
                    'content' => 'L\'équipe de Kladriva a transformé notre processus de recrutement. Nous économisons maintenant 40% de temps et trouvons des candidats de meilleure qualité.',
                    'author' => 'Sophie Tremblay',
                    'title' => 'DRH, FinTech Solutions'
                ]
            ]
        ];

        return view('home', $data);
    }

    public function emplois()
    {
        // Page des emplois (à implémenter)
        return view('emplois', [
            'page_title' => 'Emplois IT - Kladriva',
            'page_description' => 'Découvrez les meilleures opportunités de carrière dans le secteur IT. Kladriva vous connecte aux entreprises qui recherchent vos compétences.'
        ]);
    }

    public function consultants()
    {
        // Page des consultants (à implémenter)
        return view('consultants', [
            'page_title' => 'Consultants IT - Kladriva',
            'page_description' => 'Trouvez les meilleurs consultants IT pour vos projets. Expertise, flexibilité et résultats garantis avec Kladriva.'
        ]);
    }

    public function mentoring()
    {
        // Page du mentoring (à implémenter)
        return view('mentoring', [
            'page_title' => 'Mentoring & Formation - Kladriva',
            'page_description' => 'Développez vos compétences avec notre programme de mentoring personnalisé et nos formations en technologies émergentes.'
        ]);
    }

    public function entreprises()
    {
        // Page des entreprises (à implémenter)
        return view('entreprises', [
            'page_title' => 'Solutions Entreprises - Kladriva',
            'page_description' => 'Accélérez la croissance de votre entreprise IT avec nos solutions de recrutement et de conseil sur mesure.'
        ]);
    }

    public function contact()
    {
        // Page de contact (à implémenter)
        return view('contact', [
            'page_title' => 'Contact - Kladriva',
            'page_description' => 'Contactez l\'équipe Kladriva pour discuter de vos besoins en recrutement IT et en conseil en croissance.'
        ]);
    }
}
