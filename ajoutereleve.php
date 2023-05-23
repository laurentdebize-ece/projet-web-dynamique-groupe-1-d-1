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

<form action="ajoutereleve.php" method="post">
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
            <td>Promo</td>
            <td><input type="text" name="promo" size="60"></td>
        </tr>
        <tr>
            <td>Classe</td>
            <td><input type="text" name="classe" size="60"></td>
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
$promo = isset($_POST["promo"]) ? $_POST["promo"] : "";
$classe = isset($_POST["classe"]) ? $_POST["classe"] : "";

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

if ($promo == "") {
    $erreur = "Le champ Promo est vide. Veuillez le renseigner. <br>";
    echo "Attention : " . $erreur;
    }

if ($classe == "") {
        $erreur = "Le champ Classe est vide. Veuillez le renseigner. <br>";
        echo "Attention : " . $erreur;
}

if ($prenom && $nom && $email && $mdp && $promo && $classe){

    if ($db_found) {
            $sql = "SELECT * FROM Utilisateurs WHERE Email = '$email'";
            $result = mysqli_query($db_handle, $sql);
        
            if (!$result) {
                echo "<p>Erreur :</p>" . mysqli_error($db_handle);
            } elseif (mysqli_num_rows($result) != 0) {
                echo "<p>L'utilisateur existe déjà.</p>";
            } else {
                $sql = "INSERT INTO Utilisateurs (Prenom, Nom, Email, Mdp, Role) VALUES ('$prenom', '$nom', '$email', '$mdp', 'etudiant')";
                if (mysqli_query($db_handle, $sql)) {
                    $idUtilisateur = mysqli_insert_id($db_handle);
                    $sql = "INSERT INTO Promo (Promo, Idutilisateur) VALUES ('$promo', '$idUtilisateur')";
                    if (mysqli_query($db_handle, $sql)) {
                        $sql = "INSERT INTO Classe (Ecole, Groupe, Idutilisateur) VALUES ('ECE', '$classe', '$idUtilisateur')";
                        if (mysqli_query($db_handle, $sql)) {
                        echo "L'utilisateur a été ajouté avec succès.";
                        mysqli_close($db_handle);
                        header("Location: eleve.php");
                        exit();
                    } else {
                        echo "Erreur lors de l'ajout de l'utilisateur dans la table Promo : " . mysqli_error($db_handle);
                    }
                } else {
                    echo "Erreur lors de l'ajout de l'utilisateur dans la table Utilisateurs : " . mysqli_error($db_handle);
                }
            }
        }
        }
}
        
}
mysqli_close($db_handle);
?>

<?php require('./Global/Footer.php');?>