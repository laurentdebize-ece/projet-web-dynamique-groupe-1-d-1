<link href="PageAccueilPorfesseur.css" rel="stylesheet" type="text/css" />
<?php require ('./Global/Header.php');?>
<div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="PAEleve.php">Acceuil</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<form action="ajouterprof.php" method="post">
    <table border="1">
        <tr>
            <td>Prenom</td>
            <td><input type="text" name="Prenom" size="60"></td>
        </tr>
        <tr>
            <td>Nom</td>
            <td><input type="text" name="Nom" size="60"></td>
        </tr>
        <tr>
            <td>Email</td>
            <td><input type="email" name="Email" size="60"></td>
        </tr>
        <tr>
            <td>Mot de passe</td>
            <td><input type="password" name="Mdp" size="60"></td>
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

$prenom = isset($_POST["Prenom"]) ? $_POST["Prenom"] : "";
$nom = isset($_POST["Nom"]) ? $_POST["Nom"] : "";
$email = isset($_POST["Email"]) ? $_POST["Email"] : "";
$mdp = isset($_POST["Mdp"]) ? $_POST["Mdp"] : "";

if (isset($_POST["button1"])) {

if ($prenom == "") {
        $erreur = "Le champ Prenom est vide. Veuillez le renseigner. <br>";
        echo "Attention : " . $erreur;
}

if ($nom == "") {
    $erreur = "Le champ Nom est vide. Veuillez le renseigner. <br>";
    echo "Attention : " . $erreur;
}

if ($email == "") {
    $erreur = "Le champ E-mail est vide. Veuillez le renseigner. <br>";
    echo "Attention : " . $erreur;
}

if ($mdp == "") {
    $erreur = "Le champ Mot de passe est vide. Veuillez le renseigner. <br>";
    echo "Attention : " . $erreur;
}

if ($prenom && $nom && $email && $mdp){

    if ($db_found) {
        $sql = "SELECT * FROM Utilisateurs WHERE Email = '$email'";
        $result = mysqli_query($db_handle, $sql);

        if ($result === false) {
            echo "<p>Erreur :</p>" . mysqli_error($db_handle);
        } else if (mysqli_num_rows($result) != 0) {
            echo "<p>L'utilisateur existe déjà.</p>";
        } else {
            $sql = "INSERT INTO Utilisateurs (Prenom, Nom, Email, Mdp, Role) VALUES ('$prenom', '$nom', '$email', '$mdp', 'professeur')";

            if (mysqli_query($db_handle, $sql)) {
                echo "L'utilisateur a été ajouté avec succès.";
                mysqli_close($db_handle);
                header("Location: prof.php"); 
                exit();
            } else {
                echo "Erreur lors de l'ajout de l'utilisateur : " . mysqli_error($db_handle);
            }
        }
    }
}
}
mysqli_close($db_handle);
?>