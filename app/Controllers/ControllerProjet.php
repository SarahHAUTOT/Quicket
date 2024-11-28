<?php
namespace App\Controllers;
use App\Models\TacheModel;
use CodeIgniter\Controller;
use App\Models\User;

class ControllerProjet extends BaseController
{
	public function __construct()
	{
		//Chargement du helper Form
		helper(['form']);
	}
	
	public function redirection_projets()
	{
    	echo view('commun/Navbar'); 
    	echo view('projet/Projet');
    	echo view('commun/Footer'); 
	}
}