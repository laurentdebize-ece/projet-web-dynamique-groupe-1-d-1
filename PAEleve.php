<?php session_start(); 
require('./Global/Header.php'); ?>

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
        <button onclick="window.location.href='EleveCompetence.php'">Compétences</button>
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
        <?php 
        echo $_SESSION['Idutilisateur'];
        if ($db_found) {
            $sql = "SELECT * FROM utilisateurs WHERE Idutilisateur = '$_SESSION[Idutilisateur]'";
            $result = mysqli_query($db_handle, $sql);
            while ($row = mysqli_fetch_assoc($result)) { ?>

                <h2>
                    <?php echo " Bonjour  " . $row['Prenom'] . '<br>'; ?>
                </h2>
                <li>
                    <?php echo "ID Utilisateur: " . $row['Idutilisateur'] . '<br>'; ?>
                </li>
                <li>
                    <?php echo "Nom:" . $row['Nom'] . '<br>'; ?>
                </li>
                <li>
                    <?php echo "Prénom: " . $row['Prenom'] . '<br>'; ?>
                </li>
                <li>
                    <?php echo "Statut: " . $row['Role'] . '<br>'; ?>
                </li>
                <li>
                    <?php echo "Email: " . $row['Email'] . '<br>'; ?>
                </li>
                <li>
                    <?php echo "Mot de passe: " . $row['Mdp'] . '<br>'; ?>
                </li>

            <?php }
        } ?>
    </div>

</body>

</html>
