<?php


namespace app\Model;


class CommandeModel extends model
{

    public function __construct()
    {
        $this->table="Commande";
        parent::__construct($this->table);
    }


    public function getCommandeIdClient($idClient)
    {
        $condition=array("condition"=>"idClient = $idClient");
        $results=$this->trouver($condition);
        return $results;
    }

    public function addCo($commande){
        $attributs="idClient, date, prixTotal";
        $idClient= $commande->getIdClient();
        $date=$commande->getDate();
        $prixTotal= $commande->getPrixTotal();
        $données= "$idClient, $date, $prixTotal";
        $results=$this->Save($attributs, $données);
        return $results;
    }

    public function getCoId($date, $somme, $idClient){
        $condition= array("condition"=> "idClient= $idClient AND date = $date AND prixTotal= $somme", "specification"=>" IdCommande");
        $results= $this->trouverOne($condition);
        return $results;
    }

    public function suppCommande($idCommande){
        $condition=array("conditions"=>"IdCommande = $idCommande");
        $results=$this->delete($condition);
        return $results;
    }

    public function getPrix_Total($idCommande){

        $condition= array("condition"=>" IdCommande = $idCommande", "specification"=>" prixTotal");
        return $this->trouverOne($condition);

    }

    public function modificationPrix($idCommande, $somme){
        $condition=array("changement"=>" prixTotal = $somme", "condition"=>" IdCommande = $idCommande");
        $results= $this->modification($condition);
        return $results;
    }

    public function infoCom($idCommande){
        $condition=array("condition"=>" IdCommande = $idCommande");
        $results=$this->trouverOne($condition);
        return $results;
    }

    public function All(){
        $results=$this->trouver();
        return $results;
    }

    public function SuppComCli($idClient){
        $condition=array("conditions"=>" idClient =$idClient");
        $results=$this->deleteAndCount($condition);
        return $results;
    }

    
    


}

?>