<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil - JobBoard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('css/styles.css') ?>">
</head>
<body class="auth-page profile">
    <!-- Header -->
    <div class="profile-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1><i class="fas fa-user-circle me-3"></i>Mon Profil</h1>
                    <p class="mb-0">Gérez vos informations personnelles et vos préférences</p>
                </div>
                <div class="col-md-4 text-md-end">
                    <a href="<?= base_url('/') ?>" class="btn btn-outline-light">
                        <i class="fas fa-home me-2"></i>Accueil
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 mb-4">
                <div class="profile-card p-4 text-center">
                    <div class="profile-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <h5 class="mb-1"><?= esc($user->username) ?></h5>
                    <p class="text-muted mb-3"><?= esc($user->email) ?></p>
                    
                    <div class="d-grid gap-2">
                        <a href="<?= base_url('admin') ?>" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-cog me-2"></i>Administration
                        </a>
                        <a href="<?= base_url('auth/logout') ?>" class="btn btn-outline-danger btn-sm">
                            <i class="fas fa-sign-out-alt me-2"></i>Déconnexion
                        </a>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-md-9">
                <div class="profile-card">
                    <!-- Navigation -->
                    <ul class="nav nav-pills nav-fill p-3 border-bottom">
                        <li class="nav-item">
                            <a class="nav-link active" href="#profile" data-bs-toggle="tab">
                                <i class="fas fa-user me-2"></i>Profil
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#security" data-bs-toggle="tab">
                                <i class="fas fa-shield-alt me-2"></i>Sécurité
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#preferences" data-bs-toggle="tab">
                                <i class="fas fa-cog me-2"></i>Préférences
                            </a>
                        </li>
                    </ul>

                    <!-- Tab Content -->
                    <div class="tab-content p-4">
                        <!-- Profile Tab -->
                        <div class="tab-pane fade show active" id="profile">
                            <h4 class="mb-4">Informations personnelles</h4>
                            
                            <form action="<?= base_url('auth/updateProfile') ?>" method="post">
                                <?= csrf_field() ?>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="username" class="form-label">Nom d'utilisateur</label>
                                        <input type="text" 
                                               class="form-control" 
                                               id="username" 
                                               name="username" 
                                               value="<?= esc($user->username) ?>"
                                               required>
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" 
                                               class="form-control" 
                                               id="email" 
                                               name="email" 
                                               value="<?= esc($user->email) ?>"
                                               required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="first_name" class="form-label">Prénom</label>
                                        <input type="text" 
                                               class="form-control" 
                                               id="first_name" 
                                               name="first_name" 
                                               value="<?= old('first_name', $user->first_name ?? '') ?>">
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="last_name" class="form-label">Nom</label>
                                        <input type="text" 
                                               class="form-control" 
                                               id="last_name" 
                                               name="last_name" 
                                               value="<?= old('last_name', $user->last_name ?? '') ?>">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="bio" class="form-label">Biographie</label>
                                    <textarea class="form-control" 
                                              id="bio" 
                                              name="bio" 
                                              rows="3"
                                              placeholder="Parlez-nous de vous..."><?= old('bio', $user->bio ?? '') ?></textarea>
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i>Enregistrer les modifications
                                </button>
                            </form>
                        </div>

                        <!-- Security Tab -->
                        <div class="tab-pane fade" id="security">
                            <h4 class="mb-4">Sécurité</h4>
                            
                            <form action="<?= base_url('auth/changePassword') ?>" method="post">
                                <?= csrf_field() ?>
                                
                                <div class="mb-3">
                                    <label for="current_password" class="form-label">Mot de passe actuel</label>
                                    <input type="password" 
                                           class="form-control" 
                                           id="current_password" 
                                           name="current_password" 
                                           required>
                                </div>

                                <div class="mb-3">
                                    <label for="new_password" class="form-label">Nouveau mot de passe</label>
                                    <input type="password" 
                                           class="form-control" 
                                           id="new_password" 
                                           name="new_password" 
                                           required>
                                </div>

                                <div class="mb-3">
                                    <label for="confirm_password" class="form-label">Confirmer le nouveau mot de passe</label>
                                    <input type="password" 
                                           class="form-control" 
                                           id="confirm_password" 
                                           name="confirm_password" 
                                           required>
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-key me-2"></i>Changer le mot de passe
                                </button>
                            </form>
                        </div>

                        <!-- Preferences Tab -->
                        <div class="tab-pane fade" id="preferences">
                            <h4 class="mb-4">Préférences</h4>
                            
                            <form action="<?= base_url('auth/updatePreferences') ?>" method="post">
                                <?= csrf_field() ?>
                                
                                <div class="mb-3">
                                    <label class="form-label">Notifications</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="email_notifications" name="preferences[email_notifications]" checked>
                                        <label class="form-check-label" for="email_notifications">
                                            Recevoir les notifications par email
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="sms_notifications" name="preferences[sms_notifications]">
                                        <label class="form-check-label" for="sms_notifications">
                                            Recevoir les notifications par SMS
                                        </label>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="language" class="form-label">Langue</label>
                                    <select class="form-select" id="language" name="preferences[language]">
                                        <option value="fr" selected>Français</option>
                                        <option value="en">English</option>
                                        <option value="es">Español</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="timezone" class="form-label">Fuseau horaire</label>
                                    <select class="form-select" id="timezone" name="preferences[timezone]">
                                        <option value="Europe/Paris" selected>Europe/Paris (UTC+1)</option>
                                        <option value="Europe/London">Europe/London (UTC+0)</option>
                                        <option value="America/New_York">America/New_York (UTC-5)</option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i>Enregistrer les préférences
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
