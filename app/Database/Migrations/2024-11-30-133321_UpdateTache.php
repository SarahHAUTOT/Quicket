<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateTache extends Migration
{
	public function up()
	{
		$db = \Config\Database::connect();
		$db->query("ALTER TABLE tache ADD COLUMN id_projet   INT REFERENCES projet(id_projet) NOT NULL");
		$db->query("ALTER TABLE tache ADD COLUMN est_termine BOOLEAN NOT NULL");
	}

	public function down()
	{
		$db = \Config\Database::connect();
		$db->query("ALTER TABLE tache DROP COLUMN est_termine");
		$db->query("ALTER TABLE tache DROP COLUMN id_projet");
	}
}