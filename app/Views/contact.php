<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<!-- Hero Section Contact -->
<section class="contact-hero">
    <div class="container">
        <div class="contact-hero-content">
            <div class="contact-hero-text">
                <h1 class="contact-title">Contactez-nous</h1>
                <p class="contact-subtitle">
                    Prêt à transformer votre entreprise ? Discutons de vos besoins en recrutement IT et en conseil en croissance.
                </p>
                <div class="contact-highlights">
                    <div class="highlight-item">
                        <i class="fas fa-clock"></i>
                        <span>Réponse dans les plus brefs délais</span>
                    </div>
                    <div class="highlight-item">
                        <i class="fas fa-users"></i>
                        <span>Consultation gratuite</span>
                    </div>
                    <div class="highlight-item">
                        <i class="fas fa-handshake"></i>
                        <span>Accompagnement personnalisé</span>
                    </div>
                </div>
            </div>
            <div class="contact-hero-visual">
                <div class="contact-illustration">
                    <i class="fas fa-comments"></i>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Form Section -->
<section class="contact-form-section">
    <div class="container">
        <div class="contact-layout">
            <!-- Formulaire de contact -->
            <div class="contact-form-container">
                <div class="contact-form-header">
                    <h2>Envoyez-nous un message</h2>
                    <p>Remplissez le formulaire ci-dessous et nous vous répondrons dans les plus brefs délais.</p>
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
                
                <form class="contact-form" action="<?= site_url('contact/send') ?>" method="POST">
                    <?= csrf_field() ?>
                    
                    <!-- Informations personnelles -->
                    <div class="form-row">
                        <div class="form-group">
                            <label for="first_name" class="form-label">
                                <i class="fas fa-user"></i>
                                Prénom *
                            </label>
                            <input type="text" id="first_name" name="first_name" class="form-control modern <?= session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['first_name']) ? 'is-invalid' : '' ?>" value="<?= old('first_name') ?>" required>
                            <?php if (session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['first_name'])): ?>
                                <div class="invalid-feedback"><?= session()->getFlashdata('errors')['first_name'] ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="last_name" class="form-label">
                                <i class="fas fa-user"></i>
                                Nom *
                            </label>
                            <input type="text" id="last_name" name="last_name" class="form-control modern <?= session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['last_name']) ? 'is-invalid' : '' ?>" value="<?= old('last_name') ?>" required>
                            <?php if (session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['last_name'])): ?>
                                <div class="invalid-feedback"><?= session()->getFlashdata('errors')['last_name'] ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="email" class="form-label">
                                <i class="fas fa-envelope"></i>
                                Email *
                            </label>
                            <input type="email" id="email" name="email" class="form-control modern <?= session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['email']) ? 'is-invalid' : '' ?>" value="<?= old('email') ?>" required>
                            <?php if (session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['email'])): ?>
                                <div class="invalid-feedback"><?= session()->getFlashdata('errors')['email'] ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="phone" class="form-label">
                                <i class="fas fa-phone"></i>
                                Téléphone
                            </label>
                            <input type="tel" id="phone" name="phone" class="form-control modern <?= session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['phone']) ? 'is-invalid' : '' ?>" value="<?= old('phone') ?>">
                            <?php if (session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['phone'])): ?>
                                <div class="invalid-feedback"><?= session()->getFlashdata('errors')['phone'] ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <!-- Informations entreprise -->
                    <div class="form-row">
                        <div class="form-group">
                            <label for="company" class="form-label">
                                <i class="fas fa-building"></i>
                                Entreprise
                            </label>
                            <input type="text" id="company" name="company" class="form-control modern <?= session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['company']) ? 'is-invalid' : '' ?>" value="<?= old('company') ?>">
                            <?php if (session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['company'])): ?>
                                <div class="invalid-feedback"><?= session()->getFlashdata('errors')['company'] ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="position" class="form-label">
                                <i class="fas fa-briefcase"></i>
                                Poste
                            </label>
                            <input type="text" id="position" name="position" class="form-control modern <?= session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['position']) ? 'is-invalid' : '' ?>" value="<?= old('position') ?>">
                            <?php if (session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['position'])): ?>
                                <div class="invalid-feedback"><?= session()->getFlashdata('errors')['position'] ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <!-- Type de demande -->
                    <div class="form-group">
                        <label for="request_type" class="form-label">
                            <i class="fas fa-tag"></i>
                            Type de demande *
                        </label>
                        <select id="request_type" name="request_type" class="form-control modern <?= session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['request_type']) ? 'is-invalid' : '' ?>" required>
                            <option value="">Sélectionnez une option</option>
                            <option value="recrutement" <?= old('request_type') === 'recrutement' ? 'selected' : '' ?>>Recrutement IT</option>
                            <option value="conseil" <?= old('request_type') === 'conseil' ? 'selected' : '' ?>>Conseil en croissance</option>
                            <option value="partenariat" <?= old('request_type') === 'partenariat' ? 'selected' : '' ?>>Partenariat</option>
                            <option value="autre" <?= old('request_type') === 'autre' ? 'selected' : '' ?>>Autre</option>
                        </select>
                        <?php if (session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['request_type'])): ?>
                            <div class="invalid-feedback"><?= session()->getFlashdata('errors')['request_type'] ?></div>
                            <?php endif; ?>
                    </div>
                    
                    <!-- Message -->
                    <div class="form-group">
                        <label for="message" class="form-label">
                            <i class="fas fa-comment"></i>
                            Votre message *
                        </label>
                        <textarea id="message" name="message" class="form-control modern <?= session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['message']) ? 'is-invalid' : '' ?>" rows="6" placeholder="Décrivez votre projet, vos besoins ou vos questions..." required><?= old('message') ?></textarea>
                        <?php if (session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['message'])): ?>
                            <div class="invalid-feedback"><?= session()->getFlashdata('errors')['message'] ?></div>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Consentement -->
                    <div class="form-group">
                        <div class="form-check modern-check <?= session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['consent']) ? 'is-invalid' : '' ?>">
                            <input type="checkbox" id="consent" name="consent" class="form-check-input" <?= old('consent') ? 'checked' : '' ?> required>
                            <label for="consent" class="form-check-label">
                                J'accepte que mes données soient traitées pour traiter ma demande. 
                                <a href="<?= site_url('privacy') ?>" class="terms-link">Politique de confidentialité</a>
                            </label>
                            <?php if (session()->getFlashdata('errors') && isset(session()->getFlashdata('errors')['consent'])): ?>
                                <div class="invalid-feedback"><?= session()->getFlashdata('errors')['consent'] ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <!-- Bouton d'envoi -->
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary btn-large">
                            <i class="fas fa-paper-plane"></i>
                            Envoyer le message
                        </button>
                    </div>
                </form>
            </div>
            
            <!-- Informations de contact -->
            <div class="contact-info-container">
                <div class="contact-info-card">
                    <h3>Nos coordonnées</h3>
                    <p>N'hésitez pas à nous contacter directement ou à utiliser le formulaire ci-contre.</p>
                    
                    <div class="contact-methods">
                        <div class="contact-method">
                            <div class="contact-method-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="contact-method-content">
                                <h4>Email</h4>
                                <p>contact@kladriva.ca</p>
                                <small>Réponse au plus vite</small>
                            </div>
                        </div>
                        
                        <div class="contact-method">
                            <div class="contact-method-icon">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div class="contact-method-content">
                                <h4>Téléphone</h4>
                                <p>+33 1 23 45 67 89</p>
                                <small>Lun-Ven 9h-18h</small>
                            </div>
                        </div>
                        
                        <div class="contact-method">
                            <div class="contact-method-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="contact-method-content">
                                <h4>Adresse</h4>
                                <p>123 Avenue des Champs<br>75008 Paris, France</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="contact-social">
                        <h4>Suivez-nous</h4>
                        <div class="social-links">
                            <a href="https://linkedin.com/company/kladriva" class="social-link linkedin" target="_blank" rel="noopener">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a href="https://twitter.com/kladriva" class="social-link twitter" target="_blank" rel="noopener">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="https://facebook.com/kladriva" class="social-link facebook" target="_blank" rel="noopener">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="contact-cta-section">
    <div class="container">
        <div class="cta-content">
            <h2>Prêt à démarrer votre projet ?</h2>
            <p>Rejoignez les entreprises qui nous font confiance pour leur transformation digitale et leur croissance.</p>
            <div class="cta-actions">
                <a href="<?= site_url('jobs') ?>" class="btn btn-secondary btn-large">
                    <i class="fas fa-search"></i>
                    Voir nos offres
                </a>
            </div>
        </div>
    </div>
