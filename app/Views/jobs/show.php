<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<!-- Breadcrumb -->
<section class="breadcrumb-section">
    <div class="container">
        <nav class="breadcrumb-nav">
            <a href="<?= site_url('/') ?>">Accueil</a>
            <i class="fas fa-chevron-right"></i>
            <a href="<?= site_url('emplois') ?>">Emplois</a>
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
                            <span>Publié le <?= date('d/m/Y', strtotime($job['published_at'])) ?></span>
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
                        <?php if ($job['is_featured']): ?>
                        <span class="job-badge-main featured">
                            <i class="fas fa-star"></i>
                            Mis en avant
                        </span>
                        <?php endif; ?>
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
                <a href="<?= site_url('contact?job=' . $job['id']) ?>" class="btn btn-primary btn-large">
                    <i class="fas fa-paper-plane"></i>
                    Postuler maintenant
                </a>
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
                        <a href="<?= site_url('entreprise/' . ($job['company_slug'] ?? '')) ?>" class="btn btn-outline btn-block">
                            Voir l'entreprise
                        </a>
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
                    <a href="<?= site_url('emploi/' . $related_job['slug']) ?>"><?= $related_job['title'] ?></a>
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
                <a href="<?= site_url('emploi/' . $related_job['slug']) ?>" class="btn btn-outline btn-sm">
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
</script>

<?= $this->endSection() ?>
