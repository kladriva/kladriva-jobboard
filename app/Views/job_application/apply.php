<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<!-- Hero Section Candidature -->
<section class="application-hero">
    <div class="container">
        <div class="application-hero-content">
            <div class="application-hero-text">
                <h1 class="application-title">Postuler à l'emploi</h1>
                <h2 class="job-title"><?= esc($job['title']) ?></h2>
                <p class="company-name">chez <strong><?= esc($job['company_name']) ?></strong></p>
                <div class="job-highlights">
                    <div class="highlight-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <span><?= esc($job['location'] ?? 'Lieu non spécifié') ?></span>
                    </div>
                    <div class="highlight-item">
                        <i class="fas fa-clock"></i>
                        <span><?= esc($job['employment_type'] ?? 'Type non spécifié') ?></span>
                    </div>
                    <div class="highlight-item">
                        <i class="fas fa-calendar"></i>
                        <span>Publié le <?= date('d/m/Y', strtotime($job['published_at'] ?? $job['created_at'])) ?></span>
                    </div>
                </div>
            </div>
            <div class="application-hero-visual">
                <div class="application-illustration">
                    <i class="fas fa-file-upload"></i>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Formulaire de Candidature -->
<section class="application-form-section">
    <div class="container">
        <div class="application-form-container">
            <div class="application-form-header">
                <h2>Votre Candidature</h2>
                <p>Complétez le formulaire ci-dessous pour soumettre votre candidature. Assurez-vous que votre CV est à jour et que votre lettre de motivation est pertinente.</p>
            </div>

            <!-- Messages Flash -->
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

            <form class="application-form" action="<?= site_url('job-application/submit') ?>" method="POST" enctype="multipart/form-data">
                <?= csrf_field() ?>
                
                <input type="hidden" name="job_id" value="<?= $job['id'] ?>">
                
                <!-- Informations de l'emploi -->
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-briefcase"></i>
                        Emploi
                    </label>
                    <div class="job-summary">
                        <h4><?= esc($job['title']) ?></h4>
                        <p class="company-info"><?= esc($job['company_name']) ?></p>
                        <p class="job-location"><?= esc($job['location'] ?? 'Lieu non spécifié') ?></p>
                    </div>
                </div>

                <!-- CV Upload -->
                <div class="form-group">
                    <label for="cv" class="form-label">
                        <i class="fas fa-file-pdf"></i>
                        CV * <span class="text-muted">(PDF, DOC, DOCX - Max 2 MB)</span>
                    </label>
                    <input type="file" id="cv" name="cv" class="form-control modern <?= session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['cv']) ? 'is-invalid' : '' ?>" accept=".pdf,.doc,.docx" required>
                    <?php if (session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['cv'])): ?>
                        <div class="invalid-feedback"><?= session()->getFlashdata('errors')['cv'] ?></div>
                    <?php endif; ?>
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
                    <textarea id="cover_letter" name="cover_letter" class="form-control modern <?= session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['cover_letter']) ? 'is-invalid' : '' ?>" rows="6" placeholder="Présentez-vous et expliquez pourquoi vous êtes intéressé par ce poste..."><?= old('cover_letter') ?></textarea>
                    <?php if (session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['cover_letter'])): ?>
                        <div class="invalid-feedback"><?= session()->getFlashdata('errors')['cover_letter'] ?></div>
                    <?php endif; ?>
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
                    <div class="user-info">
                        <p><strong>Nom :</strong> <?= esc(auth()->getUser()->first_name ?? '') ?> <?= esc(auth()->getUser()->last_name ?? '') ?></p>
                        <p><strong>Email :</strong> <?= esc(auth()->getUser()->email ?? '') ?></p>
                        <p><strong>Membre depuis :</strong> <?= date('d/m/Y', strtotime(auth()->getUser()->created_at)) ?></p>
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
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary btn-large">
                        <i class="fas fa-paper-plane me-2"></i>
                        Soumettre ma candidature
                    </button>
                    <a href="<?= site_url("jobs/show/{$job['slug']}") ?>" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i>
                        Retour à l'emploi
                    </a>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- Conseils pour une bonne candidature -->
<section class="application-tips-section">
    <div class="container">
        <div class="tips-content">
            <h2>Conseils pour une candidature réussie</h2>
            <div class="tips-grid">
                <div class="tip-item">
                    <div class="tip-icon">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <h4>CV à jour</h4>
                    <p>Assurez-vous que votre CV est récent et contient toutes vos expériences pertinentes.</p>
                </div>
                <div class="tip-item">
                    <div class="tip-icon">
                        <i class="fas fa-pen-fancy"></i>
                    </div>
                    <h4>Lettre personnalisée</h4>
                    <p>Adaptez votre lettre de motivation au poste et à l'entreprise pour vous démarquer.</p>
                </div>
                <div class="tip-item">
                    <div class="tip-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h4>Réactivité</h4>
                    <p>Postulez rapidement pour montrer votre intérêt et votre réactivité.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
