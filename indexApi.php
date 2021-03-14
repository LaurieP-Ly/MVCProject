<?php
/******************autoload************************/
function chargerClasse($classe){


    $classe= str_replace("\\", '/', $classe);

    require ("$classe".'.php');
}

spl_autoload_register('ChargerClasse');

/*****************classes*******************************/

use app\Controller\controllerHoraires;
use app\Controller\controllerClients;
use app\Controller\controllerCours;
use app\Controller\controllerRecette;
use app\Controller\controllerCategorie;
use app\Controller\controllerCommande;
use app\Controller\controllerReservation;
use app\Controller\controllerUser;
use app\Controller\controllerCommandeCredit;

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
}else{

    $api=array();

$apiCategorie=$controllerCategorie->getApi("Categorie");
array_push($api, $apiCategorie);
$apiCommande=$controllerCommande->getApi("Commande");
array_push($api, $apiCommande);
$apiCours=$controllerCours->getApi("Cours");
array_push($api, $apiCours);
$apiHoraire=$controllerHoraires->getApi("Horaires");
array_push($api, $apiHoraire);
$apiRecette=$controllerRecette->getApi("Recettes");
array_push($api, $apiRecette);
$apiReservations=$controllerReservation->getApi("Reservations");
array_push($api, $apiReservations);
$apiCc=$controllerCommandeCredit->getApi("CommandeCredit");
array_push($api, $apiCc);


//Pour les clients et les users, la fonction est différente car on n'affiche pas le mot de passe
$apiClient=$ControllerClients->getApiClient();
array_push($api, $apiClient);

$apiUser=$controllerUser->getApiUser();
array_push($api, $apiUser);


include("app/View/api/viewApi.php");

}




?>