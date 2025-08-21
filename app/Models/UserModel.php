<?php

namespace App\Models;

use CodeIgniter\Shield\Models\UserModel as ShieldUserModel;

class UserModel extends ShieldUserModel
{
    protected $allowedFields = [
        'username',
        'first_name',
        'last_name',
        'phone',
        'location',
        'status',
        'status_message',
        'active',
        'last_active',
    ];

    /**
     * Met à jour le profil utilisateur
     */
    public function updateProfile(int $userId, array $data): bool
    {
        // Filtrer seulement les champs autorisés
        $allowedData = array_intersect_key($data, array_flip($this->allowedFields));
        
        // Ajouter la date de mise à jour
        $allowedData['updated_at'] = date('Y-m-d H:i:s');
        
        return $this->update($userId, $allowedData);
    }
}
