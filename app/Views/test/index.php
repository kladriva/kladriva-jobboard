<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> - JobBoard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h3><i class="fas fa-shield-alt me-2"></i>Test Shield Framework</h3>
                    </div>
                    <div class="card-body">
                        <h5>État de l'authentification :</h5>
                        <ul class="list-group list-group-flush mb-4">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Connecté :
                                <span class="badge bg-<?= $is_logged_in ? 'success' : 'danger' ?>">
                                    <?= $is_logged_in ? 'Oui' : 'Non' ?>
                                </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Utilisateur actuel :
                                <span class="badge bg-info">
                                    <?= $current_user ? $current_user->username : 'Aucun' ?>
                                </span>
                            </li>
                        </ul>

                        <h5>Actions disponibles :</h5>
                        <div class="d-grid gap-2 d-md-block">
                            <?php if ($is_logged_in): ?>
                                <a href="<?= base_url('test/auth') ?>" class="btn btn-success">
                                    <i class="fas fa-user-check me-2"></i>Test Authentification
                                </a>
                                <a href="<?= base_url('auth/profile') ?>" class="btn btn-info">
                                    <i class="fas fa-user-circle me-2"></i>Mon Profil
                                </a>
                                <a href="<?= base_url('auth/logout') ?>" class="btn btn-warning">
                                    <i class="fas fa-sign-out-alt me-2"></i>Déconnexion
                                </a>
                            <?php else: ?>
                                <a href="<?= base_url('connexion') ?>" class="btn btn-primary">
                                    <i class="fas fa-sign-in-alt me-2"></i>Se connecter
                                </a>
                                <a href="<?= base_url('inscription') ?>" class="btn btn-success">
                                    <i class="fas fa-user-plus me-2"></i>S'inscrire
                                </a>
                            <?php endif; ?>
                        </div>

                        <hr>

                        <h5>Utilisation des helpers :</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <h6>Menu d'authentification :</h6>
                                <?= auth_menu() ?>
                            </div>
                            <div class="col-md-6">
                                <h6>Statut d'authentification :</h6>
                                <?= auth_status() ?>
                            </div>
                        </div>

                        <hr>

                        <h5>Informations de session :</h5>
                        <pre class="bg-dark text-light p-3 rounded"><code><?= print_r($session_data, true) ?></code></pre>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
