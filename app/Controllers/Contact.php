<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class Contact
 * Gère la page de contact et l'envoi des messages
 */
class Contact extends BaseController
{
    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.
    }

    /**
     * Affiche la page de contact
     */
    public function index()
    {
        $data = [
            'page_title' => 'Contact - Kladriva',
            'page_description' => 'Contactez Kladriva pour vos besoins en recrutement IT et conseil en croissance. Réponse dans les plus brefs délais.',
        ];

        return view('contact', $data);
    }

    /**
     * Traite l'envoi du formulaire de contact
     */
    public function send()
    {
        // Validation des données
        $rules = [
            'first_name' => 'required|min_length[2]|max_length[50]',
            'last_name' => 'required|min_length[2]|max_length[50]',
            'email' => 'required|valid_email',
            'phone' => 'permit_empty|min_length[10]|max_length[20]',
            'company' => 'permit_empty|max_length[100]',
            'position' => 'permit_empty|max_length[100]',
            'request_type' => 'required|in_list[recrutement,conseil,partenariat,autre]',
            'message' => 'required|min_length[20]|max_length[2000]',
            'consent' => 'required',
        ];

        $messages = [
            'first_name' => [
                'required' => 'Le prénom est requis.',
                'min_length' => 'Le prénom doit contenir au moins 2 caractères.',
                'max_length' => 'Le prénom ne peut pas dépasser 50 caractères.',
            ],
            'last_name' => [
                'required' => 'Le nom est requis.',
                'min_length' => 'Le nom doit contenir au moins 2 caractères.',
                'max_length' => 'Le nom ne peut pas dépasser 50 caractères.',
            ],
            'email' => [
                'required' => 'L\'email est requis.',
                'valid_email' => 'Veuillez saisir un email valide.',
            ],
            'phone' => [
                'min_length' => 'Le numéro de téléphone doit contenir au moins 10 chiffres.',
                'max_length' => 'Le numéro de téléphone ne peut pas dépasser 20 caractères.',
            ],
            'company' => [
                'max_length' => 'Le nom de l\'entreprise ne peut pas dépasser 100 caractères.',
            ],
            'position' => [
                'max_length' => 'Le poste ne peut pas dépasser 100 caractères.',
            ],
            'request_type' => [
                'required' => 'Veuillez sélectionner un type de demande.',
                'in_list' => 'Le type de demande sélectionné n\'est pas valide.',
            ],
            'message' => [
                'required' => 'Le message est requis.',
                'min_length' => 'Le message doit contenir au moins 20 caractères.',
                'max_length' => 'Le message ne peut pas dépasser 2000 caractères.',
            ],
            'consent' => [
                'required' => 'Vous devez accepter le traitement de vos données.',
            ],
        ];

        if (!$this->validate($rules, $messages)) {
            // Debug : Afficher les erreurs dans les logs
            $errors = $this->validator->getErrors();
            log_message('info', 'Erreurs de validation contact: ' . json_encode($errors));
            
            // Retourner les erreurs de validation avec les erreurs spécifiques
            return redirect()->back()
                ->withInput()
                ->with('error', 'Veuillez corriger les erreurs dans le formulaire.')
                ->with('errors', $errors);
        }

        // Récupération des données validées
        $data = [
            'first_name' => $this->request->getPost('first_name'),
            'last_name' => $this->request->getPost('last_name'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone'),
            'company' => $this->request->getPost('company'),
            'position' => $this->request->getPost('position'),
            'request_type' => $this->request->getPost('request_type'),
            'message' => $this->request->getPost('message'),
            'ip_address' => $this->request->getIPAddress(),
            'user_agent' => $this->request->getUserAgent()->getAgentString(),
            'created_at' => date('Y-m-d H:i:s'),
        ];

        try {
            // Enregistrement en base de données (optionnel)
            $this->saveContactMessage($data);
            
            // Envoi de l'email de notification
            $this->sendNotificationEmail($data);
            
            // Email de confirmation au client
            $this->sendConfirmationEmail($data);
            
            return redirect()->to('/contact')->with('success', 'Votre message a été envoyé avec succès ! Nous vous répondrons dans les plus brefs délais.');
            
        } catch (\Exception $e) {
            // Log de l'erreur
            log_message('error', 'Erreur lors de l\'envoi du message de contact: ' . $e->getMessage());
            
            return redirect()->back()->withInput()->with('error', 'Une erreur est survenue lors de l\'envoi de votre message. Veuillez réessayer ou nous contacter directement.');
        }
    }

    /**
     * Sauvegarde le message de contact en base de données
     */
    private function saveContactMessage($data)
    {
        // Si vous avez une table pour les messages de contact
        // $db = \Config\Database::connect();
        // $db->table('contact_messages')->insert($data);
        
        // Pour l'instant, on log juste les données
        log_message('info', 'Nouveau message de contact reçu: ' . json_encode($data));
    }

    /**
     * Envoie un email de notification à l'équipe
     */
    private function sendNotificationEmail($data)
    {
        // Configuration de l'email (à adapter selon votre configuration)
        $email = \Config\Services::email();
        
        // ADRESSE DE RÉCEPTION - MODIFIEZ ICI
        $teamEmail = 'contact@kladriva.ca'; // Votre adresse de réception principale
        $fromEmail = 'noreply@kladriva.ca'; // Adresse d'envoi (doit être configurée dans votre serveur)
        
        $subject = 'Nouveau message de contact - ' . $data['request_type'];
        $message = $this->buildNotificationEmail($data);
        
        $email->setFrom($fromEmail, 'Kladriva Contact');
        $email->setTo($teamEmail);
        $email->setSubject($subject);
        $email->setMessage($message);
        
        // Envoi de l'email (décommenter quand la configuration email sera prête)
        $email->send();
        
        // Log pour debug
        log_message('info', "Email de notification envoyé à: {$teamEmail}");
    }

    /**
     * Envoie un email de confirmation au client
     */
    private function sendConfirmationEmail($data)
    {
        $email = \Config\Services::email();
        
        // ADRESSE D'ENVOI - MODIFIEZ ICI
        $fromEmail = 'noreply@kladriva.ca'; // Adresse d'envoi (doit être configurée dans votre serveur)
        $fromName = 'Kladriva'; // Nom d'affichage
        
        $subject = 'Confirmation de votre message - Kladriva';
        $message = $this->buildConfirmationEmail($data);
        
        $email->setFrom($fromEmail, $fromName);
        $email->setTo($data['email']);
        $email->setSubject($subject);
        $email->setMessage($message);
        
        // Envoi de l'email (décommenter quand la configuration email sera prête)
        $email->send();
        
        // Log pour debug
        log_message('info', "Email de confirmation envoyé à: {$data['email']}");
    }

    /**
     * Construit le contenu de l'email de notification
     */
    private function buildNotificationEmail($data)
    {
        $requestTypes = [
            'recrutement' => 'Recrutement IT',
            'conseil' => 'Conseil en croissance',
            'partenariat' => 'Partenariat',
            'autre' => 'Autre demande'
        ];

        return "
        <h2>Nouveau message de contact reçu</h2>
        
        <h3>Informations du contact :</h3>
        <p><strong>Nom :</strong> {$data['first_name']} {$data['last_name']}</p>
        <p><strong>Email :</strong> {$data['email']}</p>
        " . ($data['phone'] ? "<p><strong>Téléphone :</strong> {$data['phone']}</p>" : "") . "
        " . ($data['company'] ? "<p><strong>Entreprise :</strong> {$data['company']}</p>" : "") . "
        " . ($data['position'] ? "<p><strong>Poste :</strong> {$data['position']}</p>" : "") . "
        <p><strong>Type de demande :</strong> " . $requestTypes[$data['request_type']] . "</p>
        
        <h3>Message :</h3>
        <p>" . nl2br(htmlspecialchars($data['message'])) . "</p>
        
        <hr>
        <p><small>Message reçu le {$data['created_at']} depuis l'IP {$data['ip_address']}</small></p>
        ";
    }

    /**
     * Construit le contenu de l'email de confirmation
     */
    private function buildConfirmationEmail($data)
    {
        return "
        <h2>Confirmation de votre message</h2>
        
        <p>Bonjour {$data['first_name']},</p>
        
        <p>Nous avons bien reçu votre message et nous vous en remercions.</p>
        
        <p><strong>Récapitulatif de votre demande :</strong></p>
        <ul>
            <li>Type de demande : " . ucfirst($data['request_type']) . "</li>
            <li>Date d'envoi : " . date('d/m/Y à H:i', strtotime($data['created_at'])) . "</li>
        </ul>
        
        <p>Notre équipe va étudier votre demande et vous répondra dans les plus brefs délais (généralement sous 24h).</p>
        
        <p>En attendant, n'hésitez pas à consulter nos services sur notre site :</p>
        <ul>
            <li><a href='" . base_url('jobs') . "'>Nos offres d'emploi</a></li>
            <li><a href='" . base_url('about') . "'>À propos de Kladriva</a></li>
        </ul>
        
        <p>Cordialement,<br>
        L'équipe Kladriva</p>
        
        <hr>
        <p><small>Cet email est envoyé automatiquement, merci de ne pas y répondre.</small></p>
        ";
    }
}
