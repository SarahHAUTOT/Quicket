<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\User;

class ControllerHome extends BaseController
{
	public function redirection_home()
	{
    	echo view('commun/Navbar'); 
    	echo view('Accueil'); 
    	echo view('commun/Footer'); 
	}
}