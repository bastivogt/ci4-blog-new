<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterUserTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('users', [
            'is_active' => [
                'type' => 'TINYINT',
                'constraint' => 1,  
                'default' => 1,
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('users', 'is_active');
    }
}