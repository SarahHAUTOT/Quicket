<?php
namespace App\Entities;

use CodeIgniter\Entity\Entity;
use App\Models\UtilisateurModel;
use CodeIgniter\I18n\Time;
use Exception;

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
	
	public function resetTokenMdp(): Utilisateur {
		$this->attributes['token_mdp'] = "";
		$this->attributes['creation_token_mdp'] = "";
		return $this;
	}

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
	
	/**
	 * @throws Exception
	 */
	public function setTokenMdp(string $token): Utilisateur
    {
        $this->attributes['token_mdp'] = $token;
		$this->attributes['creation_token_mdp'] = Time::now('Europe/Paris', 'fr_FR');
        return $this;
    }
	
	/**
	 * @throws Exception
	 */
	public function setTokenInscription(string $token): Utilisateur
    {
        $this->attributes['token_inscription'] = $token;
		$this->attributes['creation_token_inscription'] = Time::now('Europe/Paris', 'fr_FR');
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
	
	/**
	 * @throws Exception
	 */
	public function getCreationTokenMdp(): Time
    {
        return new Time($this->attributes['creation_token_mdp']);
    }

    public function getTokenInscription(): ?string
    {
        return $this->attributes['token_inscription'];
    }
	
	/**
	 * @throws Exception
	 */
	public function getCreationTokenInscription(): Time
    {
        return new Time($this->attributes['creation_token_inscription']);
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
