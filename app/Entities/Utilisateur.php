<?php
namespace App\Entities;

use CodeIgniter\Entity\Entity;
use App\Models\UtilisateurModel;
use CodeIgniter\I18n\Time;

class Utilisateur extends Entity
{
    static $ROLE_UTILISATEUR = "ROLE_UTILISATEUR";
    static $ROLE_INACTIF     = "ROLE_INACTIF";
    static $ROLE_ADMIN       = "ROLE_ADMIN";
    
    protected $attributes = [
        'id_utilisateur' => null,
        'email'     => null,
        'mdp'       => null,
        'pseudo'    => null,
        'role'      => null,
        'token_mdp' => null,
        'creation_token_mdp' => null,
        'token_inscription'  => null,
        'creation_token_inscription' => null,
    ];

    protected $dates = ['creation_token_mdp', 'creation_token_inscription'];

    /* ---------------------------------------- */
	/* ---------------- Setter ---------------- */
	/* ---------------------------------------- */
    
    public function setRole(string $role): Utilisateur
    {
        $this->attributes['role'] = $role;

        return $this;
    }

    public function setEmail(string $email): Utilisateur
    {
        $this->attributes['email'] = $email;

        return $this;
    }

    public function setPseudo(string $pseudo): Utilisateur
    {
        $this->attributes['pseudo'] = $pseudo;

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
        return $this;
    }

    public function setTokenInscription(string $token): Utilisateur
    {
        $this->attributes['token_inscription'] = $token;
        return $this;
    }

    public function setCreationTokenMdp(?Time $time): Utilisateur
    {
        $this->attributes['creation_token_mdp'] = $time;
        return $this;
    }

    public function setCreationTokenInscription(?Time $time): Utilisateur
    {
        $this->attributes['creation_token_inscription'] = $time;
        return $this;
    }

    /* ---------------------------------------- */
	/* ---------------- Getter ---------------- */
	/* ---------------------------------------- */

    public function getIdUtilisateur(): int
    {
        return intval($this->attributes['id_utilisateur']);
    }

    public function getEmail(): ?string
    {
        return $this->attributes['email'];
    }

    public function getMdp(): ?string
    {
        return $this->attributes['mdp'];
    }

    public function getPseudo(): ?string
    {
        return $this->attributes['pseudo'];
    }

    public function getRole(): ?string
    {
        return $this->attributes['role'];
    }

    public function getTokenMdp(): ?string
    {
        return $this->attributes['token_mdp'];
    }

    public function getCreationTokenMdp(): ?string
    {
        return $this->attributes['creation_token_mdp'];
    }

    public function getTokenInscription(): ?string
    {
        return $this->attributes['token_inscription'];
    }

    public function getCreationTokenInscription(): ?string
    {
        return $this->attributes['creation_token_inscription'];
    }

    public function getTaches(): array
    {
        $utilisateurModel = new UtilisateurModel();
        return $utilisateurModel->getTaches($this);
    }

    public function getProjetsCreer(): array
    {
        $utilisateurModel = new UtilisateurModel();
        return $utilisateurModel->getProjetsCreer($this);
    }

    public function getProjetsParticipant(): array
    {
        $utilisateurModel = new UtilisateurModel();
        return $utilisateurModel->getProjetsParticipant($this);
    }
}