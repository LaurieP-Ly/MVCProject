<?php


namespace app\Controller;

use app\Model\RecetteModel;
use app\Controller\controllerCategorie;
use app\Traits\getApi;

class controllerRecette 
{
    use getApi;

    private $model;

    /**
     * controllerRecette constructor.
     */
    public function __construct()
    {
        $this->model= new RecetteModel();
       
    }

    /**Récupération de 3 recettes au hasard pour la page d'accueil */

    public function hasard(){
        $resRequete=$this->model->Hasard();
        include "app/View/Accueil.php";
    }

    /**Affichage de la page d'affichage d'une recette */

    public function getRecette($idRecette){
        $controllerCategorie= new controllerCategorie();
        $recette=$this->model->getOneRecette($idRecette);
        /***Recupération du nom de la categorie ***/
        $categorie= $controllerCategorie->getNomCategorie($recette["categorie"]);
        include "app/View/vueRecette.php";
    }

/**** Affichage de page de liste de recettes ****/

    public function getAllRecettes(){
        
        $recettes=$this->model->All();
        include "app/View/Recettes.php";
    }

    /**** Récupération de toutes les recettes ****/

    public function AllRecettes(){
        
        $recettes=$this->model->All();
        return $recettes;
    }

    /*****Lister les recettes du niveau particulier*****/

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

        $recettes=$this->model->getNiv($niv);
        include "app/View/Recettes.php";
    }

    /*** Vérification de l'existence d'une recette lors de sa création par l'administrateur****/

    public function existeDejaRecette($caract){
        $results= $this->model->VerifExisteRecette($caract);
        return $results;
    }

    /**** Ajouter une recette dans la base de données, prend en paramètre un objet de la classe Recette****/

    public function AjoutRecette($recetteObjet){
        $results=$this->model->AddRecette($recetteObjet);
        return $results;
    }

    /***** Récupération des informations d'une recette en fonctiond de son id ****/

    public function infoRecette($idRecette){
        $result=$this->model->InfoRecette($idRecette);
        return $result;
    }

    /****Supprimer une recette de la base de données en fonction de son id  ****/

    public function suppRecette($idRecette){
        $result=$this->model->SuppRecette($idRecette);
        return $result;
    }

  




}

?>