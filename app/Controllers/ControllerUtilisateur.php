<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Entities\Utilisateur;

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
		// TODO : Traitement de connexion
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
				return redirect()->to('/taches'); 
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
		$utilisateurModel = new UtilisateurModel();
		$regleValidation = $utilisateurModel->getValidationRules();
		$regleValidation['mdpConf'] = 'required_with[mdp]|min_length[8]|max_length[255]|matches[mdp]';

		$isValid = $this->validate($regleValidation, $utilisateurModel->getValidationMessages());
		
		if (!$isValid) {
			return view('connexion/Connexion',[
				'validation' => \Config\Services::validation()
			]);
		} else {
			$data = $this->request->getPost();
			$utilisateur = new Utilisateur();
			$utilisateur->fill($data);
			$utilisateur->setRole(Utilisateur::$ROLE_INACTIF);

			$tokenInsc = $this->generateValidToken();
			log_message('debug', 'Token généré pour l\'inscription : ' . $tokenInsc);
			$utilisateur->setTokenInscription($tokenInsc);
			$utilisateurModel->insert($utilisateur);

			// TODO appel fonction mail avec param et $utilisateur->getEmail() $tokenInsc
			mail_certif_compte($utilisateur->getEmail(), $tokenInsc);
			
			echo view('commun/Navbar'); 
			echo view('connexion/Connexion'); 
			echo view('commun/Footer'); 
		}
	}


	public function traitement_activation(string $tokenActivation)
	{
		$session = session();
		$utilisateurModel = new UtilisateurModel();

		// Recherche de l'utilisateur avec le token

		$utilisateur = $utilisateurModel->where('token_inscription', $tokenActivation)->first();

		if (!$utilisateur) {
			// Token invalide
			return redirect()->to('/inscription')->with('msg', 'Lien d\'activation invalide ou expiré.');
		}

		// Activation de l'utilisateur
		echo '<pre>';
		var_dump($utilisateur->toArray());
		echo '</pre>';
		
		$utilisateur->setRole(Utilisateur::$ROLE_UTILISATEUR);
		$utilisateur->setTokenInscription(""); // Suppression du token
		$utilisateurModel->save($utilisateur);

		// Création de la session
		$session->set([
			'id_utilisateur' => $utilisateur->getIdUtilisateur(),
			'email'          => $utilisateur->getEmail(),
			'pseudo'         => $utilisateur->getPseudo(),
			'role'           => $utilisateur->getRole(),
			'isLoggedIn'     => true,
		]);

		echo '<pre>';
		var_dump($utilisateur->toArray());
		echo '</pre>';

		return redirect()->to('/taches')->with('msg', 'Votre compte a été activé avec succès !');
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

	/**
	 * Génère un token robuste, pour inscription et oubli mdp
	 * @return string
	 */
	private function generateValidToken(): string
	{
		do {
			$token = bin2hex(random_bytes(16)); // Génère un token de 32 caractères
		} while (!is_string($token) || empty($token));

		return $token;
	}
}