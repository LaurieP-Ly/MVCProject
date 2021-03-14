<?php


namespace app\Controller;

use app\Model\ReservationModel;
use app\Traits\getApi;

class controllerReservation 
{
    use getApi;

    private $model;

    /**
     * controllerReservation constructor.
     */
    public function __construct()
    {
        $this->model= new ReservationModel();
       
    }

    

   

   /**** Récupérer toutes les reservations d'une commande en fonction de l'id de celle-ci****/

    public function ReservationsCommande($idCommande)
    {

        $results=$this->model->TTReservationsCommande($idCommande);
        return $results;

       
    }

    /*** Redirection si un horaire voulu est déjà present dans le panier****/


    public function dejaPresent()
    {

        
        header("location : index.php?page=panier?action=dejaPresent");

       
    }

    /**** Ajouter une reservation dans la base de données lors de la création de la commande****/

    public function addReserv($horaire, $idCommande){
        $results=$this->model->addReservation($horaire, $idCommande);
        return $results;
    }

    /***Supprimer toutes les reservations de la commande correspondant à l'id donné en paramètre */

    public function suppressionReservations($idCommande){
        $results=$this->model->suppReservations($idCommande);
        return $results;

    }

    /*** Supprimer une reservation de la base de données en fonction de son id***/

    public function suppReservation($idReservation){
        $results=$this->model->SuppReservation($idReservation);
        return $results;
    }

    /**** Récupérer les informations d'une reservation en fonction de son id****/

    public function infoReservation($idReservation){

        $results= $this->model->infoReserv($idReservation);
        return $results;

    }

    /*** Récupération de toutes les reservations contenant l'horaire donné en paramètre(id)****/

    public function getReservHoraire($idHoraire){
        $results=$this->model->ReservHoraire($idHoraire);
        return $results;
    }

    

    


    


    

    


    


  




}

?>