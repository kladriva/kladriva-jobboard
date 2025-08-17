<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<!-- Formulaire de connexion moderne -->
<div class="auth-page-container">
    <div class="auth-form-wrapper">
        <!-- Header avec logo et titre -->
        <div class="auth-header">
            <div class="auth-logo">
                <div class="logo-circle">
                    <i class="fas fa-briefcase"></i>
                </div>
            </div>
            <h1 class="auth-title">Bienvenue</h1>
            <p class="auth-subtitle">Connectez-vous à votre espace JobBoard</p>
        </div>
        
        <!-- Formulaire principal -->
        <div class="auth-form-container">
            <form action="<?= base_url('auth/attemptLogin') ?>" method="post" class="auth-form">
                <!-- Champ email -->
                <div class="form-group">
                    <div class="input-wrapper">
                        <div class="input-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <input type="email" id="email" name="email" class="form-control modern" 
                               placeholder="Votre adresse email" required>
                        <div class="input-focus-border"></div>
                    </div>
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
                </div>
                
                <!-- Options supplémentaires -->
                <div class="form-options">
                    <div class="form-check modern-check">
                        <input type="checkbox" id="remember" name="remember" class="form-check-input">
                        <label for="remember" class="form-check-label">Se souvenir de moi</label>
                    </div>
                    <a href="<?= base_url('auth/forgotPassword') ?>" class="forgot-link">
                        Mot de passe oublié ?
                    </a>
                </div>
                
                <!-- Bouton de connexion -->
                <button type="submit" class="btn-auth-primary">
                    <span class="btn-content">
                        <i class="fas fa-arrow-right"></i>
                        <span>Se connecter</span>
                    </span>
                    <div class="btn-ripple"></div>
                </button>
            </form>
            
            <!-- Séparateur -->
            <div class="auth-divider">
                <span class="divider-text">ou</span>
            </div>
            
            <!-- Connexion sociale (optionnel) -->
            <div class="social-auth-section">
                <button type="button" class="btn btn-social btn-google">
                    <i class="fab fa-google"></i>
                    Continuer avec Google
                </button>
            </div>
            
            <!-- Liens d'aide -->
            <div class="auth-links">
                <p class="auth-footer-text">
                    Pas encore de compte ? 
                    <a href="<?= base_url('inscription') ?>" class="auth-link highlight">
                        Créer un compte
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
    </div>
</div>

<?= $this->endSection() ?>
