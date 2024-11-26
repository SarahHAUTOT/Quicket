<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\User;

class ControllerTaches extends BaseController
{
    public function redirection_taches()
    {
        echo view('commun/Navbar'); 
        echo view('taches/Taches'); 
        echo view('commun/Footer'); 
    }
}