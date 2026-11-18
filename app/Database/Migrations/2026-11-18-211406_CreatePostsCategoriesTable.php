<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePostsCategoriesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'post_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'foreign_key' => [
                    'post_id' => [
                        'references' => 'id',
                        'on' => 'posts',
                        'onDelete' => 'CASCADE',
                    ],
                ],
            ],
            'category_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'foreign_key' => [
                    'category_id' => [
                        'references' => 'id',
                        'on' => 'categories',
                        'onDelete' => 'CASCADE',
                    ],
                ],
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('posts_categories');
    }

    public function down()
    {
        $this->forge->dropTable('posts_categories');
    }
}
