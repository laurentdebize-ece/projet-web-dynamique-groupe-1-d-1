<link href="PageAccueilPorfesseur.css" rel="stylesheet" type="text/css" />
<?php require ('./Global/Header.php');?>
<?php
$database = "BDDECEMYSKILL";
$db_handle = mysqli_connect('localhost', 'root', 'root');
$db_found = mysqli_select_db($db_handle, $database);

if (!$db_found) {
    die("Erreur de connexion à la base de données.");
}

if (isset($_GET["id"])) {
    $idMatiere = $_GET["id"];

    $sql = "DELETE FROM Matiere WHERE Idmatiere = '$idMatiere'";

    if (mysqli_query($db_handle, $sql)) {
        echo "La matière a été supprimée avec succès.";
    } else {
        echo "Erreur lors de la suppression de la matière : " . mysqli_error($db_handle);
    }
}

mysqli_close($db_handle);
?>