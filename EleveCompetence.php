<?php session_start(); 
require('./Global/Header.php'); 

?>
<div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="PAEleve.php">Acceuil</a>
        </li>
      </ul>
    </div>
  </div>
</nav>


    <div id="nav">
        <button onclick="window.location.href='EleveMatiere.php'">Matière</button>
        <button onclick="window.location.href='PAEleve.php'">Mon Compte</button>
    </div>
    <?php
    //identifier le nom de base de données
    $database = "bddecemyskill";
    //connectez-vous dans votre BDD
//Rappel : votre serveur = localhost | votre login = root | votre mot de pass = '' (rien)
    $db_handle = mysqli_connect('localhost', 'root', 'root');
    $db_found = mysqli_select_db($db_handle, $database);
    ?>

    <div id="section">
        <table>
            <tr>
                <th>Titres</th>
                <th>Description</th>
                <th>Avis</th>

            </tr>
            <tr>
                <?php //si le BDD existe, faire le traitement
                if ($db_found) {
                    $sql = "SELECT * FROM competences
            JOIN matiere ON matiere.Idmatiere = competences.Idmatiere
                JOIN utilisateurs ON utilisateurs.Idutilisateur = matiere.Idutilisateur";
                    $result = mysqli_query($db_handle, $sql);
                    while ($row = mysqli_fetch_assoc($result)) { ?>

                        <td>
                            <?php echo $row['Titre'] . '<br>'; ?>
                        </td>
                        <td>
                            <?php echo $row['Descriptions'] . '<br>'; ?>
                        </td>
                        <td>
                            <form action="EleveCompetence.php" method="post">
                                <input type="radio" name="avis" value="Acquis"> Acquis
                                <br>
                                <input type="radio" name="avis" value="En Cours D'Acquisition"> En Cours D'Acquisition
                                <br>
                                <input type="radio" name="avis" value="Non Acquis">Non Acquis
                                <br>
                                <input type="submit" name="Enregistrer" value="Enregistrer">
                            </form>
                        </td>
                    <tr>


                    <?php }
                } ?>
        </table>
        <?php
        $avis = isset($_POST["avis"])? $_POST["avis"] : "";
   
        if ($db_found) {
            // Modifier une ligne dans la table
            if (isset($_POST["Enregistrer"])) {
                $sql = "UPDATE acquis SET StatutEleve = '$avis' WHERE IdCompetences = '1'";
                // Exécuter la requête SQL
                mysqli_query($db_handle, $sql);

                // Vérifier si la requête a été exécutée avec succès
                if (mysqli_affected_rows($db_handle) != 0) {
                    echo "L'avis de la competence a été modifiée avec succès.";
                } else {
                    echo "Aucune competence n'a été modifiée. Verifiez le titre de la competence a modifier";
                }


            }

        } else {
            echo "Erreur : Impossible de se connecter à la base de données.";
        }

        // Fermer la connexion à la base de données
        mysqli_close($db_handle);

        ?>

    </div>

</body>

</html>
