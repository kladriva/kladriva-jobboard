<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<section class="error-section">
    <div class="container">
        <div class="error-content">
            <div class="error-visual">
                <div class="error-number">500</div>
                <div class="error-icon">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
            </div>
            
            <h1 class="error-title">Erreur serveur</h1>
            <p class="error-description">
                Oups ! Une erreur interne s'est produite sur notre serveur. 
                Nos équipes techniques ont été notifiées et travaillent à résoudre le problème.
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
                <h3>Que pouvez-vous faire ?</h3>
                <div class="suggestions-grid">
                    <div class="suggestion-item">
                        <i class="fas fa-refresh"></i>
                        <h4>Actualiser la page</h4>
                        <p>Essayez de recharger la page dans quelques instants</p>
                    </div>
                    <div class="suggestion-item">
                        <i class="fas fa-clock"></i>
                        <h4>Attendre un moment</h4>
                        <p>Le problème peut être temporaire</p>
                    </div>
                    <div class="suggestion-item">
                        <i class="fas fa-arrow-left"></i>
                        <h4>Retourner en arrière</h4>
                        <p>Utilisez le bouton retour de votre navigateur</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.error-section {
    padding: var(--spacing-3xl) 0;
    background: linear-gradient(135deg, var(--error-50) 0%, var(--warning-50) 100%);
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
    color: var(--error-600);
    line-height: 1;
    margin-bottom: var(--spacing-lg);
}

.error-icon {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-size: 3rem;
    color: var(--warning-400);
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

.suggestion-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: var(--spacing-sm);
    padding: var(--spacing-lg);
    background: white;
    border-radius: var(--radius-lg);
    border: 1px solid var(--neutral-200);
    text-align: center;
}

.suggestion-item i {
    font-size: var(--font-size-3xl);
    color: var(--error-500);
    margin-bottom: var(--spacing-sm);
}

.suggestion-item h4 {
    color: var(--neutral-800);
    font-size: var(--font-size-lg);
    margin-bottom: var(--spacing-xs);
}

.suggestion-item p {
    color: var(--neutral-600);
    font-size: var(--font-size-sm);
    line-height: 1.5;
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
