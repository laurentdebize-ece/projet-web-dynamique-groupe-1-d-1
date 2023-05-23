<link href="PageAccueilPorfesseur.css" rel="stylesheet" type="text/css" />
<?php require ('./Global/Header.php');?>

<a href="ajoutercompetence.php"><input type="submit" name="button1" value="Ajouter"></a>

<?php
$database = "BDDECEMYSKILL";
$db_handle = mysqli_connect('localhost', 'root', 'root');
$db_found = mysqli_select_db($db_handle, $database);

if (!$db_found) {
    die("Erreur de connexion à la base de données.");
}

function afficherCompetences($db_handle) {
    $sql = "SELECT * FROM Competences";
    $result = mysqli_query($db_handle, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo "<h2>Liste des compétences :</h2>";
        echo "<table>";
        echo "<tr><th>ID</th><th>Description</th><th>Titre</th><th>ID Matière</th><th>Action</th></tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row["IdCompetences"] . "</td>";
            echo "<td>" . $row["Description"] . "</td>";
            echo "<td>" . $row["Titre"] . "</td>";
            echo "<td>" . $row["Idmatiere"] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "Aucune compétence trouvée.";
    }
}

afficherCompetences($db_handle);
mysqli_close($db_handle);
?>

