<?php

namespace App\Controllers;

use App\Models\UtilisateurModel;
use App\Entities\Utilisateur;

class Home extends BaseController
{
	public function __construct()
	{
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
            $utilisateur = new Utilisateur();
            $utilisateur->fill($data);
            $utilisateur->setRole(Utilisateur::$ROLE_INACTIF);
            $utilisateur->setTokenInscription('abcd');
            echo '<pre>';
            var_dump($utilisateur);
            echo '</pre>';

            $utilisateurModel->save($utilisateur);
		}
    }
}
