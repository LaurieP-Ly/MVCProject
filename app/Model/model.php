<?php

namespace app\Model;
include "app/Config/Database.php";
use app\Config\Database;
use \PDO;


class model{

    protected $table;
    private $connex;

    /**
     * model constructor.
     */
    public function __construct($table)
    {
        $bd=new database();
        $this->connex= $bd->getConnexion();
    }

    public function trouver($donnees=array()){
        $specification=" * ";
        $autreTable= " ";
        $condition= " 1 ";
        $otherconditions= " ";
        if(isset($donnees["specification"])){
            $specification=$donnees["specification"];
        }

        if(isset($donnees["autreTable"])){
            $autreTable=$donnees["autreTable"];
        }

        if (isset($donnees["condition"])){
            $condition=$donnees["condition"];
        }
        if(isset($donnees["otherconditions"])){
            $otherconditions=$donnees["otherconditions"];
        }
        $sql = "SELECT".$specification." FROM ".$this->table." ".$autreTable." WHERE ".$condition. " ".$otherconditions;
        
        
        
        
        $envoisql=$this->connex->query($sql);
        $resultatssql=$envoisql->fetchAll(PDO::FETCH_ASSOC);

        return $resultatssql;


    }


    public function trouverOne($donnees=array()){
        $specification=" * ";
        $autreTable= " ";
        $condition= " 1 ";
        $otherconditions= " ";
        if(isset($donnees["specification"])){
            $specification=$donnees["specification"];
        }

        if(isset($donnees["autreTable"])){
            $autreTable=$donnees["autreTable"];
        }

        if (isset($donnees["condition"])){
            $condition=$donnees["condition"];
        }
        if(isset($donnees["otherconditions"])){
            $otherconditions=$donnees["otherconditions"];
        }
        $sql = "SELECT".$specification." FROM ".$this->table." ".$autreTable." WHERE ".$condition. " ".$otherconditions;
        
        
     
        $envoisql=$this->connex->query($sql);
        $resultatssql=$envoisql->fetch(PDO::FETCH_ASSOC);

        return $resultatssql;


    }


    public function Save($attributs, $attributsDonnes){

        
        $sql= "INSERT INTO $this->table ($attributs) VALUES ($attributsDonnes)";
        
        
        $connexion=$this->connex;
        $envoisql= $connexion->exec($sql);
        if (!$envoisql==null) {
            return true ;
        } else {
            return false;
        }

    }

    public function delete($donnes=array() ){
        $condition=" 1 ";
        if(isset ($donnes["conditions"])) {
            $condition=$donnes["conditions"];
        }
        $sqlDelete="DELETE FROM $this->table WHERE $condition";
        
        
        $envoiSqlDelete=$this->connex->exec($sqlDelete);

        if(!$envoiSqlDelete==null){
            return true;
        }else{
            return false;
        }
    }

    public function deleteAndCount($donnes=array() ){
        $condition=" 1 ";
        if(isset ($donnes["conditions"])) {
            $condition=$donnes["conditions"];
        }
        $sqlDelete="DELETE FROM $this->table WHERE $condition";
        
        $envoiSqlDelete=$this->connex->exec($sqlDelete);

        return $envoiSqlDelete;
    }

    public function modification($donnes=array()){
        $changement= " ";
        $condition= " ";
        if(isset ($donnes["changement"])) {
            $changement=$donnes["changement"];
        }
        if(isset ($donnes["condition"])) {
            $condition=$donnes["condition"];
        }
        $sqlmodif="UPDATE $this->table SET $changement WHERE $condition";
        $envoiSqlModif=$this->connex->exec($sqlmodif);

        if ($envoiSqlModif==null) {
            return false ;
        } else {
            return true;
        }
    }

    public function verifExistDeja($attributsaVerifier, $DonnesaVerifie){

        $sqlVerif="SELECT * FROM ". $this->table ." WHERE ".$attributsaVerifier." = ".$DonnesaVerifie;
        
        $envoisqlVerif=$this->connex->query($sqlVerif);
        $resultatsVerif=$envoisqlVerif->fetchAll(PDO::FETCH_ASSOC);
        if (!$resultatsVerif==null){
            return true;
        }else {
            return false;
        }

    }






}

?>