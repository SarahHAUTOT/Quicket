<?php
namespace App\Controllers;
use App\Entities\Utilisateur;
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
	 */
	public function traitement_connexion()
	{
		$session = session();
		$utilisateurModel = new UtilisateurModel();


		// Récupérer les données du formulaire
		$email = $this->request->getVar('email');
		$mdp   = $this->request->getVar('mdp');




		// Rechercher l'utilisateur par email
		$utilisateur = $utilisateurModel->where('email', $email)->first();

		// Vérifier si un utilisateur a été trouvé
		if ($utilisateur) {

			// Si le ccompte est inactif
			if ($utilisateur->getRole() != Utilisateur::$ROLE_INACTIF) {


				// Comparer le mot de passe
				// if (password_verify($mdp, $utilisateur->getMdp())) {  // Utiliser la méthode getMdp()
				if (strcmp($mdp, $utilisateur->getMdp()) == 0) {  // TODO : A changer quand on hashera le code avec la ligne du dessu


					// Créer les données de session
					$session->set([
						'id_utilisateur' => $utilisateur->getIdUtilisateur(),  // Utiliser la méthode getIdUtilisateur()
						'email'          => $utilisateur->getEmail(),          // Utiliser la méthode getEmail()
						'pseudo'         => $utilisateur->getPseudo(),         // Utiliser la méthode getPseudo()
						'role'           => $utilisateur->getRole(),           // Utiliser la méthode getRole()
						'isLoggedIn'     => true
					]);


					// Rediriger vers la page d'accueil
					return redirect()->to('/taches'); 


				} else {

					// Mot de passe incorrect
					return redirect()->back()->withInput()->with('error', 'Mots de passe incorrect');
				}
			} else {
				return redirect()->back()->withInput()->with('error','Votre compte n\'est pas actif.');
			}


		} else {
			// Email non trouvéreturn redirect()->back()->withInput()->with('error', 'Email inutilisé');
			return redirect()->back()->withInput()->with('error', 'Email inutilisé');
		}
	}







	public function traitement_deconnexion()
	{
		session()->destroy();
		return redirect()->to('/connexion');
	}



	
	public function traitement_inscription()
	{
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
			$tokenInsc= bin2hex(random_bytes(16));
			$utilisateur->setTokenInscription($tokenInsc);
			// TODO appel fonction mail avec param et $utilisateur->getEmail() $tokenInsc
			$utilisateurModel->insert($utilisateur);
			echo view('commun/Navbar'); 
			echo view('connexion/Connexion'); 
			echo view('commun/Footer'); 
		}
	}


	public function traitement_activation($tokenActivation)
	{
	    $session = session();
	    $utilisateurModel = new UtilisateurModel();

	
	    // Rechercher l'utilisateur avec ce token
	    $utilisateur = $utilisateurModel->where('token_inscription', $tokenActivation)->first();
	
	    if ($utilisateur) {
	        // Activer le compte (supprimer le token et mettre à jour le rôle si nécessaire)
            $utilisateur->setRole(\App\Entities\Utilisateur::$ROLE_UTILISATEUR);
	        $utilisateur->token_inscription = null; // Supprimer le token
	        $utilisateur->creation_token_inscription = null; // Supprimer la date du token
	        $utilisateurModel->save($utilisateur);
	
	        // Créer une session de connexion
	        $session->set([
	            'id_utilisateur' => $utilisateur->id_utilisateur,
	            'email' => $utilisateur->email,
	            'pseudo' => $utilisateur->pseudo,
	            'role' => $utilisateur->role,
	            'isLoggedIn' => true
	        ]);
	
	        // Redirection vers la page d'accueil connecté
	        return redirect()->to('/taches'); 
	    } else {
	        // Token invalide, rediriger vers la page d'inscription
	        $session->setFlashdata('msg', 'Lien d\'activation invalide ou expiré. Veuillez vous inscrire à nouveau.');
	        echo view('commun/Navbar'); 
			echo view('connexion/Connexion'); 
			echo view('commun/Footer'); 
	    }
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