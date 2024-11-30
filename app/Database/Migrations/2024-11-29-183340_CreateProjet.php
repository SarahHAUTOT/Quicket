<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProjet extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_projet' => [
				'type'           => 'SERIAL',
				'unsigned'       => true,
				'auto_increment' => true,
			],
			
			'nom_projet' => [
				'type'       => 'VARCHAR',
				'constraint' => 50,
				'null'       => false,
			],
			
			'couleur' => [
				'type'       => 'CHAR',
				'constraint' => 7,
				'null'       => false,
			],

			'id_createur' => [
				'type'       => 'INT',
				'unsigned'   => true,
				'null'       => false,
			],
		]);

		$this->forge->addKey('id_projet', true);
		$this->forge->addForeignKey('id_createur', 'utilisateur', 'id_utilisateur', 'CASCADE', 'CASCADE');
		$this->forge->createTable('projet');
	}

    public function down()
    {
		$this->forge->dropTable('projet', true);
    }
}
