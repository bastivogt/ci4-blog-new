<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterPostsTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('posts', [

            'user_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'foreignKey' => [
                    'table' => 'users',
                    'field' => 'id',
                ]
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('posts', 'user_id');
    }
}