</section>

<!-- JavaScript pour la FAQ -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Gestion de la FAQ
    const faqItems = document.querySelectorAll('.faq-item');
    
    faqItems.forEach(item => {
        const question = item.querySelector('.faq-question');
        const answer = item.querySelector('.faq-answer');
        const icon = item.querySelector('.faq-question i');
        
        question.addEventListener('click', () => {
            const isOpen = item.classList.contains('active');
            
            // Fermer tous les autres items
            faqItems.forEach(otherItem => {
                otherItem.classList.remove('active');
                otherItem.querySelector('.faq-answer').style.maxHeight = '0px';
                otherItem.querySelector('.faq-question i').style.transform = 'rotate(0deg)';
            });
            
            // Ouvrir/fermer l'item cliqué
            if (!isOpen) {
                item.classList.add('active');
                answer.style.maxHeight = answer.scrollHeight + 'px';
                icon.style.transform = 'rotate(180deg)';
            }
        });
    });
    
    // Animation des champs de formulaire
    const formInputs = document.querySelectorAll('.form-control.modern');
    
    formInputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('focused');
        });
        
        input.addEventListener('blur', function() {
            if (!this.value) {
                this.parentElement.classList.remove('focused');
            }
        });
    });
});
</script>

<?= $this->endSection() ?>