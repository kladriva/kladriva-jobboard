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
                <article class="job-card">
                    
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
                                <a href="<?= site_url('job/' . $job['slug']) ?>"><?= $job['title'] ?></a>
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
                                <span class="job-date">
                                    <i class="fas fa-clock"></i>
                                    <?php 
                                    if (!empty($job['published_at']) && $job['published_at'] !== '0000-00-00 00:00:00') {
                                        echo date('d/m/Y', strtotime($job['published_at']));
                                    } else {
                                        echo date('d/m/Y', strtotime($job['created_at']));
                                    }
                                    ?>
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
                        <a href="<?= site_url('job/' . $job['slug']) ?>" class="btn btn-outline">
                            Voir l'offre
                        </a>
                        <?php if (auth()->loggedIn()): ?>
                            <?php 
                            // Vérifier si l'utilisateur a déjà postulé
                            $hasApplied = false;
                            if (isset($user) && $user) {
                                $jobApplicationModel = new \App\Models\JobApplicationModel();
                                $hasApplied = $jobApplicationModel->hasUserApplied($user->id, $job['id']);
                            }
                            ?>
                            
                            <?php if ($hasApplied): ?>
                                <button class="btn btn-success" disabled>
                                    <i class="fas fa-check-circle"></i>
                                    Candidature soumise
                                </button>
                            <?php else: ?>
                                <button class="btn btn-primary" onclick="openApplicationModal(<?= $job['id'] ?>, '<?= esc($job['title']) ?>', '<?= esc($job['company_name']) ?>', '<?= esc($job['location'] ?? '') ?>')">
                                    <i class="fas fa-paper-plane"></i>
                                    Postuler
                                </button>
                            <?php endif; ?>
                        <?php else: ?>
                            <a href="<?= site_url('auth/login?redirect=' . urlencode(site_url('job/' . $job['slug']))) ?>" class="btn btn-primary">
                                <i class="fas fa-sign-in-alt"></i>
                                Se connecter pour postuler
                            </a>
                        <?php endif; ?>
                    </div>
                </article>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>

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
                <h3 id="modalJobTitle"></h3>
                <p class="company-name">chez <strong id="modalCompanyName"></strong></p>
                <p class="job-location" id="modalJobLocation"></p>
            </div>
            
            <form class="application-form-modal" action="<?= site_url('job-application/submit') ?>" method="POST" enctype="multipart/form-data">
                <?= csrf_field() ?>
                
                <input type="hidden" name="job_id" id="modalJobId">
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

<script>
function openApplicationModal(jobId, jobTitle, companyName, jobLocation) {
    // Mettre à jour le contenu de la modal
    document.getElementById('modalJobId').value = jobId;
    document.getElementById('modalJobTitle').textContent = jobTitle;
    document.getElementById('modalCompanyName').textContent = companyName;
    document.getElementById('modalJobLocation').textContent = jobLocation || 'Lieu non spécifié';
    
    // Mettre à jour le token CSRF
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    if (csrfToken) {
        document.getElementById('modalCsrfToken').value = csrfToken;
    }
    
    // Afficher la modal
    document.getElementById('applicationModal').style.display = 'block';
    document.body.style.overflow = 'hidden';
}

function closeApplicationModal() {
    document.getElementById('applicationModal').style.display = 'none';
    document.body.style.overflow = 'auto';
    
    // Réinitialiser le formulaire
    document.querySelector('.application-form-modal').reset();
}

// Fermer la modal en cliquant à l'extérieur
window.onclick = function(event) {
    const modal = document.getElementById('applicationModal');
    if (event.target === modal) {
        closeApplicationModal();
    }
}
</script>

<?= $this->endSection() ?>
