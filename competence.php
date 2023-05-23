<link href="PageAccueilPorfesseur.css" rel="stylesheet" type="text/css" />
<?php require('Header.php'); ?>

<a href="ajoutercompetence.php"><input type="submit" name="button1" value="Ajouter"></a>

<?php
// Connexion à la base de données
$database = "BDDECEMYSKILL";
$db_handle = mysqli_connect('localhost', 'root', 'root');
$db_found = mysqli_select_db($db_handle, $database);

if (!$db_found) {
    die("Erreur de connexion à la base de données.");
}

// Fonction pour afficher les compétences avec bouton de suppression
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
            echo "<td><button class='btn-supprimer' data-id='" . $row["IdCompetences"] . "'>Supprimer</button></td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "Aucune compétence trouvée.";
    }
}

// Vérification de l'ID de la compétence à supprimer
if (isset($_GET["id"])) {
    $idCompetence = $_GET["id"];

    // Suppression de la compétence de la base de données
    $sql = "DELETE FROM Competences WHERE IdCompetences = '$idCompetence'";

    if (mysqli_query($db_handle, $sql)) {
        echo "La compétence a été supprimée avec succès.";
    } else {
        echo "Erreur lors de la suppression de la compétence : " . mysqli_error($db_handle);
    }

    exit();
}

// Affichage des compétences avant l'ajout
afficherCompetences($db_handle);
mysqli_close($db_handle);
?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Gestionnaire d'événement pour le clic sur le bouton de suppression
        $('.btn-supprimer').click(function() {
            var idCompetence = $(this).data('id');

            // Requête AJAX pour supprimer la compétence sans recharger la page
            $.ajax({
                url: '',
                type: 'GET',
                data: { id: idCompetence },
                success: function(response) {
                    // Suppression de la ligne de la table
                    $(this).closest('tr').remove();
                    alert('La compétence a été supprimée avec succès.');
                }.bind(this),
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                    alert('Erreur lors de la suppression de la compétence.');
                }
            });
        });
    });
</script>
