<?php
namespace App\Entities;

use CodeIgniter\Entity\Entity;
use CodeIgniter\I18n\Time;

class Tache extends Entity
{
    protected $attributes = [
        'id_tache',
        'creation_tache',
        'modiff_tache',
        'titre',
        'description',
        'echeange',
        'id_utilisateur'
    ];

    protected $dates = ['creation_tache', 'modiff_tache'];

    // Setteurs
    
    public function setTitre(string $titre)
    {
        $this->attributes['titre'] = $titre;

        return $this;
    }
    
    public function setModiffTache()
    {
        $this->attributes['modiff_tache'] = Time::now('Europe/Paris', 'fr_FR');

        return $this;
    }
    
    public function setDescription(string $desc)
    {
        $this->attributes['description'] = $desc;

        return $this;
    }
    
    public function setEcheance(int $nombre, string $format)
    {
        switch($format)
        {
            case 'AAAA':
                $this->attributes['modiff_tache'] = $this->getCreationTache()->addYears($nombre);
                break;

            case 'MM':
                $this->attributes['modiff_tache'] = $this->getCreationTache()->addMonths($nombre);
                break;
            
            case 'DD':
                $this->attributes['modiff_tache'] = $this->getCreationTache()->addDays($nombre);
                break;
        }

        return $this;
    }

    // Getteurs

    public function getIdTache(): int|null
    {
        $id = intval($this->attributes['id_tache']) == 0 ?
            null :
            intval($this->attributes['id_tache']);

        return $id;
    }

    public function getCreationTache(): Time|null
    {
        return $this->attributes['creation_tache'];
    }

    public function getModiffTache(): Time|null
    {
        return $this->attributes['modiff_tache'];
    }

    public function getTitre(): Time|null
    {
        return $this->attributes['titre'];
    }

    public function getDescription(): Time|null
    {
        return $this->attributes['description'];
    }

    public function getEcheance(): Time|null
    {
        return $this->attributes['echeange'];
    }

    public function getIdUtilisateur(): Time|null
    {
        return $this->attributes['id_utilisateur'];
    }
}