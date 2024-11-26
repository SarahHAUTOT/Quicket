<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\User;

class ControllerPlanning extends BaseController
{
	public function redirection_vueGlobale()
	{
    	echo view('commun/Navbar'); 
    	echo view('planning/Planning'); 
    	echo view('commun/Footer'); 
	}
}