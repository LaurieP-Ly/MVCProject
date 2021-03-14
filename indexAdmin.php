<?php





/******************autoload************************/
function chargerClasse($classe){


    $classe= str_replace("\\", '/', $classe);

    require ("$classe".'.php');
}

spl_autoload_register('ChargerClasse');
/****************use***********************/

use app\Controller\controllerHoraires;
use app\Controller\controllerClients;
use app\Controller\controllerCours;
use app\Controller\controllerRecette;
use app\Controller\controllerCategorie;
use app\Controller\controllerCommande;
use app\Controller\controllerReservation;
use app\Controller\controllerUser;
use app\Controller\controllerCommandeCredit;

use app\Entity\Categorie;
use app\Entity\Clients;
use app\Entity\Commande;
use app\Entity\Cours;
use app\Entity\Horaire;
use app\Entity\Recette;
use app\Entity\Reservation;
use app\Entity\user;
use app\Entity\CommandeCredit;


$ControllerClients= new controllerClients();
$controllerRecette= new controllerRecette();
$controllerCours= new controllerCours();
$controllerHoraires= new controllerHoraires();
$controllerCategorie= new controllerCategorie();
$controllerCommande= new controllerCommande();
$controllerReservation= new controllerReservation();
$controllerUser= new controllerUser();
$controllerCommandeCredit= new controllerCommandeCredit();


session_start();

if(!isset($_SESSION["idUser"])){
    header("location:index.php?page=admin");
}

if(!isset($_GET["action"]) && !isset($_GET["page"]) && !isset($_GET["ele"]) && !isset($_GET["ajout"]) && !isset($_GET["dialogue"])){
    if(!isset($_SESSION["idUser"])){
        $controllerUser->loginAdmin();
    }else{

        header("location:indexAdmin.php?page=accueilAdmin");

    }
    
}



if(isset($_GET["action"]) && $_GET["action"]== "connecte" && !isset($_GET["page"])){

    
    
        if(!empty($_POST["username"]) && !empty($_POST["password"])){
    
            /****htmlspecialchars ***/
            $user=htmlspecialchars($_POST["username"]);
            $mdp=htmlspecialchars($_POST["password"]);

            /****Addslashes() *****/
    
            $username= addslashes($user);
            $password=addslashes($mdp);

            /*** Cryptage du mot de passe pour comparaison****/
            $password = hash('sha256',$password);
    
            $caracteristiqueUser=array("username"=>$username, "mdp"=>$password);

            $verification=$controllerUser->compteUserExiste($caracteristiqueUser); 
            
            
            if($verification != NULL){ //Si le couple username/password est trouvé...
                //Création d'un objet de la classe User pour récupération d'informations

                $userTrouvé= new User($verification);
                $_SESSION["idUser"]=$userTrouvé->getId_user();

            
                header("location:indexAdmin.php?page=accueilAdmin"); //index de l'administration
            }else{
                $controllerUser->connexionFail();
                
                
                
            }
    
        }else{
    
            $user="";
            $mdp="";
        }
    
    
}

