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
    {
        echo view('commun/Navbar'); 
        echo view('taches/Taches'); 
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
}