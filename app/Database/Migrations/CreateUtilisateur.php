<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUtilisateurTable extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_utilisateur' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			
			'email' => [
				'type'       => 'VARCHAR',
				'constraint' => 255,
				'unique'     => true,
				'null'       => false,
			],

			'mdp' => [
				'type'       => 'VARCHAR',
				'constraint' => 255,
				'null'       => false,
			],

			'pseudo' => [
				'type'       => 'VARCHAR',
				'constraint' => 50,
				'null'       => false,
			],

			'role' => [
				'type'       => 'VARCHAR',
				'constraint' => 50,
				'null'       => false,
			],

			'token_mdp' => [
				'type'       => 'VARCHAR',
				'constraint' => 255,
				'null'       => true,
			],

			'creation_token_mdp' => [
				'type' => 'TIMESTAMP',
				'null' => true,
			],

			'token_inscription' => [
				'type'       => 'VARCHAR',
				'constraint' => 255,
				'null'       => true,
			],

			'creation_token_inscription' => [
				'type' => 'TIMESTAMP',
				'null' => true,
			],
		]);

		$this->forge->addKey('id_utilisateur', true);
		$this->forge->createTable('utilisateur');
	}

	public function down()
	{
		$this->forge->dropTable('utilisateur', true);
	}
}
