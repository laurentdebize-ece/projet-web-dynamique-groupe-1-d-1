<?php session_start(); 
require('./Global/Header.php'); 

?>
<div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="PageAcceuilProfesseur.php">Acceuil</a>
        </li>
      </ul>
    </div>
</nav>

<?php

$database = "bddecemyskill";

$db_handle = mysqli_connect('localhost', 'root', 'root');
$db_found = mysqli_select_db($db_handle, $database);

$promo = isset($_POST["promo"]) ? $_POST["promo"] : "";
$classe = isset($_POST["classe"]) ? $_POST["classe"] : "";
$erreur = "";

if ($classe == "") {
    if (empty($_GET['classe'])) {
        $erreur = "Le champ Classe est vide. Veuillez revenir à l'acceuil et sélectionner une classe. <br>";
        echo "Attention : " . $erreur;
    } else {
        $classe = $_GET['classe'];
    }
}

if ($promo == "") {
    if (empty($_GET['promo'])) {
        $erreur = "Le champ Promo est vide. Veuillez revenir à l'acceuil et sélectionner une classe. <br>";
        echo "Attention : " . $erreur;
    } else {
        $promo = $_GET['promo'];
    }
}

if ($classe && $promo) {
    if ($db_found) {
        $sql = "SELECT * FROM competences
                JOIN matiere ON matiere.Idmatiere = competences.Idmatiere
                JOIN utilisateurs ON utilisateurs.Idutilisateur = matiere.Idutilisateur
                JOIN promo ON promo.Idutilisateur = utilisateurs.Idutilisateur
                JOIN classe ON classe.Idutilisateur = utilisateurs.Idutilisateur
                WHERE promo.promo LIKE '%$promo%' AND classe.groupe LIKE '%$classe%'";
        $result = mysqli_query($db_handle, $sql);
?>
        <form action="PageModifierCompetence.php" method="post">
            <table class="table table-hover">
                <tr>
                    <th scope="col">Titre</th>
                    <th scope="col">Description</th>
                    <th scope="col">Options</th>
                </tr>
                <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                    <tr>
                        <?php $id = $row['IdCompetences']; ?>
                        <td><?php echo $row['Titre']; ?></td>
                        <td><?php echo $row['Descriptions']; ?></td>
                        <td><a href="PageAcquisEleveCompetence.php?id=<?php echo $row['Titre']; ?>&classe=<?php echo $classe; ?>&promo=<?php echo $promo; ?>">Voir plus</a></td>
                        <td><a href="PageModifierCompetence.php?id=<?php echo $id; ?>&classe=<?php echo $classe; ?>&promo=<?php echo $promo; ?>" class="btn btn-warning">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                </svg>
                            </a>
                        </td>
        </form>
        <form action="PageProf.php?id=<?php echo $id; ?>&classe=<?php echo $classe; ?>&promo=<?php echo $promo; ?>" method="post">
        <td>
            <button type="submit" class="btn btn-danger" name="Supprimer" value=<?php echo $id ?>>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z" />
                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z" />
                </svg>
            </button>
        </td>
        </form>
        </tr>
    <?php endwhile; ?>
    </table>

<?php
    } else {
        echo "<br>Database not found";
    }
}
?>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    + Ajouter
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Nouvelle compétence</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="PageProf.php?classe=<?php echo $classe; ?>&promo=<?php echo $promo; ?>" method="post">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Titre</label>
                        <input type="text" class="form-control" name="titre" id="exampleFormControlInput1" placeholder="Titre compétence">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Description</label>
                        <input type="text" class="form-control" name="description" id="exampleFormControlInput1">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-secondary" data-bs-dismiss="modal" value="Fermer">
                    <input type="submit" class="btn btn-primary" name="Ajouter" value="Ajouter">
                </div>
            </form>
        </div>
    </div>
</div>

<?php

$database = "bddecemyskill";

$db_handle = mysqli_connect('localhost', 'root', 'root');
$db_found = mysqli_select_db($db_handle, $database);

$titre = isset($_POST["titre"]) ? $_POST["titre"] : "";
$description = isset($_POST["description"]) ? $_POST["description"] : "";

if (isset($_POST["Ajouter"])) {
    if ($db_found) {
        //on cherche la compétence
        $sql = "SELECT * FROM competences WHERE competences.Titre LIKE '%$titre%' AND competences.Descriptions LIKE '%$description%'";
        $result = mysqli_query($db_handle, $sql);
        //regarder s'il y a de resultat

        if ($result === false) {
            // La requête a échoué, afficher un message d'erreur
            echo "<p>Une erreur est survenue lors de l'ajout.</p>" . mysqli_error($db_handle);
        } elseif (mysqli_num_rows($result) != 0) {
            // Il y a déjà une compétence avec le même titre et la même description
            echo "<p>Cette compétence existe deja.</p>";
        } else {
            // Ajouter la compétence dans la base de données
            $sql = "INSERT INTO competences (Descriptions , Titre, Idmatiere) VALUES ('$description', '$titre', '$_SESSION[Idmatiere]')";
            $result = mysqli_query($db_handle, $sql);
            echo "<p>Ajout réussi.</p>";
        }
    } else {
        echo "<p>Erreur de connexion à la base de données.</p>";
    }
}

if (isset($_POST['titre']) && isset($_POST['description'])) {
    $string = "Location: PageProf.php?classe=";
    $string1 = "&promo=";
    header($string . $classe . $string1 . $promo);
}


if (isset($_POST["Supprimer"])) {
    $valeur = isset($_POST["Supprimer"]) ? $_POST["Supprimer"] : "";
    if ($db_found) {
        $sql = "DELETE FROM competences WHERE competences.IdCompetences = '$valeur'";
        $result = mysqli_query($db_handle, $sql);
        echo "<p>Suppression reussie.</p>";
    } else {
        echo "<p>Erreur de connexion à la base de données.</p>";
    }
}

mysqli_close($db_handle);

?>

<?php require('./Global/Footer.php'); ?>