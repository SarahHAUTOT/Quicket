<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UtilisateurSeeder extends Seeder
{
	public function run()
	{
		$utilisateurs = [
			[
				'id_utilisateur' => 1,
				'email' => 'jean.cuisine@example.com',
				'mdp' => password_hash('123465789', PASSWORD_BCRYPT),
				'pseudo' => 'ChefJean',
				'role' => 'ROLE_ADMIN',
				'token_mdp' => null,
				'creation_token_mdp' => null,
				'token_inscription' => null,
				'creation_token_inscription' => null,
			],
			[
				'id_utilisateur' => 2,
				'email' => 'sophie.gourmet@example.com',
				'mdp' => password_hash('123465789', PASSWORD_BCRYPT),
				'pseudo' => 'SophieGourmet',
				'role' => 'ROLE_UTILISATEUR',
				'token_mdp' => null,
				'creation_token_mdp' => null,
				'token_inscription' => null,
				'creation_token_inscription' => null,
			],
			[
				'id_utilisateur' => 3,
				'email' => 'paul.nouveau@example.com',
				'mdp' => password_hash('123465789', PASSWORD_BCRYPT),
				'pseudo' => 'PaulNouveau',
				'role' => 'ROLE_INACTIF',
				'token_mdp' => null,
				'creation_token_mdp' => null,
				'token_inscription' => null,
				'creation_token_inscription' => null,
			],
		];

		foreach($utilisateurs as $utilisateur)
			$this->db->query(
			'INSERT INTO Utilisateur (id_utilisateur, email, mdp, pseudo, role, token_mdp, creation_token_mdp, token_inscription, creation_token_inscription)
				  VALUES (:id_utilisateur:, :email:, :mdp:, :pseudo:, :role:, :token_mdp:, :creation_token_mdp:, :token_inscription:, :creation_token_inscription:)', $utilisateur);
	}
}
