<link href="Admin.css" rel="stylesheet" type="text/css" />
<?php require ('./Global/Header.php');?>
<div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="menu.php">Acceuil</a>
        </li>
      </ul>
    </div>
</nav>
<a href="ajoutereleve.php"><input type="submit" name="button1" value="Ajouter"></a>

<?php
$database = "BDDECEMYSKILL";
$db_handle = mysqli_connect('localhost', 'root', 'root');
$db_found = mysqli_select_db($db_handle, $database);

if (!$db_found) {
    die("Erreur de connexion à la base de données.");
}

function afficherUtilisateurs($db_handle) {
    $sql = "SELECT * FROM Utilisateurs WHERE Role = 'etudiant'";
    $result = mysqli_query($db_handle, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo "<h2>Liste des étudiants :</h2>";
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
            echo "<td><a href='modifiereleve.php?id=" . $row["Idutilisateur"] . "'>Modifier</a></td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "Aucun utilisateur trouvé.";
    }
}

if (isset($_GET["id"])) {
    $idUtilisateur = $_GET["id"];

    $sql = "DELETE FROM Utilisateurs WHERE Idutilisateur = '$idUtilisateur'";

    if (mysqli_query($db_handle, $sql)) {
        echo "L'utilisateur a été supprimé avec succès.";
    } else {
        echo "Erreur lors de la suppression de l'utilisateur : " . mysqli_error($db_handle);
    }

    exit();
}

afficherUtilisateurs($db_handle);
mysqli_close($db_handle);
?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.btn-supprimer').click(function() {
            var idUtilisateur = $(this).data('id');
            var btnSupprimer = $(this);

            $.ajax({
                url: '',
                type: 'GET',
                data: { id: idUtilisateur },
                success: function(response) {
                    btnSupprimer.closest('tr').remove();
                    alert('L\'utilisateur a été supprimé avec succès.');
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                    alert('Erreur lors de la suppression de l\'utilisateur.');
                }
            });
        });
    });
</script>

<?php require('./Global/Footer.php');?>
