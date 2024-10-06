<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCompanyTable extends Migration
{
    public function up()
    {
        // Create company table
        $this->forge->addField([
            'cid' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'address' => [
                'type' => 'TEXT'
            ],
            'city' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
            'state' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
            'zip' => [
                'type' => 'VARCHAR',
                'constraint' => 20
            ],
            'phone' => [
                'type' => 'VARCHAR',
                'constraint' => 20
            ],
            'fax' => [
                'type' => 'VARCHAR',
                'constraint' => 20
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'website' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'industry' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
            'description' => [
                'type' => 'TEXT'
            ],
            'created_at' => [
                'type' => 'DATETIME'
            ],
            'updated_at' => [
                'type' => 'DATETIME'
            ],
            'deleted_at' => [
                'type' => 'DATETIME'
            ]
        ]);
        $this->forge->addKey('cid', true);
        $this->forge->createTable('company');
    }

    public function down()
    {
        $this->forge->dropTable('company');
    }
}
