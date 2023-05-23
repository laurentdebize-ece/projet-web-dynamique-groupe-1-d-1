<link href="PageAccueilPorfesseur.css" rel="stylesheet" type="text/css" />
<?php require ('./Global/Header.php');?>
<form action="ajoutercompetence.php" method="post">
    <table border="1">
        <tr>
            <td>Description</td>
            <td><input type="text" name="Description" size="60"></td>
        </tr>
        <tr>
            <td>Titre</td>
            <td><input type="text" name="Titre" size="60"></td>
        </tr>
        <tr>
            <td>ID Matière</td>
            <td><input type="text" name="Idmatiere" size="60"></td>
        </tr>
        <tr>
            <td colspan="2" align="center">
                <input type="submit" name="button1" value="Ajouter">
            </td>
        </tr>
    </table>
</form>

<?php
$database = "BDDECEMYSKILL";
$db_handle = mysqli_connect('localhost', 'root', 'root');
$db_found = mysqli_select_db($db_handle, $database);

if (!$db_found) {
    die("Erreur de connexion à la base de données.");
}

if (isset($_POST["button1"])) {
    $description = $_POST['Description'];
    $titre = $_POST['Titre'];
    $idMatiere = $_POST['Idmatiere'];

    if ($db_found) {
        $sql = "SELECT * FROM Competences WHERE Description = '$description' AND Idmatiere = '$idMatiere'";
        $result = mysqli_query($db_handle, $sql);

        if ($result === false) {
            echo "<p>Erreur :</p>" . mysqli_error($db_handle);
        } else if (mysqli_num_rows($result) != 0) {
            echo "<p>La compétence existe déjà.</p>";
        } else {
            $sql = "INSERT INTO Competences (Description, Titre, Idmatiere) VALUES ('$description', '$titre', '$idMatiere')";

            if (mysqli_query($db_handle, $sql)) {
                echo "La compétence a été ajoutée avec succès.";
                mysqli_close($db_handle);
                header("Location: competence.php");
                exit();
            } else {
                echo "Erreur lors de l'ajout de la compétence : " . mysqli_error($db_handle);
            }
        }
    }
}
mysqli_close($db_handle);
?>
