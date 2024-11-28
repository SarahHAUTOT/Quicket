<?php
namespace App\Controllers;
use App\Models\TacheModel;
use CodeIgniter\Controller;
use App\Models\User;

class ControllerPlanning extends BaseController
{
	public function redirection_vueGlobale(?string $date = null)
	{
		if ($date === null) $date = new \DateTime();
		else                $date = new \DateTime($date);


		// TODO : Récupérer les taches de la journée pour l'utilisateur, et la passe
		// Prévenir Max quand c'est fait

        $tacheModel = new TacheModel();
        $taches = $tacheModel->getTacheJour(session()->get('id_utilisation'), $date);

        echo '<pre>';
        var_dump($taches);
        echo '</pre>';
        
    	// echo view('commun/Navbar'); 
    	// echo view('planning/Planning',[
        //     'date' => $date,
        //     'tache' => $date
        // ]);
    	// echo view('commun/Footer'); 
	}
}