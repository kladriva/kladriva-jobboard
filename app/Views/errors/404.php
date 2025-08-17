<?= $this->extend('layout/default') ?>

<?= $this->section('content') ?>

<section class="error-section">
    <div class="container">
        <div class="error-content">
            <div class="error-visual">
                <div class="error-number">404</div>
                <div class="error-icon">
                    <i class="fas fa-search"></i>
                </div>
            </div>
            
            <h1 class="error-title">Page introuvable</h1>
            <p class="error-description">
                Oups ! Il semble que la page que vous recherchez n'existe pas ou ait été déplacée.
            </p>
            
            <div class="error-actions">
                <a href="<?= site_url('/') ?>" class="btn btn-primary">
                    <i class="fas fa-home"></i>
                    Retour à l'accueil
                </a>
                <a href="<?= site_url('/contact') ?>" class="btn btn-outline">
                    <i class="fas fa-envelope"></i>
                    Nous contacter
                </a>
            </div>
            
            <div class="error-suggestions">
                <h3>Pages populaires</h3>
                <div class="suggestions-grid">
                    <a href="<?= site_url('/emplois') ?>" class="suggestion-link">
                        <i class="fas fa-briefcase"></i>
                        Emplois IT
                    </a>
                    <a href="<?= site_url('/consultants') ?>" class="suggestion-link">
                        <i class="fas fa-user-tie"></i>
                        Consultants
                    </a>
                    <a href="<?= site_url('/mentoring') ?>" class="suggestion-link">
                        <i class="fas fa-graduation-cap"></i>
                        Mentoring
                    </a>
                    <a href="<?= site_url('/entreprises') ?>" class="suggestion-link">
                        <i class="fas fa-building"></i>
                        Entreprises
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.error-section {
    padding: var(--spacing-3xl) 0;
    background: linear-gradient(135deg, var(--primary-50) 0%, var(--secondary-50) 100%);
    min-height: 70vh;
    display: flex;
    align-items: center;
}

.error-content {
    text-align: center;
    max-width: 600px;
    margin: 0 auto;
}

.error-visual {
    margin-bottom: var(--spacing-2xl);
    position: relative;
}

.error-number {
    font-size: 8rem;
    font-weight: 900;
    color: var(--primary-600);
    line-height: 1;
    margin-bottom: var(--spacing-lg);
}

.error-icon {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-size: 3rem;
    color: var(--secondary-400);
    opacity: 0.3;
}

.error-title {
    font-size: var(--font-size-3xl);
    color: var(--neutral-900);
    margin-bottom: var(--spacing-lg);
}

.error-description {
    font-size: var(--font-size-lg);
    color: var(--neutral-600);
    margin-bottom: var(--spacing-2xl);
    line-height: 1.6;
}

.error-actions {
    display: flex;
    gap: var(--spacing-lg);
    justify-content: center;
    margin-bottom: var(--spacing-3xl);
    flex-wrap: wrap;
}

.suggestions-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: var(--spacing-lg);
    margin-top: var(--spacing-lg);
}

.suggestion-link {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: var(--spacing-sm);
    padding: var(--spacing-lg);
    background: white;
    border-radius: var(--radius-lg);
    text-decoration: none;
    color: var(--neutral-700);
    transition: var(--transition-fast);
    border: 1px solid var(--neutral-200);
}

.suggestion-link:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
    color: var(--primary-600);
}

.suggestion-link i {
    font-size: var(--font-size-2xl);
    color: var(--primary-500);
}

@media (max-width: 768px) {
    .error-number {
        font-size: 6rem;
    }
    
    .error-actions {
        flex-direction: column;
        align-items: center;
    }
    
    .suggestions-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<?= $this->endSection() ?>
