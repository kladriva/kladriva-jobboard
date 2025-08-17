<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<div class="container">
    <!-- En-tête du tableau de bord -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h2 mb-1">
                        <i class="fas fa-tachometer-alt me-2"></i>Tableau de bord
                    </h1>
                    <p class="text-muted mb-0">
                        Bienvenue, <?= esc($user->username) ?> ! Voici un aperçu de votre activité.
                    </p>
                </div>
                <div class="d-flex gap-2">
                    <a href="<?= base_url('test') ?>" class="btn btn-outline-info">
                        <i class="fas fa-shield-alt me-2"></i>Test Shield
                    </a>
                    <a href="<?= base_url('auth/profile') ?>" class="btn btn-primary">
                        <i class="fas fa-user-edit me-2"></i>Modifier le profil
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistiques -->
    <div class="dashboard-stats">
        <div class="stat-card">
            <div class="stat-icon primary">
                <i class="fas fa-percentage"></i>
            </div>
            <div class="stat-number"><?= $stats['profile_completion'] ?>%</div>
            <div class="stat-label">Profil complété</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon success">
                <i class="fas fa-paper-plane"></i>
            </div>
            <div class="stat-number"><?= $stats['applications_sent'] ?></div>
            <div class="stat-label">Candidatures</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon warning">
                <i class="fas fa-calendar-check"></i>
            </div>
            <div class="stat-number"><?= $stats['interviews_scheduled'] ?></div>
            <div class="stat-label">Entretiens</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon info">
                <i class="fas fa-certificate"></i>
            </div>
            <div class="stat-number"><?= $stats['skills_verified'] ?></div>
            <div class="stat-label">Compétences</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon danger">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-number"><?= $stats['connections_made'] ?></div>
            <div class="stat-label">Connexions</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon secondary">
                <i class="fas fa-gift"></i>
            </div>
            <div class="stat-number"><?= $stats['offers_received'] ?></div>
            <div class="stat-label">Offres</div>
        </div>
    </div>

    <div class="row">
        <!-- Activités récentes -->
        <div class="col-lg-8 mb-4">
            <div class="dashboard-card">
                <div class="dashboard-card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-clock me-2"></i>Activités récentes
                    </h5>
                </div>
                <div class="dashboard-card-body">
                    <?php foreach ($recent_activities as $activity): ?>
                        <div class="activity-item">
                            <div class="activity-icon bg-<?= $activity['color'] ?> bg-opacity-10">
                                <i class="fas <?= $activity['icon'] ?> text-<?= $activity['color'] ?>"></i>
                            </div>
                            <div class="activity-content">
                                <div class="activity-title"><?= $activity['title'] ?></div>
                                <div class="activity-description"><?= $activity['description'] ?></div>
                                <div class="activity-date"><?= $activity['date'] ?></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    
                    <div class="text-center mt-3">
                        <a href="#" class="btn btn-outline-primary btn-sm">
                            Voir toutes les activités
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recommandations -->
        <div class="col-lg-4 mb-4">
            <div class="dashboard-card">
                <div class="dashboard-card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-lightbulb me-2"></i>Recommandations
                    </h5>
                </div>
                <div class="dashboard-card-body">
                    <?php foreach ($recommendations as $rec): ?>
                        <div class="recommendation-item">
                            <?php if ($rec['type'] === 'job'): ?>
                                <div class="recommendation-header">
                                    <div class="recommendation-icon bg-primary bg-opacity-10">
                                        <i class="fas <?= $rec['logo'] ?> text-primary"></i>
                                    </div>
                                    <div class="recommendation-content">
                                        <div class="recommendation-title"><?= $rec['title'] ?></div>
                                        <div class="recommendation-details"><?= $rec['company'] ?> • <?= $rec['location'] ?></div>
                                        <div class="recommendation-meta">
                                            <small class="text-success"><?= $rec['salary'] ?></small>
                                            <span class="match-badge"><?= $rec['match'] ?>% match</span>
                                        </div>
                                    </div>
                                </div>
                            <?php elseif ($rec['type'] === 'skill'): ?>
                                <div class="recommendation-header">
                                    <div class="recommendation-icon bg-warning bg-opacity-10">
                                        <i class="fab <?= $rec['icon'] ?> text-warning"></i>
                                    </div>
                                    <div class="recommendation-content">
                                        <div class="recommendation-title"><?= $rec['title'] ?></div>
                                        <div class="recommendation-details"><?= $rec['description'] ?></div>
                                        <div class="recommendation-meta">
                                            <small class="text-muted"><?= $rec['duration'] ?></small>
                                            <span class="match-badge"><?= $rec['match'] ?>% match</span>
                                        </div>
                                    </div>
                                </div>
                            <?php elseif ($rec['type'] === 'mentor'): ?>
                                <div class="recommendation-header">
                                    <div class="recommendation-icon bg-info bg-opacity-10">
                                        <i class="fas <?= $rec['avatar'] ?> text-info"></i>
                                    </div>
                                    <div class="recommendation-content">
                                        <div class="recommendation-title"><?= $rec['title'] ?></div>
                                        <div class="recommendation-details"><?= $rec['role'] ?></div>
                                        <div class="recommendation-meta">
                                            <div class="text-warning">
                                                <i class="fas fa-star"></i>
                                                <small><?= $rec['rating'] ?></small>
                                            </div>
                                            <span class="match-badge"><?= $rec['match'] ?>% match</span>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                    
                    <div class="text-center mt-3">
                        <a href="#" class="btn btn-outline-primary btn-sm">
                            Voir plus de recommandations
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Actions rapides -->
    <div class="row">
        <div class="col-12">
            <div class="dashboard-card">
                <div class="dashboard-card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-bolt me-2"></i>Actions rapides
                    </h5>
                </div>
                <div class="dashboard-card-body">
                    <div class="quick-actions">
                        <a href="<?= base_url('emplois') ?>" class="quick-action-btn">
                            <i class="fas fa-search quick-action-icon text-primary"></i>
                            <span>Rechercher un emploi</span>
                        </a>
                        <a href="<?= base_url('mentoring') ?>" class="quick-action-btn">
                            <i class="fas fa-graduation-cap quick-action-icon text-success"></i>
                            <span>Trouver un mentor</span>
                        </a>
                        <a href="<?= base_url('consultants') ?>" class="quick-action-btn">
                            <i class="fas fa-users quick-action-icon text-info"></i>
                            <span>Réseauter</span>
                        </a>
                        <a href="<?= base_url('auth/profile') ?>" class="quick-action-btn">
                            <i class="fas fa-user-edit quick-action-icon text-warning"></i>
                            <span>Compléter le profil</span>
                        </a>
                        <a href="<?= base_url('logout') ?>" class="quick-action-btn">
                            <i class="fas fa-sign-out-alt quick-action-icon text-danger"></i>
                            <span>Déconnexion</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
