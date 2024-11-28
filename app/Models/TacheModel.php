<?php
namespace App\Models;

use CodeIgniter\Model;

class TacheModel extends Model
{
	protected $table      = 'tache';
    protected $useAutoIncrement = true;
	protected $primaryKey = 'id_tache';
	protected $returnType = 'App\Entities\Tache';
	protected $allowedFields = [
        'creation_tache',
        'modiff_tache',
        'titre',
        'description',
        'echeance',
        'id_utilisateur',
        'priorite'
    ];
	
	protected $useTimestamps = true;
    protected $createdField = 'creation_tache';
    protected $updatedField = 'modiff_tache';

	protected $useSoftDeletes = false;
	
	// Règles de validation
	protected $validationRules = [
		'titre'       => 'required|max_length[50]|min_length[5]',
		'description' => 'required|max_length[255]',
		'priorite'    => 'required|greater_than[0]',
		'echeance'    => 'required',
	];

	protected $validationMessages = [
		'titre' => [
            'required'    => 'Champ requis.',
			'max_length'  => 'Votre titre dépasse les de 50 caractères.',
			'min_length'  => 'Votre titre doit faire plus de 5 caractères.',
		],

		'description' => [
            'required'    => 'Champ requis.',
			'max_length'  => 'Votre description dépasse les 255 caractères.',
		],

		'echeance' => [
            'required'     => 'Champ requis.',
        ],

		'priorite' => [
            'required'     => 'Champ requis.',
            'greater_than' => 'La priorité doit être supérieure à zéro.',
        ],
	];
	
	public function getTasks(): array {
		return $this->doFindAll();
	}
	
}
