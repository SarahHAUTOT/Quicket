<?php
namespace App\Controllers;
use App\Entities\Tache;
use App\Models\TacheModel;
use App\Models\CommentaireModel;
use CodeIgniter\Controller;
use CodeIgniter\I18n\Time;
use App\Models\User;


// @author   : Sarah Hautot, Alizéa Lebaron
// @since    : 25/11/2024
// @version  : 1.1.0 - 26/11/2024

class ControllerTaches extends BaseController
{

	public function __construct()
	{
		//Chargement du helper Form
		helper(['form']);
	}

	public function redirection_taches()
	{
		helper('cookie');


		$request = service('request');


		// Récupération 
		$titreRech = $this->request->getGet('titre')    ?? '';
		$trierPar  = $this->request->getGet('trierPar') ?? $request->getCookie('trierPar') ?? 'modiff_tache';
		$ordre     = $this->request->getGet('ordre')    ?? $request->getCookie('ordre')    ?? 'ASC';
		
		// Si ils sont définis la, c'est que les préférences ont changé
		set_cookie('titre'   , $titreRech, 1800);
		set_cookie('trierPar', $trierPar , 1800);
		set_cookie('ordre'   , $ordre    , 1800);


		// Recherches des données (filtre + pagination)
		$tacheModele = new TacheModel();

		$taches = $tacheModele->getFiltre($titreRech, $trierPar, $ordre)->paginate(5);
		
		$data = [
			'taches'     => $taches,
			'pagerTache' => $tacheModele->pager,
			'titre'      => $titreRech,
			'trierPar'   => $trierPar,
			'ordre'      => $ordre
		];


		// Affichages
		echo view('commun/Navbar'); 
		echo view('taches/Taches', $data); 
		echo view('commun/Footer');
	}

	public function traitement_suppression_tache(int $idTache)
	{
		$tacheModele = new TacheModel();
		$tacheModele->delete($idTache);

        $page    = (int) ($this->request->getGet('page') ?? 1);
		return redirect()->to('/taches?page='.$page);
	}

	public function traitement_creation_tache()
	{
		$validation = \Config\Services::validation();
	
		$tacheModel = new TacheModel();
		
		if (!$this->validate($tacheModel->getValidationRules(), $tacheModel->getValidationMessages())) {
			return redirect()->back()->withInput()->with('errors', $validation->getErrors());
		}
	
		$data = $this->request->getPost();
		$tache = new Tache();

		$data['echeance'] = new Time($data['echeance'], 'Europe/Paris', 'fr_FR');
		$tache->fill($data);
		$tache->setCreationTache();
		$tache->setModiffTache();

		$tacheModel->insert($tache);

		$tacheModele = new TacheModel();
		var_dump($tacheModel);
		return redirect()->to('/taches'); // TODO Page courante après insertion
	}

	public function grosse_tache($idTache)
	{
        $tacheModel = new TacheModel();
        $commentaireModel = new CommentaireModel();
        $commentaires = $commentaireModel->getCommentaireTache($idTache);

		echo view('commun/Navbar'); 
        echo view('taches/Detail', 
        [
            'tache' => $tacheModel->getTacheById($idTache),
            'commentaires' => $commentaires,
            'pagerCommentaire' => $commentaireModel->pager
        ]);
		
		echo view('commun/Footer');
	}
}
