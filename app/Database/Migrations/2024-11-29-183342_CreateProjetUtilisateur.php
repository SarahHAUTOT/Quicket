<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProjetUtilisateur extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_projet' => [
				'type'           => 'SERIAL',
				'unsigned'       => true,
				'auto_increment' => true,
			],

			'id_utilisateur' => [
				'type'       => 'INT',
				'unsigned'   => true,
				'null'       => false,
			],
		]);

		$this->forge->addKey('id_projet', true);
		$this->forge->addKey('id_utilisateur', true);
		$this->forge->addForeignKey('id_projet', 'projet', 'id_projet', 'CASCADE', 'CASCADE');
		$this->forge->addForeignKey('id_utilisateur', 'utilisateur', 'id_utilisateur', 'CASCADE', 'CASCADE');
		$this->forge->createTable('projetutilisateur');
    }

    public function down()
    {
		$this->forge->dropTable('projetutilisateur', true);
    }
}
