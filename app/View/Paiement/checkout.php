

<!DOCTYPE html>

<html>

  <head>

  <link href="app/View/Paiement/css/style.css" rel="stylesheet">

    <title>Paiement</title>


    <script src="https://polyfill.io/v3/polyfill.min.js?version=3.52.1&features=fetch"></script>

    <script src="https://js.stripe.com/v3/"></script>
    

  </head>

  

  <body>  

    <section>

    <header>
        <h2>Validation du paiement des crédits</h2>



    </header>


      <div class="reserv">

        <h2>Nombre de crédits voulu :  <?=$_SESSION["nb"]?></h2>
      
        <strong>Prix total : <?=$_SESSION["prix_total"]?> €</strong>

      </div>

      <button id="checkout-button">Valider et payer</button>
      <a href="../../../index.php?action=annuleCredit">---Annuler---</a>
      <a href="../../../index.php?action=crediter&credits=<?=$_SESSION["nb"]?>">---Payé ! ( Simulation )---</a>

    </section>

    

  </body>

  
  
  <script type="text/javascript">

    // Create an instance of the Stripe object with your publishable API key

    var stripe = Stripe("pk_test_TYooMQauvdEDq54NiTphI7jx");

    var checkoutButton = document.getElementById("checkout-button");
    

    checkoutButton.addEventListener("click", function () {

      fetch("app/View/Paiement/create-session.php", {

        method: "POST",

      })

        .then(function (response) {

          return response.json();

        })

        .then(function (session) {

          return stripe.redirectToCheckout({ sessionId: session.id });

        })

        .then(function (result) {

          // If redirectToCheckout fails due to a browser or network

          // error, you should display the localized error message to your

          // customer using error.message.

          if (result.error) {

            alert(result.error.message);

          }

        })

        .catch(function (error) {

          console.error("Error:", error);

        });

    });

  </script>