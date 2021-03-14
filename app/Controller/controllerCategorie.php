<?php


namespace app\Controller;

use app\Model\CategorieModel;
use app\Traits\getApi;

class controllerCategorie 
{
    use getApi;

    private $model;

    /**
     * controllerCategorie constructor.
     */
    public function __construct()
    {
        $this->model= new CategorieModel();
        
    }

    /** Récupérer le nom d'un categorie en fonction de son id***/

    public function getNomCategorie($id){
        
        $resNom=$this->model->getNom($id);
        return $resNom;
    }

    






}

?>