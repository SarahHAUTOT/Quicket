<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\User;

use App\Models\UtilisateurModel;

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

	/**
	 * Formulaire demande email pouur le liens du changement de mdp
	 * @return void
	 */
	public function email_mdp()
	{
    	echo view('commun/Navbar'); 
    	echo view('connexion/EmailMDP'); 
    	echo view('commun/Footer'); 
	}

	/**
	 * Vérifie la demande de connexion
	 * @return void page d'acueil mais connecter
	 * @return void page de connxion mais mdp incorect
	 * @return void page de connexion mais email pas inscrit
	 */
	public function traitement_connexion()
	{
    	// TODO : Traitement de connexion
		$session = session();
		$utilisateurModel = new \App\Models\UtilisateurModel();

		// Récupérer les données du formulaire
		$email = $this->request->getVar('email');
		$mdp = $this->request->getVar('mdp');

		// Rechercher l'utilisateur par email
		$utilisateur = $utilisateurModel->where('email', $email)->first();

		// Vérifier si un utilisateur a été trouvé
		if ($utilisateur) {
			// Comparer le mot de passe
			if (password_verify($mdp, $utilisateur->getMdp())) {  // Utiliser la méthode getMdp()
				// Créer les données de session
				$session->set([
					'id_utilisateur' => $utilisateur->getIdUtilisateur(),  // Utiliser la méthode getIdUtilisateur()
					'email' => $utilisateur->getEmail(),  // Utiliser la méthode getEmail()
					'pseudo' => $utilisateur->getPseudo(),  // Utiliser la méthode getPseudo()
					'role' => $utilisateur->getRole(),  // Utiliser la méthode getRole()
					'isLoggedIn' => true
				]);

				// Rediriger vers la page d'accueil
				echo view('commun/Navbar'); 
				echo view('Accueil'); //TODO changer la page
				echo view('commun/Footer'); 
			} else {
				// Mot de passe incorrect
				$session->setFlashdata('msg', 'Mot de passe incorrect.');
				echo view('commun/Navbar'); 
				echo view('connexion/Connexion'); 
				echo view('commun/Footer'); 
			}
		} else {
			// Email non trouvé
			$session->setFlashdata('msg', 'Email inexistant.');
			echo view('commun/Navbar'); 
			echo view('connexion/Connexion'); 
			echo view('commun/Footer'); 
		}
	}

	
	
	public function traitement_inscription()
	{
		// TODO : Traitement de l'inscription
		$utilisateurModel = new UtilisateurModel();
        $regleValidation = $utilisateurModel->getValidationRules();
        $regleValidation['mdpConf'] = 'required_with[mdp]|min_length[8]|max_length[255]|matches[mdp]';

		$isValid = $this->validate($regleValidation, $utilisateurModel->getValidationMessages());
		
		if (!$isValid) {
			return view('formConnexion',[
				'validation' => \Config\Services::validation()
			]);
		} else {
            $data = $this->request->getPost();
            $utilisateur = new \App\Entities\Utilisateur();
            $utilisateur->fill($data);
            $utilisateur->setRole(\App\Entities\Utilisateur::$ROLE_INACTIF);
            $utilisateur->setTokenInscription('abcd');

            $utilisateurModel->insert($utilisateur);
			echo view('commun/Navbar'); 
			echo view('connexion/Connexion'); 
			echo view('commun/Footer'); 
		}
	}


	public function traitement_activation($tokenActivation)
	{
		// TODO : Afficher seulement si le token est bon
	}

	public function traitement_emailMDPoublie()
	{
		// TODO : Traitement de l'inscription
		$session = session();
		$utilisateurModel = new UtilisateurModel();

		// Récupérer les données du formulaire
		$email = $this->request->getVar('email');
		$mdp = $this->request->getVar('mdp');

		// Rechercher l'utilisateur par email
		$utilisateur = $utilisateurModel->where('email', $email)->first();

		// Vérifier si un utilisateur a été trouvé
		if ($utilisateur) {
			// Comparer le mot de passe
			echo view('commun/Navbar'); 
			echo view('connexion/Modif'); 
			echo view('commun/Footer'); 
		} else {
			// Email non trouvé
			$session->setFlashdata('msg', 'Email inexistant.');
			echo view('commun/Navbar'); 
			echo view('connexion/Modif'); 
			echo view('commun/Footer'); 
		}
	}


	public function traitement_modificationMDP()
	{
		// TODO : Modifier le mots de passe avec les données (doit attandre l'envoie de mail OK)
		
	}
}