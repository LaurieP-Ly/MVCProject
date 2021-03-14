<?php


namespace app\Controller;

use app\Model\HoraireModel;
use app\Traits\getApi;

use app\Entity\Horaire;
use app\Entity\Clients;
use app\Controller\controllerClients;



class controllerHoraires 
{
    use getApi;

    private $model;

    /**
     * controllerHoraires constructor.
     */
    public function __construct()
    {
        $this->model= new HoraireModel();
        
    }

    /*****Affichage du planning d'un cours*****/

    public function getHoraires($idCours, $coursInfo, $nomCategorie){

        $result= $this->model->getCoursHoraires($idCours);
        include "app/View/Planning.php";
    }


    /*** Affichage du panier***/

    public function getPanier($tousLesCours, $dejaPresent)
    {   
        if($dejaPresent == true){
            


            if($tousLesCours != NULL){

                /**** Calcul du prix total *****/
            $somme=0;
            foreach($tousLesCours as $r){
            $somme+=$r->getPrix();
            }
    
            }
    
            $messageAjoutPanier="Vous avez déjà reservé cet horaire";

            /***Recupération du nombre de crédit restant */
            $controllerClient= new controllerClients();
            
            $client=new Clients($controllerClient->infoClient($_SESSION["id"]));
            

            $nbCredits=$client->getNbCredits();
    
            
            include "app/View/Panier.php";
            

        }elseif($dejaPresent == false){
            

            if($tousLesCours != NULL){

                /**** Calcul du prix total *****/
            $somme=0;
            foreach($tousLesCours as $r){
            $somme+=$r->getPrix();
            }
    
            }
    
            $messageAjoutPanier="";


            /***Recupération du nombre de crédit restant */
            $controllerClient= new controllerClients();
            
            $client=new Clients($controllerClient->infoClient($_SESSION["id"]));
            

            $nbCredits=$client->getNbCredits();
            
    
            
            include "app/View/Panier.php";

        }
        

        
       
    }

    /*****Vérifier si l'horaire voulu est déjà present dans le panier*****/

    public function DejaPresentPanier($idhoraire){
        
        $trouve=false;
        $compteur=0;
        while($trouve==false and $compteur<sizeof($_SESSION["panier"])){
        
            if($_SESSION["panier"][$compteur]->getIdHoraire() == $idhoraire){
            
                $trouve=true;
            }
            else{
            
                $compteur++;
            }
    
        }
    
        if($trouve==true){
    
            return array("trouve"=>true, "place"=>$compteur);
    
        }else{
        return array("trouve"=>false, "place"=>$compteur);
        }

    }

    /**** Avoir les informations d'un horaire en fonction de son id****/

    public function getUnHoraire($idhoraire){
        $result=$this->model->getHoraire($idhoraire);
        return $result;
    }


    

    /**** Supprimer un horaire du panier en fonction de sa place***/

    public function SuppHorairePanier($place) {
        
           
            unset($_SESSION["panier"][$place]);
            
           header("location:index.php?page=panier");
    }


    /*** Vérification de si l'horaire est déjà présent dans le panier, prend en paramètre les caractéristques de l'horaire***/

    public function existeDejaHoraire($caract){
        $results= $this->model->VerifExisteHoraire($caract);
        return $results;
    }

    /*** Ajouter un horaire dans la base de données, prend en paramètre un objet de la classe Horaire***/

    public function AjoutHoraire($horaireObjet){
        $results=$this->model->AddHoraire($horaireObjet);
        return $results;
    }

    /**** Récupérer tous les horaires***/

    public function getAllHoraire(){
        $result=$this->model->All();
        return $result;
    }

    /**** Récupérer tous les horaires contenant le cours correspondant à l'id donné en paramètre****/

    public function getHoraireCours($idCours){
        $result=$this->model->HoraireCours($idCours);
        return $result;
    }

    /**** Supprimer tous les horaires contenant le cours correspondant à l'id donné en paramètre****/

    public function supprimerHoraireCours($idCours){
       
        $result=$this->model->SuppHorairesCours($idCours);
        return $result;
    }

    /**** Supprimer un horaire en fonction de son id****/

    public function supprimerHoraire($idHoraire){
       
        $result=$this->model->suppHoraire($idHoraire);
        return $result;
    }


    

    

    






}

?>