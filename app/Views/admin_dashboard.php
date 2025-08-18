<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord - Administration Kladriva</title>
    
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
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
        
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }
        
        .dashboard-card {
            background: white;
            border-radius: 0.5rem;
            padding: 1.5rem;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
            border: 1px solid #e2e8f0;
        }
        
        .dashboard-card h3 {
            color: #1e293b;
            margin-bottom: 1rem;
            font-size: 1.25rem;
        }
        
        .dashboard-card p {
            color: #64748b;
            margin-bottom: 1rem;
        }
        
        .dashboard-card .btn {
            display: inline-block;
            background: #1e40af;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            text-decoration: none;
            font-weight: 500;
            transition: background 0.2s;
        }
        
        .dashboard-card .btn:hover {
            background: #1e3a8a;
        }
        
        .warning-box {
            background: #fef3c7;
            border: 1px solid #f59e0b;
            border-radius: 0.5rem;
            padding: 1rem;
            margin-bottom: 2rem;
        }
        
        .warning-box h4 {
            color: #92400e;
            margin-bottom: 0.5rem;
        }
        
        .warning-box p {
            color: #92400e;
            margin-bottom: 0.5rem;
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
                <li><a href="<?= base_url('admin/') ?>" class="active">
                    <i class="fas fa-tachometer-alt"></i> Tableau de bord
                </a></li>
                <li><a href="<?= base_url('admin/users') ?>">
                    <i class="fas fa-users"></i> Utilisateurs
                </a></li>
                <li><a href="<?= base_url('admin/jobs') ?>">
                    <i class="fas fa-briefcase"></i> Emplois
                </a></li>
                <li><a href="<?= base_url('admin/companies') ?>">
                    <i class="fas fa-building"></i> Entreprises
                </a></li>
                <li><a href="<?= base_url('admin/job-categories') ?>">
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
        <h2>Tableau de bord d'administration</h2>
        
        <div class="warning-box">
            <h4><i class="fas fa-exclamation-triangle"></i> Configuration requise</h4>
            <p>Avant de pouvoir utiliser toutes les fonctionnalités d'administration, vous devez :</p>
            <p>1. <strong>Créer les tables de base de données</strong> en exécutant le script SQL dans <code>bd.sql</code></p>
            <p>2. <strong>Vérifier que GroceryCRUD est correctement installé</strong></p>
        </div>
        
        <div class="dashboard-grid">
            <div class="dashboard-card">
                <h3><i class="fas fa-users"></i> Gestion des utilisateurs</h3>
                <p>Gérez les comptes utilisateurs, leurs profils et leurs permissions.</p>
                <a href="<?= base_url('admin/users') ?>" class="btn">Accéder</a>
            </div>
            
            <div class="dashboard-card">
                <h3><i class="fas fa-briefcase"></i> Gestion des emplois</h3>
                <p>Créez, modifiez et publiez des offres d'emploi avec toutes les informations nécessaires.</p>
                <a href="<?= base_url('admin/jobs') ?>" class="btn">Accéder</a>
            </div>
            
            <div class="dashboard-card">
                <h3><i class="fas fa-building"></i> Gestion des entreprises</h3>
                <p>Gérez les entreprises qui publient des offres d'emploi sur votre plateforme.</p>
                <a href="<?= base_url('admin/companies') ?>" class="btn">Accéder</a>
            </div>
            
            <div class="dashboard-card">
                <h3><i class="fas fa-tags"></i> Gestion des catégories</h3>
                <p>Organisez les emplois par catégories avec des couleurs et des icônes personnalisées.</p>
                <a href="<?= base_url('admin/job-categories') ?>" class="btn">Accéder</a>
            </div>
        </div>
    </main>
</body>
</html>
