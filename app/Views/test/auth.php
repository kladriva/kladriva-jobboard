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
                    <div class="card-header bg-success text-white">
                        <h3><i class="fas fa-user-check me-2"></i>Test Authentification Réussi</h3>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle me-2"></i>
                            Félicitations ! Vous êtes maintenant connecté avec Shield.
                        </div>

                        <h5>Informations de l'utilisateur :</h5>
                        <ul class="list-group list-group-flush mb-4">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong>ID :</strong>
                                <span class="badge bg-primary"><?= $user->id ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong>Nom d'utilisateur :</strong>
                                <span class="badge bg-info"><?= esc($user->username) ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong>Email :</strong>
                                <span class="badge bg-secondary"><?= esc($user->email) ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong>Date de création :</strong>
                                <span class="badge bg-dark"><?= $user->created_at ?? 'N/A' ?></span>
                            </li>
                        </ul>

                        <h5>Permissions :</h5>
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h6>admin.access</h6>
                                        <span class="badge bg-<?= $permissions['admin.access'] ? 'success' : 'danger' ?>">
                                            <?= $permissions['admin.access'] ? 'Autorisé' : 'Refusé' ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h6>user.read</h6>
                                        <span class="badge bg-<?= $permissions['user.read'] ? 'success' : 'danger' ?>">
                                            <?= $permissions['user.read'] ? 'Autorisé' : 'Refusé' ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h5>Groupes :</h5>
                        <div class="mb-4">
                            <?php if (!empty($groups)): ?>
                                <?php foreach ($groups as $group): ?>
                                    <span class="badge bg-primary me-2"><?= esc($group) ?></span>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <span class="badge bg-secondary">Aucun groupe</span>
                            <?php endif; ?>
                        </div>

                        <h5>Actions disponibles :</h5>
                        <div class="d-grid gap-2 d-md-block mb-4">
                            <a href="<?= base_url('auth/profile') ?>" class="btn btn-info">
                                <i class="fas fa-user-circle me-2"></i>Mon Profil
                            </a>
                            <a href="<?= base_url('admin') ?>" class="btn btn-warning">
                                <i class="fas fa-cog me-2"></i>Administration
                            </a>
                            <a href="<?= base_url('auth/logout') ?>" class="btn btn-danger">
                                <i class="fas fa-sign-out-alt me-2"></i>Déconnexion
                            </a>
                        </div>

                        <hr>

                        <h5>Test des helpers d'authentification :</h5>
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

                        <div class="text-center mt-4">
                            <a href="<?= base_url('test') ?>" class="btn btn-outline-primary">
                                <i class="fas fa-arrow-left me-2"></i>Retour au test principal
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
