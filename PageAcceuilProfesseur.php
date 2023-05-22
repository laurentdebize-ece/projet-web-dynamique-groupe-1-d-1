<link href="PageAccueilPorfesseur.css" rel="stylesheet" type="text/css" />

<?php require ('./Global/Header.php');?>

    <h2>Page d'acceuil professeur</h2>

    <p1> 

        <form id="choix-promo-classe" action="PageProf.php" method="post">
            Choisissez la promo que vous voulez consulter :<br>
            <label>
                <input type="checkbox" name="promo" value="Promo 1"> Promo 1
            </label>
              <br>
              <label>
                <input type="checkbox" name="promo" value="Promo 2"> Promo 2
            </label>
              <br>
              <label>
                <input type="checkbox" name="promo" value="Promo 3"> Promo 3
            </label>
              <br>
              Choisissez la classe que vous voulez associer : <br>
              <label>
                <input type="checkbox" name="classe" value="Classe 1"> Classe 1
            </label>
              <br>
              <label>
                <input type="checkbox" name="classe" value="Classe 2"> Classe 2
            </label>
              <br>
              <label>
                <input type="checkbox" name="classe" value="Classe 3"> Classe 3
            </label>
              <br>
              <button type="submit">Envoyer</button>
        </form>


    </p1>


    <?php require('./Global/Footer.php');?>