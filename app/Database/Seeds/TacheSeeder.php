<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TacheSeeder extends Seeder
{
	public function run()
	{
		$taches = [
			[
				'id_tache' => 1,
				'creation_tache' => '2024-11-20 10:00:00',
				'modiff_tache' => '2024-11-21 15:00:00',
				'titre' => 'Ratatouille Maison',
				'description' => 'Préparer une délicieuse ratatouille avec des légumes frais.',
				'priorite' => 2,
				'echeance' => '2024-11-30 12:00:00',
				'id_utilisateur' => 1,
			],
			[
				'id_tache' => 2,
				'creation_tache' => '2024-11-18 14:00:00',
				'modiff_tache' => '2024-11-19 09:00:00',
				'titre' => 'Gâteau au Chocolat Fondant',
				'description' => 'Recette facile pour un gâteau au chocolat moelleux et fondant.',
				'priorite' => 1,
				'echeance' => '2024-11-25 18:00:00',
				'id_utilisateur' => 2,
			],
			[
				'id_tache' => 3,
				'creation_tache' => '2024-11-15 08:30:00',
				'modiff_tache' => '2024-11-16 10:45:00',
				'titre' => 'Tarte Tatin aux Pommes',
				'description' => 'Préparer une tarte tatin caramélisée avec des pommes Golden.',
				'priorite' => 3,
				'echeance' => '2024-11-28 16:00:00',
				'id_utilisateur' => 2,
			],
			[
				'id_tache' => 4,
				'creation_tache' => '2024-11-10 11:00:00',
				'modiff_tache' => '2024-11-10 15:00:00',
				'titre' => 'Soupe de Potiron',
				'description' => 'Recette d\'automne pour une soupe de potiron onctueuse.',
				'priorite' => 4,
				'echeance' => '2024-12-01 20:00:00',
				'id_utilisateur' => 3,
			],
		];

		foreach($taches as $tache)
			$this->db->query(
			'INSERT INTO Tache (id_tache, creation_tache, modiff_tache, titre, description, priorite, echeance, id_utilisateur)
				VALUES (:id_tache:, :creation_tache:, :modiff_tache:, :titre:, :description:, :priorite:, :echeance:, :id_utilisateur:)', $tache);
	}
}
