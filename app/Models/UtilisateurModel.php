<?php
namespace App\Models;

use CodeIgniter\Model;

class UtilisateurModel extends Model
{
	protected $table      = 'utilisateur';
    protected $autoIncrement = true;
	protected $primaryKey = 'id_utilisateur';
	protected $returnType = 'App\Entities\Utilisateur';
	protected $allowedFields = [
        'email',
        'mdp',
        'pseudo',
        'role',
        'token_mdp',
        'creation_token_mdp',
        'token_inscription',
        'creation_token_inscription'
    ];
	
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
            'required'    => 'Champ requis.',
			'max_length'  => 'Votre pseudo dépasse les de 50 caractères.',
		],

		'mdp' => [
            'required'    => 'Champ requis.',
			'max_length'  => 'Votre mot de passe dépasse les 255 caractères.',
			'min_length'  => 'Votre mot de passe est inférieur à 8 caractères.',
		],

		'email' => [
            'required'    => 'Champ requis.',
			'is_unique'   => 'Cet émail est déjà utilisé.',
			'max_length'  => 'Votre émail dépasse les 255 caractères.',
			'valid_email' => 'Entrer un émail valid.',
		]
	];


}
