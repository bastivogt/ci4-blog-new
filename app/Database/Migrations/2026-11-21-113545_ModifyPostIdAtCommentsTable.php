<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ModifyPostIdAtCommentsTable extends Migration
{
    public function up()
    {
        $this->forge->modifyColumn('comments', [
            'post_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
        ]);

        $this->forge->addForeignKey('post_id', 'posts', 'id', 'CASCADE', 'CASCADE');
        $this->forge->processIndexes("comments");
    }

    public function down()
    {
        $this->forge->dropForeignKey('comments', 'comments_post_id_foreign');
        $this->forge->modifyColumn('comments', [
            'post_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
            ],
        ]);
    }
}