if(!isset($_GET["action"]) && isset($_GET["page"]) && $_GET["page"]== "accueilAdmin"){
    
    if(isset($_GET["ajout"])){
        if($_GET["ajout"]=="ok"){
            $message="";
        }
    }
    //Récupération de tous les cours pour le formulaire d'ajout d'horaire

    $Allcours=$controllerCours->AllCours();
    $arrayCoursObjet=array();
    foreach($Allcours as $c){
        $cours=new Cours($c);
        array_push($arrayCoursObjet, $cours);//Stockage de tous les objets dans un array
    }

    //Affichage de tous les cours et récupération du nom de la categorie de chaque cours
    $allCours=$arrayCoursObjet;

    $arrayCategorie=array();//contiendra tous les noms de categorie

    foreach($allCours as $co){

        $ResultNom=$controllerCategorie->getNomCategorie($co->getCategorie());
        $nom=$ResultNom["categorie"];
        array_push($arrayCategorie, $nom);

    }

    //Affichage de toutes les recettes et récupération du nom de la categorie de chaque recette

    $AllRecettes=$controllerRecette->AllRecettes();
    $arrayRecette=array();
    foreach($AllRecettes as $r){
        $recette=new Recette($r);
        array_push($arrayRecette, $recette);//Stockage de tous les objets dans un array
    }

    $allRecettes=$arrayRecette;

    

    $arrayCategorieRecette=array();//contiendra tous les noms de categorie

    foreach($allRecettes as $re){

        $ResultNom=$controllerCategorie->getNomCategorie($re->getCategorie());
        $nom=$ResultNom["categorie"];
        array_push($arrayCategorieRecette, $nom);

    }

    //Affichage de tous les horaires et récupération des noms des cours des horaires en questions

    $AllHoraires=$controllerHoraires->getAllHoraire();
    $arrayHoraire=array();
    foreach($AllHoraires as $h){
        $horaire=new Horaire($h);
        array_push($arrayHoraire, $horaire);//Stockage de tous les objets dans un array
    }

    $allHoraires=$arrayHoraire;

    

    $arrayCoursHoraire=array();//contiendra tous les noms de cours

    foreach($allHoraires as $ho){


        $ResultNom=$controllerCours->infoCours($ho->getIdCours());
        $nom=$ResultNom["nom"];
        array_push($arrayCoursHoraire, $nom);

    }

    //Afficher tous les clients

    $AllClients=$ControllerClients->getAll();
    $arrayClients=array();
    foreach($AllClients as $cl){
        $client= new Clients($cl);
        array_push($arrayClients, $client);//Stockage de tous les objets dans un array
    }

    $allClients=$arrayClients;

    //Afficher tous les clients ayant commandés

    $AllCommande=$controllerCommande->getAllCommande();
    $arrayClientCommande= array(); // Array de stockage de tous les clients ayant commandé
    if($AllCommande != NULL){ //Si il exite au moins une commande

        foreach($AllCommande as $com){//Pour chaque commande
            if($arrayClientCommande == NULL){//Si la liste des clients est vide 
                array_push($arrayClientCommande, $com["idClient"]);  //On enregistre l'id du client dans la liste
            }else{
                //Si la liste n'est pas vide
                //On regarde si le client courant est déjà dans la liste
                $compteur=0;
                $trouve=false;
                while($trouve == false && $compteur<sizeof($arrayClientCommande)){
                    if($arrayClientCommande[$compteur] == $com["idClient"]){
                        $trouve = true;
                    }
                    $compteur++;
                }
    
                if($trouve == false){
                    //Seulement si le client n'est pas déjà présent dans la liste, on l'ajoute
                    array_push($arrayClientCommande, $com["idClient"]);
                }
            }
    
    
    
        }

    }

    $ArrayCommandeClient=array(); //contiendra tous les objet de la classe Client

    if($arrayClientCommande != NULL){
        
        foreach($arrayClientCommande as $idCli){
            
            $unClient=new Clients ($ControllerClients->infoClient($idCli));
            array_push($ArrayCommandeClient, $unClient);
        }

        //Récupération des id de commande faite par les clients respectif
        $arrayidCommande=array();//Une liste de liste de commande, une liste par client

        //Pour chaque client
        foreach($ArrayCommandeClient as $unClient){
            $arrayCommandeObjet=array();//Liste des Commande, objet de la classe Commande
            $allCommandeClient=$controllerCommande->getIdClient($unClient->getIdClient());
            foreach($allCommandeClient as $unCommande){
                $commandeObjet= new Commande($unCommande);
                array_push($arrayCommandeObjet, $commandeObjet);

            }
            
            array_push($arrayidCommande, $arrayCommandeObjet);

        

        }

        
    }

    //Affichage de toutes les commandes de cours et leurs reservations

    $ToutesLesCommandes=array(); //Contiendra tous les objets de la classe Commande
    
    if($AllCommande !=NULL){

        foreach($AllCommande as $comm){
            $commObjet= new Commande($comm);
            array_push($ToutesLesCommandes, $commObjet);
        }

    }


    /**** Récupération des reservations des commandes ****/


    /**Contiendra toutes les reservations */
    $resultReservationClient=array();

    foreach($ToutesLesCommandes as $commande){//Pour chaque commande
        $arrayReservations=array(); //contiendra toutes les reservations d'une commande sous forme d'objet

        $reservationsCommande=$controllerReservation->ReservationsCommande($commande->getIdCommande());
        foreach($reservationsCommande as $p){
            $o= new Reservation($p);
            array_push($arrayReservations, $o);
        }

        array_push($resultReservationClient, $arrayReservations);

    }


    //Affichage de toutes les commandes de crédits

    $CommCredits=$controllerCommandeCredit->getAllCommande();
    //cette array contiendra toutes commandes sous forme d'objets de la classe CommandeCredit
    $CommandeCredits=array();

    foreach($CommCredits as $comcre){
        $commandeCre=new CommandeCredit($comcre);
        array_push($CommandeCredits, $commandeCre);
    }

    


    include "app/View/admin/Accueil.php";


}

