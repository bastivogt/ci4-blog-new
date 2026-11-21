<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ModifyPostIdAndCategoryIdAtPostsCategoriesTable extends Migration
{
    public function up()
    {
        $this->forge->modifyColumn('posts_categories', [
            'post_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'category_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],

        ]);

        $this->forge->addForeignKey('post_id', 'posts', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('category_id', 'categories', 'id', 'CASCADE', 'CASCADE');
        $this->forge->processIndexes("posts_categories");
    }

    public function down()
    {
        $this->forge->dropForeignKey('posts_categories', 'posts_categories_post_id_foreign');
        $this->forge->dropForeignKey('posts_categories', 'posts_categories_category_id_foreign');
        $this->forge->modifyColumn('posts_categories', [
            'post_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
            ],
            'category_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
            ],

        ]);
    }
}
