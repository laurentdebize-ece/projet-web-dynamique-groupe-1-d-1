<link href="PageAccueilPorfesseur.css" rel="stylesheet" type="text/css" />
<?php require ('./Global/Header.php');?>
<div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="menu.php">Acceuil</a>
        </li>
      </ul>
    </div>
</nav>
<?php
if (isset($_GET["id"])) {
    $idMatiere = $_GET["id"];

    $database = "BDDECEMYSKILL";
    $db_handle = mysqli_connect('localhost', 'root', 'root');
    $db_found = mysqli_select_db($db_handle, $database);

    if (!$db_found) {
        die("Erreur de connexion à la base de données.");
    }

    $sql = "SELECT * FROM Matiere WHERE Idmatiere = '$idMatiere'";
    $result = mysqli_query($db_handle, $sql);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        $nomMatiere = $row["Noms"];
        $volumeHoraireMatiere = $row["VolumeHoraire"];
    } else {
        echo "Matière introuvable.";
        exit();
    }

    mysqli_close($db_handle);
} else {
    echo "ID de matière non spécifié.";
    exit();
}
?>

<h2>Modifier une matière :</h2>

<form method="post" action="">
    <label for="nom">Nom :</label>
    <input type="text" name="nom" value="<?php echo $nomMatiere; ?>" required><br>

    <label for="volumeHoraire">Volume Horaire :</label>
    <input type="text" name="volumeHoraire" value="<?php echo $volumeHoraireMatiere; ?>" required><br>

    <input type="submit" name="modifier" value="Modifier">
</form>

<?php
if (isset($_POST["modifier"])) {
    $nom = $_POST["nom"];
    $volumeHoraire = $_POST["volumeHoraire"];

    $database = "BDDECEMYSKILL";
    $db_handle = mysqli_connect('localhost', 'root', 'root');
    $db_found = mysqli_select_db($db_handle, $database);

    if (!$db_found) {
        die("Erreur de connexion à la base de données.");
    }

    $sql = "UPDATE Matiere SET Nom = '$nom', VolumeHoraire = '$volumeHoraire' WHERE Idmatiere = '$idMatiere'";

    if (mysqli_query($db_handle, $sql)) {
        mysqli_close($db_handle);
        header("Location: matiere.php");
        exit();
    } else {
        echo "Erreur lors de la modification de la matière : " . mysqli_error($db_handle);
    }

    mysqli_close($db_handle);
}
?>

<?php require('./Global/Footer.php');?>
