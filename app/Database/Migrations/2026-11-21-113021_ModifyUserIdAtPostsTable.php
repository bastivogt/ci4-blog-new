<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ModifyUserIdAtPostsTable extends Migration
{
    public function up()
    {
        $this->forge->modifyColumn('posts', [
            'user_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
        ]);

        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->processIndexes("posts");
    }

    public function down()
    {
        $this->forge->dropForeignKey('posts', 'posts_user_id_foreign');
        $this->forge->modifyColumn('posts', [
            'user_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
            ],
        ]);
    }
}
