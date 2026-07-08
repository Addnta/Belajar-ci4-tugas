<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTransactionTableCurrent extends Migration
{
    public function up()
    {
        if ($this->db->tableExists('transaction')) {
            return;
        }

        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'username'    => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'total_harga' => [
                'type' => 'DECIMAL',
                'constraint' => '12,2',
            ],
            'alamat'      => [
                'type' => 'TEXT',
            ],
            'ongkir'      => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'status'      => [
                'type'       => 'INT',
                'constraint' => 1,
                'default'    => 0,
            ],
            'created_at'  => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at'  => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at'  => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('transaction');
    }

    public function down()
    {
        if ($this->db->tableExists('transaction')) {
            $this->forge->dropTable('transaction');
        }
    }
}
