<?php
namespace App\Entities;

use App\Entities\Projet;
use App\Models\TacheModel;
use CodeIgniter\Entity\Entity;
use CodeIgniter\I18n\Time;
use CodeIgniter\I18n\TimeDifference;

class Tache extends Entity
{
    protected $attributes = [
        'id_tache' => null,
        'creation_tache' => null,
        'modiff_tache' => null,
        'titre' => null,
        'description' => null,
        'priorite' => null,
        'echeance' => null,
        'id_utilisateur' => null,
        'est_termine' => null,
        'id_projet' => null
    ];

    protected $dates = ['creation_tache', 'modiff_tache'];

    // Setteurs
    
    public function setTitre(string $titre): Tache
    {
        $this->attributes['titre'] = $titre;

        return $this;
    }

    public function setEstTermine(bool $bool): Tache
    {
        $this->attributes['est_termine'] = $bool;

        return $this;
    }
    
    public function setIdUtilisateur(int $id): Tache
    {
        $this->attributes['id_utilisateur'] = $id;

        return $this;
    }
    
    public function setIdProjet(int $id): Tache
    {
        $this->attributes['id_projet'] = $id;

        return $this;
    }
    
    public function setModiffTache()
    {
        $this->attributes['modiff_tache'] = Time::now('Europe/Paris', 'fr_FR');

        return $this;
    }
    
    public function setDescription(string $desc): Tache
    {
        $this->attributes['description'] = $desc;

        return $this;
    }

    public function setEcheance(string $strTime): Tache
    {
        $this->attributes['echeance'] = new Time($strTime, new \DateTimeZone('Europe/Paris'), 'fr_FR');

        return $this;
    }

    public function setCreationTache(): Tache
    {
        $this->attributes['creation_tache'] = Time::now('Europe/Paris', 'fr_FR');

        return $this;
    }
    
    public function setPriorite(string $str): Tache
    {
        $this->attributes['priorite'] = intval($str);

        return $this;
    }

    // Getteurs

    public function getIdTache(): int
    {
        return intval($this->attributes['id_tache']);
    }

    public function getIdProjet(): int
    {
        return intval($this->attributes['id_projet']);
    }

    public function getEstTermine(): bool
    {
        return strcmp($this->attributes['est_termine'], 'f');
    }

    public function getModiffTache(): ?Time
    {
        return new Time($this->attributes['modiff_tache']);
    }
    
    public function getTitre(): ?string
    {
        return $this->attributes['titre'];
    }

    public function getDescription(): ?string
    {
        return $this->attributes['description'];
    }

    public function getEcheance(): ?Time
    {
        return new Time($this->attributes['echeance']);
    }

    public function getIdUtilisateur(): int
    {
        return intval($this->attributes['id_utilisateur']);
    }


    public function getPriorite(): ?int
    {
        return $this->attributes['priorite'];
    }

    public function getPrioriteString(): ?string
    {
        switch ($this->attributes['priorite']) 
        {
            case 1:
                return "Crucial";
                break;
            
            case 2:
                return "Important";
                break;
            
            case 3:
                return "Neutre";
                break;

            case 4:
                return "Négligeable";
                break;
        }

        return $this->attributes['priorite'];
    }

    public function getTempsRestant(): TimeDifference
    {
        $time = $this->getEcheance();
        return $time->difference(Time::now('Europe/Paris', 'fr_FR'));
    }

    /**
	 * Getter l'utilisateur
	 */
    public function getCommentaires(): array
    {
		$tacheModele = new TacheModel();
        return $tacheModele->getCommentaires($this);
    }

    public function getProjet(): Projet
    {
		$tacheModele = new TacheModel();
        return $tacheModele->getProjet($this);
    }


    public function getCouleur():string
    {
		$tacheModele = new TacheModel();
        return $tacheModele->getCouleur($this);

    }

    public function getNomProjet():string
    {
		$tacheModele = new TacheModel();
        return $tacheModele->getNomProjet($this);

    }
}