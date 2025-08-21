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

-- Structure finale de la table users
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `first_name` varchar(100) NULL,      
  `last_name` varchar(100) NULL,        
  `phone` varchar(20) NULL,            
  `location` varchar(200) NULL,         
  `status` varchar(255) NULL,
  `status_message` varchar(255) NULL,
  `active` tinyint(1) NULL,
  `last_active` datetime NULL,
  `created_at` datetime NULL,
  `updated_at` datetime NULL,
  `deleted_at` datetime NULL,
  PRIMARY KEY (`id`)
);

