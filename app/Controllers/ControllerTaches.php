<?php
namespace App\Controllers;
use CodeIgniter\Controller;
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
    {// Tableau de tâches simulées
        $taches = [
            [
                'id_tache' => 1,
                'titre' => 'Créer un dashboard',
                'creation_tache' => '2024-11-01',
                'modiff_tache' => '2024-11-10',
                'echeance' => '2024-11-20',
            ],
            [
                'id_tache' => 2,
                'titre' => 'Corriger les bugs',
                'creation_tache' => '2024-11-05',
                'modiff_tache' => '2024-11-12',
                'echeance' => '2024-11-22',
            ],
            [
                'id_tache' => 3,
                'titre' => 'Tester les fonctionnalités',
                'creation_tache' => '2024-11-08',
                'modiff_tache' => '2024-11-15',
                'echeance' => '2024-11-25',
            ],
        ];

        $data = [
            'taches' => $taches,
        ];
        echo view('commun/Navbar'); 
        echo view('taches/Taches', $data); 
        echo view('commun/Footer'); 
    }

    public function grosse_tache($idTache)
    {
        echo view('commun/Navbar'); 
        echo view('taches/Detail'); 
        echo view('commun/Footer');
    }

    public function ajouterCommentaire()
    {
        # TODO: Ajouter un commentaire
    }

    public function modifierCommentaire()
    {
        # TODO: Ajouter un commentaire
    }
}