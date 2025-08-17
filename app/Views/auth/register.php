<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - JobBoard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('css/styles.css') ?>">
</head>
<body class="auth-page">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="auth-container">
                    <div class="auth-header">
                        <h2><i class="fas fa-user-plus me-2"></i>Créer votre compte</h2>
                        <p class="mb-0">Rejoignez notre communauté de professionnels</p>
                    </div>
                    
                    <div class="auth-form">
                        <!-- Indicateur d'étapes -->
                        <div class="step-indicator">
                            <div class="step active" id="step1">1</div>
                            <div class="step" id="step2">2</div>
                            <div class="step" id="step3">3</div>
                        </div>

                        <?php if (session()->getFlashdata('error')): ?>
                            <div class="alert alert-danger">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                <?= session()->getFlashdata('error') ?>
                            </div>
                        <?php endif; ?>

                        <?php if (session()->getFlashdata('success')): ?>
                            <div class="alert alert-success">
                                <i class="fas fa-check-circle me-2"></i>
                                <?= session()->getFlashdata('success') ?>
                            </div>
                        <?php endif; ?>

                        <form action="<?= base_url('auth/attemptRegister') ?>" method="post" id="registerForm" novalidate>
                            <?= csrf_field() ?>
                            
                            <!-- Étape 1: Informations de base -->
                            <div class="step-content" id="step1-content">
                                <h5 class="mb-3"><i class="fas fa-user me-2"></i>Informations de base</h5>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="username" class="form-label">Nom d'utilisateur *</label>
                                        <input type="text" 
                                               class="form-control" 
                                               id="username" 
                                               name="username" 
                                               value="<?= old('username') ?>"
                                               required>
                                        <div class="form-text">3-20 caractères, lettres et chiffres uniquement</div>
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="email" class="form-label">Email *</label>
                                        <input type="email" 
                                               class="form-control" 
                                               id="email" 
                                               name="email" 
                                               value="<?= old('email') ?>"
                                               required>
                                        <div class="form-text">Votre email professionnel</div>
                                    </div>
                                </div>

                                <div class="text-end">
                                    <button type="button" class="btn btn-primary" onclick="nextStep(2)">
                                        Suivant <i class="fas fa-arrow-right ms-1"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Étape 2: Sécurité -->
                            <div class="step-content" id="step2-content" style="display: none;">
                                <h5 class="mb-3"><i class="fas fa-shield-alt me-2"></i>Sécurité</h5>
                                
                                <div class="mb-3">
                                    <label for="password" class="form-label">Mot de passe *</label>
                                    <input type="password" 
                                           class="form-control" 
                                           id="password" 
                                           name="password" 
                                           required>
                                    <div class="password-strength">
                                        <div class="progress mb-2">
                                            <div class="progress-bar strength-bar" id="strengthBar" role="progressbar"></div>
                                        </div>
                                        <small class="text-muted" id="strengthText">Force du mot de passe</small>
                                    </div>
                                    
                                    <ul class="requirements-list" id="passwordRequirements">
                                        <li id="req-length"><i class="fas fa-circle"></i> Au moins 8 caractères</li>
                                        <li id="req-lowercase"><i class="fas fa-circle"></i> Une lettre minuscule</li>
                                        <li id="req-uppercase"><i class="fas fa-circle"></i> Une lettre majuscule</li>
                                        <li id="req-number"><i class="fas fa-circle"></i> Un chiffre</li>
                                        <li id="req-special"><i class="fas fa-circle"></i> Un caractère spécial</li>
                                    </ul>
                                </div>

                                <div class="mb-3">
                                    <label for="password_confirm" class="form-label">Confirmer le mot de passe *</label>
                                    <input type="password" 
                                           class="form-control" 
                                           id="password_confirm" 
                                           name="password_confirm" 
                                           required>
                                    <div class="form-text">Répétez votre mot de passe</div>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <button type="button" class="btn btn-outline-secondary" onclick="prevStep(1)">
                                        <i class="fas fa-arrow-left me-1"></i> Précédent
                                    </button>
                                    <button type="button" class="btn btn-primary" onclick="nextStep(3)">
                                        Suivant <i class="fas fa-arrow-right ms-1"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Étape 3: Finalisation -->
                            <div class="step-content" id="step3-content" style="display: none;">
                                <h5 class="mb-3"><i class="fas fa-check-circle me-2"></i>Finalisation</h5>
                                
                                <div class="mb-3">
                                    <label for="user_type" class="form-label">Type de compte *</label>
                                    <select class="form-select" id="user_type" name="user_type" required>
                                        <option value="">Choisissez votre profil</option>
                                        <option value="jobseeker">Candidat à l'emploi</option>
                                        <option value="recruiter">Recruteur</option>
                                        <option value="consultant">Consultant</option>
                                        <option value="student">Étudiant</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="location" class="form-label">Localisation</label>
                                    <input type="text" 
                                           class="form-control" 
                                           id="location" 
                                           name="location" 
                                           placeholder="Ville, Pays">
                                </div>

                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="terms" name="terms" required>
                                    <label class="form-check-label" for="terms">
                                        J'accepte les <a href="<?= base_url('conditions') ?>" target="_blank">conditions d'utilisation</a> *
                                    </label>
                                </div>

                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="privacy" name="privacy" required>
                                    <label class="form-check-label" for="privacy">
                                        J'accepte la <a href="<?= base_url('confidentialite') ?>" target="_blank">politique de confidentialité</a> *
                                    </label>
                                </div>

                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="newsletter" name="newsletter">
                                    <label class="form-check-label" for="newsletter">
                                        Recevoir la newsletter et les offres spéciales
                                    </label>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <button type="button" class="btn btn-outline-secondary" onclick="prevStep(2)">
                                        <i class="fas fa-arrow-left me-1"></i> Précédent
                                    </button>
                                    <button type="submit" class="btn btn-primary btn-register">
                                        <i class="fas fa-user-plus me-2"></i>Créer mon compte
                                    </button>
                                </div>
                            </div>
                        </form>

                        <hr class="my-4">

                        <div class="text-center">
                            <p class="mb-0">
                                Déjà un compte ? 
                                <a href="<?= base_url('connexion') ?>" class="text-decoration-none">
                                    Se connecter
                                </a>
                            </p>
                        </div>

                        <!-- Connexion sociale -->
                        <div class="text-center mt-4">
                            <p class="text-muted mb-3">Ou inscrivez-vous avec</p>
                            <div class="d-flex justify-content-center gap-2">
                                <button class="btn btn-outline-primary">
                                    <i class="fab fa-google me-2"></i>Google
                                </button>
                                <button class="btn btn-outline-primary">
                                    <i class="fab fa-linkedin me-2"></i>LinkedIn
                                </button>
                                <button class="btn btn-outline-primary">
                                    <i class="fab fa-github me-2"></i>GitHub
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let currentStep = 1;
        const totalSteps = 3;

        // Navigation entre les étapes
        function nextStep(step) {
            if (validateCurrentStep()) {
                document.getElementById(`step${currentStep}-content`).style.display = 'none';
                document.getElementById(`step${step}-content`).style.display = 'block';
                
                document.getElementById(`step${currentStep}`).classList.remove('active');
                document.getElementById(`step${currentStep}`).classList.add('completed');
                document.getElementById(`step${step}`).classList.add('active');
                
                currentStep = step;
            }
        }

        function prevStep(step) {
            document.getElementById(`step${currentStep}-content`).style.display = 'none';
            document.getElementById(`step${step}-content`).style.display = 'block';
            
            document.getElementById(`step${currentStep}`).classList.remove('active');
            document.getElementById(`step${step}`).classList.add('active');
            document.getElementById(`step${step}`).classList.remove('completed');
            
            currentStep = step;
        }

        // Validation des étapes
        function validateCurrentStep() {
            if (currentStep === 1) {
                const username = document.getElementById('username').value;
                const email = document.getElementById('email').value;
                
                if (!username || !email) {
                    alert('Veuillez remplir tous les champs obligatoires');
                    return false;
                }
                
                if (username.length < 3 || username.length > 20) {
                    alert('Le nom d\'utilisateur doit contenir entre 3 et 20 caractères');
                    return false;
                }
                
                if (!email.includes('@')) {
                    alert('Veuillez entrer un email valide');
                    return false;
                }
            }
            
            if (currentStep === 2) {
                const password = document.getElementById('password').value;
                const passwordConfirm = document.getElementById('password_confirm').value;
                
                if (!password || !passwordConfirm) {
                    alert('Veuillez remplir tous les champs de mot de passe');
                    return false;
                }
                
                if (password !== passwordConfirm) {
                    alert('Les mots de passe ne correspondent pas');
                    return false;
                }
                
                if (password.length < 8) {
                    alert('Le mot de passe doit contenir au moins 8 caractères');
                    return false;
                }
            }
            
            return true;
        }

        // Validation du mot de passe en temps réel
        document.getElementById('password').addEventListener('input', function() {
            const password = this.value;
            const strengthBar = document.getElementById('strengthBar');
            const strengthText = document.getElementById('strengthText');
            
            let strength = 0;
            let text = '';
            let color = '';
            
            // Vérifier les exigences
            const requirements = {
                length: password.length >= 8,
                lowercase: /[a-z]/.test(password),
                uppercase: /[A-Z]/.test(password),
                number: /[0-9]/.test(password),
                special: /[^A-Za-z0-9]/.test(password)
            };
            
            // Mettre à jour l'affichage des exigences
            Object.keys(requirements).forEach(req => {
                const element = document.getElementById(`req-${req}`);
                if (requirements[req]) {
                    element.classList.add('valid');
                    element.classList.remove('invalid');
                    element.innerHTML = `<i class="fas fa-check-circle"></i> ${element.textContent.replace('●', '')}`;
                    strength++;
                } else {
                    element.classList.add('invalid');
                    element.classList.remove('valid');
                    element.innerHTML = `<i class="fas fa-times-circle"></i> ${element.textContent.replace('●', '')}`;
                }
            });
            
            // Déterminer la force et la couleur
            switch(strength) {
                case 0:
                case 1:
                    text = 'Très faible';
                    color = '#dc3545';
                    break;
                case 2:
                    text = 'Faible';
                    color = '#fd7e14';
                    break;
                case 3:
                    text = 'Moyen';
                    color = '#ffc107';
                    break;
                case 4:
                    text = 'Fort';
                    color = '#28a745';
                    break;
                case 5:
                    text = 'Très fort';
                    color = '#20c997';
                    break;
            }
            
            strengthBar.style.width = (strength * 20) + '%';
            strengthBar.style.backgroundColor = color;
            strengthText.textContent = text;
        });

        // Validation finale du formulaire
        document.getElementById('registerForm').addEventListener('submit', function(e) {
            if (!validateCurrentStep()) {
                e.preventDefault();
                return false;
            }
            
            const terms = document.getElementById('terms').checked;
            const privacy = document.getElementById('privacy').checked;
            
            if (!terms || !privacy) {
                e.preventDefault();
                alert('Veuillez accepter les conditions d\'utilisation et la politique de confidentialité');
                return false;
            }
        });

        // Validation en temps réel des champs
        document.getElementById('username').addEventListener('input', function() {
            const value = this.value;
            if (value.length >= 3 && value.length <= 20) {
                this.classList.add('is-valid');
                this.classList.remove('is-invalid');
            } else {
                this.classList.add('is-invalid');
                this.classList.remove('is-valid');
            }
        });

        document.getElementById('email').addEventListener('input', function() {
            const value = this.value;
            if (value.includes('@') && value.includes('.')) {
                this.classList.add('is-valid');
                this.classList.remove('is-invalid');
            } else {
                this.classList.add('is-invalid');
                this.classList.remove('is-valid');
            }
        });
    </script>
</body>
</html>
