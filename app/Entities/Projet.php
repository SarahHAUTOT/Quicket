<?php
namespace App\Entities;

use App\Models\ProjetModel;
use CodeIgniter\Entity\Entity;

class Projet extends Entity
{
	protected $attributes = [
		'id_projet'	  => null,
		'couleur'	  => null,
		'nom_projet'  => null,
		'id_createur' => null,
	];

	/* ---------------------------------------- */
	/* ---------------- Setter ---------------- */
	/* ---------------------------------------- */

	public function setCouleur(string $texte): self
	{
		$this->attributes['couleur'] = $texte;
		return $this;
	}

	public function setNomProjet(string $texte): self
	{
		$this->attributes['nom_projet'] = $texte;
		return $this;
	}

	public function setIdCreateur(int $idUtilisateur): self
	{
		$this->attributes['id_createur'] = $idUtilisateur;
		return $this;
	}

	/* ---------------------------------------- */
	/* ---------------- Getter ---------------- */
	/* ---------------------------------------- */

	public function getIdProjet(): ?int
	{
		return intval($this->attributes['id_projet']);
	}

    public function getIdCreateur(): int
    {
        return $this->attributes['id_createur'];
    }

    public function getCreateur(): Utilisateur
    {
		$projetModel = new ProjetModel();
        return $projetModel->getCreateur($this);
    }

    public function getUtilisateurs(): array
    {
		$projetModel = new ProjetModel();
        return $projetModel->getUtilisateurs($this);
    }

    public function getTaches(): array
    {
		$projetModel = new ProjetModel();
        return $projetModel->getTaches($this);
    }

	public function getNomProjet(): ?string
	{
		return $this->attributes['nom_projet'];
	}

	public function getCouleur(): ?string
	{
		return $this->attributes['couleur'];
	}
}