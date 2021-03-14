<?php


namespace app\Model;


class UserModel extends model
{

    public function __construct()
    {
        $this->table="user";
        parent::__construct($this->table);
    }

    public function UserExiste($caracteristiqueUser){
        $username= $caracteristiqueUser["username"];
        $mdp= $caracteristiqueUser["mdp"];
        $condition=array("condition"=> " username = '$username' AND password = '$mdp'");
        $results=$this->trouverone($condition);
        return $results;
    }

    public function All(){
        return $this->trouver();
    }


    


    
    
   

    


}

?>