<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterUsersTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('users', [
            'username' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'unique' => true,
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('users', 'username');
    }
}
