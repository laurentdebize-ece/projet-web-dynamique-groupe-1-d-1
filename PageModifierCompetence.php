<?php session_start() ?>
<?php 

    require ('./Global/Header.php'); ?>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="PageAcceuilProfesseur.php">Acceuil</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<?php

    $Classe = $_GET['classe'];
    $Promo = $_GET['promo'];

    ?>

    <a href="PageProf.php?classe=<?php echo $Classe;?>&promo=<?php echo $Promo;?>">
    <input type="button" name="Retour" value="Retour">
    </a>



<?php $id = $_GET['id']; ?>

<form action="PageModifierCompetence.php?id=<?php echo $id;?>&classe=<?php echo $Classe;?>&promo=<?php echo $Promo;?>" method="post">
<table border="1">
<tr>
<td size="20">Titre</td>
<td><input type="text" name="titre" size="20"></td>
</tr>
<tr>
<td size="20">Description</td>
<td><input type="text" name="description" size="20"></td>
</tr>
</table>
<input type="submit" name="Modifier" value="Modifier" href="PageProf.php">
</form>

<?php

$database = "bddecemyskill";

$db_handle = mysqli_connect('localhost', 'root', 'root');
$db_found = mysqli_select_db($db_handle, $database);

$titre = isset($_POST["titre"])? $_POST["titre"] : "";
$description = isset($_POST["description"])? $_POST["description"] : "";
// Vérifier si la connexion à la base de données est réussie
if ($db_found) {
    // Modifier une ligne dans la table
    if (isset($_POST["Modifier"])){
    $sql = "UPDATE competences SET Descriptions = '$description', Titre = '$titre' WHERE IdCompetences = '$id'";
    // Exécuter la requête SQL
    mysqli_query($db_handle, $sql);

    // Vérifier si la requête a été exécutée avec succès
    if (mysqli_affected_rows($db_handle) != 0) {
        echo "La competence a été modifiée avec succès.";
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

<?php require('./Global/Footer.php');?>