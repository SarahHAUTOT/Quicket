<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTacheTable extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_tache' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],

			'creation_tache' => [
				'type' => 'TIMESTAMP',
				'null' => false,
			],

			'modiff_tache' => [
				'type' => 'TIMESTAMP',
				'null' => false,
			],

			'titre' => [
				'type'       => 'VARCHAR',
				'constraint' => 50,
				'null'       => false,
			],

			'description' => [
				'type'       => 'VARCHAR',
				'constraint' => 255,
				'null'       => false,
			],

			'priorite' => [
				'type'       => 'INT',
				'constraint' => 11,
				'null'       => false,
			],

			'echeance' => [
				'type' => 'TIMESTAMP',
				'null' => false,
			],
			
			'id_utilisateur' => [
				'type'       => 'INT',
				'constraint' => 11,
				'unsigned'   => true,
				'null'       => false,
			],
		]);

		$this->forge->addKey('id_tache', true);
		$this->forge->addForeignKey('id_utilisateur', 'utilisateur', 'id_utilisateur', 'CASCADE', 'CASCADE');
		$this->forge->createTable('tache');
	}

	public function down()
	{
		$this->forge->dropTable('tache', true);
	}
}
