<?php
namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Utilisateur extends Entity
{
    /*
    protected $attributes = [
        'id_utilisateur' => null,
        'email' => null,
        'mdp'   => null,
        'pseudo'=> null,
        'role'  => null,
        'token' => null,
        'date_creation_token' => null,
    ];
    */
    
    public function setRole(string $role)
    {
        $this->attributes['role'] = $role;

        return $this;
    }
    
    public function setMdp(string $mdp)
    {
        $this->attributes['mdp'] = password_hash($mdp, PASSWORD_BCRYPT);

        return $this;
    }

    public function setToken(string $role)
    {
        $this->attributes['role'] = $role;

        return $this;
    }
}