if(!isset($_GET["action"]) && !isset($_GET["page"]) && isset($_GET["dialogue"])){
    

    $affichageEnregistrement=$_GET["dialogue"];

    include "app/View/admin/dialogue.php";
}

if(isset($_GET["action"]) && $_GET["action"]== "deconnecter" && !isset($_GET["page"])){

    $controllerUser->deconnecter();

}


if(isset($_GET["ajout"]) && $_GET["ajout"]== "cours" && !isset($_GET["page"]) && !isset($_GET["action"])){

    /***Verification du formulaire  d'ajout d'un cours */

  if(isset($_POST["send"])){
      
    if(isset($_POST["nom"], $_POST["niveau"], $_POST["prix"], $_POST["temps"], $_POST["categorie"], $_POST["description"], $_FILES["img"])){
    
    /*** htmlspecialchars**/
    $n= htmlspecialchars($_POST["nom"]);
    $pr= htmlspecialchars($_POST["prix"]);
    $t= htmlspecialchars($_POST["temps"]);
    $des= htmlspecialchars($_POST["description"]);

    /*** addslashes ***/

    $nom=addslashes($n);
    $prix=addslashes($pr);
    $temps=addslashes($t);
    $description=addslashes($des);

    $categorie=$_POST["categorie"];
    $niveau=$_POST["niveau"];
    $img=$_FILES["img"];



    }else{
      $nom="";
      $prix= "";
      $temps= "";
      $description= "";
      $categorie="";
      $niveau="";
      $img="";
    }



    /***Vérification du contenu des variables avant d'enregistrer ***/
    
  if(!empty($nom) && !empty($prix) && !empty($temps) && !empty($description)&& !empty($categorie)&& !empty($niveau)&& !empty($img)){
    
    $nomImg="img/".$nom; //recuperation du nom de l'image

    /**** Vérification de l'existence du cours entré****/

    if($controllerCours->existeDejaCours(array("categorie"=>$categorie,"nom" => $nom, "description" => $description)) == NULL)
    
    { //Si le cours n'existe pas...
      
      $cours = array("nom" => $nom, "niveau"=>$niveau, "prix"=>$prix, "temps"=>$temps, "categorie"=>$categorie,  "description" => $description, "imgCours"=>$nomImg);
      
      $coursObjet= new Cours($cours); // création d'un objet de la classe cours pour l'ajouter ensuite
      $retourInsertion=$controllerCours->AjoutCours($coursObjet); //ajout du cours
      if($retourInsertion == true){ //Si le cours a bien été enregistré...
        

        /*** Enregistrement de l'image ***/
        if(isset($_FILES) && $_FILES["img"]["error"]==0){

        $enre= move_uploaded_file( $_FILES["img"]["tmp_name"],  "$nomImg");
        $affichageEnregistrement= "Enregistrement effectué----- Image enregistrée dans $nomImg";
        include "app/View/admin/dialogue.php";
        
      

       
      }
    }else{

        $affichageEnregistrement="Erreur rencontrée lors de l'enregistrement";
        include "app/View/admin/dialogue.php";

    }
  }else{ //Sinon, si le cours existe déjà..
    $affichageEnregistrement="Ce cours existe déjà";
    include "app/View/admin/dialogue.php";

    


  }
  }else{

    $affichageEnregistrement="Erreur rencontrée lors de l'enregistrement";
    include "app/View/admin/dialogue.php";

  }
  
  }


}





