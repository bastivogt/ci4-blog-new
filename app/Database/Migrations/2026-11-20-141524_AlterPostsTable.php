<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterPostsTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('posts', [
            'is_published' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0,
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('posts', 'is_published');
    }
}
