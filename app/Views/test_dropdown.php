<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h1>Test du Dropdown</h1>
                </div>
                <div class="card-body">
                    <h2>🔍 Test du menu utilisateur</h2>
                    <p>Cliquez sur votre nom dans la navbar pour tester le dropdown.</p>
                    
                    <h3>Instructions de test :</h3>
                    <ol>
                        <li>Cliquez sur votre nom d'utilisateur dans la navbar (en haut à droite)</li>
                        <li>Le menu devrait s'ouvrir avec les options : Tableau de bord, Mon Profil, Test Shield, Déconnexion</li>
                        <li>Cliquez ailleurs pour fermer le menu</li>
                    </ol>
                    
                    <h3>Statut de l'authentification :</h3>
                    <p>
                        <?php if (is_logged_in()): ?>
                            <span class="badge bg-success">✅ Connecté</span>
                            <br>Utilisateur : <strong><?= esc(current_user()->username) ?></strong>
                        <?php else: ?>
                            <span class="badge bg-warning">⚠️ Non connecté</span>
                            <br><a href="<?= base_url('connexion') ?>" class="btn btn-primary">Se connecter</a>
                        <?php endif; ?>
                    </p>
                    
                    <h3>Débogage JavaScript :</h3>
                    <p>Ouvrez la console du navigateur (F12) pour voir les logs du dropdown.</p>
                    
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i>
                        <strong>Note :</strong> Si le dropdown ne fonctionne pas, vérifiez que :
                        <ul class="mt-2 mb-0">
                            <li>Le fichier <code>public/js/main.js</code> est bien chargé</li>
                            <li>Il n'y a pas d'erreurs JavaScript dans la console</li>
                            <li>Les classes CSS <code>user-dropdown</code> et <code>dropdown-menu</code> sont bien présentes</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
