<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CommentaireSeeder extends Seeder
{
	public function run()
	{
		$commentaires = [
			[
				'id_commentaire' => 1,
				'texte_commentaire' => 'La ratatouille était vraiment délicieuse, merci pour la recette !',
				'creation_commentaire' => '2024-11-21 16:00:00',
				'id_utilisateur' => 2,
				'id_tache' => 1,
			],
			[
				'id_commentaire' => 2,
				'texte_commentaire' => 'Super gâteau, tout le monde a adoré chez moi !',
				'creation_commentaire' => '2024-11-22 14:30:00',
				'id_utilisateur' => 1,
				'id_tache' => 2,
			],
			[
				'id_commentaire' => 3,
				'texte_commentaire' => 'J’ai eu un peu de mal avec le caramel pour la tarte tatin, des astuces ?',
				'creation_commentaire' => '2024-11-17 11:15:00',
				'id_utilisateur' => 3,
				'id_tache' => 3,
			],
			[
				'id_commentaire' => 4,
				'texte_commentaire' => 'Soupe très facile à faire, parfaite pour l\'automne !',
				'creation_commentaire' => '2024-11-12 10:00:00',
				'id_utilisateur' => 2,
				'id_tache' => 4,
			],
		];

		foreach($commentaires as $comm)
			$this->db->query(
			'INSERT INTO Commentaire (id_utilisateur, id_commentaire, texte_commentaire, creation_commentaire, id_tache)
				VALUES (:id_utilisateur:, :id_commentaire:, :texte_commentaire:, :creation_commentaire:, :id_tache:)', $comm);
	}
}
