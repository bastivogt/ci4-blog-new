<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ChangeIsPublishedDefaultAtPostsTable extends Migration
{
    public function up()
    {
        $this->forge->modifyColumn('posts', [
            'is_published' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 1,
            ]
        ]);
    }

    public function down()
    {
        $this->forge->modifyColumn('posts', [
            'is_published' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0,
            ]
        ]);
    }
}
