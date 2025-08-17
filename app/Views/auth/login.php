<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - JobBoard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('css/styles.css') ?>">
</head>
<body class="auth-page">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="auth-container">
                    <div class="auth-header">
                        <h2><i class="fas fa-user-circle me-2"></i>Connexion</h2>
                        <p class="mb-0">Accédez à votre espace personnel</p>
                    </div>
                    
                    <div class="auth-form">
                        <?php if (session()->getFlashdata('error')): ?>
                            <div class="alert alert-danger">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                <?= session()->getFlashdata('error') ?>
                            </div>
                        <?php endif; ?>

                        <?php if (session()->getFlashdata('success')): ?>
                            <div class="alert alert-success">
                                <i class="fas fa-check-circle me-2"></i>
                                <?= session()->getFlashdata('success') ?>
                            </div>
                        <?php endif; ?>

                        <form action="<?= base_url('auth/attemptLogin') ?>" method="post">
                            <?= csrf_field() ?>
                            
                            <div class="mb-3">
                                <label for="email" class="form-label">
                                    <i class="fas fa-envelope me-2"></i>Email
                                </label>
                                <input type="email" 
                                       class="form-control" 
                                       id="email" 
                                       name="email" 
                                       value="<?= old('email') ?>"
                                       required>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">
                                    <i class="fas fa-lock me-2"></i>Mot de passe
                                </label>
                                <input type="password" 
                                       class="form-control" 
                                       id="password" 
                                       name="password" 
                                       required>
                            </div>

                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                <label class="form-check-label" for="remember">
                                    Se souvenir de moi
                                </label>
                            </div>

                            <button type="submit" class="btn btn-primary btn-auth w-100 mb-3">
                                <i class="fas fa-sign-in-alt me-2"></i>Se connecter
                            </button>
                        </form>

                        <div class="text-center mb-3">
                            <a href="<?= base_url('auth/forgotPassword') ?>" class="text-decoration-none">
                                Mot de passe oublié ?
                            </a>
                        </div>

                        <div class="social-auth text-center">
                            <p class="text-muted mb-3">Ou connectez-vous avec</p>
                            <div class="d-flex justify-content-center gap-2">
                                <button class="btn btn-outline-primary">
                                    <i class="fab fa-google me-2"></i>Google
                                </button>
                                <button class="btn btn-outline-primary">
                                    <i class="fab fa-linkedin me-2"></i>LinkedIn
                                </button>
                            </div>
                        </div>

                        <div class="text-center mt-3">
                            <p class="mb-0">
                                Pas encore de compte ? 
                                <a href="<?= base_url('inscription') ?>" class="text-decoration-none">
                                    Créer un compte
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
