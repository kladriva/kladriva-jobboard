<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateJobApplications extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => false,
            ],
            'job_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => false,
            ],
            'cv_filename' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ],
            'cv_path' => [
                'type' => 'VARCHAR',
                'constraint' => 500,
                'null' => false,
            ],
            'cover_letter' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['pending', 'reviewed', 'shortlisted', 'rejected', 'accepted'],
                'default' => 'pending',
            ],
            'notes' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey(['user_id', 'job_id'], false, true); // Clé unique composite
        
        // Créer la table sans clés étrangères pour éviter les erreurs
        $this->forge->createTable('job_applications');
        
        // Ajouter les clés étrangères après la création de la table
        try {
            $this->db->query("ALTER TABLE `job_applications` ADD CONSTRAINT `job_applications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE");
        } catch (Exception $e) {
            // Log l'erreur mais ne pas bloquer la migration
            log_message('warning', 'Impossible d\'ajouter la contrainte user_id: ' . $e->getMessage());
        }
        
        try {
            $this->db->query("ALTER TABLE `job_applications` ADD CONSTRAINT `job_applications_ibfk_2` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE");
        } catch (Exception $e) {
            // Log l'erreur mais ne pas bloquer la migration
            log_message('warning', 'Impossible d\'ajouter la contrainte job_id: ' . $e->getMessage());
        }
    }

    public function down()
    {
        $this->forge->dropTable('job_applications');
    }
}
