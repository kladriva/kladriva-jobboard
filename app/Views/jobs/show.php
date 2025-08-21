<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<!-- Breadcrumb -->
<section class="breadcrumb-section">
    <div class="container">
        <nav class="breadcrumb-nav">
            <a href="<?= site_url('/') ?>">Accueil</a>
            <i class="fas fa-chevron-right"></i>
                                    <a href="<?= site_url('jobs') ?>">Emplois</a>
            <i class="fas fa-chevron-right"></i>
            <span><?= $job['title'] ?></span>
        </nav>
    </div>
</section>

<!-- Job Header -->
<section class="job-header-section">
    <div class="container">
        <div class="job-header">
            <div class="job-header-content">
                <div class="company-logo-large">
                    <?php if (!empty($job['company_logo'])): ?>
                    <img src="<?= base_url('uploads/companies/' . $job['company_logo']) ?>" 
                         alt="<?= $job['company_name'] ?>">
                    <?php else: ?>
                    <div class="company-logo-placeholder-large">
                        <?= strtoupper(substr($job['company_name'], 0, 2)) ?>
                    </div>
                    <?php endif; ?>
                </div>
                
                <div class="job-title-section">
                    <h1 class="job-title"><?= $job['title'] ?></h1>
                    <p class="company-name"><?= $job['company_name'] ?></p>
                    
                    <div class="job-meta-grid">
                        <div class="meta-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <span><?= $job['location'] ?></span>
                        </div>
                        <div class="meta-item">
                            <i class="fas fa-briefcase"></i>
                            <span><?= ucfirst($job['contract_type']) ?></span>
                        </div>
                        <div class="meta-item">
                            <i class="fas fa-clock"></i>
                            <span>
                                <?php 
                                if (!empty($job['published_at']) && $job['published_at'] !== '0000-00-00 00:00:00') {
                                    echo 'Publié le ' . date('d/m/Y', strtotime($job['published_at']));
                                } else {
                                    echo 'Publié le ' . date('d/m/Y', strtotime($job['created_at']));
                                }
                                ?>
                            </span>
                        </div>
                        <?php if (!empty($job['salary_min'])): ?>
                        <div class="meta-item">
                            <i class="fas fa-euro-sign"></i>
                            <span><?= number_format($job['salary_min'], 0, ',', ' ') ?> - 
                                  <?= number_format($job['salary_max'] ?? $job['salary_min'], 0, ',', ' ') ?> 
                                  <?= $job['salary_period'] ?></span>
                        </div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="job-tags-main">
                        <span class="job-category-main" style="background-color: <?= $job['category_color'] ?>20; color: <?= $job['category_color'] ?>">
                            <?= $job['category_name'] ?>
                        </span>

                        <?php if ($job['is_urgent']): ?>
                        <span class="job-badge-main urgent">
                            <i class="fas fa-exclamation-triangle"></i>
                            Urgent
                        </span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            
            <div class="job-actions-main">
                <?php if (auth()->loggedIn()): ?>
                    <?php 
                    // Vérifier si l'utilisateur a déjà postulé
                    $hasApplied = false;
                    if (isset($hasUserApplied)) {
                        $hasApplied = $hasUserApplied;
                    }
                    ?>
                    
                    <?php if ($hasApplied): ?>
                        <button class="btn btn-success btn-large" disabled>
                            <i class="fas fa-check-circle"></i>
                            Candidature soumise
                        </button>
                    <?php else: ?>
                        <button class="btn btn-primary btn-large" onclick="openApplicationModal()">
                            <i class="fas fa-paper-plane"></i>
                            Postuler maintenant
                        </button>
                    <?php endif; ?>
                <?php else: ?>
                    <a href="<?= site_url('auth/login?redirect=' . urlencode(current_url())) ?>" class="btn btn-primary btn-large">
                        <i class="fas fa-sign-in-alt"></i>
                        Se connecter pour postuler
                    </a>
                <?php endif; ?>
                
                <button class="btn btn-outline btn-large" onclick="shareJob()">
                    <i class="fas fa-share-alt"></i>
                    Partager
                </button>
            </div>
        </div>
    </div>
</section>

