<?php
namespace App\Models;

use CodeIgniter\Model;
use App\Entities\Tache;
use App\Entities\Projet;
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
		'est_termine'
	];
	
	protected $useTimestamps = true;
	protected $createdField = 'creation_tache';
	protected $updatedField = 'modiff_tache';

	protected $useSoftDeletes = false;
	
	// Règles de validation
	protected $validationRules = [
		'titre'       => 'required|regex_match[/^[^<>;{}]*$/]|max_length[50]|min_length[1]',
		'description' => 'required|max_length[255]',
		'priorite'    => 'required|greater_than[0]|in_list[1,2,3,4]',
		'echeance'    => 'required',
	];
//^[^<>;{}]*$

	protected $validationMessages = [
		'titre' => [
			'required'    => 'Champ requis.',
			'max_length'  => 'Votre titre dépasse les de 50 caractères.',
			'min_length'  => 'Votre titre doit faire plus d\'un caractère.',
			'regex_match' => 'Les caractères < > ; { } sont interdits',
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
		]
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
		$commentaires = $commentaireModele->where('id_tache', $tache->getIdTache())->get()->getResult('App\Entities\Commentaire');
		return $commentaires ? $commentaires : [];
	}

	public function getProjet(Tache $tache): Projet
	{
		$projetModele = new ProjetModel();
		return $projetModele->where('id_projet', $tache->getIdProjet())->get()->getFirstRow('App\Entities\Projet');
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
		$utilisateurModel = new UtilisateurModel();
		$utilisateurCourant = $utilisateurModel->find($idUtilisateur);
		$projets = $utilisateurCourant->getProjetsCreer();
		$projets = array_merge($projets, $utilisateurCourant->getProjetsParticipant());

		$tacheModele = new TacheModel();

		$datetime->setTime(0, 0, 1);
		$timeMatin = new Time($datetime->format('d M Y H:i:s'));
		$datetime->setTime(23, 59, 59);
		$timeSoir = new Time($datetime->format('d M Y H:i:s'));


		$tachesJour = [];
		foreach ($projets as $projet)
		{
			$taches = $projet->getTaches();
			foreach($taches as $tache)
			{
				$jour = $tache->getEcheance();
				if ($jour > $timeMatin && $jour < $timeSoir)
					array_push($tachesJour, $tache);
			}

		}


		return  $tachesJour;
	}


	public function getCouleur ($tache):string
	{		
		$builder = $this->builder();
		$builder->select(select: 'projet.couleur')
				->join ('projet', 'projet.id_projet = tache.id_projet', 'left')
				->where('projet.id_projet', $tache->getIdProjet());
		
		return $builder->get(limit: 1)->getRow()->couleur;
	}


	public function getNomProjet ($tache):string
	{		
		$builder = $this->builder();
		$builder->select(select: 'projet.nom_projet')
				->join ('projet', 'projet.id_projet = tache.id_projet', 'left')
				->where('projet.id_projet', $tache->getIdProjet());
		
		return $builder->get(limit: 1)->getRow()->nom_projet;
	}
}
