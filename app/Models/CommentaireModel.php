<?php
namespace App\Models;

use CodeIgniter\Model;

class CommentaireModel extends Model
{
	protected $table      = 'commentaire';
	protected $autoIncrement = true;
	protected $primaryKey = 'id_commentaire';
	protected $returnType = 'App\Entities\commentaire';
	protected $allowedFields = ['texte_commentaire', 'creation_tache', 'id_utilisateur', 'id_tache' ];
	
	protected $useTimestamps = false;
	protected $createdField = 'creation_commentaire';
	protected $useSoftDeletes = true;
	
	// Règles de validation
	protected $validationRules = [
		'texte_commentaire' => 'required|min_length[3]|max_length[255]',
	];

	protected $validationMessages = [
		'texte_commentaire' => [
			'required'    => 'Champ requis.',
			'min_length'  => 'Votre commentaire fait moins de 3 caractères.',
			'max_length'  => 'Votre commentaire dépasse les de 250 caractères.',
		],
	];
}
