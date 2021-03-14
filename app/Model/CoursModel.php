<?php


namespace app\Model;


class CoursModel extends model
{

    public function __construct()
    {
        $this->table="Cours";
        parent::__construct($this->table);
    }
    /**** Tout les cours ****/

    public function All(){


       $resultatGetAll=$this->trouver();
       return $resultatGetAll;

    }

    /**** Un cours ****/

    public function InfoCours($idCours){

        $condition= array("condition"=>" idCours = $idCours ");
        $resultatGetAll=$this->trouverOne( $condition);
        return $resultatGetAll;
 
     }


    public function getNiv($niv){
        $condition= array("otherconditions"=>" AND niveau = '$niv'");
        $resultatGetNiv=$this->trouver($condition);
        return $resultatGetNiv;
 
     }

     public function VerifExisteCours($caract){
         $categorie= $caract["categorie"];
         $nom= $caract["nom"];
         $description= $caract["description"];
         $condition= array("condition"=> " categorie = $categorie AND nom= '$nom' AND description= '$description' ");
         $results= $this->trouverOne($condition);
         return $results;
     }

     public function AddCours($coursObjet){
        $attributs= "nom, niveau, prix, temps, categorie, description, imgCours";
        $nom=$coursObjet->getNom();
        $niveau=$coursObjet->getNiveau();
        $prix=$coursObjet->getPrix();
        $temps=$coursObjet->getTemps();
        $categorie=$coursObjet->getCategorie();
        $description=$coursObjet->getDescription();
        $imgCours=$coursObjet->getImgCours();
        $donnees= "'$nom', '$niveau', $prix, '$temps', $categorie, '$description', '$imgCours'";

         $results=$this->Save($attributs, $donnees);
         return $results;
     }

     public function suppCours($idCours){
         $condition=array("conditions"=>" idCours =$idCours");
         $results=$this->delete($condition);
         return $results;
     }


    
   



}

?>