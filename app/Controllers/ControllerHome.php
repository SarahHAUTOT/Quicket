<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\User;

class ControllerHome extends BaseController
{

	public function __construct()
	{
		//Chargement du helper Form
		helper(['form']);
	}


	public function redirection_home()
	{
    	echo view('commun/Navbar'); 
    	echo view('Accueil'); 
    	echo view('commun/Footer'); 
	}
}