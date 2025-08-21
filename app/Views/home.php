<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<!-- Hero Section -->
<section class="hero-section">
    <div class="hero-container">
        <div class="hero-content">
            <h1 class="hero-title">
                Accélérez la <span class="highlight">croissance</span> de votre entreprise IT
            </h1>
            <p class="hero-subtitle">
                Kladriva connecte les entreprises aux meilleurs consultants IT et accompagne les talents dans leur développement professionnel grâce à un système de mentoring innovant.
            </p>
            <div class="hero-actions">
                <a href="<?= site_url('/jobs') ?>" class="btn btn-primary btn-large">
                    <i class="fas fa-search"></i>
                    Trouver un emploi
                </a>
                <a href="<?= site_url('/contact') ?>" class="btn btn-outline btn-large">
                    <i class="fas fa-users"></i>
                    Recruter des talents
                </a>
            </div>
        </div>
        <div class="hero-visual">
            <div class="hero-image">
                <i class="fas fa-rocket hero-icon"></i>
            </div>
        </div>
    </div>
</section>

<!-- Section Utilisateur Connecté -->
<?php if (is_logged_in()): ?>
<section class="user-welcome-section">
    <div class="container">
        <div class="user-welcome-card">
            <div class="user-welcome-content">
                <h2>Bienvenue, <?= esc(current_user()->username) ?> !</h2>
                <p>Vous êtes connecté à votre espace personnel. Accédez rapidement à vos fonctionnalités.</p>
                <div class="user-welcome-actions">
                    <a href="<?= base_url('dashboard') ?>" class="btn btn-primary">
                        <i class="fas fa-tachometer-alt"></i>
                        Tableau de bord
                    </a>
                                            <a href="<?= base_url('auth/logout') ?>" class="btn btn-outline btn-danger">
                        <i class="fas fa-sign-out-alt"></i>
                        Déconnexion
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Stats Section -->
<section class="stats-section">
    <div class="container">
        <div class="stats-grid">
            <div class="stat-item">
                <div class="stat-number">500+</div>
                <div class="stat-label">Entreprises accompagnées</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">2000+</div>
                <div class="stat-label">Consultants qualifiés</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">95%</div>
                <div class="stat-label">Taux de satisfaction</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">24h</div>
                <div class="stat-label">Délai de réponse moyen</div>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="services-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Nos Solutions</h2>
            <p class="section-subtitle">Découvrez comment Kladriva peut transformer votre entreprise</p>
        </div>
        
        <div class="services-grid">
            <div class="service-card">
                <div class="service-icon">
                    <i class="fas fa-user-tie"></i>
                </div>
                <h3 class="service-title">Recrutement IT</h3>
                <p class="service-description">
                    Trouvez les meilleurs talents IT pour votre équipe grâce à notre plateforme de recrutement intelligente et notre réseau de consultants qualifiés.
                </p>
                <a href="<?= site_url('/about') ?>" class="service-link">En savoir plus <i class="fas fa-arrow-right"></i></a>
            </div>
            
            <div class="service-card">
                <div class="service-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <h3 class="service-title">Conseil en Croissance</h3>
                <p class="service-description">
                    Bénéficiez de l'expertise de consultants expérimentés pour accélérer votre développement et optimiser vos processus.
                </p>
                <a href="<?= site_url('/about') ?>" class="service-link">En savoir plus <i class="fas fa-arrow-right"></i></a>
            </div>
            
            <div class="service-card">
                <div class="service-icon">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <h3 class="service-title">Mentoring & Formation</h3>
                <p class="service-description">
                    Développez vos compétences avec notre programme de mentoring personnalisé et nos formations continues en technologies émergentes.
                </p>
                <a href="<?= site_url('/about') ?>" class="service-link">En savoir plus <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
</section>

