<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLostItemsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'item_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'category' => [
                'type'       => 'VARCHAR',
                'constraint' => 80,
                'null'       => true,
            ],
            'found_location' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
            ],
            'found_date' => [
                'type' => 'DATE',
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['unclaimed', 'claimed'],
                'default'    => 'unclaimed',
            ],
            'reported_by' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'claimed_by' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
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
        $this->forge->addKey('status');
        $this->forge->addKey('found_date');
        $this->forge->addForeignKey('reported_by', 'users', 'id', 'CASCADE', 'RESTRICT');
        $this->forge->addForeignKey('claimed_by', 'users', 'id', 'SET NULL', 'SET NULL');
        $this->forge->createTable('lost_items', true);
    }

    public function down()
    {
        $this->forge->dropTable('lost_items', true);
    }
}
