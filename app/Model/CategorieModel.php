<?php


namespace app\Model;


class CategorieModel extends model
{

    public function __construct()
    {
        $this->table="Categorie";
        parent::__construct($this->table);
    }

    public function getNom($id){
        $condition= array("specification"=>" categorie", "otherconditions"=> " AND idCategorie = $id");
        $resultatNom=$this->trouverOne($condition);
        return $resultatNom;
    }

    public function All(){
        return $this->trouver();
    }
    



}

?>