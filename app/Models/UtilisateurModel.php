<?php
namespace App\Models;

use CodeIgniter\Model;

class UtilisateurModel extends Model
{
	protected $table      = 'Utilisateur';
	protected $primaryKey = 'id_utilisateur';
	protected $returnType = 'App\Entities\Utilisateur';
	protected $allowedFields = ['id_utilisateur', 'email', 'mdp', 'pseudo', 'role', 'token', 'date_creation_token'];
	
	protected $useTimestamps = false;
	protected $useSoftDeletes = true;
	
	// Règles de validation
	protected $validationRules = [
		'pseudo' => 'required|max_length[50]',
		'email'  => 'required|max_length[255]|valid_email|is_unique[utilisateur.email]',
		'mdp'    => 'required|max_length[255]|min_length[8]',
	];

	protected $validationMessages = [
		'pseudo' => [
			'max_length'  => 'Votre pseudo est trop long, il doit faire moins de 50 caractères.',
		],

		'mdp' => [
			'max_length'  => 'Votre mot de passe est trop long. Veuillez en choisir un autre.',
			'min_length'  => 'Votre mot de passe est trop court. Veuillez en choisir un autre.',
		],

		'email' => [
			'is_unique'   => 'Cet émail est déjà utilisé. Veuillez en prendre une autre.',
			'max_length'  => 'Votre émail est trop long. Veuillez en prendre une autre.',
			'valid_email' => 'Entrez un émail valid.',
		]
	];


}
