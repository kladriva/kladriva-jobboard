<?= $this->extend('layout/default') ?>

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
                <a href="<?= site_url('/emplois') ?>" class="btn btn-primary btn-large">
                    <i class="fas fa-search"></i>
                    Trouver un emploi
                </a>
                <a href="<?= site_url('/recruter') ?>" class="btn btn-outline btn-large">
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
                <a href="<?= site_url('/recrutement') ?>" class="service-link">En savoir plus <i class="fas fa-arrow-right"></i></a>
            </div>
            
            <div class="service-card">
                <div class="service-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <h3 class="service-title">Conseil en Croissance</h3>
                <p class="service-description">
                    Bénéficiez de l'expertise de consultants expérimentés pour accélérer votre développement et optimiser vos processus.
                </p>
                <a href="<?= site_url('/conseil') ?>" class="service-link">En savoir plus <i class="fas fa-arrow-right"></i></a>
            </div>
            
            <div class="service-card">
                <div class="service-icon">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <h3 class="service-title">Mentoring & Formation</h3>
                <p class="service-description">
                    Développez vos compétences avec notre programme de mentoring personnalisé et nos formations continues en technologies émergentes.
                </p>
                <a href="<?= site_url('/mentoring') ?>" class="service-link">En savoir plus <i class="fas fa-arrow-right"></i></a>
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