<!-- Job Content -->
<section class="job-content-section">
    <div class="container">
        <div class="job-content-layout">
            <!-- Contenu principal -->
            <main class="job-content-main">
                <!-- Description -->
                <div class="content-block">
                    <h2>Description du poste</h2>
                    <div class="job-description">
                        <?= nl2br(esc($job['description'])) ?>
                    </div>
                </div>
                
                <!-- Prérequis -->
                <?php if (!empty($job['requirements'])): ?>
                <div class="content-block">
                    <h2>Prérequis</h2>
                    <div class="job-requirements">
                        <?= nl2br(esc($job['requirements'])) ?>
                    </div>
                </div>
                <?php endif; ?>
                
                <!-- Compétences requises -->
                <?php if (!empty($job['skills_required'])): ?>
                <div class="content-block">
                    <h2>Compétences requises</h2>
                    <div class="skills-list">
                        <?php 
                        $skills = explode(',', $job['skills_required']);
                        foreach ($skills as $skill): 
                            $skill = trim($skill);
                            if (!empty($skill)):
                        ?>
                        <span class="skill-tag"><?= esc($skill) ?></span>
                        <?php 
                            endif;
                        endforeach; 
                        ?>
                    </div>
                </div>
                <?php endif; ?>
                
                <!-- Technologies -->
                <?php if (!empty($job['technologies'])): ?>
                <div class="content-block">
                    <h2>Technologies</h2>
                    <div class="technologies-list">
                        <?php 
                        $technologies = explode(',', $job['technologies']);
                        foreach ($technologies as $tech): 
                            $tech = trim($tech);
                            if (!empty($tech)):
                        ?>
                        <span class="tech-tag"><?= esc($tech) ?></span>
                        <?php 
                            endif;
                        endforeach; 
                        ?>
                    </div>
                </div>
                <?php endif; ?>
                
                <!-- Avantages -->
                <?php if (!empty($job['benefits'])): ?>
                <div class="content-block">
                    <h2>Avantages</h2>
                    <div class="job-benefits">
                        <?= nl2br(esc($job['benefits'])) ?>
                    </div>
                </div>
                <?php endif; ?>
            </main>
            
            <!-- Sidebar -->
            <aside class="job-sidebar">
                <!-- Informations entreprise -->
                <div class="sidebar-block company-info">
                    <h3>À propos de l'entreprise</h3>
                    <div class="company-details">
                        <h4><?= $job['company_name'] ?></h4>
                        <?php if (!empty($job['company_industry'])): ?>
                        <p class="company-industry">
                            <i class="fas fa-industry"></i>
                            <?= $job['company_industry'] ?>
                        </p>
                        <?php endif; ?>
                        <?php if (!empty($job['company_logo'])): ?>
                        <div class="company-logo-sidebar">
                            <img src="<?= base_url('uploads/companies/' . $job['company_logo']) ?>" 
                                 alt="<?= $job['company_name'] ?>">
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- Détails du poste -->
                <div class="sidebar-block job-details">
                    <h3>Détails du poste</h3>
                    <div class="detail-list">
                        <div class="detail-item">
                            <span class="detail-label">Type de contrat</span>
                            <span class="detail-value"><?= ucfirst($job['contract_type']) ?></span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Niveau d'expérience</span>
                            <span class="detail-value"><?= ucfirst($job['experience_level']) ?></span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Localisation</span>
                            <span class="detail-value"><?= $job['location'] ?></span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Type de travail</span>
                            <span class="detail-value"><?= ucfirst($job['location_type']) ?></span>
                        </div>
                        <?php if (!empty($job['salary_min'])): ?>
                        <div class="detail-item">
                            <span class="detail-label">Salaire</span>
                            <span class="detail-value">
                                <?= number_format($job['salary_min'], 0, ',', ' ') ?> - 
                                <?= number_format($job['salary_max'] ?? $job['salary_min'], 0, ',', ' ') ?> 
                                <?= $job['salary_period'] ?>
                            </span>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- Statistiques -->
                <div class="sidebar-block job-stats">
                    <h3>Statistiques</h3>
                    <div class="stats-list">
                        <div class="stat-item">
                            <span class="stat-number"><?= $job['views_count'] ?? 0 ?></span>
                            <span class="stat-label">Vues</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number"><?= $job['applications_count'] ?? 0 ?></span>
                            <span class="stat-label">Candidatures</span>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</section>

<!-- Emplois similaires -->
<?php if (!empty($related_jobs)): ?>
<section class="related-jobs-section">
    <div class="container">
        <div class="section-header">
            <h2>Emplois similaires</h2>
            <p>Découvrez d'autres opportunités dans la même catégorie</p>
        </div>
        
        <div class="related-jobs-grid">
            <?php foreach ($related_jobs as $related_job): ?>
            <article class="related-job-card">
                <h3 class="related-job-title">
                                            <a href="<?= site_url('job/' . $related_job['slug']) ?>"><?= $related_job['title'] ?></a>
                </h3>
                <p class="related-company-name"><?= $related_job['company_name'] ?></p>
                <div class="related-job-meta">
                    <span class="related-job-location">
                        <i class="fas fa-map-marker-alt"></i>
                        <?= $related_job['location'] ?>
                    </span>
                    <span class="related-job-type">
                        <i class="fas fa-briefcase"></i>
                        <?= ucfirst($related_job['contract_type']) ?>
                    </span>
                </div>
                <a href="<?= site_url('job/' . $related_job['slug']) ?>" class="btn btn-outline btn-sm">
                    Voir l'offre
                </a>
            </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- JavaScript pour le partage -->
