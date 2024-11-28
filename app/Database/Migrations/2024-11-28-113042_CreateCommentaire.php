<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCommentaire extends Migration
{
    public function up()
	{
		$this->forge->addField([
			'id_commentaire' => [
				'type'           => 'SERIAL',
				'unsigned'       => true,
				'auto_increment' => true,
			],

			'texte_commentaire' => [
				'type'       => 'VARCHAR',
				'constraint' => 255,
				'null'       => false,
			],

			'creation_commentaire' => [
				'type' => 'TIMESTAMP',
				'null' => false,
			],

			'id_utilisateur' => [
				'type'       => 'INT',
				'unsigned'   => true,
				'null'       => false,
			],
			
			'id_tache' => [
				'type'       => 'INT',
				'unsigned'   => true,
				'null'       => false,
			],
		]);

		$this->forge->addKey('id_commentaire', true);
		$this->forge->addForeignKey('id_utilisateur', 'utilisateur', 'id_utilisateur', 'CASCADE', 'CASCADE');
		$this->forge->addForeignKey('id_tache', 'tache', 'id_tache', 'CASCADE', 'CASCADE');
		$this->forge->createTable('commentaire');
	}

	public function down()
	{
		$this->forge->dropTable('commentaire', true);
	}
}
