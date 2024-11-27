<?php
namespace App\Models;

use CodeIgniter\Model;

class CommentaireModel extends Model
{
	protected $table      = 'commentaire';
	protected $autoIncrement = true;
	protected $primaryKey = 'id_commentaire';
	protected $returnType = 'App\Entities\Commentaire';
	protected $allowedFields = ['texte_commentaire', 'creation_tache', 'id_utilisateur', 'id_tache' ];
	
	protected $useTimestamps = false;
	protected $createdField = 'creation_commentaire';
	protected $useSoftDeletes = false;
	
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

	/**
	 * Retourne tous les commentaires liés à une tâche donnée.
	 *
	 * @param int $idTache L'ID de la tâche pour laquelle récupérer les commentaires.
	 * @return array|null Une liste d'entités `Commentaire` ou `null` si aucun commentaire trouvé.
	 */
	public function getCommentaireTache(int $idTache, int $perPage = 5): ?array
	{
		return $this->where('id_tache', $idTache)
					->paginate($perPage);
	}
}