<script>
function shareJob() {
    if (navigator.share) {
        navigator.share({
            title: '<?= esc($job['title']) ?>',
            text: '<?= esc($job['company_name']) ?> recherche un(e) <?= esc($job['title']) ?>',
            url: window.location.href
        });
    } else {
        // Fallback pour les navigateurs qui ne supportent pas l'API Web Share
        const url = window.location.href;
        const text = '<?= esc($job['title']) ?> - <?= esc($job['company_name']) ?>';
        
        // Copier l'URL dans le presse-papiers
        navigator.clipboard.writeText(url).then(() => {
            alert('Lien copié dans le presse-papiers !');
        });
    }
}

function openApplicationModal() {
    document.getElementById('applicationModal').style.display = 'block';
    document.body.style.overflow = 'hidden';
}

function closeApplicationModal() {
    document.getElementById('applicationModal').style.display = 'none';
    document.body.style.overflow = 'auto';
}

// Fermer la modal en cliquant à l'extérieur
window.onclick = function(event) {
    const modal = document.getElementById('applicationModal');
    if (event.target === modal) {
        closeApplicationModal();
    }
}
</script>

<!-- Modal de Candidature -->
<div id="applicationModal" class="application-modal">
    <div class="application-modal-content">
        <div class="application-modal-header">
            <h2>Postuler à l'emploi</h2>
            <button class="modal-close" onclick="closeApplicationModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <div class="application-modal-body">
            <div class="job-summary-modal">
                <h3><?= esc($job['title']) ?></h3>
                <p class="company-name">chez <strong><?= esc($job['company_name']) ?></strong></p>
                <p class="job-location"><?= esc($job['location'] ?? 'Lieu non spécifié') ?></p>
            </div>
            
            <form class="application-form-modal" action="<?= site_url('job-application/submit') ?>" method="POST" enctype="multipart/form-data">
                <?= csrf_field() ?>
                
                <input type="hidden" name="job_id" value="<?= $job['id'] ?>">
                <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" id="modalCsrfToken">
                
                <!-- CV Upload -->
                <div class="form-group">
                    <label for="cv" class="form-label">
                        <i class="fas fa-file-pdf"></i>
                        CV * <span class="text-muted">(PDF, DOC, DOCX - Max 2 MB)</span>
                    </label>
                    <input type="file" id="cv" name="cv" class="form-control modern" accept=".pdf,.doc,.docx" required>
                    <small class="form-text text-muted">
                        <i class="fas fa-info-circle me-1"></i>
                        Formats acceptés : PDF, DOC, DOCX. Taille maximale : 2 MB.
                    </small>
                </div>

                <!-- Lettre de motivation -->
                <div class="form-group">
                    <label for="cover_letter" class="form-label">
                        <i class="fas fa-envelope"></i>
                        Lettre de motivation <span class="text-muted">(Optionnel)</span>
                    </label>
                    <textarea id="cover_letter" name="cover_letter" class="form-control modern" rows="4" placeholder="Présentez-vous et expliquez pourquoi vous êtes intéressé par ce poste..."></textarea>
                    <small class="form-text text-muted">
                        <i class="fas fa-info-circle me-1"></i>
                        Maximum 2000 caractères. Expliquez votre motivation et votre intérêt pour ce poste.
                    </small>
                </div>

                <!-- Informations personnelles (lecture seule) -->
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-user"></i>
                        Vos informations
                    </label>
                    <div class="user-info-modal">
                        <?php if (isset($user) && $user): ?>
                            <p><strong>Nom :</strong> <?= esc($user->first_name ?? '') ?> <?= esc($user->last_name ?? '') ?></p>
                            <p><strong>Email :</strong> <?= esc($user->email ?? '') ?></p>
                            <p><strong>Membre depuis :</strong> <?= date('d/m/Y', strtotime($user->created_at)) ?></p>
                        <?php else: ?>
                            <p class="text-muted">Veuillez vous connecter pour voir vos informations</p>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Consentement -->
                <div class="form-group">
                    <div class="form-check modern-check">
                        <input type="checkbox" id="consent" name="consent" class="form-check-input" required checked>
                        <label for="consent" class="form-check-label">
                            J'accepte que mes données personnelles et mon CV soient traités pour cette candidature. 
                            <a href="<?= site_url('privacy') ?>" class="terms-link">Politique de confidentialité</a>
                        </label>
                    </div>
                </div>

                <!-- Boutons d'action -->
                <div class="form-actions-modal">
                    <button type="submit" class="btn btn-primary btn-large">
                        <i class="fas fa-paper-plane me-2"></i>
                        Soumettre ma candidature
                    </button>
                    <button type="button" class="btn btn-outline-secondary" onclick="closeApplicationModal()">
                        <i class="fas fa-times me-2"></i>
                        Annuler
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
