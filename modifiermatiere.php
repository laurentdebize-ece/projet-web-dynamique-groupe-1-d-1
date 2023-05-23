<link href="PageAccueilPorfesseur.css" rel="stylesheet" type="text/css" />
<?php require('Header.php'); ?>

<?php
// Vérification de l'ID de la matière à modifier
if (isset($_GET["id"])) {
    $idMatiere = $_GET["id"];

    // Connexion à la base de données
    $database = "BDDECEMYSKILL";
    $db_handle = mysqli_connect('localhost', 'root', 'root');
    $db_found = mysqli_select_db($db_handle, $database);

    if (!$db_found) {
        die("Erreur de connexion à la base de données.");
    }

    // Récupération des informations de la matière
    $sql = "SELECT * FROM Matiere WHERE Idmatiere = '$idMatiere'";
    $result = mysqli_query($db_handle, $sql);
    $row = mysqli_fetch_assoc($result);

    // Vérification si la matière existe
    if ($row) {
        $nomMatiere = $row["Nom"];
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
// Vérification de la soumission du formulaire de modification
if (isset($_POST["modifier"])) {
    $nom = $_POST["nom"];
    $volumeHoraire = $_POST["volumeHoraire"];

    // Connexion à la base de données
    $database = "BDDECEMYSKILL";
    $db_handle = mysqli_connect('localhost', 'root', 'root');
    $db_found = mysqli_select_db($db_handle, $database);

    if (!$db_found) {
        die("Erreur de connexion à la base de données.");
    }

    // Mise à jour des informations de la matière
    $sql = "UPDATE Matiere SET Nom = '$nom', VolumeHoraire = '$volumeHoraire' WHERE Idmatiere = '$idMatiere'";

    if (mysqli_query($db_handle, $sql)) {
        mysqli_close($db_handle);
        // Redirection vers la page matiere.php
        header("Location: matiere.php");
        exit();
    } else {
        echo "Erreur lors de la modification de la matière : " . mysqli_error($db_handle);
    }

    mysqli_close($db_handle);
}
?>
