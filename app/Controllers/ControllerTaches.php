<?php
namespace App\Controllers;
use App\Entities\Tache;
use App\Entities\Commentaire;
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
        $this->validation = \Config\Services::validation();
	}

	public function redirection_taches()
	{
		$session = session();
		$idUtilisateur = $session->get('id_utilisateur');
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

		$taches = $tacheModele->getFiltre($trierPar, $ordre, $titreRech)->where('id_utilisateur', $idUtilisateur)->paginate(5);
		
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
		$commentaireModele = new CommentaireModel();
		$tache = $tacheModele->getTacheById($idTache);
		$commentaires = $tacheModele->getCommentaires($tache);

		
		foreach ($commentaires as $commentaire)
		{
			$commentaireModele->delete($commentaire->getIdCommentaire());
		}

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

		if (!ControllerTaches::date_check($this->request->getPost('echeance'))) {
			// Ajouter une erreur structurée dans le tableau associatif
			return redirect()->back()->withInput()->with('errors', ['echeance' => 'Le format de la date est invalide ou la date est dans le passé.']);
		}
		
		/// Verifier la
	
		$data = $this->request->getPost();
		$tache = new Tache();

		$data['echeance'] = new Time($data['echeance'], 'Europe/Paris', 'fr_FR');
		echo $data['echeance'];
		$tache->fill($data);

		$tache->setCreationTache();
		$tache->setIdUtilisateur(session()->get('id_utilisateur'));
		$tache->setModiffTache();

		$tacheModel->insert($tache);

		var_dump($tacheModel->errors());
		return redirect()->to('/taches'); 
	}

	
    public static function date_check(string $str): bool
    {
        $date = \DateTime::createFromFormat('Y-m-d\TH:i', $str);

        if (!$date || $date->format('Y-m-d\TH:i') !== $str) {
            return false;
        }

        $current_date = new \DateTime('now', new \DateTimeZone('Europe/Paris') );
		$bool = $date >= $current_date;
        return $bool;
    }

	public function traitement_creation_comm()
	{
		$validation = \Config\Services::validation();
	
		$commModel = new CommentaireModel();
		
		if (!$this->validate($commModel->getValidationRules(), $commModel->getValidationMessages())) 
		{
			return redirect()->back()->withInput()->with('errors', $validation->getErrors());
		}
	
		$data = $this->request->getPost();

		$data['id_tache'] = intval($data['id_tache']);
		$comm = new Commentaire();
		$comm->fill($data);

		// Je récupère la date actuelle
		$date = new \DateTime();
		$date->format('Y-m-d H:i:s');

		$data['creation_commentaire'] = $date;

		$comm->fill($data);
		$comm->setIdUtilisateur(session()->get('id_utilisateur'));

		$commModel->insert($comm);

		var_dump($commModel);
		return redirect()->to('/taches/'.$data['id_tache']);
	}

	public function grosse_tache($idTache)
	{
        $commentaireModel = new CommentaireModel();
        $tacheModel = new TacheModel();
        $commentaires = $commentaireModel->getCommentaireTache($idTache);

		echo view('commun/Navbar'); 
        echo view('taches/Detail', 
        [
            'tache' => $tacheModel->getTacheById($idTache),
            'commentaires' => $commentaireModel->getCommentaireTache($idTache),
            'pagerCommentaire' => $commentaireModel->pager
        ]);
		
		echo view('commun/Footer');
	}

	// C'est pour  la view qui modifie les tâches mais j'aime beaucoup l'humour
	// Pitié ne supprimez pas ça
	public function pis_tache($idTache)
	{
		$commentaireModel = new CommentaireModel();
        $tacheModel = new TacheModel();
		echo view('commun/Navbar'); 
        echo view('taches/Modif', 
        [
            'tache' => $tacheModel->getTacheById($idTache),
        ]);
		
		echo view('commun/Footer');
	}
}

