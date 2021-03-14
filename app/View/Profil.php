
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Votre profil</title>
    <link rel="stylesheet" href="../../css/style.css">
    <script type="text/javascript" src="../../js/main.js"></script>
</head>


<body class="vignet">
    <?php include_once("header.php")?>

    <section class="profil">
    <p><?=$messageAnnulation?></p>
    <h2>Voila votre profil, <?=$_SESSION["pseudo"]?> ! </h2>
    <p>Votre email : <?=$email?></p>
    <p>Votre nb de crédits : <?=$nbCredits?></p>
    <a href="index.php?page=recharge">Acheter des crédits </a>
    <?php if($nbCredits == 1):?>
    <p>Attention ! Il ne vous reste plus qu'1 crédit ! <a href="index.php?page=recharge">Je vais acheter des crédits ! </a></p>
    <?php elseif($nbCredits == 0):?>
    <p>Attention ! Vous n'avez plus de crédit <a href="index.php?page=recharge">Je vais acheter des crédits ! </a></p>
    <?php endif?>

    <?php if($toutesLesCommandes == NULL):?>
    <h2>Vous n'avez reservé aucun cours, pourquoi pas commencer maintenant ? <a href="index.php?page=cours">J'y vais ! </a></h2>
    <?php else :?>

    <h2>Vos reservations ( merci !) </h2>
    <table id="cart-table">
		<?php for($compteur=0; $compteur<sizeof($toutesLesCommandes); $compteur++):?>

       
        
        
		<tr>
			<th>
                <p>N° de commande :<?=$toutesLesCommandes[$compteur]->getIdCommande()?> </p>
                <p id="total-achat" > Prix total : <?=$toutesLesCommandes[$compteur]->getPrixTotal()?> crédit(s)</p> 
			</th>
            
		</tr>

       

            

        <?php for($compteur2=0; $compteur2<sizeof($resultReservationClient[$compteur]); $compteur2++):?>
            
                <tr>
                    <td>Id de reservation : <?=$resultReservationClient[$compteur][$compteur2]["idReservation"]?></td>
                    <td>Jour :<?=$resultReservationClient[$compteur][$compteur2]["jour"]?></td>
                    <td>Heure : <?=$resultReservationClient[$compteur][$compteur2]["heure"]?></td>
                    <td><?=$resultReservationClient[$compteur][$compteur2]["nomCours"]?> <a href="planning.php?id=<?=$resultReservationClient[$compteur][$compteur2]["idCours"]?>?>"> Voir les détails<img id="detail" src="img/magnifying-glass-189254_640.png" alt="detail"></a></td>
		            <td><img src="<?=$resultReservationClient[$compteur][$compteur2]["imgCours"]?>" alt=""></td>
                    <td> <strong><?=$resultReservationClient[$compteur][$compteur2]["prixCours"]?> crédit(s)</strong></td>
                    
                    <td><button><a href="index.php?action=suppReservationConfirmer&idreserv=<?=$resultReservationClient[$compteur][$compteur2]["idReservation"]?>">Annuler cette reservation</a></button></td>
                   
                </tr>   
               
            
            
        <?php endfor?>
        <?php endfor?>
            

	
		</table>

    
    <?php endif;?>

    <?php if($CommandesCredits !=NULL):?>
        <h2>Vos/Votre commande(s) de crédits </h2>

        <ul>

            <?php foreach($CommandesCredits as $cc):?>
                <li>Id de la commande : <?=$cc->getIdCommande?> ------------ Date : <?=$cc->getDate()?> ------------ Prix total : <?=$cc->getPrixTotal()?> ----------- Nombre de crédits achetés : <?=$cc->getPrixTotal()/30?></li>
            <?php endforeach?>
        
        </ul>
        <?php endif?>
    </section>
   
    <div id="footer">
<?php include_once("footer.php")?>
</div>


</body></html>