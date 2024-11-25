<?php
namespace App\Models;

use CodeIgniter\Model;

class TacheModel extends Model
{
	protected $table      = 'tache';
    protected $autoIncrement = true;
	protected $primaryKey = 'id_tache';
	protected $returnType = 'App\Entities\Tache';
	protected $allowedFields = [
        'creation_tache',
        'modiff_tache',
        'titre',
        'description',
        'echeange',
        'id_utilisateur'
    ];
	
	protected $useTimestamps = true;
    protected $createdField = 'creation_tache';
    protected $updatedField = 'modiff_tache';

	protected $useSoftDeletes = true;
	
	// Règles de validation
	protected $validationRules = [
		'titre'     => 'required|max_length[50]|min_length[5]',
		'texte'     => 'required|max_length[255]',
		'echeange'  => 'required|greater_than[0]',
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

		'echeange' => [
            'required'     => 'Champ requis.',
			'greater_than' => 'L\'échéance doit être supérieur à zéro.',
		]
	];
}
