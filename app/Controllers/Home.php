<?php

namespace App\Controllers;

use App\Models\UtilisateurModel;

class Home extends BaseController
{
	public function __construct()
	{
	//Chargement du helper Form
		helper(['form']);
	}
    
    public function index(): string
    {
        return view('formConnexion');
    }
    
    public function save()
    {
        $utilisateurModel = new UtilisateurModel();
        $regleValidation = $utilisateurModel->getValidationRules();
        $regleValidation['mdpConf'] = 'required_with[mdp]|min_length[8]|max_length[255]|matches[mdp]';

		$isValid = $this->validate($regleValidation);
		
		if (!$isValid) {
			return view('/userModel',[
				'validation' => \Config\Services::validation()
			]);
		} else {
			echo 'succès'; 
		}
    }
}
