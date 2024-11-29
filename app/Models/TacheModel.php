<?php
namespace App\Models;

use CodeIgniter\Model;
use App\Entities\Tache;
use CodeIgniter\I18n\Time;

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
		'priorite'    => 'required|greater_than[0]|in_list[1,2,3,4]',
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

    // Fonctions
	public function getTasks(): array {
		return $this->doFindAll();
	}
	
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
