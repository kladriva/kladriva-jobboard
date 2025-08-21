<?php

if (!function_exists('getStatusLabel')) {
    /**
     * Traduit le statut d'une candidature en français
     */
    function getStatusLabel($status) {
        $labels = [
            'pending' => 'En attente',
            'reviewed' => 'Examinée',
            'shortlisted' => 'Sélectionnée',
            'rejected' => 'Non retenue',
            'accepted' => 'Acceptée'
        ];
        return $labels[$status] ?? $status;
    }
}

if (!function_exists('getStatusClass')) {
    /**
     * Retourne la classe CSS pour le statut
     */
    function getStatusClass($status) {
        $classes = [
            'pending' => 'status-pending',
            'reviewed' => 'status-reviewed',
            'shortlisted' => 'status-shortlisted',
            'rejected' => 'status-rejected',
            'accepted' => 'status-accepted'
        ];
        return $classes[$status] ?? 'status-default';
    }
}
