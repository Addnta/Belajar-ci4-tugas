<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTransactionDetailTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'                => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'transaction_id'    => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'product_id'        => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'jumlah'            => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'diskon'            => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'default'    => 0,
            ],
            'subtotal_harga'    => [
                'type' => 'DECIMAL',
                'constraint' => '12,2',
            ],
            'created_at'        => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at'        => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at'        => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('transaction_id', 'transaction', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('product_id', 'product', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('transaction_detail');
    }

    public function down()
    {
        $this->forge->dropTable('transaction_detail');
    }
}
