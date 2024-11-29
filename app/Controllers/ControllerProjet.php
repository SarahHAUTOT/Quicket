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
		$projetModele = new ProjetModel();
		$projets = $projetModele->where('id_createur', session()->get('id_utilisateur'))->get()->getResult('App\Entities\Projet');
		
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
		$idProjet = $data['id_projet'];

		$utilisateur = $utilisateurModele->find($data['email']);

		if ($utilisateur == null) 
		{
			return redirect()->back()->withInput()->with('errors', 'Cet utilisateur n\'existe pas');
		}

		$projetModele = new ProjetModel();
		$projetModele->insererProjetUtilisateur($idProjet, $utilisateur->getIdUtilisateur() );

		return redirect()->to('/taches/'.$idProjet);
	}
	
	public function traitement_delete_participant(int $idProjet, int $idParticipant)
	{
		$projetModel = new ProjetModel();
		$projetModel->deleteProjetUtilisateur($idProjet, $idParticipant);

		return redirect()->back();
	}
	
	public function redirection_participants(int $idProjet)
	{
		$projetModel = new ProjetModel();
		$participants = $projetModel->getUtilisateurs($projetModel->find($idProjet));

		$data = [
			'participants'     => $participants,
			// 'pagerTache'       => $tacheModele->pager,
			'idProjet'         => $idProjet
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