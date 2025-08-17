<?php

if (!function_exists('is_logged_in')) {
    /**
     * Vérifie si l'utilisateur est connecté
     */
    function is_logged_in(): bool
    {
        return service('auth')->loggedIn();
    }
}

if (!function_exists('current_user')) {
    /**
     * Récupère l'utilisateur actuellement connecté
     */
    function current_user()
    {
        return service('auth')->getUser();
    }
}

if (!function_exists('current_user_id')) {
    /**
     * Récupère l'ID de l'utilisateur actuellement connecté
     */
    function current_user_id(): ?int
    {
        $user = service('auth')->getUser();
        return $user ? $user->id : null;
    }
}

if (!function_exists('has_permission')) {
    /**
     * Vérifie si l'utilisateur a une permission spécifique
     */
    function has_permission(string $permission): bool
    {
        $user = service('auth')->getUser();
        if (!$user) {
            return false;
        }
        
        return $user->can($permission);
    }
}

if (!function_exists('has_group')) {
    /**
     * Vérifie si l'utilisateur appartient à un groupe spécifique
     */
    function has_group(string $group): bool
    {
        $user = service('auth')->getUser();
        if (!$user) {
            return false;
        }
        
        return $user->inGroup($group);
    }
}

if (!function_exists('auth_menu')) {
    /**
     * Génère le menu d'authentification selon l'état de connexion
     */
    function auth_menu(): string
    {
        if (is_logged_in()) {
            $user = current_user();
            return '
            <div class="dropdown">
                <button class="btn btn-outline-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    <i class="fas fa-user me-2"></i>' . esc($user->username) . '
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="' . base_url('auth/profile') . '">
                        <i class="fas fa-user-circle me-2"></i>Mon Profil
                    </a></li>
                    <li><a class="dropdown-item" href="' . base_url('admin') . '">
                        <i class="fas fa-cog me-2"></i>Administration
                    </a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="' . base_url('auth/logout') . '">
                        <i class="fas fa-sign-out-alt me-2"></i>Déconnexion
                    </a></li>
                </ul>
            </div>';
        } else {
            return '
            <div class="d-flex gap-2">
                <a href="' . base_url('connexion') . '" class="btn btn-outline-light">
                    <i class="fas fa-sign-in-alt me-2"></i>Connexion
                </a>
                <a href="' . base_url('inscription') . '" class="btn btn-primary">
                    <i class="fas fa-user-plus me-2"></i>Inscription
                </a>
            </div>';
        }
    }
}

if (!function_exists('auth_status')) {
    /**
     * Affiche le statut d'authentification
     */
    function auth_status(): string
    {
        if (is_logged_in()) {
            $user = current_user();
            return '<span class="badge bg-success">
                <i class="fas fa-user-check me-1"></i>Connecté en tant que ' . esc($user->username) . '
            </span>';
        } else {
            return '<span class="badge bg-secondary">
                <i class="fas fa-user-times me-1"></i>Non connecté
            </span>';
        }
    }
}

if (!function_exists('get_current_user_safe')) {
    /**
     * Récupère l'utilisateur connecté de manière sécurisée
     * Gère les cas où l'objet utilisateur pourrait être incomplet
     */
    function get_current_user_safe()
    {
        try {
            if (!service('auth')->loggedIn()) {
                return null;
            }
            
            $user = service('auth')->user();
            
            // Vérifier que l'utilisateur est complet
            if (!$user || !$user->id) {
                // Déconnecter l'utilisateur corrompu
                service('auth')->logout();
                return null;
            }
            
            return $user;
            
        } catch (\Exception $e) {
            // En cas d'erreur, déconnecter et retourner null
            service('auth')->logout();
            return null;
        }
    }
}

if (!function_exists('is_user_valid')) {
    /**
     * Vérifie si l'utilisateur connecté est valide
     */
    function is_user_valid($user = null)
    {
        if ($user === null) {
            $user = get_current_user_safe();
        }
        
        return $user && $user->id;
    }
}

if (!function_exists('require_valid_user')) {
    /**
     * Redirige vers la connexion si l'utilisateur n'est pas valide
     */
    function require_valid_user()
    {
        $user = get_current_user_safe();
        
        if (!$user) {
            return redirect()->to('/connexion')
                ->with('error', 'Session utilisateur invalide. Veuillez vous reconnecter.');
        }
        
        return $user;
    }
}
