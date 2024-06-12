<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePengajuanTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'officer_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'items' => [
                'type' => 'TEXT',
            ],
            'date_of_filing' => [
                'type' => 'DATETIME',
            ],
            'status_on_manager' => [
                'type' => 'ENUM',
                'constraint' => ['Pending', 'Approved', 'Rejected'],
                'default' => 'Pending',
            ],
            'update_status_on_manager' => [
                'type' => 'DATETIME',
                'default' => null,
            ],
            'note_from_manager' => [
                'type' => 'TEXT',
                'constraint' => 250,
                'default' => null,
            ],
            'status_on_finance' => [
                'type' => 'ENUM',
                'constraint' => ['Pending', 'Approved', 'Rejected'],
                'default' => 'Pending',
            ],
            'update_status_on_finance' => [
                'type' => 'DATETIME',
                'default' => null,
            ],
            'note_from_finance' => [
                'type' => 'TEXT',
                'constraint' => 250,
                'default' => null,
            ],
            'finance_document' => [
                'type' => 'TEXT',
                'constraint' => 255,
                'default' => null,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('pengajuan');
    }

    public function down()
    {
        $this->forge->dropTable('pengajuan');
    }
}
