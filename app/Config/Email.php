<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Email extends BaseConfig
{
    /**
     * @var string
     */
    public string $fromEmail = 'noreply@kladriva.ca';

    /**
     * @var string
     */
    public string $fromName = 'Kladriva';

    /**
     * @var string
     */
    public string $protocol = 'smtp';

    /**
     * @var string
     */
    public string $SMTPHost = 'mail.kladriva.ca'; // Votre serveur SMTP
    
    // Alternatives selon votre hébergeur :
    // - 'smtp.kladriva.ca'
    // - 'mail.kladriva.ca'
    // - 'smtp.votre-hebergeur.com'
    // - 'localhost' (si sur le même serveur)

    /**
     * @var string
     */
    public string $SMTPUser = 'noreply@kladriva.ca'; // Votre email d'envoi

    /**
     * @var string
     */
    public string $SMTPPass = 'Phil1v21!!!'; // Votre mot de passe

    /**
     * @var int
     */
    public int $SMTPPort = 587; // Port standard pour TLS
    
    // Alternatives selon votre hébergeur :
    // - 587 (TLS recommandé)
    // - 465 (SSL)
    // - 25 (non sécurisé, déconseillé)

    /**
     * @var string
     */
    public string $SMTPCrypto = 'tls'; // Chiffrement TLS recommandé
    
    // Alternatives :
    // - 'tls' (recommandé)
    // - 'ssl' (si port 465)
    // - '' (pas de chiffrement, déconseillé)

    /**
     * @var bool
     */
    public bool $SMTPAuth = true;

    /**
     * @var bool
     */
    public bool $SMTPKeepAlive = false;

    /**
     * @var string
     */
    public string $mailType = 'html';

    /**
     * @var string
     */
    public string $charset = 'UTF-8';

    /**
     * @var bool
     */
    public bool $validate = false;

    /**
     * @var int
     */
    public int $priority = 3;

    /**
     * @var bool
     */
    public bool $CRLF = false;

    /**
     * @var string
     */
    public string $newline = "\r\n";

    /**
     * @var bool
     */
    public bool $BCCBatchMode = false;

    /**
     * @var int
     */
    public int $BCCBatchSize = 200;

    /**
     * @var bool
     */
    public bool $DSN = false;
}
