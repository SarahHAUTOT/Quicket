<?php
namespace App\Controllers;
use App\Models\ProjetModel;
use App\Models\UtilisateurModel;
use CodeIgniter\Controller;
use App\Entities\Projet;

class ControllerProjet extends BaseController
{
	public function __construct()
	{
		//Chargement du helper Form
		helper(['form']);
	}
	
	public function redirection_projets()
	{
		$utilisateurModele = new UtilisateurModel();
		$utilisateurCourant =$utilisateurModele->find(session()->get('id_utilisateur'));
		$projetsCreer       = $utilisateurModele->getProjetsCreer      ($utilisateurCourant);
		$projetsParticipant = $utilisateurModele->getProjetsParticipant($utilisateurCourant);
		
		$projets = array_merge($projetsParticipant, $projetsCreer);

    	echo view('commun/Navbar'); 
    	echo view('projet/Projets', [
				'projets'     => $projets,
			]
		);
    	echo view('commun/Footer'); 
	}
	
	public function traitement_ajouter_participant()
	{
		$data = $this->request->getPost();
		$utilisateurModele = new UtilisateurModel();

		$idProjet = intval($data['id_projet']);

		$participant = $utilisateurModele->where('email', $data['email'])->first();

		if ($participant == null) 
		{
			return redirect()->back()->withInput()->with('errors', 'Cet utilisateur n\'existe pas');
		}

		$projetModele = new ProjetModel();
		echo '<pre>';
		var_dump($data);
		echo '</pre>';
		$projetModele->insererProjetUtilisateur($idProjet, $participant->getIdUtilisateur());

		return redirect()->to('/taches/participants/'.$idProjet)->with('msg', $participant->getPseudo().' a été ajouté dans votre projet');
	}
	
	public function traitement_delete_participant(int $idProjet, int $idParticipant)
	{
		$projetModel = new ProjetModel();
		$idCreateur = $projetModel->find($idProjet)->getIdCreateur();

		if ($idParticipant == $idCreateur)
			return redirect()->back();

		$projetModel->deleteProjetUtilisateur($idProjet, $idParticipant);
		return redirect()->back();
	}
	
	public function redirection_participants(int $idProjet)
	{
		$projetModel = new ProjetModel();
		$participants = $projetModel->getUtilisateurs($projetModel->find($idProjet));

		$data = [
			'participants'     => $participants,
			// 'pagerParticipant'       => $tacheModele->pager,
			'projet'         => $projetModel->find($idProjet)
		];

		// Affichages
		echo view('commun/Navbar'); 
		echo view('taches/Participants', $data); 
		echo view('commun/Footer');
	}

	public function traitement_creation()
	{
		
		$validation = \Config\Services::validation();
	
		$projetModel = new ProjetModel();
		
		if (!$this->validate($projetModel->getValidationRules(), $projetModel->getValidationMessages())) {
			return redirect()->back()->withInput()->with('errors', $validation->getErrors());
		}
		
		/// Verifier la
	
		$data = $this->request->getPost();
		$projet = new Projet();

		$projet->fill($data);

		$projet->setIdCreateur(session()->get('id_utilisateur'));

		$projetModel->insert($projet);

		return redirect()->back();
	}
}