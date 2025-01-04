<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDriversAndCarTypeTables extends Migration
{
    public function up()
    {
        // Create drivers table
        $this->forge->addField([
            'did' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'ax' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'lname' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'gender' => [
                'type' => 'ENUM',
                'constraint' => ['male', 'female']
            ],
            'mobile' => [
                'type' => 'VARCHAR',
                'constraint' => 20
            ],
            'mobile2' => [
                'type' => 'VARCHAR',
                'constraint' => 20
            ],
            'phone' => [
                'type' => 'VARCHAR',
                'constraint' => 20
            ],
            'address' => [
                'type' => 'TEXT'
            ],
            'work_type' => [
                'type' => 'ENUM',
                'constraint' => ['azad', 'sherkati']
            ],
            'melli' => [
                'type' => 'VARCHAR',
                'constraint' => 20
            ],
            'scan_melli' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'bank' => [
                'type' => 'VARCHAR',
                'constraint' => 20
            ],
            'date_created' => [
                'type' => 'DATETIME'
            ]
        ]);
        $this->forge->addKey('did', true);
        $this->forge->createTable('drivers');

        // Create car_type table
        $this->forge->addField([
            'TiD' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'type' => [
                'type' => 'ENUM',
                'constraint' => ['1', '2', '3', '4', '5']
            ],
            'brand' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'fuel' => [
                'type' => 'ENUM',
                'constraint' => ['1', '2', '3', '4', '5']
            ]
        ]);
        $this->forge->addKey('TiD', true);
        $this->forge->createTable('car_type');


        // Create cars table
        $this->forge->addField([
            'cid' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'driver_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true
            ],
            'fuel' => [
                'type' => 'INT',
                'constraint' => 11
            ],
            'harf' => [
                'type' => 'VARCHAR',
                'constraint' => 50
            ],
            'motor' => [
                'type' => 'VARCHAR',
                'constraint' => 50
            ],
            'pelak' => [
                'type' => 'VARCHAR',
                'constraint' => 50
            ],
            'pic_back' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
            'pic_front' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
            'pic_in_back' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
            'pic_in_front' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
            'scan_govahiname' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
            'shasi' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
            'type' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
            'vin' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ]
        ]);
        $this->forge->addKey('cid', true);
        $this->forge->createTable('cars');

        // Create admin table
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 50
            ],
            'user' => [
                'type' => 'VARCHAR',
                'constraint' => 50
            ],
            'pass' => [
                'type' => 'VARCHAR',
                'constraint' => 50
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('admin');
    }

    public function down()
    {
        $this->forge->dropTable('drivers');
        $this->forge->dropTable('car_type');
        $this->forge->dropTable('cars');
        $this->forge->dropTable('admin');

    }
}
