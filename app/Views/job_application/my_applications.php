<?= $this->extend('layout/main') ?>

<?php
// Fonction helper pour traduire les statuts (solution de secours)
if (!function_exists('getStatusLabel')) {
    function getStatusLabel($status) {
        $labels = [
            'pending' => 'En attente',
            'reviewed' => 'Examinée',
            'shortlisted' => 'Sélectionnée',
            'rejected' => 'Non retenue',
            'accepted' => 'Acceptée'
        ];
        return $labels[$status] ?? $status;
    }
}
?>

<?= $this->section('content') ?>

<!-- Hero Section Mes Candidatures -->
<section class="applications-hero">
    <div class="container">
        <div class="applications-hero-content">
            <div class="applications-hero-text">
                <h1 class="applications-title">Mes Candidatures</h1>
                <p class="applications-subtitle">Suivez l'état de vos candidatures et restez informé de leur progression.</p>
            </div>
            <div class="applications-hero-visual">
                <div class="applications-illustration">
                    <i class="fas fa-clipboard-list"></i>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Liste des Candidatures -->
<section class="applications-list-section">
    <div class="container">
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show mb-4">
                <i class="fas fa-check-circle me-2"></i>
                <?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show mb-4">
                <i class="fas fa-exclamation-triangle me-2"></i>
                <?= session()->getFlashdata('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php if (empty($applications)): ?>
            <div class="no-applications">
                <div class="no-applications-icon">
                    <i class="fas fa-file-alt"></i>
                </div>
                <h3>Aucune candidature pour le moment</h3>
                <p>Vous n'avez pas encore postulé à des emplois. Commencez par explorer nos offres !</p>
                <a href="<?= site_url('jobs') ?>" class="btn btn-primary">
                    <i class="fas fa-search me-2"></i>
                    Voir les emplois
                </a>
            </div>
        <?php else: ?>
            <div class="applications-header">
                <h2>Vos Candidatures (<?= count($applications) ?>)</h2>
                <p>Consultez l'état de vos candidatures et les réponses des entreprises.</p>
            </div>

            <div class="applications-grid">
                <?php foreach ($applications as $application): ?>
                    <div class="application-card">
                        <div class="application-card-header">
                            <div class="application-status status-<?= $application['status'] ?>">
                                <i class="fas fa-circle"></i>
                                <?= getStatusLabel($application['status']) ?>
                            </div>
                            <div class="application-date">
                                <i class="fas fa-calendar me-1"></i>
                                <?= date('d/m/Y', strtotime($application['created_at'])) ?>
                            </div>
                        </div>

                        <div class="application-card-body">
                            <h3 class="job-title">
                                <a href="<?= site_url("jobs/show/" . ($application['job_slug'] ?? $application['job_id'])) ?>">
                                    <?= esc($application['job_title']) ?>
                                </a>
                            </h3>
                            
                            <p class="company-name">
                                <i class="fas fa-building me-2"></i>
                                <?= esc($application['company_name']) ?>
                            </p>

                            <div class="application-details">
                                <div class="detail-item">
                                    <i class="fas fa-file-pdf me-2"></i>
                                    <span>CV : <?= esc($application['cv_filename']) ?></span>
                                </div>
                                
                                <?php if ($application['cover_letter']): ?>
                                    <div class="detail-item">
                                        <i class="fas fa-envelope me-2"></i>
                                        <span>Lettre de motivation incluse</span>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <?php if ($application['notes']): ?>
                                <div class="application-notes">
                                    <h5>Notes du recruteur :</h5>
                                    <p><?= esc($application['notes']) ?></p>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="application-card-footer">
                            <div class="application-actions">
                                <a href="<?= site_url("jobs/show/" . ($application['job_slug'] ?? $application['job_id'])) ?>" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-eye me-1"></i>
                                    Voir l'emploi
                                </a>
                                
                                <?php if ($application['status'] === 'pending'): ?>
                                    <span class="status-info">
                                        <i class="fas fa-clock me-1"></i>
                                        En attente de réponse
                                    </span>
                                <?php elseif ($application['status'] === 'reviewed'): ?>
                                    <span class="status-info">
                                        <i class="fas fa-eye me-1"></i>
                                        En cours d'examen
                                    </span>
                                <?php elseif ($application['status'] === 'shortlisted'): ?>
                                    <span class="status-info text-success">
                                        <i class="fas fa-star me-1"></i>
                                        Sélectionné !
                                    </span>
                                <?php elseif ($application['status'] === 'accepted'): ?>
                                    <span class="status-info text-success">
                                        <i class="fas fa-check-circle me-1"></i>
                                        Accepté !
                                    </span>
                                <?php elseif ($application['status'] === 'rejected'): ?>
                                    <span class="status-info text-danger">
                                        <i class="fas fa-times-circle me-1"></i>
                                        Non retenu
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- CTA Section -->
<section class="applications-cta-section">
    <div class="container">
        <div class="cta-content">
            <h2>Prêt pour de nouvelles opportunités ?</h2>
            <p>Continuez à explorer nos offres d'emploi et postulez aux postes qui vous intéressent.</p>
            <div class="cta-actions">
                <a href="<?= site_url('jobs') ?>" class="btn btn-primary btn-large">
                    <i class="fas fa-search me-2"></i>
                    Voir les emplois
                </a>
                <a href="<?= site_url('dashboard') ?>" class="btn btn-outline-primary">
                    <i class="fas fa-tachometer-alt me-2"></i>
                    Tableau de bord
                </a>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
