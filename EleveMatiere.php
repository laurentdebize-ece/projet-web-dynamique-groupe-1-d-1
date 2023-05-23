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


    <div class="container">
        <button onclick="window.location.href='PAEleve.php'">Mon Compte</button>
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
        <table>
            <tr>
                <th>Les Matières</th>
            </tr>
            <tr>
                <?php //si le BDD existe, faire le traitement
                if ($db_found) {
                    $sql = "SELECT * FROM matiere
            JOIN utilisateurs ON utilisateurs.Idutilisateur = matiere.Idutilisateur";
                    $result = mysqli_query($db_handle, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {  ?>
                
                        <td>
                        <a href="CompetenceParMatiere.php?id=<?php echo $row['Idmatiere']; ?>"><?php echo $row['Noms']. '<br>'; ?> </a>
                        </td>
                        <tr>


                    <?php }
                } ?>
        </table>

    </div>

</body>

</html>
