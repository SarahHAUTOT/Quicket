<?php
namespace App\Models;

use CodeIgniter\Model;
use App\Entities\Projet;
use App\Entities\Utilisateur;
use App\Models\UtilisateurModel;
use App\Entities\Commentaire;

class ProjetModel extends Model
{
	protected $table      = 'projet';
	protected $autoIncrement = true;
	protected $primaryKey = 'id_projet';
	protected $returnType = 'App\Entities\Projet';
	protected $allowedFields = ['couleur', 'nom_projet', 'id_createur'];
	
	protected $useTimestamps = false;
	protected $useSoftDeletes = false;
	
	// Règles de validation
	protected $validationRules = [
		'couleur'        => 'required|exact_length[7]',
		'nom_projet'     => 'required|min_length[1]|max_length[50]',
	];

	protected $validationMessages = [
		'couleur' => [
			'required'     => 'Champ requis.',
			'exact_length' => 'Couleur invalide.',
		],

		'nom_projet' => [
			'required'    => 'Champ requis.',
			'min_length'  => 'Votre commentaire fait moins de 3 caractères.',
			'max_length'  => 'Votre nom de projet dépasse les 50 caractères.',
		],
	];
	
	public function getUtilisateurs(Projet $projet): ?array
	{
		$builder = $this->builder();
		$builder->select(select: 'utilisateur.*')->from('utilisateur')
				->join('projetutilisateur', 'utilisateur.id_utilisateur = projetutilisateur.id_utilisateur', 'left')
				->where('projetutilisateur.id_projet', $projet->getIdProjet());
			
		$utilisateurs = $builder->get()->getResult('App\Entities\Utilisateur');
		array_push($utilisateurs, $projet->getCreateur());
		return $utilisateurs;
	}
	
	public function getTaches(Projet $projet): ?array
	{
		$builder = $this->builder();
		$builder->select(select: 'tache.*')->from('tache')
				->where('tache.id_projet', $projet->getIdProjet());
			
		$utilisateurs = $builder->get()->getResult('App\Entities\Utilisateur');
		array_push($utilisateurs, $projet->getCreateur());
		return $utilisateurs;
	}

	public function insererProjetUtilisateur(int $idProjet, int $idUtilisateur): bool
    {
        $db = \Config\Database::connect();
        $builder = $db->table('projetutilisateur');

        $data = [
            'id_projet'  => $idProjet,
            'id_utilisateur' => $idUtilisateur,
        ];
        
        return $builder->insert($data);
    }

	public function deleteProjetUtilisateur(int $idProjet, int $idUtilisateur): bool
    {
        $db = \Config\Database::connect();
        $builder = $db->table('projetutilisateur');

        $data = [
            'id_projet'  => $idProjet,
            'id_utilisateur' => $idUtilisateur,
        ];
        
        return $builder->delete($data);
    }

	public function deleteCascade(int $idProjet): bool
    {
		$utilisateurModele = new UtilisateurModel();
		$utilisateurs = $this->getUtilisateurs($idProjet);

		foreach ($utilisateurs as $utilisateur)
        	$utilisateurModele->deleteCascade($utilisateur->getIdUtilisateur());

		return $this->delete($idProjet);
    }

	public function getCreateur(Projet $projet): Utilisateur
	{
		$utilisateurModele = new UtilisateurModel();
		return $utilisateurModele->find($projet->getIdCreateur());
	}
}