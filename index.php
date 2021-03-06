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

/***Accueil***/
if(empty($_GET)){

    $controllerRecette->hasard();
    

    
}

/***Information ***/

if($_GET["page"]&& $_GET["page"]=="information"){
    include("app/View/aPropos.php");
}

/****Login******/

if (isset($_GET["page"]) && $_GET["page"]=="Login"){
    $ControllerClients->login();
}

/*****connecte******/

if (isset($_GET["action"]) && $_GET["action"]=="login"){
$email=$_POST["email"];
$mdp=$_POST["password"];

$ControllerClients->connecte($email, $mdp);
header("location : index.php");


}

/*****deconnexion******/

if (isset($_GET["action"]) && $_GET["action"]=="deconnecter"){
   
    $ControllerClients->deconnexion();
    //header("location : index.php");
}


/*****Creez_Compte*****/

if(isset($_GET["page"]) && $_GET["page"]=="Creez"){
$ControllerClients->Crea();
}


if(isset($_GET["action"]) && $_GET["action"]=="save") {


    if(isset($_POST["send"])){
        if(isset($_POST["pseudo"]) && isset($_POST["email"]) && isset($_POST["mdp"]) && isset($_POST["Nom"]) && isset($_POST["Prenom"]) && isset($_POST["Codepostal"])){
        
        /***Htmlspecialchars() */
        
        $e= htmlspecialchars($_POST["email"]);
        $password=htmlspecialchars($_POST["mdp"]);
        $n= htmlspecialchars($_POST["Nom"]);
        $pre =htmlspecialchars($_POST["Prenom"]);
        $cp= htmlspecialchars($_POST["Codepostal"]);
        $p= htmlspecialchars($_POST["pseudo"]);
    
        /****Addslashes() *****/
    
        $email= addslashes($e);
        $mdp=addslashes($password);
        $nom= addslashes($n);
        $prenom =addslashes($pre);
        $codePostal= addslashes($cp);
        $pseudo=addslashes($p);
    
    
        /*** Cryptage du mot de passe****/
        $mdp = hash('sha256',$mdp);

        $vide=false;
    
        }else{
            
            $email= "";
            $mdp="";
            $nom= "";
            $prenom ="";
            $codePostal= "";
            $pseudo= "";
            $vide=true;
    
    
        }

        if(!empty($_POST["pseudo"]) && !empty($_POST["email"]) && !empty($_POST["mdp"]) && !empty($_POST["Nom"]) && !empty($_POST["Prenom"]) && !empty($_POST["Codepostal"])){

            $vide=false;

        }else{

            $vide=true;

        }



    $attributs = "nom, prenom, codePostale, email, pseudo, motDePasse, nbCredits";

    $attributsDonnes = "'$nom', '$prenom', $codePostal, '$email', '$pseudo', '$mdp', 1";

 
    $ControllerClients->SaveClient($attributs, $attributsDonnes, $email, $vide);


}

}

/****Vue recette *****/

if( isset($_GET["page"]) && isset($_GET["id"]) && $_GET["page"]=="vuerecette"){

    $resRequete=$controllerRecette->getRecette($_GET["id"]);


}


/********** Cours ******/

if(isset($_GET["page"]) && $_GET["page"]== "cours" && !isset($_GET["niv"])){

    $controllerCours->getAllCours();

}elseif(isset($_GET["page"]) && $_GET["page"]== "cours" && isset($_GET["niv"])){

    $controllerCours->getNivCours($_GET["niv"]);

}

/**** Planning *****/

if(isset($_GET["page"]) && $_GET["page"]== "planning" && isset($_GET["id"])){

    /**Recup??ration des infos du cours choisi, pour l'affichage du planning avec "getHoraires" **/

    $infoCours=$controllerCours->infoCours($_GET["id"]);

    /*** R??cup??ration du nomo de la categorie du cours***/

    $nomCategorie=$controllerCategorie->getNomCategorie($infoCours["categorie"]);
    $controllerHoraires->getHoraires($_GET["id"], $infoCours, $nomCategorie);

}

/***** Recettes *****/

if(isset($_GET["page"]) && $_GET["page"]== "recettes"  && !isset($_GET["niv"]) ){

    $controllerRecette->getAllRecettes();
}elseif(isset($_GET["page"]) && $_GET["page"]== "recettes"  && isset($_GET["niv"])){

    $controllerRecette->getNivCours($_GET["niv"]);

}

/***** Panier *****/

