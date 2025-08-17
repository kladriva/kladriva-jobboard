<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- SEO Meta Tags -->
    <title><?= isset($page_title) ? $page_title : 'Kladriva - Plateforme de Recrutement IT & Conseil en Croissance' ?></title>
    <meta name="description" content="<?= isset($page_description) ? $page_description : 'Kladriva accélère la croissance des entreprises IT via des consultants sur mesure et un système de mentoring innovant. Découvrez nos opportunités de carrière et nos solutions de conseil.' ?>">
    <meta name="keywords" content="recrutement IT, conseil en croissance, consultants IT, mentoring, développement de carrière, emploi tech, Québec, Canada">
    <meta name="author" content="Kladriva">
    <meta name="robots" content="index, follow">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= current_url() ?>">
    <meta property="og:title" content="<?= isset($page_title) ? $page_title : 'Kladriva - Plateforme de Recrutement IT & Conseil en Croissance' ?>">
    <meta property="og:description" content="<?= isset($page_description) ? $page_description : 'Kladriva accélère la croissance des entreprises IT via des consultants sur mesure et un système de mentoring innovant.' ?>">
    <meta property="og:image" content="<?= base_url('img/kladriva-og.jpg') ?>">
    
    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="<?= current_url() ?>">
    <meta property="twitter:title" content="<?= isset($page_title) ? $page_title : 'Kladriva - Plateforme de Recrutement IT & Conseil en Croissance' ?>">
    <meta property="twitter:description" content="<?= isset($page_description) ? $page_description : 'Kladriva accélère la croissance des entreprises IT via des consultants sur mesure et un système de mentoring innovant.' ?>">
    <meta property="twitter:image" content="<?= base_url('img/kladriva-og.jpg') ?>">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?= base_url('favicon.ico') ?>">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- CSS -->
    <link rel="stylesheet" href="<?= base_url('css/styles.css') ?>">
    
    <!-- Structured Data -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "name": "Kladriva",
        "description": "Plateforme de recrutement IT et conseil en croissance des entreprises",
        "url": "<?= base_url() ?>",
        "logo": "<?= base_url('img/kladriva-logo.png') ?>",
        "sameAs": [
            "https://linkedin.com/company/kladriva",
            "https://twitter.com/kladriva"
        ]
    }
    </script>
</head>
<body>
    <?= $this->include('layout/header') ?>
    
    <main>
        <?= $this->renderSection('content') ?>
    </main>
    
    <?= $this->include('layout/footer') ?>
    
    <!-- JavaScript -->
    <script src="<?= base_url('js/main.js') ?>"></script>
</body>
</html>