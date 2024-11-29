<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateTache extends Migration
{
	public function up()
	{
		$db = \Config\Database::connect();
		$db->query("ALTER TABLE tache ADD COLUMN categorie VARCHAR(50) NOT NULL");
	}

	public function down()
	{
		$db = \Config\Database::connect();
		$db->query("ALTER TABLE tache DROP COLUMN categorie");
	}
}