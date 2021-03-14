<?php


namespace app\Model;
use app\Entity\Clients;


class ClientModel extends model
{

    public function __construct()
    {
        $this->table="Clients";
        parent::__construct($this->table);
    }
    /**** Enregistrer un client ****/

    public function saveClient($attributs, $attributsDonnes){


       $resultatSave=$this->Save($attributs, $attributsDonnes);
       return $resultatSave;

    }
    /**** connecte ****/

    public function connexion($email, $mdp){
        $mdp = hash('sha256',$mdp);
        $resultsTrouver=$this->trouver(array("condition"=>" email = "."'$email'"." and "."motDePasse = ". "'$mdp'"));
        return $resultsTrouver;

    }
    /**** Client déjà existant ? ****/

    public function verifExDeja($attributsaVerifier, $DonnesaVerifier){
        $exits=$this->verifExistDeja($attributsaVerifier, $DonnesaVerifier);
        return $exits;
    }

    public function informationClient($idClient){
        $condition = array("condition"=>"idClient = $idClient");
        $results= $this->trouverOne($condition);
        return $results;
    }

    public function All(){
        $results=$this->trouver();
        return $results;
    }

    public function SuppClient($idClient){
        $condition=array("conditions"=>" idClient = $idClient");
        $results=$this->delete($condition);
        return $results;
    }

    public function modifCredit($idClient, $nbCredit){
        $client=new Clients($this->informationClient($idClient));
        $newNb=$client->getNbCredits()-$nbCredit;
        $condition=array("changement"=>" nbCredits = $newNb", "condition"=>" idClient = $idClient");
        return $this->modification($condition);
    }

    public function modifCreditPlus($idClient, $nbCredit){
        $client=new Clients($this->informationClient($idClient));
        $newNb=$client->getNbCredits()+$nbCredit;
        $condition=array("changement"=>" nbCredits = $newNb", "condition"=>" idClient = $idClient");
        return $this->modification($condition);

    }



}

?>