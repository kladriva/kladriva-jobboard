<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<div class="container">
    <!-- En-tête du tableau de bord -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted mb-0">
                        Bienvenue, <?= esc($user->username) ?> ! Voici votre espace personnel.
                    </p>
                </div>
                <div class="d-flex gap-2">
                    <a href="<?= base_url('auth/profile') ?>" class="btn btn-primary">
                        <i class="fas fa-user-edit me-2"></i>Modifier le profil
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Actions rapides -->
    <div class="row">
        <div class="col-12">
            <div class="dashboard-card">
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
                        <a href="<?= base_url('auth/logout') ?>" class="quick-action-btn">
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
