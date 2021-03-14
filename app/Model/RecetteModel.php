<?php


namespace app\Model;


class RecetteModel extends model
{

    public function __construct()
    {
        $this->table="Recettes";
        parent::__construct($this->table);
    }
    
    public function Hasard(){
        $conditions= array("otherconditions"=> "ORDER BY RAND() LIMIT 3");
        $resultatHasard=$this->trouver($conditions);
        return $resultatHasard;

    }

    public function getOneRecette($idRecette){
        $conditions= array("condition"=> "idRecette = $idRecette");
        $resultatRecette=$this->trouverOne($conditions);
        return $resultatRecette;

    }

    public function All(){
        
        $resultatRecettes=$this->trouver();
        return $resultatRecettes;

    }

    public function getNiv($niv){
        $condition= array("otherconditions"=>" AND niveau = '$niv'");
        $resultatGetNiv=$this->trouver($condition);
        return $resultatGetNiv;
 
     }

     public function VerifExisteRecette($caract){
        $categorie= $caract["categorie"];
        $nom= $caract["nom"];
        $description= $caract["description"];
        $condition= array("condition"=> " categorie = $categorie AND nom= '$nom' AND description= '$description' ");
        $results= $this->trouverOne($condition);
        return $results;
     }

     public function AddRecette($recetteObjet){
        $attributs= "nom, niveau, temps, nombreDePersonne, ingredients, description, categorie, imgRecette, ImgDerouleRecette";

        $nom=$recetteObjet->getNom();
        $temps=$recetteObjet->getTemps();
        $ingredients=$recetteObjet->getIngredients();
        $description=$recetteObjet->getDescription();
        $categorie=$recetteObjet->getCategorie();
        $nbPer=$recetteObjet->getNombreDePersonne();
        $niveau=$recetteObjet->getNiveau();
        $imgRecette=$recetteObjet->getImgRecette();
        $ImgDerouleRecette=$recetteObjet->getImgDerouleRecette();

        $donnees= "'$nom', '$niveau', '$temps', $nbPer, '$ingredients', '$description', $categorie, '$imgRecette', '$ImgDerouleRecette'";

         $results=$this->Save($attributs, $donnees);
         return $results;
     }

     public function InfoRecette($idRecette){
         $condition=array("condition"=>" idRecette = $idRecette");
         $results=$this->trouverOne($condition);
         return $results;
     }

     public function SuppRecette($idRecette){
         $condition=array("conditions"=> " idRecette = $idRecette");
         $results=$this->delete($condition);
         return $results;
     }


    


}

?>