<?php


namespace app\Model;


class HoraireModel extends model
{

    public function __construct()
    {
        $this->table="Horaires";
        parent::__construct($this->table);
    }
    /**** Avoir tout les horaires d'un cours en particulier ****/

    public function getCoursHoraires($idCours){

        $conditions= array("otherconditions"=>" AND idCours = $idCours");
       $resultatHoraires=$this->trouver($conditions);
       return $resultatHoraires;

    }

    public function getHoraire($idHoraire){

        $conditions= array("condition"=>"idHoraire = $idHoraire");
       $resultatHoraire=$this->trouverOne($conditions);
       return $resultatHoraire;

    }

    public function VerifExisteHoraire($caract){
        $jour= $caract["jour"];
        $heure= $caract["heure"];
        $idCours= $caract["idCours"];
        $condition= array("condition"=> " jour = '$jour' AND heure= '$heure' AND idCours= $idCours ");
        $results= $this->trouverOne($condition);
        return $results;
    }

    public function AddHoraire($horaireObjet){
        $attributs= "idCours, jour, heure";

        $idCours=$horaireObjet->getIdCours();
        $jour=$horaireObjet->getJour();
        $heure=$horaireObjet->getHeure();

        $donnees= "$idCours, '$jour', '$heure'";

         $results=$this->Save($attributs, $donnees);
         return $results;
    }

    public function All(){
        $results=$this->trouver();
        return $results;
    }

    public function HoraireCours($idCours){
        $condition= array("condition"=>" idCours = $idCours");
        $results=$this->trouver($condition);
        return $results;
    }

    public function SuppHorairesCours($idCours){
        
        $condition=array("conditions"=>" idCours = $idCours");
        return $this->deleteAndCount($condition);
    }

    public function suppHoraire($idHoraire){

        $condition=array("conditions"=>" idHoraire = $idHoraire");
        return $this->delete($condition);

    }

   

}

?>