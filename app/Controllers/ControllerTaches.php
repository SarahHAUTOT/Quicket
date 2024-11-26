<?php
namespace App\Controllers;
use App\Models\TacheModel;
use CodeIgniter\Controller;
use App\Models\User;


// @author   : Sarah Hautot, Alizéa Lebaron
// @since    : 25/11/2024
// @version  : 1.1.0 - 26/11/2024

class ControllerTaches extends BaseController
{
    public function redirection_taches()
    {
        $tacheModele = new TacheModel();

        $titreRech = $this->request->getGet('titre') ?? null;
        $attribut  = $this->request->getGet('attribut') ?? null;
        $ordre     = $this->request->getGet('ordre') ?? null;

        $taches = $tacheModele->getFiltre($titreRech, $attribut, $ordre)->paginate(5);
        
        $data = [
            'taches' => $taches,
            'pagerTache' => $tacheModele->pager
        ];
        
        echo view('commun/Navbar'); 
        echo view('taches/Taches', $data); 
        echo view('commun/Footer');
    }

    public function traitement_suppression_tache(int $idTache)
    {
        $tacheModele = new TacheModel();
        $tacheModele->delete($idTache);
        return redirect()->to('/taches');
    }

    public function grosse_tache($idTache)
    {
        echo view('commun/Navbar'); 
        echo view('taches/Taches'); 
        echo view('commun/Footer');
    }
}