if(isset($_GET["page"]) && $_GET["page"]== "panier" && !isset($_GET["action"]) && !isset($_GET["validation"]) ){

    if(!isset($_SESSION["id"])){
        $ControllerClients->login();
    }else{

        if(!empty($_SESSION["panier"])){

            $tousLesCours=array();
    
            foreach($_SESSION["panier"] as $reser){
                //stockage des informations des cours correspondant aux horaires pr??sents dans le panier
    
                $c=$controllerCours->infoCours($reser->getIdCours());
                $cours=new Cours($c);
                array_push($tousLesCours, $cours);
    
            }
    
            
    
        }else{
            $tousLesCours=NULL;
        }
    
        
        $dejaPresent= false;
        $controllerHoraires->getPanier($tousLesCours, $dejaPresent);
        
        
    }
    
    
    
    

}


if(isset($_GET["page"]) && $_GET["page"]== "panier" && isset($_GET["action"]) && $_GET["action"]== "dejaPresent" ){

    
    
    if(!empty($_SESSION["panier"])){

        $tousLesCours=array();

        foreach($_SESSION["panier"] as $reser){
            //stockage des informations des cours correspondant aux horaires pr??sents dans le panier

            $c=$controllerCours->infoCours($reser->getIdCours());
            $cours=new Cours($c);
            array_push($tousLesCours, $cours);

        }

        

    }else{
        $tousLesCours=NULL;
    }


     
    $dejaPresent=true;
    $controllerHoraires->getPanier($tousLesCours, $dejaPresent);
    
    
    

}







if(isset($_GET["page"]) && $_GET["page"]== "panier" && isset($_GET["action"]) && $_GET["action"]=="reserver" && isset($_GET["idHoraire"])){

    /*** Initialisation de la variable de session du panier***/

    if(!isset($_SESSION["panier"])){
	$_SESSION["panier"]= array();

    }


    /*** Recup??ration des informations de l'horaire ajout?? dans le panier ***/
	if(isset($_POST["ajouter"])){
        /**V??rification de si l'horaire voulu est deja present dans le panier***/
        if(!empty($_SESSION["panier"])){
		    $verifpanier= $controllerHoraires->DejaPresentPanier($_GET["idHoraire"]); 

        }
		
        //On verifie egalement si il existe  d??j?? dans les reservations deja enregistr??es 

            //On a besoins de tous les id de commandes r??alis??e par le client

        $commandesDuClient=$controllerCommande->getIdClient($_SESSION["id"]);
            //Maintenant, de toutes les reservations de ses commandes
        $TTReservationsClient=array();
        foreach($commandesDuClient as $commande){
            $co= new Commande($commande);
            $reservations=$controllerReservation->ReservationsCommande($co->getIdCommande());
            foreach($reservations as $r){
                //Cr??ation et insertion de chaque reservation dans l'array

                $reserv=new Reservation($r);

                array_push($TTReservationsClient, $reserv);

            }
            
        }
        //Maintenant, on cherche dans toutes les reservations
        
        if(!empty($TTReservationsClient)){


            $trouve=false;
		    foreach($TTReservationsClient as $res){ //Toutes les reservations d'un client
			if($res->getIdHoraire() == $_GET["idHoraire"] ){ //Si on trouve l'horaire
                $trouve=true;
                
			}
			
		}

        }
		
        
       

            if($verifpanier["trouve"] == false && $trouve == false){ 
                $horaireAjout??e=new Horaire($controllerHoraires->getUnHoraire($_GET["idHoraire"]));
                //Si l'horaire n'est ni dans le panier, ni dans les reservations d??j?? faite
                //On v??rifie que le jour et l'heure ne soit pas deja pris dans un autre horaire
                
                $trouveReserv=false;
                foreach($TTReservationsClient as $reservationClient){
                    $horaireTemp=new Horaire($controllerHoraires->getUnHoraire($reservationClient->getIdHoraire()));
                    $jour=$horaireTemp->getJour();
                    $heure=$horaireTemp->getHeure();
                    if(strcmp($jour, $horaireAjout??e->getJour())==0 && strcmp($heure, $horaireAjout??e->getHeure())==0){
                        
                        $trouveReserv=true;
                        break;

                    }

                }
                $trouvePanier=false;
                foreach($_SESSION["panier"] as $horaire){

                    $jour=$horaire->getJour();
                    $heure=$horaire->getHeure();
                    if(strcmp($jour, $horaireAjout??e->getJour())==0 && strcmp($heure, $horaireAjout??e->getHeure())==0){
                        $trouvePanier=true;
                        break;

                    }

                }



                if($trouvePanier==false && $trouveReserv==false ){
                    array_push($_SESSION["panier"], $horaireAjout??e); //Ajout de l'horaire dans le panier
       
        

                header("location:index.php?page=panier");

                }elseif($trouvePanier==true && $trouveReserv==false){

                    $message= "Vous avez d??j?? un cours m??me jour m??me heure dans votre panier";
                    include "app/View/dialogue.php";

                }else{

                    $message= "Vous avez d??j?? r??serv?? un cours m??me jour m??me heure";
                    include "app/View/dialogue.php";

                }

                
                
                
        
			
                
         
                
                
            }else{

                header("location:index.php?page=panier&action=dejaPresent");

            }

                
                
                
                
                
    
    
            

        
		
		
		
	}



    

}

