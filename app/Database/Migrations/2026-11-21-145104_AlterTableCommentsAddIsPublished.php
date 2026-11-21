<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterTableCommentsAddIsPublished extends Migration
{
    public function up()
    {
        $this->forge->addColumn('comments', [
            'is_published' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 1,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('comments', 'is_published');
    }
}
