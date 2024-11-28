<?php
namespace App\Controllers;
use App\Models\CommentaireModel;
use App\Models\TacheModel;
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

	public function redirection_compte()
	{
		// TODO : Afficher seulement si le token est bon

		echo view('commun/Navbar'); 
		echo view('compte/Compte'); 
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

			//Si le compte est actif
			if($utilisateur->getRole() != Utilisateur::$ROLE_INACTIF) {
				
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
					return redirect()->back()->withInput()->with('error','Mots de passe incorrect.');
				}

			} else {
				return redirect()->back()->withInput()->with('error','Votre compte n\'est pas actif. Consultez vos mails pour l\'activer !');
			}
		} else {
			// Email non trouvé
			$session->setFlashdata('msg', 'Email inexistant.');
            return redirect()->to('/connexion')->with('msg', 'Pas de compte lier a cette email !');
		}
	}




	public function traitement_deconnexion()
	{
		session()->destroy();
		return redirect()->to('/connexion');
	}



	public function traitement_modifDonne()
	{
		$validation = \Config\Services::validation();
		$utilisateurModel = new UtilisateurModel();
		$session = session();

		$data = $this->request->getPost();

		// Règles de validation uniquement pour email et pseudo
		$regleValidation = [];

		if (strcmp($data['email'], $session->get('email')) == 0) {
			$regleValidation = [
				'pseudo' => $utilisateurModel->getValidationRules()['pseudo']
			];
		} else {
			$regleValidation = [
				'email'  => $utilisateurModel->getValidationRules()['email'],
				'pseudo' => $utilisateurModel->getValidationRules()['pseudo']
			];
		}

		$isValid = $this->validate($regleValidation, $utilisateurModel->getValidationMessages());

		if (!$isValid) {
			return redirect()->back()->withInput()->with('errors', $validation->getErrors());
		}

		// Récupération des données de la session
		$idUtilisateur = $session->get('id_utilisateur');

		/**
		 * @var Utilisateur
		 */
		$utilisateur = $utilisateurModel->find($idUtilisateur);

		// Mise à jour des propriétés
		$utilisateur->setEmail ($data['email']  ?? $utilisateur->getEmail());
		$utilisateur->setPseudo($data['pseudo'] ?? $utilisateur->getPseudo());

		// Enregistrer les modifications
		$utilisateurModel->save($utilisateur);

		// Mettre à jour la session
		$session->set([
			'email'  => $utilisateur->email,
			'pseudo' => $utilisateur->pseudo,
		]);

		return redirect()->to('/account')->with('success', 'Vos données ont été mises à jour.');
	}


	public function traitement_delete()
	{
		
		$session = session();
		$utilisateurModel = new UtilisateurModel();

		// Récupérer les données du formulaire
		$mdp   = $this->request->getVar('mdp');

		// Rechercher l'utilisateur par email
		$utilisateur = $utilisateurModel->find($session->get('id_utilisateur'));

		// Comparer le mot de passe
		// if (password_verify($mdp, $utilisateur->getMdp())) {  // Utiliser la méthode getMdp()
		if (strcmp($mdp, $utilisateur->getMdp()) == 0) {  // TODO : A changer quand on hashera le code avec la ligne du dessu
			
			//Supprimer
			$tableModele = new TacheModel();
			$commentaireModele = new CommentaireModel();
			$taches = $utilisateur->getTaches();
			
			foreach ($taches as $tache)
			{
				$commentaires = $tache->getCommentaires();
				foreach ($commentaires as $commentaire)
				{
					$commentaireModele->delete($commentaire->getIdCommentaire());
				}
				$tableModele->delete($tache->getIdTache());
			}

			$utilisateurModel->delete($utilisateur->getIdUtilisateur());
			
			// Deconnexion
			return redirect()->to('/deconnect'); 
		} else {
			// Mot de passe incorrect
			return redirect()->back()->withInput()->with('error', 'Mots de passe incorrect');
		}
	}
  
	public function traitement_inscription()
	{
		$utilisateurModel = new UtilisateurModel();
		$regleValidation = $utilisateurModel->getValidationRules();
		$regleValidation['mdpConf'] = 'required_with[mdp]|min_length[8]|max_length[255]|matches[mdp]';

		$isValid = $this->validate($regleValidation, $utilisateurModel->getValidationMessages());
		
		if (!$isValid) {
            session()->setFlashdata('validation', \Config\Services::validation()->getErrors());
            // Rediriger vers la page d'inscription
            return redirect()->to('/inscription');
		} else {
			$data = $this->request->getPost();
			$utilisateur = new Utilisateur();
			$utilisateur->fill($data);
			$utilisateur->setRole(Utilisateur::$ROLE_INACTIF);

			$tokenInsc = $this->generateValidToken();
			$utilisateur->setTokenInscription($tokenInsc);
			$utilisateurModel->insert($utilisateur);
			mail_certif_compte($utilisateur->getEmail(), $tokenInsc);
            return redirect()->to('/connexion')->with('msg', 'Votre compte a été créer avec succès, maintenant il faut l\'activer avec votre mail !');
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
		
		$utilisateur->setRole(Utilisateur::$ROLE_UTILISATEUR);
		$utilisateur->setTokenInscription(""); // Suppression du token
		$utilisateurModel->save($utilisateur);

		// Création de la session
		$session->set([
			'id_utilisateur' => $utilisateur->getIdUtilisateur(),
			'email'          => $utilisateur->getEmail(),
			'pseudo'         => $utilisateur->getPseudo(),
			'role'           => $utilisateur->getRole(),
			'isLoggedIn'     => false,
		]);

		echo '<pre>';
		var_dump($utilisateur->toArray());
		echo '</pre>';

		return redirect()->to('/connexion')->with('msg', 'Votre compte a été activé avec succès !');
	}


	public function traitement_emailMDPoublie()
	{
		// TODO : Traitement de l'inscription
		$session = session();
		$utilisateurModel = new UtilisateurModel();

		// Récupérer les données du formulaire
		$email = $this->request->getVar('email');

		// Rechercher l'utilisateur par email
		$utilisateur = $utilisateurModel->where('email', $email)->first();

		// Vérifier si un utilisateur a été trouvé
		if ($utilisateur) {
            $tokenMDP = $this->generateValidToken();
			$utilisateur->setTokenMdp($tokenMDP);
			$utilisateurModel->save($utilisateur);
            mail_modifier_mdp($utilisateur->getEmail(), $tokenMDP);
            return redirect()->to('/connexion/mdp')->with('msg', 'Un email a été envoyer !');
		} else {
			// Email non trouvé
			$session->setFlashdata('msg', 'Email inexistant.');
			return redirect()->to('/emailmdp')->with('msg', 'Email inexistant !');
		}
	}


	public function traitement_modificationMDP($tokenMDP)
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