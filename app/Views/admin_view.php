<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - Kladriva</title>
    
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- CSS GroceryCRUD -->
    <?php foreach($css_files as $file): ?>
        <link rel="stylesheet" href="<?= $file; ?>">
    <?php endforeach; ?>
    
    <style>
        /* Styles d'administration */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: #f8fafc;
            color: #1e293b;
        }
        
        .admin-header {
            background: linear-gradient(135deg, #1e40af 0%, #3730a3 100%);
            color: white;
            padding: 1rem 0;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
        
        .admin-header .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }
        
        .admin-header h1 {
            font-size: 1.5rem;
            font-weight: 600;
        }
        
        .admin-nav {
            background: white;
            border-bottom: 1px solid #e2e8f0;
            padding: 0.5rem 0;
        }
        
        .admin-nav .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }
        
        .nav-menu {
            display: flex;
            gap: 1rem;
            list-style: none;
        }
        
        .nav-menu a {
            color: #64748b;
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            transition: all 0.2s;
            font-weight: 500;
        }
        
        .nav-menu a:hover {
            color: #1e40af;
            background: #eff6ff;
        }
        
        .nav-menu a.active {
            color: #1e40af;
            background: #eff6ff;
        }
        
        .admin-content {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
        }
        
        .admin-content h2 {
            margin-bottom: 1.5rem;
            color: #1e293b;
            font-size: 1.875rem;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .nav-menu {
                flex-direction: column;
                gap: 0.5rem;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="admin-header">
        <div class="container">
            <h1><i class="fas fa-cogs"></i> Administration Kladriva</h1>
        </div>
    </header>
    
    <!-- Navigation -->
    <nav class="admin-nav">
        <div class="container">
            <ul class="nav-menu">
                <li><a href="<?= base_url('admin/users') ?>" <?= (current_url() == base_url('admin/users')) ? 'class="active"' : '' ?>>
                    <i class="fas fa-users"></i> Utilisateurs
                </a></li>
                <li><a href="<?= base_url('admin/jobs') ?>" <?= (current_url() == base_url('admin/jobs')) ? 'class="active"' : '' ?>>
                    <i class="fas fa-briefcase"></i> Emplois
                </a></li>
                <li><a href="<?= base_url('admin/companies') ?>" <?= (current_url() == base_url('admin/companies')) ? 'class="active"' : '' ?>>
                    <i class="fas fa-building"></i> Entreprises
                </a></li>
                <li><a href="<?= base_url('admin/job-categories') ?>" <?= (current_url() == base_url('admin/job-categories')) ? 'class="active"' : '' ?>>
                    <i class="fas fa-tags"></i> Catégories
                </a></li>
                <li><a href="<?= base_url('/') ?>" style="margin-left: auto;">
                    <i class="fas fa-home"></i> Retour au site
                </a></li>
            </ul>
        </div>
    </nav>
    
    <!-- Contenu principal -->
    <main class="admin-content">
        <?= $output; ?>
    </main>
    
    <!-- JavaScript GroceryCRUD -->
    <?php foreach($js_files as $file): ?>
        <script src="<?= $file; ?>"></script>
    <?php endforeach; ?>
</body>
</html>
