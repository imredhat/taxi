<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTripsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'start_loc' => ['type' => 'VARCHAR', 'constraint' => '255'],
            'end_loc' => ['type' => 'VARCHAR', 'constraint' => '255'],
            'start_loc_text' => ['type' => 'TEXT'],
            'end_loc_text' => ['type' => 'TEXT'],
            'distance' => ['type' => 'FLOAT'],
            'fare' => ['type' => 'FLOAT'],
            'isHoliday' => ['type' => 'BOOLEAN'],
            'roadCondition' => ['type' => 'VARCHAR', 'constraint' => '100'],
            'weather' => ['type' => 'VARCHAR', 'constraint' => '100'],
            'carType' => ['type' => 'VARCHAR', 'constraint' => '100'],
            'travelTime' => ['type' => 'TIME'],
            'passenger_id' => ['type' => 'INT'],
            'passenger_name' => ['type' => 'VARCHAR', 'constraint' => '255'],
            'passenger_tel' => ['type' => 'VARCHAR', 'constraint' => '20'],
            'isGuest' => ['type' => 'BOOLEAN'],
            'guest_name' => ['type' => 'VARCHAR', 'constraint' => '255'],
            'guest_tel' => ['type' => 'VARCHAR', 'constraint' => '20'],
            'company_factor' => ['type' => 'FLOAT'],
            'company_name' => ['type' => 'VARCHAR', 'constraint' => '255'],
            'trip_date' => ['type' => 'DATE'],
            'trip_time' => ['type' => 'TIME'],
            'total_passenger' => ['type' => 'INT'],
            'start_address_desc' => ['type' => 'TEXT'],
            'end_address_desc' => ['type' => 'TEXT'],
            'created_at' => ['type' => 'DATETIME'],
            'updated_at' => ['type' => 'DATETIME'],
            'deleted_at' => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('trips');
    }

    public function down()
    {
        $this->forge->dropTable('trips');
    }
}
