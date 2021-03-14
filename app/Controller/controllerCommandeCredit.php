<?php


namespace app\Controller;

use app\Model\CommandeCreditModel;
use app\Controller\controllerReservation;
use app\Controller\controllerCours;
use app\Controller\controllerHoraires;
use app\Controller\controllerClients;
use app\Entity\Cours;
use app\Entity\Commande;
use app\Entity\Clients;
use app\Entity\Horaire;
use app\Entity\Reservation;

use app\Traits\getApi;





class controllerCommandeCredit 
{

    use getApi;


    private $model;

    /**
     * controllerCommandeCredit constructor.
     */
    public function __construct()
    {
        $this->model= new CommandeCreditModel();
        
    }

    /*** Récupération de toutes les commandes d'achats de crédits ***/

    public function getCommandeClient($idClient)
    {
        /** Récupération des commandes faites par clients***/
        $resultsCommandeClient=$this->model->getCommandeIdClient($idClient);
        if($resultsCommandeClient == NULL){
            $resultReservationClient=NULL;
        }

        if($resultsCommandeClient !=NULL){

            /**Création d'objet de la classe Client */

            /**Puis stockage dans un array de tout les objets **/

            $toutesLesCommandes= array();

            foreach($resultsCommandeClient as $commande){
                $comm= new Commande($commande);
                array_push($toutesLesCommandes, $comm);
            }

        }
        
        return $toutesLesCommandes;
        
    }

    /*** Récupérer toutes les commandes d'un client en particulier en fonction de son id***/

    public function getIdClient($idClient)
    {
        $resultsCommandeClient=$this->model->getCommandeIdClient($idClient);
        return $resultsCommandeClient;
        
    }

    /**** Ajouter une commande, prend un objet de la classe Commande en paramètre*****/

    public function addCommande($commande){
        $results=$this->model->addCo($commande);
        return $results;
    }

    /**** Récupération de l'id d'une commande d'après ses caractéristiques****/

    public function getCommandeId($date, $somme, $idClient){

        $results=$this->model->getCoId($date, $somme, $idClient);
        return $results;

    }

    /**** Affichage de la vérification avant de valider le paiement ****/

    public function getCheckout($somme){
        
        header("location:index.php?action=paiementCrédit");
    }

    /**** Suppression d'une commande en fonction de son id ***/

    public function suppressionCommande($idCommande){

        $results=$this->model->suppCommande($idCommande);
        return $results;

    }

    /**** Récupérer le prix total de la commande en fonction de son id ***/

    public function getPrix($idCommande){
        $results=$this->model->getPrix_Total($idCommande);
        return $results;
    }

    /*** Redirection vers la page de vérification de commande****/

    public function AffichagePaiement(){
        include("app/View/Paiement/checkout.php");
    }

    /*** Redirection vers la page de vérification d'annulation***/

    public function annulerCommande(){
        include ("app/View/cancelCredit.php");
    }

    /***** Modification du prix d'une commande, notamment lors de la suppression d'une reservation****/

    public function changePrix($idCommande, $somme){

        $results=$this->model->modificationPrix($idCommande, $somme);
        return $results;

    }

    /**** Récupération des informations d'une commande en fonction de son id ****/

    public function infoCommande($idCommande){
        $results=$this->model->infoCom($idCommande);
        return $results;
    }

    /***** Récupérer toutes les commandes ****/

    public function getAllCommande(){
        $results=$this->model->All();
        return $results;
    }

    /***** Supprimer les commandes d'un client en particulier en fonction de son id****/

    public function suppressionCommandeClient($idClient){

        //Suppression des reservations de la commande 

        $ttCommandes=$this->getIdClient($idClient);


        $controllerReservation=new controllerReservation();
        //Pour chacune des commandes
        $compteurTrue=0;
        foreach($ttCommandes as $commande){
            $ttReservation=$controllerReservation->ReservationsCommande($commande["idCommande"]);
            $retourSuppression=$controllerReservation->suppressionReservations($commande["idCommande"]);

            if(sizeof($ttReservation) == $retourSuppression){
                $compteurTrue++;
            }



        }

        if(sizeof($ttCommandes) == $compteurTrue){
        
            //Si toutes les commandes ont été vidées de leurs reservations
            $results=$this->model->SuppComCli($idClient);
            return $results;
        }

        return NULL;
        

    }


}

?>