if(isset($_GET["page"])&& $_GET["page"]=="panier" && isset($_GET["validation"]) && $_GET["validation"]== true){
    
    /**** Si la commande est valid??e ***/
    //Cr??ation de la commande
    $somme=$_GET["somme"];
    $idClient=$_SESSION["id"];
    $date=date("YmdHis");

    $commande= new Commande(array("idClient"=>$idClient, "date"=>$date, "prixTotal"=>$somme));


    

    if($controllerCommande->addCommande($commande)== true){ //Si la commande est bien cr????e

        /**** R??cup??ration de l'id de la commande juste cr????e****/

        $idCommande=$controllerCommande->getCommandeId($date, $somme, $idClient);


        //Cr??ation de toutes les reservations
        $compteurSave=0;
        foreach($_SESSION["panier"] as $horaire){


            if($controllerReservation->addReserv($horaire, $idCommande["IdCommande"]) == true){
                $compteurSave=$compteurSave+1;
            }

        }

        if($compteurSave == sizeof($_SESSION["panier"])){

            unset($_SESSION["panier"]);
            $_SESSION["commande"]=$idCommande["IdCommande"]; //Stockage de l'id de la commande pour s??curit?? par la suite
            $_SESSION["prix_total"]=$somme;//Stockage de la somme de la commande pour r??cup??ration plus tard
            /*** Affichage du paiement ***/
            $controllerCommande->getCheckout($somme);
            
        }

    }

    
}

/***** Validation de l'utilisation des cr??dits ****/

if(!isset($_GET["page"]) && isset($_GET["action"]) && $_GET["action"]== "valide" && !isset($_GET["validation"])){

    $ControllerClients->decrediter($_SESSION["id"], $_SESSION["prix_total"]);
    header("location:index.php");
}

/***** Page de recharge de cr??dits *****/

if(!isset($_GET["action"]) && isset($_GET["page"]) && $_GET["page"]== "recharge" && !isset($_GET["validation"])){

    include("app/View/recharge.php");
}

/*****Recharge de cr??dits ******/

if(!isset($_GET["page"]) && isset($_GET["action"]) && $_GET["action"]== "recharge" && isset($_GET["somme"]) && !isset($_GET["validation"])){
    $somme=$_GET["somme"];
    $idClient=$_SESSION["id"];
    $date=date("YmdHis");
    $commandeCredit= new CommandeCredit(array("idClient"=>$idClient, "date"=>$date, "prixTotal"=>$somme));

    if($controllerCommandeCredit->addCommande($commandeCredit)== true){ //Si la commande est bien cr????e

        /**** R??cup??ration de l'id de la commande juste cr????e****/

        $idCommande=$controllerCommandeCredit->getCommandeId($date, $somme, $idClient);

       

            unset($_SESSION["panier"]);
            $_SESSION["commande"]=$idCommande["IdCommande"]; //Stockage de l'id de la commande pour s??curit?? par la suite
            $_SESSION["prix_total"]=$somme;//Stockage de la somme de la commande pour r??cup??ration plus tard
            $_SESSION["nb"]=$_GET["nb"];//Stockage de la somme de la commande pour r??cup??ration plus tard
            /*** Affichage du paiement ***/
            $controllerCommandeCredit->getCheckout($somme);
            
        

    }

    
}

/**** Suppression d'un element du panier*****/

