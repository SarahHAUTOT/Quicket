<?php
namespace App\Controllers;
use App\Entities\Tache;
use App\Entities\Commentaire;
use App\Models\ProjetModel;
use App\Models\TacheModel;
use App\Models\CommentaireModel;
use CodeIgniter\I18n\Time;


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

	public function redirection_taches(int $idProjet)
	{
		$session = session();
		$idUtilisateur = $session->get('id_utilisateur');
		helper('cookie');


		$request = service('request');


		// Récupération 
		$titreRech = $this->request->getGet('titre')    ?? '';
		$trierPar  = $this->request->getGet('trierPar') ?? $request->getCookie('trierPar') ?? 'modiff_tache'; // TODO cookie non fonctionnelle
		$ordre     = $this->request->getGet('ordre')    ?? $request->getCookie('ordre')    ?? 'DESC';
		
		// Si ils sont définis la, c'est que les préférences ont changé
		set_cookie('titre'   , $titreRech, 1800);
		set_cookie('trierPar', $trierPar , 1800);
		set_cookie('ordre'   , $ordre    , 1800);


		// Recherches des données (filtre + pagination)
		$tacheModele = new TacheModel();
		$projetModele = new ProjetModel();

		$taches = $tacheModele->getFiltre($trierPar, $ordre, $titreRech)->where('id_projet', $idProjet)->paginate(5);
		$data = [
			'taches'     => $taches,
			'pagerTache' => $tacheModele->pager,
			'titre'      => $titreRech,
			'trierPar'   => $trierPar,
			'ordre'      => $ordre,
			'projet'     => $projetModele->find($idProjet)
		];


		// Affichages
		echo view('commun/Navbar'); 
		echo view('taches/Taches', $data); 
		echo view('commun/Footer');
	}

	public function traitement_etat(int $idProjet, int $idTache)
	{
		$tacheModele = new TacheModel();
		$tache = $tacheModele->find($idTache);
		$tache->setEstTermine(!$tache->getEstTermine());
		$tache->setModiffTache();

		$tacheModele->save($tache);

		return redirect()->to('/taches/'.$tache->getIdProjet());
	}

	public function traitement_suppression_tache(int $idProjet, int $idTache)
	{
		$tacheModele = new TacheModel();
		$commentaireModele = new CommentaireModel();
		$tache = $tacheModele->getTacheById($idTache);
		$commentaires = $tacheModele->getCommentaires($tache);

		
		foreach ($commentaires as $commentaire)
		{
			$commentaireModele->delete($commentaire->getIdCommentaire());
		}
-
		$tacheModele->delete($idTache);

        $page    = (int) ($this->request->getGet('page') ?? 1);
		return redirect()->to('/taches/'.$idProjet.'?page='.$page);
	}

	public function traitement_modification(int $idProjet, int $idTache)
	{
		$validation = \Config\Services::validation();
		$tacheModel = new TacheModel();
		
		//echo "Il est passé par ici";

		$data = $this->request->getPost();

		// Modification de certaines données

		// $data['priorite'] = intval($data['priorite']); //Cast en int 

		// $data['echeance'] = new Time($data['echeance'], 'Europe/Paris', 'fr_FR'); //On recast l'échéance

	
		if (!$this->validate($tacheModel->getValidationRules(), $tacheModel->getValidationMessages())) 
		{
			return redirect()->back()->withInput()->with('errors', $validation->getErrors());
		}

		if ($idProjet < 0 || $idTache < 0) 
		{
			return redirect()->back();
		}

		$data['id_tache'] = $idTache;
		$tache = new Tache();
		$tache = $tache->fill($data);
		
		echo "<pre>";
		var_dump($tache);
		echo "</pre>";

		$tache->setModiffTache();

		// Enregistrer les modifications
		$tacheModel->save($tache);

		return redirect()->to('/taches/modif/'. $idProjet."/".$idTache)->with('success', 'Vos données ont été mises à jour.');
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

		$data['id_projet'] = intval($data['id_projet']);
		$tache->fill($data);

		$tache->setCreationTache();
		$tache->setEstTermine(false);
		$tache->setIdUtilisateur(session()->get('id_utilisateur'));
		$tache->setModiffTache();

		$tacheModel->insert($tache);
		return redirect()->to('/taches/'.$tache->getIdProjet()); 
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

		// Je récupère la date actuelle
		$date = new \DateTime("now", new \DateTimeZone("Europe/Paris"));
		$date->format('Y-m-d H:i:s');

		$data['creation_commentaire'] = $date;

		$comm->fill($data);
		$comm->setIdUtilisateur(session()->get('id_utilisateur'));

		$commModel->insert($comm);
		return redirect()->to('/taches/detail/'.$data['id_projet'].'/'.$data['id_tache']);
	}

	public function grosse_tache(int $idProjet, int $idTache)
	{
        $commentaireModel = new CommentaireModel();
        $tacheModel = new TacheModel();
        $projetModele = new ProjetModel();

		echo view('commun/Navbar'); 
        echo view('taches/Detail', 
        [
            'tache'  => $tacheModel->find($idTache),
            'projet' => $projetModele->find($idProjet),
            'commentaires' => $commentaireModel->getCommentaireTache($idTache),
            'pagerCommentaire' => $commentaireModel->pager
        ]);
		
		echo view('commun/Footer');
	}

	// C'est pour  la view qui modifie les tâches mais j'aime beaucoup l'humour
	// Pitié ne supprimez pas ça
	public function pis_tache(int $idProjet, int $idTache)
	{
		$commentaireModel = new CommentaireModel();
        $tacheModel = new TacheModel();
		echo view('commun/Navbar'); 
        echo view('taches/Modif', 
        [
            'tache' => $tacheModel->find($idTache),
        ]);
		
		echo view('commun/Footer');
	}
}

