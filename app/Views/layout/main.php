<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- SEO Meta Tags -->
    <title><?= isset($page_title) ? $page_title : 'Kladriva - Plateforme de recrutement' ?></title>
    <meta name="description" content="<?= isset($page_description) ? $page_description : 'Kladriva connecte les entreprises aux meilleurs consultants IT et accompagne les talents dans leur développement professionnel grâce à un système de mentoring innovant.' ?>">
    <meta name="keywords" content="recrutement IT, conseil en croissance, consultants IT, mentoring, développement de carrière, emploi tech, France">
    <meta name="author" content="Kladriva">
    <meta name="robots" content="index, follow">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= current_url() ?>">
    <meta property="og:title" content="<?= isset($page_title) ? $page_title : 'Kladriva - Plateforme de recrutement' ?>">
    <meta property="og:description" content="<?= isset($page_description) ? $page_description : 'Kladriva connecte les entreprises aux meilleurs consultants IT et accompagne les talents dans leur développement professionnel.' ?>">
    <meta property="og:image" content="<?= base_url('img/kladriva-og.jpg') ?>">
    
    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="<?= current_url() ?>">
    <meta property="twitter:title" content="<?= isset($page_title) ? $page_title : 'Kladriva - Plateforme de recrutement' ?>">
    <meta property="twitter:description" content="<?= isset($page_description) ? $page_description : 'Kladriva connecte les entreprises aux meilleurs consultants IT et accompagne les talents dans leur développement professionnel.' ?>">
    <meta property="twitter:image" content="<?= base_url('img/kladriva-og.jpg') ?>">
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?= base_url('img/logo-header.png') ?>">
    <link rel="shortcut icon" type="image/png" href="<?= base_url('img/logo-header.png') ?>">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?= csrf_hash() ?>">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- CSS -->
    <link rel="stylesheet" href="<?= base_url('css/styles.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/jobs.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/contact.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/about.css') ?>">
    
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
    
    <?= $this->renderSection('styles') ?>
</head>
<body>
    <?= $this->include('layout/header') ?>
    
    <!-- Messages flash -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="container mt-3">
            <div class="alert alert-success alert-dismissible fade show">
                <i class="fas fa-check-circle me-2"></i>
                <?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="container mt-3">
            <div class="alert alert-danger alert-dismissible fade show">
                <i class="fas fa-exclamation-triangle me-2"></i>
                <?= session()->getFlashdata('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    <?php endif; ?>
    
    <main class="main-content">
        <?= $this->renderSection('content') ?>
    </main>
    
    <?= $this->include('layout/footer') ?>
    
    <!-- JavaScript -->
    <script src="<?= base_url('js/main.js') ?>"></script>
    <?= $this->renderSection('scripts') ?>
</body>
</html>