if(isset($_GET["page"])&& $_GET["page"]=="panier" && isset($_GET["action"]) && $_GET["action"]== "suppressionReserv" && isset($_GET["idHoraire"])){

    $compteur=0;
    $trouve= false;
    while($compteur<$_SESSION["panier"] && $trouve==false){
        if($_SESSION["panier"][$compteur]->getIdHoraire()== $_GET["idHoraire"]){
            $trouve =true;
            $controllerHoraires->SuppHorairePanier($compteur);
            
        }

        $compteur++;
    }

    if($trouve == false){

        $message= "Erreur lors de la suppression";
        include "app/View/dialogue.php";
        
    }
}


/**** Suppression du panier*****/

if(isset($_GET["page"])&& $_GET["page"]=="panier" && isset($_GET["action"]) && $_GET["action"]== "viderPanier" ){

    unset($_SESSION["panier"]);
    header("location:index.php?page=panier");
}





/**** Annuler une commande de cours ?  ***/

if(isset($_GET["action"]) && $_GET["action"]== "annule"){

    $controllerCommande->annulerCommande();

}

/***annulation **/

if(!isset($_GET["page"]) && isset($_GET["annuler"]) && $_GET["annuler"]=="ok" && !isset($_GET["validation"])){

    if(!isset($_SESSION["commande"])){	//$_SESSION["commande"] : correspond ?? l'id de la commande, enregistr??(pour r??cup??rer les informations)  dans la session lors de la validation de la commande depuis le panier 
		//Si le client arrive sur la page "index.php?canceled=true" par un autre moyen
		header("Location:index.php");
	}elseif(!empty($_SESSION["commande"])){

        /***Suppression des reservations et de la commande ***/
		/**** R??cup??ration du nombre de reservations avec l'id de la commande***/
        
    $ttLesReservations=$controllerReservation->ReservationsCommande($_SESSION["commande"]);
    $nbReserv= sizeof($ttLesReservations);
    

	$retourSuppression= $controllerReservation->suppressionReservations($_SESSION["commande"]);
	//Suppression des lignes de commandes

		/** V??rification que toutes reservations ont ??t?? supprim??es****/
		
	if($retourSuppression == $nbReserv){

		/***Suppression de la commande ***/
	 
		if($controllerCommande->suppressionCommande($_SESSION["commande"]) == true){ //Si la commande a ??t?? correctement supprim??e
			

            unset($_SESSION["commande"]);
            $message= "Votre commande est annul??e";
            include "app/View/dialogueIndex.php";//redirection
	
		}
		else{
            $message= "Un erreur est survenue lors de la suppression de votre commande";
            include "app/View/dialogueIndex.php";
	
		}

	}else{
        $message= "Un erreur est survenue lors de la suppression de vos articles";
        include "app/View/dialogueIndex.php";

	}
	
	

	}else{
        $message= "Un probl??me est survenu.";
        include "app/View/dialogueIndex.php";

	}

}


/***Pas d'annulation ***/

if(!isset($_GET["page"]) && isset($_GET["annuler"]) && $_GET["annuler"]=="non" && !isset($_GET["validation"])){
    $controllerCommande->getCheckout($_SESSION["prix_total"]);
}




/**** Annuler une commande de cr??dits ?  ***/

if(isset($_GET["action"]) && $_GET["action"]== "annuleCredit"){

    $controllerCommandeCredit->annulerCommande();

}

/***Annulation */

if(!isset($_GET["page"]) && isset($_GET["annuler"]) && $_GET["annuler"]=="okCredit" && !isset($_GET["validation"])){

    if(!isset($_SESSION["commande"])){	//$_SESSION["commande"] : correspond ?? l'id de la commande, enregistr??(pour r??cup??rer les informations)  dans la session lors de la validation de la commande depuis le panier 
		//Si le client arrive sur la page "index.php?canceled=true" par un autre moyen
		header("Location:index.php");
	}elseif(!empty($_SESSION["commande"])){

		/***Suppression de la commande ***/
	 
		if($controllerCommandeCredit->suppressionCommande($_SESSION["commande"]) == true){ //Si la commande a ??t?? correctement supprim??e
			

            unset($_SESSION["commande"]);
            unset($_SESSION["prix_total"]);
            unset($_SESSION["nb"]);
            $message= "Votre commande est annul??e";
            include "app/View/dialogueIndex.php"; //redirection
	
		}
		else{
            $message= "Un erreur est survenue lors de la suppression de votre commande";
            include "app/View/dialogueIndex.php";
	
		}

	
	
	

	}else{
        $message= "Un probl??me est survenu.";
        include "app/View/dialogueIndex.php";

	}

}


/***Pas d'annulation ***/

