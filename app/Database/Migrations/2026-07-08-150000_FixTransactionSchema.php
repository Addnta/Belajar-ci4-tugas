<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FixTransactionSchema extends Migration
{
    private function isCurrentTransactionSchema(): bool
    {
        return $this->db->fieldExists('username', 'transaction')
            && $this->db->fieldExists('total_harga', 'transaction')
            && $this->db->fieldExists('alamat', 'transaction')
            && $this->db->fieldExists('ongkir', 'transaction')
            && $this->db->fieldExists('status', 'transaction');
    }

    private function isCurrentTransactionDetailSchema(): bool
    {
        return $this->db->fieldExists('jumlah', 'transaction_detail')
            && $this->db->fieldExists('diskon', 'transaction_detail')
            && $this->db->fieldExists('subtotal_harga', 'transaction_detail');
    }

    private function createCurrentTables(): void
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'username' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'total_harga' => [
                'type'       => 'DECIMAL',
                'constraint' => '12,2',
            ],
            'alamat' => [
                'type' => 'TEXT',
            ],
            'ongkir' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'status' => [
                'type'       => 'INT',
                'constraint' => 1,
                'default'    => 0,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('transaction');

        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'transaction_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'product_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'jumlah' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'diskon' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'default'    => 0,
            ],
            'subtotal_harga' => [
                'type'       => 'DECIMAL',
                'constraint' => '12,2',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('transaction_id', 'transaction', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('product_id', 'product', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('transaction_detail');
    }

    private function createLegacyTables(): void
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'total' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'default'    => 'pending',
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

        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'transaction_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'product_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'quantity' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'price' => [
                'type'       => 'INT',
                'constraint' => 11,
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
        $this->forge->addForeignKey('transaction_id', 'transaction', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('product_id', 'product', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('transaction_detail');
    }

    public function up()
    {
        if ($this->isCurrentTransactionSchema() && $this->isCurrentTransactionDetailSchema()) {
            return;
        }

        if ($this->db->tableExists('transaction_detail')) {
            $this->forge->dropTable('transaction_detail', true);
        }

        if ($this->db->tableExists('transaction')) {
            $this->forge->dropTable('transaction', true);
        }

        $this->createCurrentTables();
    }

    public function down()
    {
        if ($this->db->tableExists('transaction_detail')) {
            $this->forge->dropTable('transaction_detail', true);
        }

        if ($this->db->tableExists('transaction')) {
            $this->forge->dropTable('transaction', true);
        }

        $this->createLegacyTables();
    }
}