if(isset($_GET["ajout"]) && $_GET["ajout"]== "recette" && !isset($_GET["page"]) && !isset($_GET["action"])){

    /***Verification du formulaire d'ajout d'une recette */

if(isset($_POST["sendRecette"])){
      
    if(isset($_POST["nom"], $_POST["niveau"], $_POST["temps"], $_POST["nbPer"], $_POST["ingredients"], $_POST["description"], $_POST["categorie"], $_FILES["imgRecette"], $_FILES["ImgDerouleRecette"])){
    
    /*** htmlspecialchars**/
    $n= htmlspecialchars($_POST["nom"]);
    $t= htmlspecialchars($_POST["temps"]);
    $ingred= htmlspecialchars($_POST["ingredients"]);
    $des= htmlspecialchars($_POST["description"]);
  
    /*** addslashes ***/
  
    $nom=addslashes($n);
    $temps=addslashes($t);
    $ingredients=addslashes($ingred);
    $description=addslashes($des);
  
    $categorie=$_POST["categorie"];
    $nbPer=$_POST["nbPer"];
    $niveau=$_POST["niveau"];
    $imgRecette=$_FILES["imgRecette"];
    $ImgDerouleRecette=$_FILES["ImgDerouleRecette"];
  
  
  
    }else{
      $nom="";
      $temps= "";
      $ingredients= "";
      $description= "";
      $categorie="";
      $nbPer="";
      $niveau="";
      $imgRecette="";
      $ImgDerouleRecette="";
    }
  
  
  
    /***Vérification du contenu des variables avant d'enregistrer ***/
    
  if(!empty($nom) && !empty($temps) && !empty($ingredients) && !empty($description) && !empty($categorie)&& !empty($nbPer)&& !empty($niveau)&& !empty($imgRecette)&& !empty($ImgDerouleRecette)){
    
    $nomImgRecette="img/".$nom; //recuperation du nom de l'image
    $nomImgDeroule="img/".$nom."Deroule";
  
  
    /**** Vérification de l'existence de la recette entrés****/
  
    if($controllerRecette->existeDejaRecette(array("categorie"=>$categorie,"nom" => $nom, "description" => $description)) == NULL)
    
    { //Si la recette n'existe pas...
      
      $recette = array("nom" => $nom, "temps"=>$temps, "ingredients"=>$ingredients, "description"=>$description, "categorie"=>$categorie,  "nombreDePersonne" => $nbPer, "niveau"=>$niveau, "imgRecette"=>$nomImgRecette, "imgDerouleRecette"=>$nomImgDeroule);
      $recetteObjet= new Recette($recette); //Creation d'un objet de la classe Recette pour l'ajouter ensuite
      
      $retourInsertion=$controllerRecette->AjoutRecette($recetteObjet); //ajout de la recette
      if($retourInsertion == true){ //Si la recette a bien été enregistrée...
        
        
        
        /*** Enregistrement de l'image ***/
        if(isset($_FILES) && $_FILES["img"]["error"]==0){
  
        $enre= move_uploaded_file( $_FILES["imgRecette"]["tmp_name"],  "$nomImgRecette");
        $enre= move_uploaded_file( $_FILES["ImgDerouleRecette"]["tmp_name"],  "$nomImgDeroule");
        $affichageEnregistrement= "Enregistrement effectué-------Stored into $nomImgRecette------Stored into $nomImgDeroule";
        include "app/View/admin/dialogue.php";
        
      
  
       
      }
    }else{
  
        $affichageEnregistrement= "Erreur rencontrée lors de l'enregistrement";
        include "app/View/admin/dialogue.php";
  
    }
  }else{ //Sinon, si la recette existe déjà..
    $affichageEnregistrement= "Cette recette existe déjà";
    include "app/View/admin/dialogue.php";
  }
  
    
  
  
    
  }else{
  
    $affichageEnregistrement= "Erreur rencontrée lors de l'enregistrement";
    include "app/View/admin/dialogue.php";
  
  }
  
  }
  
  


}



