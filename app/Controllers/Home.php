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

		$isValid = $this->validate($regleValidation, $utilisateurModel->getValidationMessages());
		
		if (!$isValid) {
			return view('formConnexion',[
				'validation' => \Config\Services::validation()
			]);
		} else {
            $data = $this->request->getPost();
            $utilisateur = new \App\Entities\Utilisateur();
            $utilisateur->fill($data);
            $utilisateur->setRole('ROLE_INACTIF');
            $utilisateurModel->save($utilisateur);
		}
    }
}
