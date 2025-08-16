# Guide de Déploiement Kladriva

## 🌐 Serveur Web Hosting Canada (Virtualisé)

### Prérequis
- Accès cPanel
- Support Node.js activé
- Accès FTP/SFTP

### Étapes de déploiement

#### 1. Préparation du build
```bash
# Dans votre environnement de développement
npm run build
```

#### 2. Configuration cPanel
1. Connectez-vous à votre cPanel
2. Allez dans "Setup Node.js App"
3. Créez une nouvelle application :
   - **Node.js version** : 18.x ou 20.x
   - **Application mode** : Production
   - **Application root** : `/home/username/kladriva`
   - **Application URL** : `votre-domaine.com`
   - **Application startup file** : `server.js`

#### 3. Création du serveur personnalisé
Créez un fichier `server.js` à la racine :
```javascript
const { createServer } = require('http');
const { parse } = require('url');
const next = require('next');

const dev = process.env.NODE_ENV !== 'production';
const hostname = 'localhost';
const port = process.env.PORT || 3000;

const app = next({ dev, hostname, port });
const handle = app.getRequestHandler();

app.prepare().then(() => {
  createServer(async (req, res) => {
    try {
      const parsedUrl = parse(req.url, true);
      await handle(req, res, parsedUrl);
    } catch (err) {
      console.error('Error occurred handling', req.url, err);
      res.statusCode = 500;
      res.end('internal server error');
    }
  }).listen(port, (err) => {
    if (err) throw err;
    console.log(`> Ready on http://${hostname}:${port}`);
  });
});
```

#### 4. Upload des fichiers
1. Uploadez via FTP :
   - Dossier `.next/`
   - Fichier `server.js`
   - Fichier `package.json`
   - Fichier `next.config.ts`

2. Installez les dépendances :
```bash
npm install --production
```

#### 5. Démarrage de l'application
Dans cPanel > Setup Node.js App :
- Cliquez sur "Restart" pour votre application

---

## 🖥️ Serveur Contabo (Debian)

### Prérequis
- Accès SSH root
- Serveur Debian 11/12
- Domaine configuré

### Installation et configuration

#### 1. Mise à jour du système
```bash
sudo apt update && sudo apt upgrade -y
sudo apt install curl git nginx certbot python3-certbot-nginx -y
```

#### 2. Installation de Node.js
```bash
curl -fsSL https://deb.nodesource.com/setup_20.x | sudo -E bash -
sudo apt-get install -y nodejs

# Vérification
node --version
npm --version
```

#### 3. Installation de PM2
```bash
sudo npm install -g pm2
```

#### 4. Configuration de l'utilisateur
```bash
# Créer un utilisateur pour l'application
sudo adduser kladriva
sudo usermod -aG sudo kladriva

# Passer à l'utilisateur
su - kladriva
```

#### 5. Déploiement de l'application
```bash
# Cloner le projet
git clone [votre-repo] /home/kladriva/app
cd /home/kladriva/app

# Installer les dépendances
npm install

# Build de production
npm run build

# Créer le fichier serveur
cat > server.js << 'EOF'
const { createServer } = require('http');
const { parse } = require('url');
const next = require('next');

const dev = process.env.NODE_ENV !== 'production';
const hostname = 'localhost';
const port = process.env.PORT || 3000;

const app = next({ dev, hostname, port });
const handle = app.getRequestHandler();

app.prepare().then(() => {
  createServer(async (req, res) => {
    try {
      const parsedUrl = parse(req.url, true);
      await handle(req, res, parsedUrl);
    } catch (err) {
      console.error('Error occurred handling', req.url, err);
      res.statusCode = 500;
      res.end('internal server error');
    }
  }).listen(port, (err) => {
    if (err) throw err;
    console.log(`> Ready on http://${hostname}:${port}`);
  });
});
EOF

# Démarrer avec PM2
pm2 start server.js --name "kladriva"
pm2 save
pm2 startup
```

#### 6. Configuration Nginx
```bash
sudo nano /etc/nginx/sites-available/kladriva
```

Contenu :
```nginx
server {
    listen 80;
    server_name votre-domaine.com www.votre-domaine.com;
    
    location / {
        proxy_pass http://localhost:3000;
        proxy_http_version 1.1;
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection 'upgrade';
        proxy_set_header Host $host;
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
        proxy_set_header X-Forwarded-Proto $scheme;
        proxy_cache_bypass $http_upgrade;
    }
    
    # Gestion des fichiers statiques
    location /_next/static {
        alias /home/kladriva/app/.next/static;
        expires 365d;
        access_log off;
    }
    
    # Gestion des images
    location /images {
        expires 30d;
        add_header Cache-Control "public, immutable";
    }
}
```

Activer le site :
```bash
sudo ln -s /etc/nginx/sites-available/kladriva /etc/nginx/sites-enabled/
sudo nginx -t
sudo systemctl reload nginx
```

#### 7. Configuration SSL avec Let's Encrypt
```bash
sudo certbot --nginx -d votre-domaine.com -d www.votre-domaine.com
```

#### 8. Configuration du firewall
```bash
sudo ufw allow 22
sudo ufw allow 80
sudo ufw allow 443
sudo ufw enable
```

---

## 🔧 Configuration des variables d'environnement

### Créer un fichier `.env`
```bash
# Production
NODE_ENV=production
PORT=3000
NEXT_PUBLIC_SITE_URL=https://votre-domaine.com

# Base de données (pour les prochaines étapes)
# DATABASE_URL=postgresql://user:password@localhost:5432/kladriva
# JWT_SECRET=votre-secret-jwt
```

---

## 📊 Monitoring et maintenance

### PM2 (serveur Contabo)
```bash
# Voir les processus
pm2 list

# Voir les logs
pm2 logs kladriva

# Redémarrer l'application
pm2 restart kladriva

# Mettre à jour l'application
cd /home/kladriva/app
git pull
npm install
npm run build
pm2 restart kladriva
```

### Nginx (serveur Contabo)
```bash
# Vérifier la configuration
sudo nginx -t

# Recharger la configuration
sudo systemctl reload nginx

# Voir les logs
sudo tail -f /var/log/nginx/access.log
sudo tail -f /var/log/nginx/error.log
```

---

## 🚀 Déploiement automatique (optionnel)

### Webhook GitHub
1. Créer un script de déploiement
2. Configurer un webhook GitHub
3. Automatiser le build et redémarrage

### Script de déploiement
```bash
#!/bin/bash
cd /home/kladriva/app
git pull origin main
npm install
npm run build
pm2 restart kladriva
echo "Déploiement terminé"
```

---

## 🔍 Vérification du déploiement

1. **Test de l'application** : `https://votre-domaine.com`
2. **Vérification des performances** : Google PageSpeed Insights
3. **Test de sécurité** : SSL Labs
4. **Monitoring** : Uptime, logs, métriques

---

## 📞 Support

En cas de problème :
1. Vérifiez les logs PM2 : `pm2 logs kladriva`
2. Vérifiez les logs Nginx : `/var/log/nginx/`
3. Vérifiez la configuration : `nginx -t`
4. Redémarrez les services si nécessaire
