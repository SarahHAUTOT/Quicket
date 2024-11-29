<?php
namespace App\Controllers;
use App\Models\ProjetModel;
use CodeIgniter\Controller;
use App\Models\User;
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
	
	public function traitement_ajouter_participant(int $idProjet, int $idParticipant)
	{
		$projetModele = new ProjetModel();
		$projetModele->insererProjetUtilisateur($idProjet, $idParticipant );
/*
		$idParticipants = $this->request->getPost();
		foreach ($idParticipants as $idParticipant)
			$projetModele->insererProjetUtilisateur($idProjet, $idParticipant );
*/
		return redirect()->to("/taches/".$idProjet);
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