<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<!-- Header du profil -->
<div class="profile-header">
    <div class="container">
        <div class="profile-header-content">
            <div class="profile-avatar-section">
                <div class="profile-avatar">
                    <div class="avatar-placeholder">
                        <i class="fas fa-user"></i>
                    </div>
                    <button class="avatar-edit-btn" title="Modifier la photo">
                        <i class="fas fa-camera"></i>
                    </button>
                </div>
                <div class="profile-info">
                    <h1 class="profile-name"><?= esc($user->username ?? 'Utilisateur') ?></h1>
                    <p class="profile-email"><?= esc($user->email ?? '') ?></p>
                    <div class="profile-status">
                        <span class="status-badge">
                            <i class="fas fa-circle"></i>
                            Membre actif
                        </span>
                    </div>
                </div>
            </div>
            <div class="profile-actions">
                <a href="<?= base_url('dashboard') ?>" class="btn btn-primary btn-elevated">
                    <i class="fas fa-tachometer-alt"></i>
                    Tableau de bord
                </a>
                <a href="<?= base_url('auth/logout') ?>" class="btn btn-outline btn-danger">
                    <i class="fas fa-sign-out-alt"></i>
                    Déconnexion
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Contenu principal -->
<main class="profile-main">
    <div class="container">
        <!-- Section des informations du profil -->
        <section class="profile-section">
            <div class="section-header">
                <h2 class="section-title">Informations du profil</h2>
                <p class="section-subtitle">Complétez votre profil pour améliorer votre visibilité</p>
            </div>
            
            <div class="profile-cards-grid">
                <div class="profile-card-modern">
                    <div class="card-icon">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="card-content">
                        <h3 class="card-title">Informations personnelles</h3>
                        <p class="card-description">Nom, prénom, localisation et informations de contact</p>
                    </div>
                    <div class="card-actions">
                        <button class="btn btn-outline btn-sm">
                            <i class="fas fa-edit"></i>
                            Modifier
                        </button>
                    </div>
                </div>
                
                <div class="profile-card-modern">
                    <div class="card-icon">
                        <i class="fas fa-briefcase"></i>
                    </div>
                    <div class="card-content">
                        <h3 class="card-title">Expérience professionnelle</h3>
                        <p class="card-description">Vos postes, entreprises et responsabilités</p>
                    </div>
                    <div class="card-actions">
                        <button class="btn btn-outline btn-sm">
                            <i class="fas fa-plus"></i>
                            Ajouter
                        </button>
                    </div>
                </div>
                
                <div class="profile-card-modern">
                    <div class="card-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <div class="card-content">
                        <h3 class="card-title">Formation</h3>
                        <p class="card-description">Diplômes, certifications et formations</p>
                    </div>
                    <div class="card-actions">
                        <button class="btn btn-outline btn-sm">
                            <i class="fas fa-plus"></i>
                            Ajouter
                        </button>
                    </div>
                </div>
                
                <div class="profile-card-modern">
                    <div class="card-icon">
                        <i class="fas fa-code"></i>
                    </div>
                    <div class="card-content">
                        <h3 class="card-title">Compétences techniques</h3>
                        <p class="card-description">Langages, frameworks et outils maîtrisés</p>
                    </div>
                    <div class="card-actions">
                        <button class="btn btn-outline btn-sm">
                            <i class="fas fa-cog"></i>
                            Gérer
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section des statistiques -->
        <section class="profile-section">
            <div class="section-header">
                <h2 class="section-title">Vos statistiques</h2>
                <p class="section-subtitle">Suivez votre activité et votre progression</p>
            </div>
            
            <div class="stats-grid-modern">
                <div class="stat-card-modern">
                    <div class="stat-icon">
                        <i class="fas fa-paper-plane"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-number">0</div>
                        <div class="stat-label">Candidatures envoyées</div>
                    </div>
                </div>
                
                <div class="stat-card-modern">
                    <div class="stat-icon">
                        <i class="fas fa-building"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-number">0</div>
                        <div class="stat-label">Entreprises consultées</div>
                    </div>
                </div>
                
                <div class="stat-card-modern">
                    <div class="stat-icon">
                        <i class="fas fa-bookmark"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-number">0</div>
                        <div class="stat-label">Offres sauvegardées</div>
                    </div>
                </div>
                
                <div class="stat-card-modern">
                    <div class="stat-icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-number">0</div>
                        <div class="stat-label">Jours d'activité</div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>

<?= $this->endSection() ?>
