<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterPostTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('posts', [
            'is_featured' => [
                'type' => 'Boolean',
                'null' => true,
                'default' => false,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('posts', 'is_featured');
    }
}
