<?php

namespace App\Controllers;

class ControllerHome extends BaseController
{
	
	/**
	 * Fonction pour rediriger vers l'accueil.
	 *
	 * @return void
	 */
	public function redirection_home(): void
	{
    	echo view('commun/Navbar');
    	echo view('Accueil');
    	echo view('commun/Footer');
	}
}
