<link href="PageAccueilPorfesseur.css" rel="stylesheet" type="text/css" />
<?php require('Header.php'); ?>

<a href="ajouterprof.php"><input type="submit" name="button1" value="Ajouter"></a>

<?php
// Connexion à la base de données
$database = "BDDECEMYSKILL";
$db_handle = mysqli_connect('localhost', 'root', 'root');
$db_found = mysqli_select_db($db_handle, $database);

if (!$db_found) {
    die("Erreur de connexion à la base de données.");
}

// Fonction pour afficher les utilisateurs avec bouton de suppression
function afficherUtilisateurs($db_handle) {
    $sql = "SELECT * FROM Utilisateurs WHERE Role = 'professeur'";
    $result = mysqli_query($db_handle, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo "<h2>Liste des utilisateurs :</h2>";
        echo "<table>";
        echo "<tr><th>ID</th><th>Prénom</th><th>Nom</th><th>Email</th><th>Mot de passe</th><th>Rôle</th><th>Action</th></tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row["Idutilisateur"] . "</td>";
            echo "<td>" . $row["Prenom"] . "</td>";
            echo "<td>" . $row["Nom"] . "</td>";
            echo "<td>" . $row["Email"] . "</td>";
            echo "<td>" . $row["Mdp"] . "</td>";
            echo "<td>" . $row["Role"] . "</td>";
            echo "<td><button class='btn-supprimer' data-id='" . $row["Idutilisateur"] . "'>Supprimer</button></td>";
            echo "<td><a href='modifierprof.php?id=" . $row["Idutilisateur"] . "'>Modifier</a></td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "Aucun utilisateur trouvé.";
    }
}

// Vérification de l'ID de l'utilisateur à supprimer
if (isset($_GET["id"])) {
    $idUtilisateur = $_GET["id"];

    // Suppression de l'utilisateur de la base de données
    $sql = "DELETE FROM Utilisateurs WHERE Idutilisateur = '$idUtilisateur'";

    if (mysqli_query($db_handle, $sql)) {
        echo "L'utilisateur a été supprimé avec succès.";
    } else {
        echo "Erreur lors de la suppression de l'utilisateur : " . mysqli_error($db_handle);
    }

    exit();
}

// Affichage des utilisateurs avant l'ajout
afficherUtilisateurs($db_handle);
mysqli_close($db_handle);
?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Gestionnaire d'événement pour le clic sur le bouton de suppression
        $('.btn-supprimer').click(function() {
            var idUtilisateur = $(this).data('id');

            // Requête AJAX pour supprimer l'utilisateur sans recharger la page
            $.ajax({
                url: '',
                type: 'GET',
                data: { id: idUtilisateur },
                success: function(response) {
                    // Suppression de la ligne de la table
                    $(this).closest('tr').remove();

                    // Affichage du message de succès
                    alert(response);
                },
                error: function(xhr, status, error) {
                    // Affichage du message d'erreur
                    alert("Erreur lors de la suppression de l'utilisateur : " + error);
                }
            });
        });
    });
</script>
