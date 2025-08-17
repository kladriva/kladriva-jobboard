
<body>
    <header class="main-header">
        <nav class="navbar">
            <div class="nav-container">
                <div class="nav-brand">
                    <a href="<?= site_url('/') ?>" class="logo">
                        <span class="logo-text">Kladriva</span>
                        <span class="logo-tagline">Accélérer la croissance</span>
                    </a>
                </div>
                
                <div class="nav-menu" id="nav-menu">
                    <ul class="nav-list">
                        <li class="nav-item">
                            <a href="<?= site_url('/') ?>" class="nav-link">Accueil</a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= site_url('/emplois') ?>" class="nav-link">Emplois IT</a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= site_url('/consultants') ?>" class="nav-link">Consultants</a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= site_url('/mentoring') ?>" class="nav-link">Mentoring</a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= site_url('/entreprises') ?>" class="nav-link">Entreprises</a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= site_url('/contact') ?>" class="nav-link">Contact</a>
                        </li>
                    </ul>
                </div>
                
                <div class="nav-actions">
                    <a href="<?= site_url('/connexion') ?>" class="btn btn-outline">Connexion</a>
                    <a href="<?= site_url('/inscription') ?>" class="btn btn-primary">S'inscrire</a>
                </div>
                
                <div class="nav-toggle" id="nav-toggle">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </div>
            </div>
        </nav>
    </header>
</body>