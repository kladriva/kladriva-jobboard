<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<!-- Hero Section -->
<section class="jobs-hero">
    <div class="container">
        <div class="jobs-hero-content">
            <h1>Trouvez votre prochaine opportunité IT</h1>
            <p>Découvrez des milliers d'offres d'emploi dans le secteur technologique</p>
            
            <!-- Barre de recherche -->
            <div class="search-container">
                <form action="<?= site_url('jobs') ?>" method="GET" class="search-form">
                    <div class="search-inputs">
                        <div class="search-field">
                            <i class="fas fa-search"></i>
                            <input type="text" name="search" placeholder="Titre, compétences, technologies..." 
                                   value="<?= esc($filters['search'] ?? '') ?>">
                        </div>
                        <div class="search-field">
                            <i class="fas fa-map-marker-alt"></i>
                            <input type="text" name="location" placeholder="Localisation..." 
                                   value="<?= esc($filters['location'] ?? '') ?>">
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i>
                            Rechercher
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Filtres et résultats -->
<section class="jobs-content">
    <div class="container">
        <!-- Message de bienvenue pour l'utilisateur connecté -->
        <?php if (isset($user) && $user): ?>
        <div class="welcome-message">
            <div class="welcome-content">
                <i class="fas fa-user-circle"></i>
                <div class="welcome-text">
                    <h3>Bonjour <?= esc($user->username ?? $user->email) ?> !</h3>
                    <p>Bienvenue sur la plateforme des emplois IT. Découvrez les meilleures opportunités qui correspondent à votre profil.</p>
                </div>
            </div>
        </div>
        <?php endif; ?>
        
        <!-- Filtres par catégorie -->
        <div class="categories-filter">
            <h3>Filtrer par catégorie :</h3>
            <div class="categories-list">
                <a href="<?= site_url('jobs') ?>" class="category-item <?= (empty($filters['category'])) ? 'active' : '' ?>">
                    Toutes les catégories
                </a>
                <?php foreach ($categories as $category): ?>
                <a href="<?= site_url('jobs?category=' . $category['id']) ?>" 
                   class="category-item <?= ($filters['category'] == $category['id']) ? 'active' : '' ?>"
                   style="border-color: <?= $category['color'] ?>; color: <?= $category['color'] ?>">
                    <?= $category['name'] ?>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
        
        <!-- Liste des emplois -->
        <div class="jobs-list">
            <div class="jobs-header">
                <h2><?= count($jobs) ?> offre(s) trouvée(s)</h2>
                <div class="jobs-sort">
                    <select name="sort" id="sort-jobs">
                        <option value="recent">Plus récents</option>
                        <option value="featured">Mis en avant</option>
                        <option value="salary">Salaire</option>
                    </select>
                </div>
            </div>
            
            <?php if (empty($jobs)): ?>
            <div class="no-jobs">
                <i class="fas fa-search"></i>
                <h3>Aucun emploi trouvé</h3>
                <p>Essayez de modifier vos critères de recherche</p>
            </div>
            <?php else: ?>
            <div class="jobs-grid">
                <?php foreach ($jobs as $job): ?>
                <article class="job-card <?= $job['is_featured'] ? 'featured' : '' ?>">
                    <?php if ($job['is_featured']): ?>
                    <div class="job-badge featured">
                        <i class="fas fa-star"></i>
                        Mis en avant
                    </div>
                    <?php endif; ?>
                    
                    <div class="job-header">
                        <div class="company-logo">
                            <?php if (!empty($job['company_logo'])): ?>
                            <img src="<?= base_url('uploads/companies/' . $job['company_logo']) ?>" 
                                 alt="<?= $job['company_name'] ?>">
                            <?php else: ?>
                            <div class="company-logo-placeholder">
                                <?= strtoupper(substr($job['company_name'], 0, 2)) ?>
                            </div>
                            <?php endif; ?>
                        </div>
                        <div class="job-info">
                            <h3 class="job-title">
                                <a href="<?= site_url('emploi/' . $job['slug']) ?>"><?= $job['title'] ?></a>
                            </h3>
                            <p class="company-name"><?= $job['company_name'] ?></p>
                            <div class="job-meta">
                                <span class="job-location">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <?= $job['location'] ?>
                                </span>
                                <span class="job-type">
                                    <i class="fas fa-briefcase"></i>
                                    <?= ucfirst($job['contract_type']) ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="job-tags">
                        <span class="job-category" style="background-color: <?= $job['category_color'] ?>20; color: <?= $job['category_color'] ?>">
                            <?= $job['category_name'] ?>
                        </span>
                        <?php if (!empty($job['salary_min'])): ?>
                        <span class="job-salary">
                            <i class="fas fa-euro-sign"></i>
                            <?= number_format($job['salary_min'], 0, ',', ' ') ?> - 
                            <?= number_format($job['salary_max'] ?? $job['salary_min'], 0, ',', ' ') ?> 
                            <?= $job['salary_period'] ?>
                        </span>
                        <?php endif; ?>
                    </div>
                    
                    <div class="job-actions">
                        <a href="<?= site_url('emploi/' . $job['slug']) ?>" class="btn btn-outline">
                            Voir l'offre
                        </a>
                        <a href="<?= site_url('contact?job=' . $job['id']) ?>" class="btn btn-primary">
                            Postuler
                        </a>
                    </div>
                </article>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
