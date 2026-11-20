<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterPostsTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('posts', [
            'allow_comments' => [
                'type' => 'BOOLEAN',
                'default' => true,
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('posts', 'allow_comments');
    }
}
