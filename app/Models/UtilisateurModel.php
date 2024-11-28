<?php
namespace App\Models;

use App\Entities\Utilisateur;
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
	protected $useSoftDeletes = false;
	
	// Règles de validation
	protected $validationRules = [
		'pseudo' => 'required|max_length[50]',
		'email'  => 'required|max_length[255]|valid_email|is_unique[utilisateur.email]',
		'mdp'    => 'required|max_length[255]|min_length[8]',
	];

	protected $validationMessages = [
        'pseudo' => [
            'required'    => 'Champ requis.',
            'max_length'  => 'Votre pseudo fait plus de 50 caractères.',
        ],

        'mdp' => [
            'required'    => 'Champ requis.',
            'max_length'  => 'Votre mot de passe doit faire moins de 255 caractères.',
            'min_length'  => 'Votre mot de passe doit faire plus de 8 caractères.',
        ],

        'email' => [
            'required'    => 'Champ requis.',
            'is_unique'   => 'Cet email est déjà utilisé.',
            'max_length'  => 'Votre email dépasse les 255 caractères.',
            'valid_email' => 'Entrez un email valide.',
        ]
    ];

	// Fonctions
    public function getTaches(Utilisateur $utilisateur): array
    {
        $tacheModele = new TacheModel();
        return $tacheModele->where('id_utilisateur', $utilisateur->getIdUtilisateur())->get()->getResult('App\Entities\Tache');
    }

    public function deleteCascade(int $idUtilisateur): bool
    {
        $tacheModele = new TacheModel();
        $taches = $this->getTaches($this->find($idUtilisateur));
        
        foreach ($taches as $tache)
        {
            $tacheModele->deleteCascade($tache->getIdTache());
            /*
            $commentaires = $tache->getCommentaires();
            foreach ($commentaires as $commentaire)
            {
                $commentaireModele->delete($commentaire->getIdCommentaire());
            }
            $tacheModele->delete($tache->getIdTache());*/
        }

		return $this->delete($idUtilisateur);
    }
}
