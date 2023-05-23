<link href="PageAccueilPorfesseur.css" rel="stylesheet" type="text/css" />
<?php require ('./Global/Header.php');?>
<div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="menu.php">Acceuil</a>
        </li>
      </ul>
    </div>
</nav>
<?php
if (isset($_GET["id"])) {
    $idUtilisateur = $_GET["id"];

    $database = "BDDECEMYSKILL";
    $db_handle = mysqli_connect('localhost', 'root', 'root');
    $db_found = mysqli_select_db($db_handle, $database);

    if (!$db_found) {
        die("Erreur de connexion à la base de données.");
    }

    $sql = "SELECT * FROM Utilisateurs WHERE Idutilisateur = '$idUtilisateur'";
    $result = mysqli_query($db_handle, $sql);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        $prenom = $row["Prenom"];
        $nom = $row["Nom"];
        $email = $row["Email"];
        $mdp = $row["Mdp"];
        $role = $row["Role"];
    } else {
        echo "Utilisateur introuvable.";
        exit();
    }

    mysqli_close($db_handle);
} else {
    echo "ID d'utilisateur non spécifié.";
    exit();
}
?>

<h2>Modifier un utilisateur :</h2>

<form method="post" action="">
    <label for="prenom">Prénom :</label>
    <input type="text" name="prenom" value="<?php echo $prenom; ?>" required><br>

    <label for="nom">Nom :</label>
    <input type="text" name="nom" value="<?php echo $nom; ?>" required><br>

    <label for="email">Email :</label>
    <input type="email" name="email" value="<?php echo $email; ?>" required><br>

    <label for="mdp">Mot de passe :</label>
    <input type="password" name="mdp" value="<?php echo $mdp; ?>" required><br>

    <label for="role">Role :</label>
    <input type="text" name="role" value="<?php echo $role; ?>" required><br>

    <input type="submit" name="modifier" value="Modifier">
</form>

<?php
if (isset($_POST["modifier"])) {
    $prenom = $_POST["prenom"];
    $nom = $_POST["nom"];
    $email = $_POST["email"];
    $mdp = $_POST["mdp"];
    $role = $_POST["role"];

    $database = "BDDECEMYSKILL";
    $db_handle = mysqli_connect('localhost', 'root', 'root');
    $db_found = mysqli_select_db($db_handle, $database);

    if (!$db_found) {
        die("Erreur de connexion à la base de données.");
    }

    $sql = "UPDATE Utilisateurs SET Prenom = '$prenom', Nom = '$nom', Email = '$email', Mdp = '$mdp', Role = '$role' WHERE Idutilisateur = '$idUtilisateur'";

    if (mysqli_query($db_handle, $sql)) {
        mysqli_close($db_handle);
        header("Location: prof.php");
        exit();
    } else {
        echo "Erreur lors de la modification de l'utilisateur : " . mysqli_error($db_handle);
    }

    mysqli_close($db_handle);
}
?>

<?php require('./Global/Footer.php');?>