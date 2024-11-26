<?php
namespace App\Entities;

use CodeIgniter\Entity\Entity;
use CodeIgniter\I18n\Time;

class Commentaire extends Entity
{
	protected $attributes = [
		'id_commentaire'		=> null,
		'texte_commentaire'		=> null,
		'id_utilisateur'		=> null,
		'id_tache'				=> null,
	];
	protected $dates = ['creation_commentaire'];

	/* ---------------------------------------- */
	/* ---------------- Setter ---------------- */
	/* ---------------------------------------- */

	/**
	 * Setter pour texte_commentaire
	 * @param string $texte le texte du commentaire
	 * @return texte le texte du commentaire
	 */
	public function setTexteCommentaire(string $texte): self
	{
		$this->attributes['texte_commentaire'] = $texte;
		return $this;
	}


	/**
	 * Setter pour id_utilisateur
	 * @param int $idUtilisateur change l'utilisateur qui à écrit le commentaire
	 * @return int renvois le nouveau utilisateur
	 */
	public function setIdUtilisateur(int $idUtilisateur): self
	{
		$this->attributes['id_utilisateur'] = $idUtilisateur;
		return $this;
	}

	/**
	 * Setter pour id_tache
	 */
	public function setIdTache(int $idTache): self
	{
		$this->attributes['id_tache'] = $idTache;
		return $this;
	}

	/* ---------------------------------------- */
	/* ---------------- Getter ---------------- */
	/* ---------------------------------------- */

	/**
	 * Getter pour id_commentaire
	 */
	public function getIdCommentaire(): ?int
	{
		return $this->attributes['id_commentaire'];
	}

	/**
	 * Getter pour texte_commentaire
	 */
	public function getTexteCommentaire(): ?string
	{
		return $this->attributes['texte_commentaire'];
	}



	/**
	 * Getter pour texte_commentaire
	 */
	public function getIdTache(): ?int
	{
		return $this->attributes['id_tache'];
	}
}