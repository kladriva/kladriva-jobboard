<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Debug extends Controller
{
    public function index()
    {
        // Vérifier la configuration de la base de données
        $db = \Config\Database::connect();
        
        echo "<h2>Diagnostic de la base de données</h2>";
        
        // Vérifier si la table users existe
        if ($db->tableExists('users')) {
            echo "<p>✅ Table 'users' existe</p>";
            
            // Compter les utilisateurs
            $userCount = $db->table('users')->countAllResults();
            echo "<p>Nombre d'utilisateurs: $userCount</p>";
            
            // Afficher la structure de la table
            $fields = $db->getFieldNames('users');
            echo "<p>Champs de la table users:</p><ul>";
            foreach ($fields as $field) {
                echo "<li>$field</li>";
            }
            echo "</ul>";
            
            // Afficher quelques utilisateurs (sans mot de passe)
            $users = $db->table('users')->select('id, username, email, created_at')->limit(5)->get()->getResultArray();
            echo "<p>Utilisateurs (limite 5):</p><ul>";
            foreach ($users as $user) {
                echo "<li>ID: {$user['id']}, Username: {$user['username']}, Email: {$user['email']}</li>";
            }
            echo "</ul>";
            
        } else {
            echo "<p>❌ Table 'users' n'existe pas</p>";
        }
        
        // Vérifier la table auth_identities
        if ($db->tableExists('auth_identities')) {
            echo "<p>✅ Table 'auth_identities' existe</p>";
            
            $identityCount = $db->table('auth_identities')->countAllResults();
            echo "<p>Nombre d'identités: $identityCount</p>";
            
        } else {
            echo "<p>❌ Table 'auth_identities' n'existe pas</p>";
        }
        
        // Vérifier la session
        echo "<h2>Diagnostic de la session</h2>";
        if (session_status() === PHP_SESSION_ACTIVE) {
            echo "<p>✅ Session active</p>";
            echo "<p>ID de session: " . session_id() . "</p>";
            
            $sessionData = session()->get();
            echo "<p>Données de session:</p><pre>" . print_r($sessionData, true) . "</pre>";
        } else {
            echo "<p>❌ Session non active</p>";
        }
        
        // Vérifier l'authentification
        echo "<h2>Diagnostic de l'authentification</h2>";
        try {
            if (service('auth')->loggedIn()) {
                echo "<p>✅ Utilisateur connecté</p>";
                
                $user = service('auth')->user();
                if ($user) {
                    echo "<p>Objet utilisateur récupéré:</p>";
                    echo "<ul>";
                    echo "<li>ID: " . ($user->id ?? 'NULL') . "</li>";
                    echo "<li>Username: " . ($user->username ?? 'NULL') . "</li>";
                    echo "<li>Email: " . ($user->email ?? 'NULL') . "</li>";
                    echo "</ul>";
                } else {
                    echo "<p>❌ Objet utilisateur null</p>";
                }
            } else {
                echo "<p>❌ Aucun utilisateur connecté</p>";
            }
        } catch (\Exception $e) {
            echo "<p>❌ Erreur lors de la vérification de l'authentification: " . $e->getMessage() . "</p>";
        }
    }
}
