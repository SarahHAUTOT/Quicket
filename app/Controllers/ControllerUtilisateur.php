<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\User;

class ControllerUtilisateur extends BaseController
{

	public function __construct()
	{
		//Chargement du helper Form
		helper(['form']);
	}


	public function redirection_connexion()
	{
    	echo view('commun/Navbar'); 
    	echo view('connexion/Connexion'); 
    	echo view('commun/Footer'); 
	}


	public function redirection_inscription()
	{
    	echo view('commun/Navbar'); 
    	echo view('connexion/Inscription'); 
    	echo view('commun/Footer'); 
	}


	public function redirection_modificationMDP($tokenMdp)
	{
		// TODO : Afficher seulement si le token est bon

    	echo view('commun/Navbar'); 
    	echo view('connexion/ModifMDP'); 
    	echo view('commun/Footer'); 
	}


	public function mail_Modification()
	{
		// TODO : Envoie du mail de modification de mots de passe

    	echo view('commun/Navbar'); 
    	echo view('connexion/Modif'); 
    	echo view('commun/Footer'); 
	}


	public function traitement_connexion()
	{
    	// TODO : Traitement de connexion
	}
	
	
	public function traitement_inscription()
	{
		// TODO : Traitement de l'inscription



		// Redirection vers la page pour demander l'activation
    	echo view('commun/Navbar'); 
    	echo view('connexion/Activation'); 
    	echo view('commun/Footer'); 
	}


	public function traitement_activation($tokenActivation)
	{
		// TODO : Afficher seulement si le token est bon
	}


	public function traitement_modificationMDP()
	{
		// TODO : Modifier le mots de passe avec les données
	}
}