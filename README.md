# Kladriva - Plateforme de Recrutement IT & Conseil en Croissance

## 🚀 À propos

Kladriva est une plateforme innovante qui accélère la croissance des entreprises IT en connectant les entreprises aux meilleurs consultants et en offrant un système de mentoring personnalisé pour développer les compétences des talents.

## ✨ Fonctionnalités principales

- **Recrutement IT** : Plateforme de recrutement intelligente pour les entreprises
- **Conseil en Croissance** : Accompagnement stratégique par des consultants expérimentés
- **Mentoring & Formation** : Programme personnalisé de développement des compétences
- **Écosystème IA** : Outils et agents IA pour optimiser les processus

## 🛠️ Technologies utilisées

- **Backend** : CodeIgniter 4 (PHP 8.0+)
- **Frontend** : HTML5, CSS3, JavaScript ES6+
- **Design** : Material Design 3, Google Design Practices
- **Responsive** : Mobile-first design
- **SEO** : Optimisé pour les moteurs de recherche

## 📁 Structure du projet

```
jobboard/
├── app/
│   ├── Controllers/     # Contrôleurs de l'application
│   ├── Models/         # Modèles de données
│   ├── Views/          # Vues et templates
│   │   ├── layout/     # Layouts principaux
│   │   └── home/       # Pages spécifiques
│   └── Config/         # Configuration
├── public/             # Fichiers publics
│   ├── css/           # Styles CSS
│   ├── js/            # JavaScript
│   ├── img/           # Images
│   └── .htaccess      # Configuration Apache
├── system/             # CodeIgniter core
└── writable/          # Fichiers temporaires
```

## 🚀 Installation

### Prérequis
- PHP 8.0 ou supérieur
- Composer
- Serveur web (Apache/Nginx)
- Base de données MySQL/PostgreSQL

### Étapes d'installation

1. **Cloner le repository**
   ```bash
   git clone https://github.com/kladriva/jobboard.git
   cd jobboard
   ```

2. **Installer les dépendances**
   ```bash
   composer install
   ```

3. **Configuration**
   - Copier `env` vers `.env`
   - Configurer la base de données dans `.env`
   - Ajuster les paramètres selon votre environnement

4. **Permissions**
   ```bash
   chmod -R 755 writable/
   ```

5. **Lancer l'application**
   ```bash
   php spark serve
   ```

## 🎨 Design et UX

Le design de Kladriva suit les meilleures pratiques de Google Material Design 3 :

- **Palette de couleurs** : Bleus et violets modernes
- **Typographie** : Police Inter pour une excellente lisibilité
- **Espacement** : Système de spacing cohérent
- **Animations** : Transitions fluides et micro-interactions
- **Responsive** : Design mobile-first

## 🔍 Optimisations SEO

- Métadonnées optimisées (Open Graph, Twitter Cards)
- Structure HTML sémantique
- Sitemap XML automatique
- Robots.txt configuré
- Données structurées (Schema.org)
- Performance optimisée (compression, cache)

## 📱 Responsive Design

- **Mobile-first** : Optimisé pour les appareils mobiles
- **Breakpoints** : 480px, 768px, 1024px, 1200px
- **Navigation** : Menu hamburger pour mobile
- **Images** : Optimisées et responsives

## 🚀 Déploiement

### Serveur Web Hosting Canada
- Configuration optimisée pour l'hébergement partagé
- Support des agents IA et MCP
- Intégration avec les outils d'écosystème

### Serveur Debian Contabo
- Configuration serveur dédié
- Optimisations de performance
- Support Docker (optionnel)

## 📊 Performance

- **Core Web Vitals** : Optimisés pour Google
- **Lighthouse Score** : Objectif 90+
- **Temps de chargement** : < 3 secondes
- **Compression** : Gzip/Brotli
- **Cache** : Headers d'expiration optimisés

## 🔒 Sécurité

- Headers de sécurité HTTP
- Protection XSS et CSRF
- Validation des entrées
- Sanitisation des données
- HTTPS obligatoire (production)

## 🤝 Contribution

1. Fork le projet
2. Créer une branche feature (`git checkout -b feature/AmazingFeature`)
3. Commit les changements (`git commit -m 'Add AmazingFeature'`)
4. Push vers la branche (`git push origin feature/AmazingFeature`)
5. Ouvrir une Pull Request

## 📄 Licence

Ce projet est sous licence MIT. Voir le fichier `LICENSE` pour plus de détails.

## 📞 Contact

- **Email** : contact@kladriva.com
- **Site web** : https://kladriva.com
- **LinkedIn** : [Kladriva](https://linkedin.com/company/kladriva)

## 🙏 Remerciements

- CodeIgniter 4 pour le framework robuste
- Google Material Design pour les guidelines de design
- La communauté open source pour les outils et bibliothèques

---

**Kladriva** - Accélérons ensemble la croissance des entreprises IT 🚀
