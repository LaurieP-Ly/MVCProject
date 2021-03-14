<?php


namespace app\Controller;

use app\Model\CoursModel;
use app\Traits\getApi;

class controllerCours 
{

    use getApi;

    private $model;

    /**
     * controllerCours constructor.
     */
    public function __construct()
    {
        $this->model= new CoursModel();
        
    }

    /*****Page de liste de cours*****/

    public function getAllCours(){
        $result=$this->model->All();
        include "app/View/cours.php";
    }

    /*****Récupération de tous les cours*****/

    public function AllCours(){
        $result=$this->model->All();
        return $result;
    }

    /*****Les informations d'un seul cours*****/

    public function infoCours($idCours){
        $result=$this->model->InfoCours($idCours);
        return $result;
    }

    /*****Lister les cours du niveau particulier*****/

    public function getNivCours($niv){

        if($niv==1){

           $niv='Facile';

        }elseif($niv==2){
    
            $niv='Moyen';
    
        }elseif($niv==3){
    
            $niv='Difficile';
    
        }else{
            echo("Ce paramètre n'existe pas.");
            $result=NULL;
            
        }

        $result=$this->model->getNiv($niv);
        include "app/View/cours.php";
    }

    /**** Vérification de l'existence d'un cours lors de sa création par l'administrateur****/

    public function existeDejaCours($caract){
        $results= $this->model->VerifExisteCours($caract);
        return $results;
    }

    /**** Ajouter un cours à la base de données, prend en paramètre un objet de la classe Cours****/

    public function AjoutCours($coursObjet){
        $results=$this->model->AddCours($coursObjet);
        return $results;
    }

    /***** Supprimer un cours en fonction de son id ****/

    public function supprimerCours($idCours){
        $result=$this->model->suppCours($idCours);
        return $result;
    }

    

    

   





}

?>