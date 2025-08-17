<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RemoveUsernameUniqueConstraint extends Migration
{
    public function up()
    {
        // Supprimer la contrainte d'unicité sur le champ username
        $this->forge->dropKey('users', 'username');
    }

    public function down()
    {
        // Recréer la contrainte d'unicité sur le champ username
        $this->forge->addUniqueKey('username', 'users');
    }
}
