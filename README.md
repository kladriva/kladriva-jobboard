# Kladriva - Job Board MVP

## 🚀 À propos

Kladriva est une boîte de conseils dont la mission est d'accélérer la croissance des entreprises. Nous proposons :

- **Consultants sur mesure** pour les entreprises
- **Accompagnement personnalisé** aux consultants débutants
- **Système de mentoring** pour augmenter l'employabilité
- **Écosystème d'outils IA** pour optimiser les processus

## 🎯 Objectif du MVP

Ce job board est la première étape de notre écosystème. Il permet de :
- Connecter consultants et entreprises
- Filtrer les offres par compétences, expérience, localisation
- Présenter les services de mentoring
- Créer une base pour les futurs outils IA

## 🛠️ Technologies utilisées

- **Frontend** : Next.js 15 + React 19
- **Styling** : Tailwind CSS 4
- **TypeScript** : Pour la sécurité du code
- **Icons** : Lucide React
- **Responsive** : Design mobile-first

## 📁 Structure du projet

```
app/
├── page.tsx          # Page d'accueil Kladriva
├── jobs/
│   └── page.tsx     # Job board avec filtres
├── consultants/
│   └── page.tsx     # Présentation des consultants
├── mentoring/
│   └── page.tsx     # Programme de mentoring
└── layout.tsx        # Layout principal
```

## 🚀 Installation et développement

### Prérequis
- Node.js 18+ 
- npm ou yarn

### Installation
```bash
# Cloner le projet
git clone [votre-repo]

# Installer les dépendances
npm install

# Lancer en mode développement
npm run dev
```

### Build de production
```bash
npm run build
npm start
```

## 🌐 Déploiement

### Web Hosting Canada (serveur virtualisé)
- Compatible avec cPanel
- Déployer via FTP ou Git
- Configuration Node.js requis

### Contabo (serveur Debian)
- Déploiement via SSH
- Configuration Nginx/Apache
- Process Manager (PM2) recommandé

## 🔧 Configuration serveur

### Variables d'environnement
```env
NODE_ENV=production
PORT=3000
```

### Nginx (exemple)
```nginx
server {
    listen 80;
    server_name votre-domaine.com;
    
    location / {
        proxy_pass http://localhost:3000;
        proxy_http_version 1.1;
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection 'upgrade';
        proxy_set_header Host $host;
        proxy_cache_bypass $http_upgrade;
    }
}
```

## 📱 Fonctionnalités

### Job Board
- ✅ Recherche par mots-clés
- ✅ Filtres : localisation, type, expérience
- ✅ Affichage des offres avec détails
- ✅ Interface responsive

### Consultants
- ✅ Profils des experts
- ✅ Domaines d'expertise
- ✅ Système de disponibilité
- ✅ Recherche et filtrage

### Mentoring
- ✅ Programmes par niveau
- ✅ Tarification transparente
- ✅ Présentation des mentors
- ✅ CTA pour inscription

## 🎨 Design System

### Couleurs
- **Primaire** : Blue-600 (#2563eb)
- **Secondaire** : Gray-900 (#111827)
- **Accent** : Green-500 (#10b981)

### Typographie
- **Titres** : Font-bold, tailles 2xl-6xl
- **Corps** : Font-normal, tailles base-lg
- **Navigation** : Font-medium

## 🔮 Prochaines étapes

1. **Base de données** : Intégration PostgreSQL/MongoDB
2. **Authentification** : Système de connexion sécurisé
3. **IA Agents** : Outils de matching automatique
4. **API** : Backend pour la gestion des données
5. **Notifications** : Système d'alertes en temps réel

## 📞 Contact

- **Email** : info@kladriva.com
- **Site** : [kladriva.com](https://kladriva.com)

## 📄 Licence

Propriétaire - Kladriva © 2024