if(!isset($_GET["page"]) && isset($_GET["annuler"]) && $_GET["annuler"]=="nonCredit" && !isset($_GET["validation"])){
    $controllerCommandeCredit->getCheckout($_SESSION["prix_total"]);
}





/**** Affichage de la page de paiement pour commande de cours ****/



if(!isset($_GET["page"]) && isset($_GET["action"]) && $_GET["action"]=="paiement" && !isset($_GET["validation"]) ){

    
    
    $controllerCommande->AffichagePaiement();
}

/**** Affichage de la page de paiement pour commande de cr??dits ****/



if(!isset($_GET["page"]) && isset($_GET["action"]) && $_GET["action"]=="paiementCr??dit" && !isset($_GET["validation"]) ){
    
    $controllerCommandeCredit->AffichagePaiement();
}

/***Si les cr??dits ont ??t?? pay?? ****/

if(!isset($_GET["page"]) && isset($_GET["action"]) && $_GET["action"]=="crediter" && !isset($_GET["validation"]) && isset($_GET["credits"]) ){
    
    $ControllerClients->crediterClient($_SESSION["id"], $_GET["credits"]);
    header("location:index.php");
}





/***** Profil  ****/


if(isset($_GET["page"]) && $_GET["page"] == "profil" && !isset($_GET["action"]) && !isset($_GET["validation"]) ){

    if(isset($_SESSION["id"])){
        $controllerCommande->getCommandeClient($_SESSION["id"]);

    }else{

        $ControllerClients->login();

    }

    
    
    
}
/*** Supprimer une reservation ***/
    //confirmation

if(!isset($_GET["page"]) && isset($_GET["action"]) && $_GET["action"] == "suppReservationConfirmer" && isset($_GET["idreserv"]) && !isset($_GET["validation"]) ){

    $message= "Etes-vous sur ? Vous receverez un email contenant les modalit?? de remboursement (simulation)";
    $id=$_GET["idreserv"];
    include "app/View/dialogueProfil.php";

}

if(!isset($_GET["page"]) && isset($_GET["action"]) && $_GET["action"] == "suppReservation" && isset($_GET["idreserv"]) && !isset($_GET["validation"]) ){

    //Cr??ation d'un objet de la classe Reservation pour r??cup??rer les informations n??cessaires facilement
    $infoReservation= new Reservation($controllerReservation->infoReservation($_GET["idreserv"]));


   //R??cup??ration du nombre de reservations de la m??me commande que la reservation choisie
    $reservationsCommande=$controllerReservation->ReservationsCommande($infoReservation->getIdCommande());
    

    if(sizeof($reservationsCommande)== 1){
        $idCommande=$infoReservation->getIdCommande();
        $suppReserv=$controllerReservation->suppReservation($_GET["idreserv"]);
        //Si il n'y qu'une seule reservation dans cette commande, alors, on doit aussi supprimer la commande en entier;
        $suppComm=$controllerCommande->suppressionCommande($idCommande);

        if($suppReserv && $suppComm == true){
            header("location:index.php?page=profil");
        }
    }elseif(sizeof($reservationsCommande)>1 ){

        $idCommande=$infoReservation->getIdCommande();
        //On doit r??cup??rer le prix du cours de la reservation pour changer le prix total

        $horaireTemporaire= new Horaire($controllerHoraires->getUnHoraire($infoReservation->getIdHoraire()));
        $coursTemporaire = new Cours($controllerCours->infoCours($horaireTemporaire->getIdCours()));

        $prixCours= $coursTemporaire->getPrix();

        //Suppression
        $suppReserv=$controllerReservation->suppReservation($_GET["idreserv"]);

        if($suppReserv == true){
            //On doit modifier le prix de la commande si une reservation est enlev??e
            //on r??cup??re d'abord le prix de base
            
            $somme=$controllerCommande->getPrix($idCommande);
            

            $newSomme=$somme["prixTotal"]-$prixCours;

            $controllerCommande->changePrix($idCommande, $newSomme);

            header("location:index.php?page=profil");



            

            
        }

        

        


        
    }else{

        header("location:index.php?page=profil");
        
    }


    

    
    
    
}

if (isset($_GET["page"]) && $_GET["page"]== "admin" && !isset($_GET["action"])){

    $controllerUser->loginAdmin();
}

if(isset($_GET["page"]) && $_GET["page"]== "Api" && !isset($_GET["action"])){

    header("location:indexApi.php");

}






?>


