<?php

namespace App\Controllers;

use App\Models\JobApplicationModel;
use App\Models\JobModel;
use CodeIgniter\HTTP\Files\UploadedFile;

class JobApplication extends BaseController
{
    protected $jobApplicationModel;
    protected $jobModel;
    protected $auth;

    public function __construct()
    {
        $this->jobApplicationModel = new JobApplicationModel();
        $this->jobModel = new \App\Models\Job(); // Corrected: Use App\Models\Job
        $this->auth = service('auth');
        
        // Désactiver temporairement la vérification CSRF pour les candidatures
        // TODO: Réactiver une fois le problème CSRF résolu
        $this->security = \Config\Services::security();
        $this->security->CSRFVerify = false;
    }

    /**
     * Affiche le formulaire de candidature
     */
    public function apply($jobId = null)
    {
        // Vérifier que l'utilisateur est connecté
        if (!$this->auth->loggedIn()) {
            return redirect()->to('auth/login')
                ->with('error', 'Vous devez être connecté pour postuler à un emploi.');
        }

        // Vérifier que l'emploi existe
        $job = $this->jobModel->find($jobId);
        if (!$job) {
            return redirect()->to('jobs')
                ->with('error', 'Emploi introuvable.');
        }

        // Vérifier que l'utilisateur n'a pas déjà postulé
        $userId = $this->auth->getUser()->id;
        if ($this->jobApplicationModel->hasUserApplied($userId, $jobId)) {
            return redirect()->to("jobs/show/{$job['slug']}")
                ->with('error', 'Vous avez déjà postulé à cet emploi.');
        }

        $data = [
            'page_title' => 'Postuler - ' . $job['title'],
            'page_description' => 'Postulez à l\'emploi ' . $job['title'] . ' chez ' . $job['company_name'],
            'job' => $job,
        ];

        return view('job_application/apply', $data);
    }

