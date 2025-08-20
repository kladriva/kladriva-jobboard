<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<!-- Formulaire d'inscription moderne -->
<div class="auth-page-container">
    <div class="auth-form-wrapper">
        <!-- Header avec logo et titre -->
        <div class="auth-header">
            <div class="auth-logo">
                <div class="logo-circle">
                    <i class="fas fa-user-plus"></i>
                </div>
            </div>
            <h1 class="auth-title">Rejoignez-nous</h1>
                            <p class="auth-subtitle">Créez votre compte Kladriva et commencez votre aventure</p>
        </div>
        
        <!-- Formulaire principal -->
        <div class="auth-form-container">
            <!-- Affichage des erreurs -->
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show mb-4">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <?= session()->getFlashdata('error') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>
            
            <!-- Affichage des erreurs de validation -->
            <?php if (session()->getFlashdata('errors')): ?>
                <div class="alert alert-danger alert-dismissible fade show mb-4">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Erreurs de validation :</strong>
                    <ul class="mb-0 mt-2">
                        <?php foreach (session()->getFlashdata('errors') as $field => $error): ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>
            
            <form action="<?= base_url('auth/attemptRegister') ?>" method="post" class="auth-form">
                <?= csrf_field() ?>
                <!-- Champ nom d'utilisateur -->
                <div class="form-group">
                    <div class="input-wrapper">
                        <div class="input-icon">
                            <i class="fas fa-user"></i>
                        </div>
                        <input type="text" id="username" name="username" class="form-control modern" 
                               placeholder="Votre nom d'utilisateur" required 
                               value="<?= old('username') ?>">
                        <div class="input-focus-border"></div>
                    </div>
                    <?php if (session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['username'])): ?>
                        <div class="invalid-feedback d-block">
                            <i class="fas fa-exclamation-circle me-1"></i>
                            <?= esc(session()->getFlashdata('errors')['username']) ?>
                        </div>
                    <?php endif; ?>
                </div>
                
                <!-- Champ email -->
                <div class="form-group">
                    <div class="input-wrapper">
                        <div class="input-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <input type="email" id="email" name="email" class="form-control modern" 
                               placeholder="Votre adresse email" required 
                               value="<?= old('email') ?>">
                        <div class="input-focus-border"></div>
                    </div>
                    <?php if (session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['email'])): ?>
                        <div class="invalid-feedback d-block">
                            <i class="fas fa-exclamation-circle me-1"></i>
                            <?= esc(session()->getFlashdata('errors')['email']) ?>
                        </div>
                    <?php endif; ?>
                </div>
                
                <!-- Champ mot de passe -->
                <div class="form-group">
                    <div class="input-wrapper">
                        <div class="input-icon">
                            <i class="fas fa-lock"></i>
                        </div>
                        <input type="password" id="password" name="password" class="form-control modern" 
                               placeholder="Votre mot de passe" required>
                        <div class="input-focus-border"></div>
                    </div>
                    <?php if (session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['password'])): ?>
                        <div class="invalid-feedback d-block">
                            <i class="fas fa-exclamation-circle me-1"></i>
                            <?= esc(session()->getFlashdata('errors')['password']) ?>
                        </div>
                    <?php endif; ?>
                    <div class="password-strength-indicator">
                        <div class="strength-bar">
                            <div class="strength-fill" data-strength="0"></div>
                        </div>
                        <span class="strength-text">Force du mot de passe</span>
                    </div>
                </div>
                
                <!-- Champ confirmation mot de passe -->
                <div class="form-group">
                    <div class="input-wrapper">
                        <div class="input-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <input type="password" id="password_confirm" name="password_confirm" class="form-control modern" 
                               placeholder="Confirmez votre mot de passe" required>
                        <div class="input-focus-border"></div>
                    </div>
                    <?php if (session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['password_confirm'])): ?>
                        <div class="invalid-feedback d-block">
                            <i class="fas fa-exclamation-circle me-1"></i>
                            <?= esc(session()->getFlashdata('errors')['password_confirm']) ?>
                        </div>
                    <?php endif; ?>
                </div>
                
                <!-- Conditions d'utilisation -->
                <div class="form-group">
                    <div class="form-check modern-check terms-check">
                        <input type="checkbox" id="terms" name="terms" class="form-check-input" required>
                        <label for="terms" class="form-check-label">
                            J'accepte les <a href="<?= base_url('conditions') ?>" class="terms-link">conditions d'utilisation</a> 
                            et la <a href="<?= base_url('confidentialite') ?>" class="terms-link">politique de confidentialité</a>
                        </label>
                    </div>
                </div>
                
                <!-- Bouton d'inscription -->
                <button type="submit" class="btn btn-primary btn-auth-modern">
                    <span class="btn-content">
                        <i class="fas fa-user-plus"></i>
                        <span>Créer mon compte</span>
                    </span>
                    <div class="btn-ripple"></div>
                </button>
            </form>
            
            <!-- Séparateur -->
            <div class="auth-divider">
                <span class="divider-text">ou</span>
            </div>
            
            <!-- Inscription sociale (optionnel) -->
            <div class="social-auth-section">
                <button type="button" class="btn btn-social btn-google">
                    <i class="fab fa-google"></i>
                    S'inscrire avec Google
                </button>
                <button type="button" class="btn btn-social btn-linkedin">
                    <i class="fab fa-linkedin"></i>
                    S'inscrire avec LinkedIn
                </button>
            </div>
            
            <!-- Liens d'aide -->
            <div class="auth-links">
                <p class="auth-footer-text">
                    Déjà un compte ? 
                    <a href="<?= base_url('connexion') ?>" class="auth-link highlight">
                        Se connecter
                    </a>
                </p>
            </div>
        </div>
    </div>
    
    <!-- Éléments décoratifs -->
    <div class="auth-decoration">
        <div class="decoration-circle circle-1"></div>
        <div class="decoration-circle circle-2"></div>
        <div class="decoration-circle circle-3"></div>
        <div class="decoration-circle circle-4"></div>
    </div>
</div>

<!-- Script pour l'indicateur de force du mot de passe -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const passwordInput = document.getElementById('password');
    const strengthFill = document.querySelector('.strength-fill');
    const strengthText = document.querySelector('.strength-text');
    
    passwordInput.addEventListener('input', function() {
        const password = this.value;
        const strength = calculatePasswordStrength(password);
        updateStrengthIndicator(strength);
    });
    
    function calculatePasswordStrength(password) {
        let score = 0;
        
        if (password.length >= 8) score++;
        if (/[a-z]/.test(password)) score++;
        if (/[A-Z]/.test(password)) score++;
        if (/[0-9]/.test(password)) score++;
        if (/[^A-Za-z0-9]/.test(password)) score++;
        
        return Math.min(score, 5);
    }
    
    function updateStrengthIndicator(strength) {
        const percentage = (strength / 5) * 100;
        const colors = ['#ef4444', '#f97316', '#eab308', '#22c55e', '#16a34a'];
        const texts = ['Très faible', 'Faible', 'Moyen', 'Fort', 'Très fort'];
        
        strengthFill.style.width = percentage + '%';
        strengthFill.style.backgroundColor = colors[strength - 1] || '#e5e7eb';
        strengthText.textContent = texts[strength - 1] || 'Force du mot de passe';
        strengthText.style.color = colors[strength - 1] || '#6b7280';
    }
});
</script>

<?= $this->endSection() ?>
