<form action="ajoutermatiere.php" method="post">
    <table border="1">
        <tr>
            <td size="20">Nom</td>
            <td><input type="text" name="Nom" size="60"></td>
        </tr>
        <tr>
            <td size="20">Volume Horaire</td>
            <td><input type="text" name="VolumeHoraire" size="60"></td>
        </tr>
        <tr>
            <td size="20">ID Utilisateur</td>
            <td><input type="text" name="Idutilisateur" size="60"></td>
        </tr>
        <tr>
            <td colspan="2" align="center">
                <input type="submit" name="button1" value="Ajouter">
            </td>
        </tr>
    </table>
</form>

<?php
// Connexion à la base de données
$database = "BDDECEMYSKILL";
$db_handle = mysqli_connect('localhost', 'root', 'root');
$db_found = mysqli_select_db($db_handle, $database);

if (!$db_found) {
    die("Erreur de connexion à la base de données.");
}

if (isset($_POST["button1"])) {
    $nom = $_POST['Nom'];
    $volumeHoraire = $_POST['VolumeHoraire'];
    $idUtilisateur = $_POST['Idutilisateur'];

    if ($db_found) {
        // Vérification si la matière existe déjà
        $sql = "SELECT * FROM Matiere WHERE Nom = '$nom'";
        $result = mysqli_query($db_handle, $sql);

        if ($result === false) {
            echo "<p>Erreur :</p>" . mysqli_error($db_handle);
        } else if (mysqli_num_rows($result) != 0) {
            echo "<p>La matière existe déjà.</p>";
        } else {
            // Ajout de la matière
            $sql = "INSERT INTO Matiere (Nom, VolumeHoraire, Idutilisateur) VALUES ('$nom', '$volumeHoraire', '$idUtilisateur')";

            if (mysqli_query($db_handle, $sql)) {
                echo "La matière a été ajoutée avec succès.";
                mysqli_close($db_handle);
                header("Location: matiere.php"); // Redirection vers la page matiere.php
                exit();
            } else {
                echo "Erreur lors de l'ajout de la matière : " . mysqli_error($db_handle);
            }
        }
    }
}

mysqli_close($db_handle);
?>
