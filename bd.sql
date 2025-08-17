-- Table des catégories d'emplois
CREATE TABLE job_categories (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    slug VARCHAR(100) UNIQUE NOT NULL,
    description TEXT,
    icon VARCHAR(50),
    color VARCHAR(7) DEFAULT '#3b82f6',
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Table des entreprises
CREATE TABLE companies (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(200) NOT NULL,
    slug VARCHAR(200) UNIQUE NOT NULL,
    description TEXT,
    logo VARCHAR(255),
    website VARCHAR(255),
    industry VARCHAR(100),
    size VARCHAR(50),
    location VARCHAR(200),
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Table principale des emplois
CREATE TABLE jobs (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(200) NOT NULL,
    slug VARCHAR(200) UNIQUE NOT NULL,
    company_id INT NOT NULL,
    category_id INT NOT NULL,
    
    -- Informations de base
    description TEXT NOT NULL,
    requirements TEXT,
    benefits TEXT,
    salary_min DECIMAL(10,2),
    salary_max DECIMAL(10,2),
    salary_currency VARCHAR(3) DEFAULT 'EUR',
    salary_period VARCHAR(20) DEFAULT 'annuel',
    
    -- Localisation et type
    location VARCHAR(200) NOT NULL,
    location_type ENUM('remote', 'hybrid', 'onsite') DEFAULT 'onsite',
    contract_type ENUM('cdi', 'cdd', 'freelance', 'stage', 'alternance') NOT NULL,
    experience_level ENUM('junior', 'mid', 'senior', 'expert') DEFAULT 'mid',
    
    -- Compétences requises
    skills_required TEXT,
    technologies TEXT,
    
    -- Processus
    status ENUM('draft', 'published', 'closed', 'archived') DEFAULT 'draft',
    is_featured BOOLEAN DEFAULT FALSE,
    is_urgent BOOLEAN DEFAULT FALSE,
    published_at TIMESTAMP NULL,
    expires_at TIMESTAMP NULL,
    
    -- Métadonnées
    views_count INT DEFAULT 0,
    applications_count INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    FOREIGN KEY (company_id) REFERENCES companies(id) ON DELETE CASCADE,
    FOREIGN KEY (category_id) REFERENCES job_categories(id) ON DELETE CASCADE,
    
    INDEX idx_status (status),
    INDEX idx_category (category_id),
    INDEX idx_company (company_id),
    INDEX idx_location (location),
    INDEX idx_published (published_at),
    INDEX idx_featured (is_featured)
);

-- ===== DONNÉES DE TEST =====

-- Insertion des catégories d'emplois
INSERT INTO job_categories (name, slug, description, icon, color, is_active) VALUES
('Développement Web', 'developpement-web', 'Développement d\'applications web et sites internet', 'fas fa-laptop-code', '#3b82f6', 1),
('Développement Mobile', 'developpement-mobile', 'Développement d\'applications mobiles iOS et Android', 'fas fa-mobile-alt', '#10b981', 1),
('Base de Données', 'base-de-donnees', 'Administration et développement de bases de données', 'fas fa-database', '#f59e0b', 1),
('DevOps & Infrastructure', 'devops-infrastructure', 'Gestion de l\'infrastructure et déploiement', 'fas fa-server', '#8b5cf6', 1),
('Intelligence Artificielle', 'intelligence-artificielle', 'Machine Learning et IA', 'fas fa-robot', '#ef4444', 1),
('Sécurité Informatique', 'securite-informatique', 'Cybersécurité et protection des données', 'fas fa-shield-alt', '#06b6d4', 1);

-- Insertion des entreprises
INSERT INTO companies (name, slug, description, industry, size, location, is_active) VALUES
('TechStartup', 'techstartup', 'Startup innovante dans le domaine de la fintech', 'Fintech', 'startup', 'Paris, France', 1),
('DigitalCorp', 'digitalcorp', 'Agence digitale spécialisée dans la transformation numérique', 'Marketing Digital', 'medium', 'Lyon, France', 1),
('CloudTech', 'cloudtech', 'Expert en solutions cloud et infrastructure', 'Technologie', 'small', 'Marseille, France', 1),
('DataLab', 'datalab', 'Laboratoire spécialisé dans l\'analyse de données', 'Data Science', 'medium', 'Toulouse, France', 1);

-- Insertion des emplois
INSERT INTO jobs (title, slug, company_id, category_id, description, requirements, benefits, salary_min, salary_max, location, contract_type, experience_level, skills_required, technologies, status, is_featured, published_at) VALUES
('Développeur Full Stack React/Node.js', 'developpeur-full-stack-react-nodejs', 1, 1, 'Nous recherchons un développeur full stack pour rejoindre notre équipe et participer au développement de notre plateforme fintech.', 'Minimum 2 ans d\'expérience en développement web, maîtrise de React et Node.js', 'Télétravail possible, équipe jeune et dynamique, projets innovants', 45000, 65000, 'Paris, France', 'cdi', 'mid', 'React, Node.js, JavaScript, HTML/CSS, Git', 'React, Node.js, MongoDB, AWS, Docker', 'published', 1, NOW()),
('Développeur Mobile iOS', 'developpeur-mobile-ios', 2, 2, 'Rejoignez notre équipe mobile pour développer des applications iOS innovantes et performantes.', 'Expérience en développement iOS, maîtrise de Swift', 'Formation continue, équipement Apple, télétravail hybride', 50000, 70000, 'Lyon, France', 'cdi', 'mid', 'Swift, iOS SDK, Git, Agile', 'Swift, Xcode, Core Data, Firebase', 'published', 0, NOW()),
('DevOps Engineer', 'devops-engineer', 3, 4, 'Nous cherchons un ingénieur DevOps pour optimiser nos processus de déploiement et notre infrastructure cloud.', 'Expérience en CI/CD, Docker, Kubernetes, AWS', 'Formation certifiante, télétravail complet, horaires flexibles', 55000, 75000, 'Marseille, France', 'cdi', 'senior', 'Docker, Kubernetes, AWS, CI/CD, Linux', 'Docker, Kubernetes, AWS, Jenkins, Terraform', 'published', 1, NOW()),
('Data Scientist', 'data-scientist', 4, 5, 'Rejoignez notre équipe de data scientists pour développer des modèles prédictifs innovants.', 'Master en Data Science, expérience en Python et ML', 'Projets de recherche, publication scientifique, équipe internationale', 60000, 80000, 'Toulouse, France', 'cdi', 'senior', 'Python, Machine Learning, Statistiques, SQL', 'Python, TensorFlow, PyTorch, PostgreSQL, AWS', 'published', 0, NOW());