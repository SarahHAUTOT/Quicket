<?php
namespace App\Entities;

use CodeIgniter\Entity\Entity;
use CodeIgniter\I18n\Time;

class Utilisateur extends Entity
{
    static $ROLE_UTILISATEUR = "ROLE_UTILISATEUR";
    static $ROLE_INACTIF     = "ROLE_INACTIF";
    static $ROLE_ADMIN       = "ROLE_ADMIN";
    
    protected $attributes = [
        'id_utilisateur' => null,
        'email' => null,
        'mdp'   => null,
        'pseudo'=> null,
        'role'  => null,
        'token_mdp' => null,
        'creation_token_mdp' => null,
        'token_inscription' => null,
        'creation_token_inscription' => null,
    ];

    protected $dates = ['creation_token_mdp', 'creation_token_inscription'];

    // Setteurs
    
    public function setRole(string $role): Utilisateur
    {
        $this->attributes['role'] = $role;

        return $this;
    }
    
    public function setMdp(string $mdp): Utilisateur
    {
        $this->attributes['mdp'] = password_hash($mdp, PASSWORD_BCRYPT);

        return $this;
    }

    public function setTokenMdp(string $token): Utilisateur
    {
        $this->attributes['token_mdp'] = $token;
        $this->attributes['creation_token_mdp'] = Time::now('Europe/Paris', 'fr_FR');

        return $this;
    }

    public function setTokenInscription(string $token): Utilisateur
    {
        $this->attributes['token_inscription'] = $token;
        $this->attributes['creation_token_inscription'] = Time::now('Europe/Paris', 'fr_FR');
        return $this;
    }

    // Getteurs

    public function getIdUtilisateur(): int|null
    {
        $id = intval($this->attributes['id_utilisateur']) == 0 ?
            null :
            intval($this->attributes['id_utilisateur']);

        return $id;
    }

    public function getEmail(): string|null
    {
        return $this->attributes['email'];
    }

    public function getMdp(): string|null
    {
        return $this->attributes['mdp'];
    }

    public function getPseudo(): string|null
    {
        return $this->attributes['pseudo'];
    }

    public function getRole(): string|null
    {
        return $this->attributes['role'];
    }

    public function getTokenMdp(): string|null
    {
        return $this->attributes['token_mdp'];
    }

    public function getCreationTokenMdp(): string|null
    {
        return $this->attributes['creation_token_mdp'];
    }

    public function getTokenInscription(): string|null
    {
        return $this->attributes['token_inscription'];
    }

    public function getCreationTokenInscription(): string|null
    {
        return $this->attributes['creation_token_inscription'];
    }
}