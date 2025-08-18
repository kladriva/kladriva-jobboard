
    <header class="main-header">
        <nav class="navbar">
            <div class="nav-container">
                <div class="nav-brand">
                    <a href="<?= site_url('/') ?>" class="logo">
                        <img src="<?= base_url('img/logo.png') ?>" alt="Kladriva" class="logo-image">
                    </a>
                </div>
                
                <div class="nav-menu" id="nav-menu">
                    <ul class="nav-list">
                        <li class="nav-item">
                            <a href="<?= site_url('/') ?>" class="nav-link">Accueil</a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= site_url('/jobs') ?>" class="nav-link">Jobs</a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= site_url('/contact') ?>" class="nav-link">Contact</a>
                        </li>
                        
                        <!-- Boutons d'authentification pour mobile -->
                        <?php if (!is_logged_in()): ?>
                        <li class="nav-item nav-auth-mobile">
                            <div class="nav-auth-buttons">
                                <a href="<?= site_url('/connexion') ?>" class="btn btn-outline btn-mobile">Connexion</a>
                                <a href="<?= site_url('/inscription') ?>" class="btn btn-primary btn-mobile">Inscription</a>
                            </div>
                        </li>
                        <?php endif; ?>
                    </ul>
                </div>
                
                <div class="nav-actions">
                    <?php if (is_logged_in()): ?>
                        <!-- Utilisateur connecté -->
                        <div class="user-dropdown">
                            <button class="btn btn-outline dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user-circle me-2"></i><?= esc(current_user()->username) ?>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="<?= base_url('dashboard') ?>">
                                        <i class="fas fa-tachometer-alt me-2"></i>Tableau de bord
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="<?= base_url('auth/profile') ?>">
                                        <i class="fas fa-user me-2"></i>Mon Profil
                                    </a>
                                </li>

                                <?php if (has_permission('admin.access')): ?>
                                    <li>
                                        <a class="dropdown-item" href="<?= base_url('admin') ?>">
                                            <i class="fas fa-cog me-2"></i>Administration
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <li><hr class="dropdown-divider"></li>
                                                            <li>
                                <a class="dropdown-item text-danger" href="<?= base_url('auth/logout') ?>">
                                    <i class="fas fa-sign-out-alt me-2"></i>Déconnexion
                                </a>
                            </li>
                            </ul>
                        </div>
                    <?php else: ?>
                        <!-- Utilisateur non connecté -->
                        <a href="<?= site_url('/connexion') ?>" class="btn btn-outline">Connexion</a>
                        <a href="<?= site_url('/inscription') ?>" class="btn btn-primary">Inscription</a>
                    <?php endif; ?>
                </div>
                
                <div class="nav-toggle" id="nav-toggle">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </div>
            </div>
        </nav>
    </header>