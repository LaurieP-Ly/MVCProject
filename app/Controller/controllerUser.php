<?php


namespace app\Controller;

use app\Model\UserModel;
use app\Traits\getApi;


class controllerUser 
{
    use getApi;

    private $model;

    /**
     * controllerUser constructor.
     */
    public function __construct()
    {
        $this->model= new UserModel();
       
    }

    /*****formulaire se connecter****/

    public function loginAdmin(){
        include "app/View/admin/Login.php";
    }

    public function compteUserExiste($caracteristiqueUser){
        $results= $this->model->UserExiste($caracteristiqueUser);
        return $results;
    }

    /***Redirection si la connexion a échouée ****/

    public function connexionFail(){

        $messageConnexion=" Le couple username/mot de passe est incorrect";
        include "app/View/admin/ConnexionFail.php";
    }

   
    /*** Deconnexion d'user ***/
    public function deconnecter(){
        session_destroy();
        header("location:index.php");
    }

    

   

    

    


    


    

    


    


  




}

?>