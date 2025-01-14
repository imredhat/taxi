use CodeIgniter\Database\Migration;

<?php

namespace App\Database\Migrations;


class CreateUserTransactionTable extends Migration
{
    public function up()
    {
        // Create user_transaction table
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'tel' => [
                'type' => 'VARCHAR',
                'constraint' => 20
            ],
            'amount' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2'
            ],
            'desc' => [
                'type' => 'TEXT'
            ],
            'trans_id' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
            'refid' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
            'date_created' => [
                'type' => 'DATETIME'
            ],
            'response' => [
                'type' => 'TEXT'
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => 50
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('user_transaction');
    }

    public function down()
    {
        $this->forge->dropTable('user_transaction');
    }
}