if(isset($_GET["ajout"]) && $_GET["ajout"]== "horaire" && !isset($_GET["page"]) && !isset($_GET["action"])){

   /***Verification du formulaire d'ajout d'un horaire */

if(isset($_POST["sendHoraires"])){
      
    if(isset($_POST["idCours"], $_POST["jour"], $_POST["heure"] )){
    
    /*** htmlspecialchars**/
    
    $j= htmlspecialchars($_POST["jour"]);
    $h= htmlspecialchars($_POST["heure"]);
  
    /*** addslashes ***/
  
    
    $jour=addslashes($j);
    $heure=addslashes($h);
  
  
    $cours=$_POST["idCours"];
  
  
  
    }else{
      $jour="";
      $heure="";
      $cours="";
    }
  
  
    /***Vérification du contenu des variables avant d'enregistrer ***/
    
  if(!empty($jour) && !empty($heure) && !empty($cours)){
    
    
    /**** Vérification de l'existence de l'horaire entrés****/
  
    if($controllerHoraires->existeDejaHoraire(array("jour"=>$jour,"heure" => $heure, "idCours" => $cours)) == NULL)
    
    { //Si l'horaire n'existe pas...
      
      $horaire = array("idCours" => $cours, "jour"=>$jour, "heure"=>$heure);
      $horaireObjet= new Horaire($horaire); //Creation d'un objet de la classe Horaire pour l'ajouter ensuite
      $retourInsertion=$controllerHoraires->AjoutHoraire($horaireObjet); //ajout de l'horaire
      if($retourInsertion == true){ //Si l'horaire a bien été enregistrée...
        
        $affichageEnregistrement= "Enregistrement effectué";
        include "app/View/admin/dialogue.php";
        
      
      }else{
  
        $affichageEnregistrement= "Erreur rencontrée lors de l'enregistrement";
      include "app/View/admin/dialogue.php";
  
    }
  }else{ //Sinon, si l'horaire existe déjà..
    $affichageEnregistrement= "Cet horaire existe déjà";
    include "app/View/admin/dialogue.php";
  }
  
    
  
  
    
  }
  
  }
  
  


}


/********************************* Suppression d'un cours *************************/

