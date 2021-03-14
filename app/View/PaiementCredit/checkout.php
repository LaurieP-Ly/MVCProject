

<!DOCTYPE html>

<html>

  <head>

  <link href="app/View/PaiementCredit/css/style.css" rel="stylesheet">

    <title>Paiement</title>


    <script src="https://polyfill.io/v3/polyfill.min.js?version=3.52.1&features=fetch"></script>

    <script src="https://js.stripe.com/v3/"></script>
    

  </head>

  

  <body>  

    <section>

    <header>
        <h2>Validation des reservations</h2>



    </header>


      <div class="reserv">
      <?php for($i=0; $i<sizeof($_SESSION["tousLesCours"]); $i++):?>

        <img

          src="../../../<?=$_SESSION["tousLesCours"][$i]->getImgCours()?>"
          alt="<?=$_SESSION["tousLesCours"][$i]->getNom()?>"

        />
        <h3><?=$_SESSION["tousLesCours"][$i]->getNom()?></h3>

        <div class="descriptionArticle">

          <h3>Jour : <?=$_SESSION["tousLesHoraires"][$i]->getJour()?></h3>
          <h3>Heure : <?=$_SESSION["tousLesHoraires"][$i]->getHeure()?></h3>

          <p><?=$_SESSION["tousLesCours"][$i]->getPrix()?> crédit(s)</p>
          

        </div>

      <?php endfor?>

        <strong>Prix total : <?=$_SESSION["prix_total"]?> crédit(s)</strong>

      </div>
      <p>Voulez-vous utiliser <?=$_SESSION["prix_total"]?> crédit(s) ? </p>
      <a href="../../../index.php?action=annule">---Annuler---</a>
      <a href="../../../index.php?action=valide">---Je valide ! ---</a>

    </section>

    

  </body>

</html>