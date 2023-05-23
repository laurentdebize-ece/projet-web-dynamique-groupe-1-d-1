<link href="PageAccueilPorfesseur.css" rel="stylesheet" type="text/css" />
<?php require('Header.php'); ?>

<a href="ajoutermatiere.php"><input type="submit" name="button1" value="Ajouter"></a>

<?php
// Connexion à la base de données
$database = "BDDECEMYSKILL";
$db_handle = mysqli_connect('localhost', 'root', 'root');
$db_found = mysqli_select_db($db_handle, $database);

if (!$db_found) {
    die("Erreur de connexion à la base de données.");
}

// Fonction pour afficher les matières avec bouton de suppression
function afficherMatieres($db_handle) {
    $sql = "SELECT * FROM Matiere";
    $result = mysqli_query($db_handle, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo "<h2>Liste des matières :</h2>";
        echo "<table>";
        echo "<tr><th>ID</th><th>Nom</th><th>Volume Horaire</th><th>ID Utilisateur</th><th>Action</th></tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row["Idmatiere"] . "</td>";
            echo "<td>" . $row["Nom"] . "</td>";
            echo "<td>" . $row["VolumeHoraire"] . "</td>";
            echo "<td>" . $row["Idutilisateur"] . "</td>";
            echo "<td><button class='btn-supprimer' data-id='" . $row["Idmatiere"] . "'>Supprimer</button></td>";
            echo "<td><a href='modifiermatiere.php?id=" . $row["Idmatiere"] . "'>Modifier</a></td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "Aucune matière trouvée.";
    }
}

// Vérification de l'ID de la matière à supprimer
if (isset($_GET["id"])) {
    $idMatiere = $_GET["id"];

    // Suppression de la matière de la base de données
    $sql = "DELETE FROM Matiere WHERE Idmatiere = '$idMatiere'";

    if (mysqli_query($db_handle, $sql)) {
        echo "La matière a été supprimée avec succès.";
    } else {
        echo "Erreur lors de la suppression de la matière : " . mysqli_error($db_handle);
    }

    exit();
}

// Affichage des matières avant l'ajout
afficherMatieres($db_handle);
mysqli_close($db_handle);
?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Gestionnaire d'événement pour le clic sur le bouton de suppression
        $('.btn-supprimer').click(function() {
            var idMatiere = $(this).data('id');

            // Requête AJAX pour supprimer la matière sans recharger la page
            $.ajax({
                url: '',
                type: 'GET',
                data: { id: idMatiere },
                success: function(response) {
                    // Suppression de la ligne de la table
                    $(this).closest('tr').remove();

                    // Affichage du message de succès
                    alert(response);
                },
                error: function(xhr, status, error) {
                    // Affichage du message d'erreur
                    alert("Erreur lors de la suppression de la matière : " + error);
                }
            });
        });
    });
</script>
