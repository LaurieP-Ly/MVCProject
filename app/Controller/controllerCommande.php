<?php


namespace app\Controller;

use app\Model\CommandeModel;
use app\Controller\controllerReservation;
use app\Controller\controllerCommandeCredit;
use app\Controller\controllerCours;
use app\Controller\controllerHoraires;
use app\Controller\controllerClients;
use app\Entity\Cours;
use app\Entity\Commande;
use app\Entity\Clients;
use app\Entity\Horaire;
use app\Entity\Reservation;

use app\Traits\getApi;





class controllerCommande 
{

    use getApi;


    private $model;

    /**
     * controllerCommande constructor.
     */
    public function __construct()
    {
        $this->model= new CommandeModel();
        
    }

    /***  Affichage de la page de profil avec toutes les commandes et toutes les reservations ***/

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

            /**** Récupération des reservations des commandes ****/

            $controllerReservation= new controllerReservation();

            /**Contiendra toutes les reservations */
            $resultReservationClient=array();

            foreach($resultsCommandeClient as $commande){//Pour chaque commande

                $reservationsCommande=$controllerReservation->ReservationsCommande($commande["IdCommande"]);
                
                //On a besoins de beaucoup d'information sur les reservations : sur l'horaire de cette reservation et sur le cours de cet horaire

                //On va recréer une array qui remplacera $reservationsCommande et qui aura bcp plus d'information
                $RemplacementReservationsCommande= array();
                //Pour chaque reservation de la liste de reservations
                foreach($reservationsCommande as $reservation){

                    

                    $reservationTemporaire= new Reservation($reservation); //Création d'un objet de classe Reservation

                    //Récupération de l'id de la reservations
                    $idReservation = $reservationTemporaire->getIdReservation();
                   
                    //Récupération du jour et de l'heure de l'horaire de la réservation
                    $controllerHoraires= new controllerHoraires();
                    $Resultshoraire=$controllerHoraires->getUnHoraire($reservationTemporaire->getIdHoraire()); //Récupération des informations de l'horaire en question

                    $horaire= new Horaire($Resultshoraire); //Création d'un objet de la classe Horaire

                    $jour= $horaire->getJour();
                    $heure= $horaire->getHeure();

                    //Récupération des informations du cours

                    $controllerCours= new controllerCours();
                    $ResultsCours=$controllerCours->infoCours($horaire->getIdCours()); 

                    $cours = new Cours($ResultsCours);//Création d'un objet de la classe Cours

                    $nomCours= $cours->getNom();
                    $imgCours=$cours->getImgCours();
                    $prixCours=$cours->getPrix();
                    $idCours=$cours->getIdCours();

                    //Avec toutes ces informations, on peut créer un element de liste

                    $ArrayReservationAvecInfos=array("idReservation"=>$idReservation, "jour"=>$jour, "heure"=>$heure, "idCours"=>$idCours, "nomCours"=>$nomCours, "imgCours"=>$imgCours, "prixCours"=>$prixCours);

                    //On peut ajouter cette element dans un array qui contiendra toutes les reservations et leur infos d'un seul commande
                    array_push($RemplacementReservationsCommande, $ArrayReservationAvecInfos);

                }
                



                array_push($resultReservationClient, $RemplacementReservationsCommande);
                /**On a donc une liste de liste de reservations et d'informations **/

            }


        }
        
        /***Récupération des information du client */

        $controllerClients= new controllerClients();
        $recupEmail= $controllerClients->infoClient($idClient);
        $client= new Clients($recupEmail);
        $email= $client->getEmail();
        $nbCredits=$client->getNbCredits();

        /***Recuperation des commandes d'achats de crédits */

        $controllerCommandeCredit=new controllerCommandeCredit();
        $CommandesCredits=$controllerCommandeCredit->getCommandeClient($idClient);



        
        include "app/View/Profil.php";
        
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

        

        /*** Pour la page de paiement, on a besoins des informations sur les horaires de cette commande, et des informations sur les cours de ces horaires***/

        $controllerHoraires=new controllerHoraires();
        $controllerCours=new controllerCours();
        $controllerReservation= new controllerReservation();


        $toutesLesReservations=$controllerReservation->ReservationsCommande($_SESSION["commande"]);
        
        

        $tousLesCours=array();
        $tousLesHoraires=array();



        foreach($toutesLesReservations as $reserv){

            
            $reservation= new Reservation($reserv); //Création d'un objet de la classe Reservation
            $idHoraire=$reservation->getIdHoraire(); //Récupération de l'id de chaque horaire
            $infoHoraire=$controllerHoraires->getUnHoraire($idHoraire); //Récupération des informations de l'horaire

            $horaire=new Horaire($infoHoraire);//Création d'un objet de la classe Horaire

            array_push($tousLesHoraires, $horaire); //Stockage de l'horaire dans la liste

            $idCoursHoraire=$horaire->getIdCours(); //Récupération de l'id de cours de chaque horaire grâce à cet id
            $infoCours=$controllerCours->infoCours($idCoursHoraire); //Récupération des informations du cours trouvé

            $cours=new Cours($infoCours); //Création d'un objet de la classe Cours

            array_push($tousLesCours, $cours); //Stockage du cours dans la liste

            

            $_SESSION["tousLesCours"]=$tousLesCours;
            $_SESSION["tousLesHoraires"]=$tousLesHoraires;


        }

        
        
        header("location:index.php?action=paiement");
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
        include("app/View/PaiementCredit/checkout.php");
    }

    /*** Redirection vers la page de vérification d'annulation***/

    public function annulerCommande(){
        include ("app/View/cancel.php");
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
            $ttReservation=$controllerReservation->ReservationsCommande($commande["IdCommande"]);
            $retourSuppression=$controllerReservation->suppressionReservations($commande["IdCommande"]);

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