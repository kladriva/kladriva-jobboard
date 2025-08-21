<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de candidature - Kladriva</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f8f9fa;
        }
        .email-container {
            background-color: #ffffff;
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #e9ecef;
        }
        .logo {
            max-width: 150px;
            margin-bottom: 20px;
        }
        .title {
            color: #2563eb;
            font-size: 24px;
            font-weight: 700;
            margin: 0;
        }
        .greeting {
            font-size: 18px;
            color: #374151;
            margin-bottom: 25px;
        }
        .content {
            background-color: #f8f9fa;
            padding: 25px;
            border-radius: 8px;
            margin-bottom: 25px;
        }
        .job-details {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            border-left: 4px solid #2563eb;
            margin-bottom: 20px;
        }
        .job-title {
            font-size: 20px;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 10px;
        }
        .company-name {
            color: #2563eb;
            font-weight: 500;
            margin-bottom: 5px;
        }
        .application-date {
            color: #6b7280;
            font-size: 14px;
        }
        .next-steps {
            background-color: #dbeafe;
            padding: 20px;
            border-radius: 8px;
            border-left: 4px solid #3b82f6;
        }
        .next-steps h3 {
            color: #1e40af;
            margin-bottom: 15px;
            font-size: 18px;
        }
        .next-steps ul {
            margin: 0;
            padding-left: 20px;
        }
        .next-steps li {
            margin-bottom: 8px;
            color: #1e40af;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e9ecef;
            color: #6b7280;
            font-size: 14px;
        }
        .cta-button {
            display: inline-block;
            background-color: #2563eb;
            color: #ffffff;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 500;
            margin: 20px 0;
        }
        .cta-button:hover {
            background-color: #1d4ed8;
        }
        .info-box {
            background-color: #fef3c7;
            border: 1px solid #f59e0b;
            border-radius: 6px;
            padding: 15px;
            margin: 20px 0;
        }
        .info-box h4 {
            color: #92400e;
            margin-bottom: 10px;
            font-size: 16px;
        }
        .info-box p {
            color: #92400e;
            margin: 0;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1 class="title">Confirmation de candidature</h1>
        </div>
        
        <div class="greeting">
            Bonjour <?= esc($user->first_name ?? $user->username) ?>,
        </div>
        
        <p>Nous avons bien reçu votre candidature et nous vous en remercions !</p>
        
        <div class="content">
            <div class="job-details">
                <div class="job-title"><?= esc($job['title']) ?></div>
                <div class="company-name"><?= esc($job['company_name']) ?></div>
                <div class="application-date">
                    Candidature soumise le <?= date('d/m/Y à H:i', strtotime($application['created_at'])) ?>
                </div>
            </div>
            
            <div class="info-box">
                <h4>📋 Récapitulatif de votre candidature</h4>
                <p>
                    <strong>CV :</strong> <?= esc($application['cv_filename']) ?><br>
                    <?php if ($application['cover_letter']): ?>
                        <strong>Lettre de motivation :</strong> Incluse
                    <?php else: ?>
                        <strong>Lettre de motivation :</strong> Non incluse
                    <?php endif; ?>
                </p>
            </div>
            
            <div class="next-steps">
                <h3>🔄 Prochaines étapes</h3>
                <ul>
                    <li>Notre équipe va examiner votre candidature dans les plus brefs délais</li>
                    <li>Vous recevrez une réponse sous 5 à 10 jours ouvrables</li>
                    <li>En cas de présélection, nous vous contacterons pour un entretien</li>
                </ul>
            </div>
        </div>
        
        <p>En attendant, n'hésitez pas à :</p>
        <ul>
            <li>Consulter d'autres offres d'emploi sur notre plateforme</li>
            <li>Mettre à jour votre profil pour améliorer votre visibilité</li>
            <li>Suivre l'état de vos candidatures dans votre espace personnel</li>
        </ul>
        
        <div style="text-align: center; margin: 30px 0;">
            <a href="<?= base_url('jobs') ?>" class="cta-button">
                Voir nos autres offres
            </a>
        </div>
        
        <div style="text-align: center; margin: 30px 0;">
            <a href="<?= base_url('job-application/my-applications') ?>" class="cta-button" style="background-color: #059669;">
                Suivre mes candidatures
            </a>
        </div>
        
        <div class="footer">
            <p><strong>L'équipe Kladriva</strong></p>
            <p>Cet email est envoyé automatiquement, merci de ne pas y répondre.</p>
            <p>Pour toute question, contactez-nous à <a href="mailto:contact@kladriva.ca">contact@kladriva.ca</a></p>
        </div>
    </div>
</body>
</html>
