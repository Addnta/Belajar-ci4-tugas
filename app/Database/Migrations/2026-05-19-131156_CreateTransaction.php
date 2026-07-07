<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTransaction extends Migration
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

            'user_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],

            'total' => [
                'type' => 'INT',
                'constraint' => 11,
            ],

            'status' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'default' => 'pending'
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
        $this->forge->addForeignKey('user_id', 'user', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('transaction');
    }

    public function down()
    {
        $this->forge->dropTable('transaction');
    }
}
