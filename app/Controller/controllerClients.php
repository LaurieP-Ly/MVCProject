<?php


namespace app\Controller;

use app\Model\ClientModel;

use app\Traits\getApi;


class controllerClients 
{
    use getApi;

    private $model;

    /**
     * controllerClients constructor.
     */
    public function __construct()
    {
        $this->model= new ClientModel();
        
    }

    /*****formulaire creation compte*****/

    public function Crea(){
        include "app/View/Creez_compte.php";
    }

    /****Enregistrer clients****/

    public function SaveClient($attributs, $attributsDonnes, $email, $vide){

        if($vide == false){


            if($this->VerifExistence("email", "'$email'") == false){

                $resultSave=$this->model->saveClient($attributs, $attributsDonnes);
    
                include "app/View/Login.php";
    
            }else{
                $messageEmailDansBase="cette email est déjà utilisée";
                include "app/View/Creez_compte.php";
            }

        }else{
            $messageChamps="Un champ n'est pas rempli";
            include "app/View/Creez_compte.php";
        }

        

        
        
    }

    /*****formulaire se connecter****/

    public function login(){
        include "app/View/Login.php";
    }

    /*****se connecter****/

    public function connecte($email, $mdp){
        $existsClient=$this->model->connexion($email, $mdp);
        if (!$existsClient==null){
            
            $_SESSION["id"]=$existsClient[0]["idClient"];
            $_SESSION["pseudo"]=$existsClient[0]["pseudo"];
            include "app/View/Accueil.php";
        }else{
            $messageConnexion="Votre email et/ou mot est incorrect";
            include "app/View/Login.php";
        }
        
    }

    /****Client déjà existant ?****/


    public function VerifExistence($attributsaVerifier, $DonnesaVerifier){
        $resultsexists=$this->model->verifExDeja($attributsaVerifier, $DonnesaVerifier);
        return $resultsexists;

    }
    /*****deconnexion****/
    public function deconnexion(){
        session_destroy();
        header('location: index.php');

    }

    /*** Récupérer des information sur un client en fonction de son id ***/

    public function infoClient($idClient){
        $results= $this->model->informationClient($idClient);
        return $results;
    }
    /*** Récupérer tous les clients ***/

    public function getAll(){
        $results=$this->model->All();
        return $results;
    }

    /*** Supprimer un client en fonction de son id ***/

    public function suppressionClient($idClient){
        $results=$this->model->SuppClient($idClient);
        return $results;
    }

    /***** Decriter le client(id) lors de la validation de commande ****/

    public function decrediter($idClient, $nbCredit){

        return $this->model->modifCredit($idClient, $nbCredit);

    }

    public function crediterClient($idClient, $nbCredit){
        return $this->model->modifCreditPlus($idClient, $nbCredit);

    }






}

?>