if(isset($_GET["action"]) && $_GET["action"]=="suppression" && isset($_GET["ele"]) && !isset($_GET["page"])){
    if($_GET["ele"]=="cours"){
        $idCours=$_GET["id"];
        //Si on veut supprimer un cours, on doit supprimer les horaires ou ce cours est attitré

        //Verifions d'abord s'il existe

        $coursExiste=$controllerCours->infoCours($idCours);
        if($coursExiste !=NULL){

            $HorairesContenantCours=$controllerHoraires->getHoraireCours($idCours); //tt les horaires contenant ce cours
        if($HorairesContenantCours ==NULL){
            //Si le cours n'est dans aucun horaire créé, on supprime juste le cours
            if($controllerCours->supprimerCours($idCours)== true){

                $affichageEnregistrement= "Le cours à bien été supprimé";
                include "app/View/admin/dialogue.php";

            }else{

                $affichageEnregistrement= "Un problème est survenu lors de la suppression du cours";
                include "app/View/admin/dialogue.php";

            }
        }else{
            
            //Si des horaires contenant ce cours existe
            
            //Pour chaque Horaire, on doit aussi supprimer le necessaire
            foreach($HorairesContenantCours as $h){
                $idHoraire= $h["idHoraire"];
        
                    //Si on veut supprimer un horaire, on doit d'abord supprimer toutes les reservations qui contienne cet horaire
                    $toutesReservationsHoraire= $controllerReservation->getReservHoraire($idHoraire); //Toutes les reservations avec l'horaire en question
                    
                   
                    //On va regarder pour chaque si on a besoins de supprimer la commande avec: si on supprime toutes les reservations d'une commande, on doit supprimer la commande aussi
                    foreach($toutesReservationsHoraire as $horaire){
        
                        $infoReservation= new Reservation($horaire);
                        //Création d'un objet de la classe Reservation pour récupérer les informations nécessaires facilement
        
        
                        //Récupération du nombre de reservations de la même commande que la reservation choisie
                        $reservationsCommande=$controllerReservation->ReservationsCommande($infoReservation->getIdCommande());
                       
             
         
                        if(sizeof($reservationsCommande)== 1){
                           
                        $idCommande=$infoReservation->getIdCommande();
                        $controllerReservation->suppReservation($infoReservation->getIdReservation());
                        //Si il n'y qu'une seule reservation dans cette commande, alors, on doit aussi supprimer la commande en entier;
                        $controllerCommande->suppressionCommande($idCommande);
        
                        }elseif(sizeof($reservationsCommande)>1 ){
         
                            $idCommande=$infoReservation->getIdCommande();
                            //On doit récupérer le prix du cours de la reservation pour changer le prix total
         
                            $horaireTemporaire= new Horaire($controllerHoraires->getUnHoraire($infoReservation->getIdHoraire()));
                            $coursTemporaire = new Cours($controllerCours->infoCours($horaireTemporaire->getIdCours()));
         
                            $prixCours= $coursTemporaire->getPrix();
         
                            //Suppression
                            $suppReserv=$controllerReservation->suppReservation($_GET["idreserv"]);
         
                            if($suppReserv == true){
                                //On doit modifier le prix de la commande si une reservation est enlevée
                                //on récupère d'abord le prix de base
                     
                                $somme=$controllerCommande->getPrix($idCommande);
                     
         
                                $newSomme=$somme["prixTotal"]-$prixCours;
         
                                $controllerCommande->changePrix($idCommande, $newSomme);
                                
                                
                     
                            }
                 
                        }
                        }

                        //Suppression de l'horaire
                $controllerHoraires->supprimerHoraire($idHoraire);
               
        
                
        
        
        
                    
            }

            $HorairesContenantCoursApresSupp=$controllerHoraires->getHoraireCours($idCours);
            

            if($HorairesContenantCoursApresSupp == NULL){//S'il sont été tous supprimés, on peut supprimer le cours
                
                if($controllerCours->supprimerCours($idCours)== true){

                    $affichageEnregistrement= "Le cours à bien été supprimé";
                    include "app/View/admin/dialogue.php";
    
                }else{
    
                    $affichageEnregistrement= "Un problème est survenu lors de la suppression du cours";
                    include "app/View/admin/dialogue.php";
    
                }


            }else{
    
                $affichageEnregistrement= "Un problème est survenu lors de la suppression";
                include "app/View/admin/dialogue.php";

            } 
        }

        }else{

                $affichageEnregistrement= "Ce cours n'existe pas/plus";
                include "app/View/admin/dialogue.php";

        }

        
    }if($_GET["ele"]=="recette"){

    
        $idRecette=$_GET["id"];
        //On verifie si la recette existe

        if($controllerRecette->infoRecette($idRecette)!=NULL){

            if($controllerRecette->suppRecette($idRecette)==true){

                $affichageEnregistrement= "La recette a bien été supprimée";
                include "app/View/admin/dialogue.php";

            }

        }else{

                $affichageEnregistrement= "Cette recette n'existe pas/plus";
                include "app/View/admin/dialogue.php";

        }
        
    }

    if($_GET["ele"]=="horaire"){

    
        $idHoraire=$_GET["id"];
        //On verifie si l'horaire existe

        if($controllerHoraires->getUnHoraire($idHoraire)!=NULL){
            //Si il existe
            //Si on veut supprimer un horaire, on doit d'abord supprimer toutes les reservations qui contienne cet horaire
            $toutesReservationsHoraire= $controllerReservation->getReservHoraire($idHoraire); //Toutes les reservations avec l'horaire en question
           
           
            //On va regarder pour chaque si on a besoins de supprimer la commande avec: si on supprime toutes les reservations d'une commande, on doit supprimer la commande aussi
            foreach($toutesReservationsHoraire as $horaire){

                $infoReservation= new Reservation($horaire);
                //Création d'un objet de la classe Reservation pour récupérer les informations nécessaires facilement


                //Récupération du nombre de reservations de la même commande que la reservation choisie
                $reservationsCommande=$controllerReservation->ReservationsCommande($infoReservation->getIdCommande());
     
 
                if(sizeof($reservationsCommande)== 1){
                $idCommande=$infoReservation->getIdCommande();
                $suppReserv=$controllerReservation->suppReservation($infoReservation->getIdReservation());
                //Si il n'y qu'une seule reservation dans cette commande, alors, on doit aussi supprimer la commande en entier;
                $suppComm=$controllerCommande->suppressionCommande($idCommande);
 
                
                }elseif(sizeof($reservationsCommande)>1 ){
 
                    $idCommande=$infoReservation->getIdCommande();
                    //On doit récupérer le prix du cours de la reservation pour changer le prix total
 
                    $horaireTemporaire= new Horaire($controllerHoraires->getUnHoraire($infoReservation->getIdHoraire()));
                    $coursTemporaire = new Cours($controllerCours->infoCours($horaireTemporaire->getIdCours()));
 
                    $prixCours= $coursTemporaire->getPrix();
 
                    //Suppression
                    $suppReserv=$controllerReservation->suppReservation($_GET["idreserv"]);
 
                    if($suppReserv == true){
                        //On doit modifier le prix de la commande si une reservation est enlevée
                        //on récupère d'abord le prix de base
             
                        $somme=$controllerCommande->getPrix($idCommande);
             
 
                        $newSomme=$somme["prixTotal"]-$prixCours;
 
                        $controllerCommande->changePrix($idCommande, $newSomme);
                        
                        
             
                    }
         
                }
                }

                //Suppression de l'horaire
                if($controllerHoraires->supprimerHoraire($idHoraire)==true){
                    $affichageEnregistrement= "L'horaire a été supprimé";
                    include "app/View/admin/dialogue.php";

                }else{

                    $affichageEnregistrement= "Un problème est survenu";
                    include "app/View/admin/dialogue.php";

                }

        



            }else{

                $affichageEnregistrement= "Cet horaire n'existe pas/plus";
                include "app/View/admin/dialogue.php";

        }
        
    }

    if($_GET["ele"]=="commande"){
        //On verifie que la commande existe 

        if($controllerCommande->infoCommande($_GET["id"])!=NULL){

            //pour supprimer une commande, on doit supprimer toutes les reservations de cette commande

            $ttlesReservations=$controllerReservation->ReservationsCommande($_GET["id"]);
            $retourSuppression=$controllerReservation->suppressionReservations($_GET["id"]);

            if($retourSuppression == sizeof($ttlesReservations)){
                //Si toutes les reservations ont bien été supprimées
                if($controllerCommande->suppressionCommande($_GET["id"])==true){

                    $affichageEnregistrement= "La commande a été supprimée";
                    include "app/View/admin/dialogue.php";



                }
            }

        }else{

            $affichageEnregistrement= "Cet commande n'existe pas/plus";
            include "app/View/admin/dialogue.php";

        }
        

    }


    if($_GET["ele"]=="commandeCredit"){
        //On verifie que la commande existe 

        if($controllerCommandeCredit->infoCommande($_GET["id"])!=NULL){

            if($controllerCommandeCredit->suppressionCommande($_GET["id"])==true){

                $affichageEnregistrement= "La commande a été supprimée";
                include "app/View/admin/dialogue.php";



            }

        }else{

            $affichageEnregistrement= "Cet commande n'existe pas/plus";
            include "app/View/admin/dialogue.php";

        }
        

    }

    if($_GET["ele"]=="reservation"){
        //On verifie que la reservation existe 

        if($controllerReservation->infoReservation($_GET["id"])!=NULL){

            //Création d'un objet de la classe Reservation pour récupérer les informations nécessaires facilement
    $infoReservation= new Reservation($controllerReservation->infoReservation($_GET["id"]));


    //Récupération du nombre de reservations de la même commande que la reservation choisie
     $reservationsCommande=$controllerReservation->ReservationsCommande($infoReservation->getIdCommande());
     
 
     if(sizeof($reservationsCommande)== 1){
         $idCommande=$infoReservation->getIdCommande();
         $suppReserv=$controllerReservation->suppReservation($_GET["id"]);
         //Si il n'y qu'une seule reservation dans cette commande, alors, on doit aussi supprimer la commande en entier;
         $suppComm=$controllerCommande->suppressionCommande($idCommande);
 
         if($suppReserv && $suppComm == true){
            $affichageEnregistrement= "La reservation a bien été supprimée";
            include "app/View/admin/dialogue.php";
         }
     }elseif(sizeof($reservationsCommande)>1 ){
 
         $idCommande=$infoReservation->getIdCommande();
         //On doit récupérer le prix du cours de la reservation pour changer le prix total
 
         $horaireTemporaire= new Horaire($controllerHoraires->getUnHoraire($infoReservation->getIdHoraire()));
         $coursTemporaire = new Cours($controllerCours->infoCours($horaireTemporaire->getIdCours()));
 
         $prixCours= $coursTemporaire->getPrix();
 
         //Suppression
         $suppReserv=$controllerReservation->suppReservation($_GET["id"]);
 
         if($suppReserv == true){
             //On doit modifier le prix de la commande si une reservation est enlevée
             //on récupère d'abord le prix de base
             
             $somme=$controllerCommande->getPrix($idCommande);
             
 
             $newSomme=$somme["prixTotal"]-$prixCours;
 
             $controllerCommande->changePrix($idCommande, $newSomme);
 
             $affichageEnregistrement= "La reservation a bien été supprimée";
                include "app/View/admin/dialogue.php";
 
 
 
             
 
             
         }
 
         
 
         
 
 
         
     }else{
 
        $affichageEnregistrement= "Un problème est survenu";
        include "app/View/admin/dialogue.php";
         
     }

        }else{

            $affichageEnregistrement= "Cette reservation n'existe pas/plus";
            include "app/View/admin/dialogue.php";

        }
        

    }


    if($_GET["ele"]=="client"){
        //On verifie que le client existe 

        if($ControllerClients->infoClient($_GET["id"])!=NULL){

            //pour supprimer un client, on doit supprimer toutes ses commandes

            $toutesLesCommandesClient=$controllerCommande->getIdClient($_GET["id"]);
            $toutesLesCommandesCreditsClient=$controllerCommandeCredit->getIdClient($_GET["id"]);
            if($toutesLesCommandesClient!=NULL || $toutesLesCommandesCreditsClient!=NULL){


                $retourSuppression=$controllerCommande->suppressionCommandeClient($_GET["id"]);
                $retourSuppressionCommandeCredit=$controllerCommandeCredit->suppressionCommandeClient($_GET["id"]);
            
            if($retourSuppression != NULL || $retourSuppressionCommandeCredit!=NULL){

                if($retourSuppression == sizeof($toutesLesCommandesClient) || $retourSuppressionCommandeCredit ==  sizeof($retourSuppressionCommandeCredit)){
                    //Si toutes les commandes ont bien été supprimées
                    if($ControllerClients->suppressionClient($_GET["id"])==true){
    
                        $affichageEnregistrement= "Le client a été supprimé";
                        include "app/View/admin/dialogue.php";
    
    
    
                    }else{

                        $affichageEnregistrement= "Un problème est survenu lors de la suppression du client";
                        include "app/View/admin/dialogue.php";
            
                    }
                }else{

                    $affichageEnregistrement= "Un problème est survenu lors de la suppression des commandes du client";
                    include "app/View/admin/dialogue.php";
        
                }

            }else{

                $affichageEnregistrement= "Un problème est survenu lors de la suppression des commandes du client";
                include "app/View/admin/dialogue.php";
    
            }

            }else{ //Si le client n'a effectué aucune commande
                if($ControllerClients->suppressionClient($_GET["id"])==true){
    
                    $affichageEnregistrement= "Le client a été supprimé";
                    include "app/View/admin/dialogue.php";



                }else{

                    $affichageEnregistrement= "Un problème est survenu lors de la suppression du client";
                    include "app/View/admin/dialogue.php";
        
                }
            }
            

            

        }else{

            $affichageEnregistrement= "Ce client n'existe pas/plus";
            include "app/View/admin/dialogue.php";

        }
        

    }




}

?>