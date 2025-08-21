<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<div class="profile-page-container">
    <div class="container">
        <div class="profile-header">
            <h1 class="profile-title">Mon Profil</h1>
            <p class="profile-subtitle">Gérez vos informations personnelles</p>
        </div>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show mb-4">
                <i class="fas fa-check-circle me-2"></i>
                <?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show mb-4">
                <i class="fas fa-exclamation-triangle me-2"></i>
                <?= session()->getFlashdata('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <div class="profile-content">
            <!-- Formulaire centré -->
            <div class="profile-card">
                <div class="profile-card-header">
                    <h3 class="card-title">
                        <i class="fas fa-user-circle me-2"></i>
                        Informations Personnelles
                    </h3>
                    <button class="btn btn-sm btn-outline-light" onclick="toggleEdit('personal-info')">
                        <i class="fas fa-edit"></i> Modifier
                    </button>
                </div>
                <div class="profile-card-body">
                    <form id="personal-info-form" action="<?= base_url('auth/update-profile') ?>" method="post" style="display: none;">
                        <?= csrf_field() ?>
                        <div class="profile-info-grid">
                            <div class="info-item">
                                <label class="info-label">Nom d'utilisateur :</label>
                                <input type="text" name="username" value="<?= esc($user->username) ?>" class="form-control" required>
                            </div>
                            
                            <div class="info-item">
                                <label class="info-label">Prénom :</label>
                                <input type="text" name="first_name" value="<?= esc($user->first_name ?? '') ?>" class="form-control">
                            </div>
                            
                            <div class="info-item">
                                <label class="info-label">Nom :</label>
                                <input type="text" name="last_name" value="<?= esc($user->last_name ?? '') ?>" class="form-control">
                            </div>
                            
                            <div class="info-item">
                                <label class="info-label">Email :</label>
                                <span class="info-value">
                                    <?php 
                                    $userEmail = 'Non défini';
                                    if (isset($identities) && !empty($identities)) {
                                        foreach ($identities as $identity) {
                                            if ($identity->type === 'email') {
                                                $userEmail = esc($identity->secret);
                                                break;
                                            }
                                        }
                                    }
                                    echo $userEmail;
                                    ?>
                                </span>
                            </div>
                            
                            <div class="info-item">
                                <label class="info-label">Téléphone :</label>
                                <input type="tel" name="phone" value="<?= esc($user->phone ?? '') ?>" class="form-control" placeholder="+237 621210000">
                            </div>
                            
                            <div class="info-item">
                                <label class="info-label">Localisation :</label>
                                <input type="text" name="location" value="<?= esc($user->location ?? '') ?>" class="form-control" placeholder="Ville, Pays">
                            </div>
                            
                            <div class="info-item">
                                <label class="info-label">Membre depuis :</label>
                                <span class="info-value">
                                    <?= date('d/m/Y', strtotime($user->created_at)) ?>
                                </span>
                            </div>
                        </div>
                        
                        <div class="form-actions mt-3">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Sauvegarder
                            </button>
                            <button type="button" class="btn btn-outline-secondary" onclick="cancelEdit('personal-info')">
                                <i class="fas fa-times me-2"></i>Annuler
                            </button>
                        </div>
                    </form>
                    
                    <div id="personal-info-display">
                        <div class="profile-info-grid">
                            <div class="info-item">
                                <label class="info-label">Nom d'utilisateur :</label>
                                <span class="info-value"><?= esc($user->username) ?></span>
                            </div>
                            
                            <div class="info-item">
                                <label class="info-label">Prénom :</label>
                                <span class="info-value"><?= esc($user->first_name ?? 'Non renseigné') ?></span>
                            </div>
                            
                            <div class="info-item">
                                <label class="info-label">Nom :</label>
                                <span class="info-value"><?= esc($user->last_name ?? 'Non renseigné') ?></span>
                            </div>
                            
                            <div class="info-item">
                                <label class="info-label">Email :</label>
                                <span class="info-value">
                                    <?php 
                                    $userEmail = 'Non défini';
                                    if (isset($identities) && !empty($identities)) {
                                        foreach ($identities as $identity) {
                                            if ($identity->type === 'email') {
                                                $userEmail = esc($identity->secret);
                                                break;
                                            }
                                        }
                                    }
                                    echo $userEmail;
                                    ?>
                                </span>
                            </div>
                            
                            <div class="info-item">
                                <label class="info-label">Téléphone :</label>
                                <span class="info-value"><?= esc($user->phone ?? 'Non renseigné') ?></span>
                            </div>
                            
                            <div class="info-item">
                                <label class="info-label">Localisation :</label>
                                <span class="info-value"><?= esc($user->location ?? 'Non renseigné') ?></span>
                            </div>
                            
                            <div class="info-item">
                                <label class="info-label">Membre depuis :</label>
                                <span class="info-value">
                                    <?= date('d/m/Y', strtotime($user->created_at)) ?>
                                </span>
                            </div>
                        </div>
                        
                        <!-- Actions du Profil à côté des informations -->
                        <div class="profile-actions mt-4">
                            <a href="<?= base_url('/') ?>" class="btn btn-primary">
                                <i class="fas fa-home me-2"></i>
                                Retour à l'accueil
                            </a>
                            
                            <a href="<?= base_url('dashboard') ?>" class="btn btn-outline-primary">
                                <i class="fas fa-tachometer-alt me-2"></i>
                                Tableau de bord
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function toggleEdit(section) {
    const form = document.getElementById(section + '-form');
    const display = document.getElementById(section + '-display');
    const editBtn = event.target;
    
    if (form.style.display === 'none') {
        form.style.display = 'block';
        display.style.display = 'none';
        editBtn.innerHTML = '<i class="fas fa-eye"></i> Voir';
        editBtn.classList.remove('btn-outline-light');
        editBtn.classList.add('btn-outline-secondary');
    } else {
        form.style.display = 'none';
        display.style.display = 'block';
        editBtn.innerHTML = '<i class="fas fa-edit"></i> Modifier';
        editBtn.classList.remove('btn-outline-secondary');
        editBtn.classList.add('btn-outline-light');
    }
}

function cancelEdit(section) {
    const form = document.getElementById(section + '-form');
    const display = document.getElementById(section + '-display');
    const editBtn = form.parentElement.querySelector('.btn-outline-light, .btn-outline-secondary');
    
    form.style.display = 'none';
    display.style.display = 'block';
    editBtn.innerHTML = '<i class="fas fa-edit"></i> Modifier';
    editBtn.classList.remove('btn-outline-secondary');
    editBtn.classList.add('btn-outline-light');
}
</script>

<?= $this->endSection() ?>
