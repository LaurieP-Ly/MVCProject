<?php


namespace app\Model;


class ReservationModel extends model
{

    public function __construct()
    {
        $this->table="Reservations";
        parent::__construct($this->table);
    }

    public function TTReservationsCommande($idCommande)
    {
        $condition=array("condition"=>"IdCommande = $idCommande");
        $results=$this->trouver($condition);
        return $results;
    }

    public function addReservation($horaire, $idCommande){
        $attributs= "IdCommande, IdHoraire";

        $idHoraire=$horaire->getIdHoraire();
        $données= "$idCommande, $idHoraire";
        $results=$this->Save($attributs, $données);
        return $results;
    }

    public function suppReservations($idCommande){
        $condition=array("conditions"=>" IdCommande = $idCommande");
        $results=$this->deleteAndCount($condition);
        return $results;
        

    }


    public function SuppReservation($idReservation){
        $condition=array("conditions"=>"IdReservation = $idReservation");
        $results=$this->delete($condition);
        return $results;
    }

    public function infoReserv($idReservation){
        $condition=array("condition"=>" IdReservation = $idReservation");
        $results= $this->trouverOne($condition);
        return $results;
    }

    public function ReservHoraire($idHoraire){
        $condition=array("condition"=> " idHoraire = $idHoraire");
        return $this->trouver($condition);
    }

    public function All(){
        return $this->trouver();
    }


    


    
    
   

    


}

?>