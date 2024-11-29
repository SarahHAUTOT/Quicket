<?php
namespace App\Models;

use CodeIgniter\Model;
use App\Entities\Tache;
use CodeIgniter\I18n\Time;

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
		'echeance',
		'id_utilisateur',
		'id_projet',
		'priorite',
		'categorie',
		'est_termine'
	];
	
	protected $useTimestamps = true;
	protected $createdField = 'creation_tache';
	protected $updatedField = 'modiff_tache';

	protected $useSoftDeletes = false;
	
	// Règles de validation
	protected $validationRules = [
		'titre'       => 'required|alpha_space|max_length[50]|min_length[1]',
		'description' => 'required|alpha_numeric_punct|max_length[255]',
		'priorite'    => 'required|greater_than[0]|in_list[1,2,3,4]',
		'categorie'   => 'required|alpha_space|min_length[1]|max_length[50]',
		'echeance'    => 'required',
	];

	protected $validationMessages = [
		'titre' => [
			'required'    => 'Champ requis.',
			'alpha_space' => 'Les ponctuations ne sont pas accéptées',
			'max_length'  => 'Votre titre dépasse les de 50 caractères.',
			'min_length'  => 'Votre titre doit faire plus d\'un caractère.',
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

		'categorie' => [
			'required'     => 'Champ requis.',
			'alpha_space'  => 'Les ponctuations ne sont pas accéptées',
			'min_length'   => 'Votre titre dépasse les de 50 caractères.',
			'max_length'   => 'Votre catégorie doit faire plus d\'un caractère.',
		],
	];

	// Fonctions
	public function getPagination(int $parPage)
	{
		$this->paginate($parPage);
	}
	
	public function getFiltre(string $attributOrdre, string $ordre, ?string $titreRech = null): TacheModel
	{
		$tacheModele = $this->select();

		if ($titreRech)
			$tacheModele->like('titre', $titreRech);

		if (strcmp($attributOrdre, 'retard') == 0)
		{
			$tacheModele->where('echeance <', date('Y-m-d H:i:s'));
			$tacheModele->orderBy('echeance', $ordre);
		}
		else
		{
			$tacheModele->orderBy($attributOrdre, $ordre);
		}
		
		return $tacheModele;
	}

	public function getTacheById(int $idTache): Tache
	{
		return $this->find($idTache); // Utilisation de la méthode native find()
	}

	public function getCommentaires(Tache $tache): array
	{
		$commentaireModele = new CommentaireModel();
		return $commentaireModele->where('id_tache', $tache->getIdTache())->get()->getResult('App\Entities\Commentaire');
	}

	public function deleteCascade(int $idTache): bool
	{
		$commentaireModele = new CommentaireModel();
		$commentaires = $this->getCommentaires($this->find($idTache));
		foreach ($commentaires as $commentaire)
		{
			$commentaireModele->delete($commentaire->getIdCommentaire());
		}

		return $this->delete($idTache);
	}

	public function getTacheJour(int $idUtilisateur, \DateTime $datetime): array
	{
		$datetime->setTime(0, 0, 1);
		$timeMatin = new Time($datetime->format('d M Y H:i:s'));
		$datetime->setTime(23, 59, 59);
		$timeSoir = new Time($datetime->format('d M Y H:i:s'));

		$tacheModele = new TacheModel();
		return  $tacheModele->where('echeance <=', $timeSoir)
							->where('echeance >=', $timeMatin)
							->where('id_utilisateur', $idUtilisateur)
							->orderBy('echeance', 'asc')
							->get()->getResult('App\Entities\Tache');
	}
}