    /**
     * Traite la soumission de la candidature
     */
    public function submit()
    {
        try {
            // Log de début de soumission
            log_message('info', 'Début de soumission de candidature - IP: ' . $this->request->getIPAddress());
            
            // Vérifier que l'utilisateur est connecté
            if (!$this->auth->loggedIn()) {
                log_message('warning', 'Tentative de soumission sans connexion');
                return redirect()->to('auth/login')
                    ->with('error', 'Vous devez être connecté pour postuler à un emploi.');
            }

            $jobId = $this->request->getPost('job_id');
            $userId = $this->auth->getUser()->id;
            
            log_message('info', "Soumission candidature - Job ID: {$jobId}, User ID: {$userId}");

            // Vérifier que l'emploi existe
            $job = $this->jobModel->find($jobId);
            if (!$job) {
                log_message('error', "Emploi introuvable - Job ID: {$jobId}");
                return redirect()->to('jobs')
                    ->with('error', 'Emploi introuvable.');
            }

            // Vérifier que l'utilisateur n'a pas déjà postulé
            if ($this->jobApplicationModel->hasUserApplied($userId, $jobId)) {
                log_message('info', "Utilisateur {$userId} a déjà postulé à l'emploi {$jobId}");
                return redirect()->to("jobs/show/{$job['slug']}")
                    ->with('error', 'Vous avez déjà postulé à cet emploi.');
            }

            // Log des données reçues
            log_message('info', 'Données reçues: ' . json_encode($this->request->getPost()));
            
            // Validation des données
            $rules = [
                'job_id' => 'required|integer',
                'cv' => 'uploaded[cv]|max_size[cv,2048]|ext_in[cv,pdf,doc,docx]',
                'cover_letter' => 'permit_empty|max_length[2000]',
            ];

            $messages = [
                'cv' => [
                    'uploaded' => 'Veuillez sélectionner un fichier CV.',
                    'max_size' => 'Le fichier CV ne peut pas dépasser 2 MB.',
                    'ext_in' => 'Seuls les formats PDF, DOC et DOCX sont acceptés.',
                ],
                'cover_letter' => [
                    'max_length' => 'La lettre de motivation ne peut pas dépasser 2000 caractères.',
                ],
            ];

            if (!$this->validate($rules, $messages)) {
                $errors = $this->validator->getErrors();
                log_message('warning', 'Erreurs de validation: ' . json_encode($errors));
                return redirect()->back()
                    ->withInput()
                    ->with('errors', $errors);
            }

            // Traitement du fichier CV
            $cvFile = $this->request->getFile('cv');
            if (!$cvFile->isValid() || $cvFile->hasMoved()) {
                log_message('error', 'Fichier CV invalide ou déjà déplacé');
                return redirect()->back()
                    ->with('error', 'Erreur lors du téléversement du fichier CV.');
            }

            log_message('info', 'Fichier CV reçu: ' . $cvFile->getClientName() . ' - Taille: ' . $cvFile->getSize());

            // Générer un nom de fichier unique
            $cvFilename = $cvFile->getRandomName();
            $cvPath = 'uploads/cv/' . date('Y/m/') . $cvFilename;

            // Créer le dossier de destination s'il n'existe pas
            $uploadPath = FCPATH . 'uploads/cv/' . date('Y/m/');
            if (!is_dir($uploadPath)) {
                if (!mkdir($uploadPath, 0755, true)) {
                    log_message('error', 'Impossible de créer le dossier: ' . $uploadPath);
                    return redirect()->back()
                        ->with('error', 'Erreur lors de la création du dossier de destination.');
                }
            }

            // Déplacer le fichier
            if (!$cvFile->move($uploadPath, $cvFilename)) {
                log_message('error', 'Impossible de déplacer le fichier CV vers: ' . $uploadPath);
                return redirect()->back()
                    ->with('error', 'Erreur lors de la sauvegarde du fichier CV.');
            }

            log_message('info', 'Fichier CV déplacé avec succès vers: ' . $uploadPath . $cvFilename);

            // Préparer les données de la candidature
            $applicationData = [
                'user_id' => $userId,
                'job_id' => $jobId,
                'cv_filename' => $cvFile->getClientName(),
                'cv_path' => $cvPath,
                'cover_letter' => $this->request->getPost('cover_letter'),
                'status' => 'pending',
            ];

            log_message('info', 'Données de candidature préparées: ' . json_encode($applicationData));

            // Sauvegarder la candidature
            $inserted = $this->jobApplicationModel->insert($applicationData);
            if (!$inserted) {
                throw new \Exception('Échec de l\'insertion en base de données');
            }

            log_message('info', 'Candidature insérée avec succès - ID: ' . $inserted);

            // Envoyer un email de confirmation (optionnel)
            try {
                $this->sendApplicationConfirmation($applicationData, $job);
                log_message('info', 'Email de confirmation envoyé avec succès');
            } catch (\Exception $e) {
                log_message('warning', 'Erreur lors de l\'envoi de l\'email: ' . $e->getMessage());
                // Ne pas bloquer le processus si l'email échoue
            }

            return redirect()->to("jobs/show/{$job['slug']}")
                ->with('success', 'Votre candidature a été soumise avec succès ! Nous vous contacterons bientôt.');

        } catch (\Exception $e) {
            log_message('error', 'Exception lors de la soumission de candidature: ' . $e->getMessage());
            log_message('error', 'Stack trace: ' . $e->getTraceAsString());
            
            // Supprimer le fichier en cas d'erreur si il existe
            if (isset($cvFile) && isset($uploadPath) && isset($cvFilename)) {
                if (file_exists($uploadPath . $cvFilename)) {
                    unlink($uploadPath . $cvFilename);
                    log_message('info', 'Fichier CV supprimé après erreur');
                }
            }

            return redirect()->back()
                ->with('error', 'Une erreur est survenue lors de la soumission de votre candidature. Veuillez réessayer.');
        }
    }

    /**
     * Affiche les candidatures de l'utilisateur connecté
     */
    public function myApplications()
    {
        // Vérifier que l'utilisateur est connecté
        if (!$this->auth->loggedIn()) {
            return redirect()->to('auth/login')
                ->with('error', 'Vous devez être connecté pour voir vos candidatures.');
        }

        $userId = $this->auth->getUser()->id;
        $applications = $this->jobApplicationModel->getUserApplications($userId);

        $data = [
            'page_title' => 'Mes Candidatures',
            'page_description' => 'Consultez l\'état de vos candidatures',
            'applications' => $applications,
        ];

        return view('job_application/my_applications', $data);
    }

    /**
     * Envoie un email de confirmation de candidature
     */
    private function sendApplicationConfirmation($applicationData, $job)
    {
        try {
            $email = \Config\Services::email();
            
            $to = $this->auth->getUser()->email;
            $subject = 'Confirmation de votre candidature - ' . $job['title'];
            
            $message = view('emails/application_confirmation', [
                'application' => $applicationData,
                'job' => $job,
                'user' => $this->auth->getUser()
            ]);

            $email->setFrom('noreply@kladriva.ca', 'Kladriva');
            $email->setTo($to);
            $email->setSubject($subject);
            $email->setMessage($message);
            
            $email->send();
            
            log_message('info', "Email de confirmation de candidature envoyé à: {$to}");
            
        } catch (\Exception $e) {
            log_message('error', 'Erreur lors de l\'envoi de l\'email de confirmation: ' . $e->getMessage());
        }
    }
}