<!-- Services Details Section -->
<section class="services-details-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Nos Services Spécialisés</h2>
            <p class="section-subtitle">Découvrez nos solutions complètes pour tous vos besoins</p>
        </div>
        
        <div class="services-details-grid">
            <div class="service-detail-card">
                <div class="service-detail-icon">
                    <i class="fas fa-users-cog"></i>
                </div>
                <h3 class="service-detail-title">Consultants IT</h3>
                <p class="service-detail-description">
                    Accédez à notre réseau de consultants IT expérimentés et certifiés. Que ce soit pour un projet ponctuel ou une mission de longue durée, nous vous proposons les meilleurs profils adaptés à vos besoins spécifiques.
                </p>
                <div class="service-detail-features">
                    <ul>
                        <li>Profils validés et certifiés</li>
                        <li>Expertise dans toutes les technologies</li>
                        <li>Flexibilité des engagements</li>
                        <li>Support et suivi continu</li>
                    </ul>
                </div>
                <a href="<?= site_url('/contact') ?>" class="service-detail-link">Découvrir nos consultants <i class="fas fa-arrow-right"></i></a>
            </div>
            
            <div class="service-detail-card">
                <div class="service-detail-icon">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <h3 class="service-detail-title">Programme de Mentoring</h3>
                <p class="service-detail-description">
                    Développez vos compétences avec notre programme de mentoring personnalisé. Nos mentors expérimentés vous accompagnent dans votre évolution professionnelle et vous aident à atteindre vos objectifs de carrière.
                </p>
                <div class="service-detail-features">
                    <ul>
                        <li>Mentoring personnalisé 1-on-1</li>
                        <li>Suivi régulier et objectifs définis</li>
                        <li>Accès à un réseau d'experts</li>
                        <li>Certifications et accréditations</li>
                    </ul>
                </div>
                <a href="<?= site_url('/contact') ?>" class="service-detail-link">Découvrir le mentoring <i class="fas fa-arrow-right"></i></a>
            </div>
            
            <div class="service-detail-card">
                <div class="service-detail-icon">
                    <i class="fas fa-building"></i>
                </div>
                <h3 class="service-detail-title">Solutions Entreprises</h3>
                <p class="service-detail-description">
                    Nous accompagnons les entreprises dans leur transformation digitale et leur croissance. De la stratégie à l'implémentation, nos solutions s'adaptent à la taille et aux enjeux de votre organisation.
                </p>
                <div class="service-detail-features">
                    <ul>
                        <li>Audit et conseil stratégique</li>
                        <li>Accompagnement au changement</li>
                        <li>Formation des équipes</li>
                        <li>Support technique et opérationnel</li>
                    </ul>
                </div>
                <a href="<?= site_url('/contact') ?>" class="service-detail-link">Découvrir nos solutions <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
</section>

<!-- How It Works Section -->
<section class="how-it-works-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Comment ça marche ?</h2>
            <p class="section-subtitle">Un processus simple et efficace en 3 étapes</p>
        </div>
        
        <div class="steps-grid">
            <div class="step-item">
                <div class="step-number">1</div>
                <div class="step-content">
                    <h3 class="step-title">Analyse des Besoins</h3>
                    <p class="step-description">
                        Nous analysons vos besoins spécifiques et identifions les meilleures solutions pour votre entreprise.
                    </p>
                </div>
            </div>
            
            <div class="step-item">
                <div class="step-number">2</div>
                <div class="step-content">
                    <h3 class="step-title">Mise en Relation</h3>
                    <p class="step-description">
                        Nous vous connectons avec des consultants qualifiés qui correspondent parfaitement à vos exigences.
                    </p>
                </div>
            </div>
            
            <div class="step-item">
                <div class="step-number">3</div>
                <div class="step-content">
                    <h3 class="step-title">Accompagnement Continu</h3>
                    <p class="step-description">
                        Nous assurons un suivi régulier et un accompagnement pour garantir le succès de votre projet.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="testimonials-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Ils nous font confiance</h2>
            <p class="section-subtitle">Découvrez les témoignages de nos clients satisfaits</p>
        </div>
        
        <div class="testimonials-grid">
            <div class="testimonial-card">
                <div class="testimonial-content">
                    <p>"Kladriva nous a permis de trouver des développeurs talentueux en seulement 2 semaines. Leur approche personnalisée a fait toute la différence."</p>
                </div>
                <div class="testimonial-author">
                    <div class="author-info">
                        <h4 class="author-name">Marie Dubois</h4>
                        <p class="author-title">CTO, TechStartup</p>
                    </div>
                </div>
            </div>
            
            <div class="testimonial-card">
                <div class="testimonial-content">
                    <p>"Grâce au programme de mentoring de Kladriva, j'ai pu développer mes compétences en IA et obtenir une promotion dans les 6 mois."</p>
                </div>
                <div class="testimonial-author">
                    <div class="author-info">
                        <h4 class="author-name">Thomas Martin</h4>
                        <p class="author-title">Développeur Senior</p>
                    </div>
                </div>
            </div>
            
            <div class="testimonial-card">
                <div class="testimonial-content">
                    <p>"L'équipe de Kladriva a transformé notre processus de recrutement. Nous économisons maintenant 40% de temps et trouvons des candidats de meilleure qualité."</p>
                </div>
                <div class="testimonial-author">
                    <div class="author-info">
                        <h4 class="author-name">Sophie Tremblay</h4>
                        <p class="author-title">DRH, FinTech Solutions</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="container">
        <div class="cta-content">
            <h2 class="cta-title">Prêt à accélérer votre croissance ?</h2>
            <p class="cta-subtitle">
                Rejoignez les centaines d'entreprises qui font confiance à Kladriva pour leur développement.
            </p>
            <div class="cta-actions">
                <a href="<?= site_url('/inscription') ?>" class="btn btn-primary btn-large">Commencer maintenant</a>
                <a href="<?= site_url('/contact') ?>" class="btn btn-outline btn-large">Parler à un expert</a>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>