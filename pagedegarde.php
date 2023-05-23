<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="pagedegarde.css" type="text/css" rel="stylesheet"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body> 
    <div class = tout>
        <image src="citroen.png" id="picture"></image>
        <div class = contenu>
            <img src="omnes.png" alt="test"><br>
            <form method="post" action="pagedegarde.php">
                <input type="email" id="email" name="email" placeholder="Email:" required><br><br>
                <input type="password" id="mdp" name="mdp" placeholder="Mot de passe:" required><br><br>
                <input type="submit" id="submit" value ="submit">
            </form>
        </div>
    </div>
    <footer>© 2023 Groupe-1-D, Samuel SIDOUN Mael BESREST Eva AFONSO Amine DAGHIGHI</footer>
</body>
</html>

<?php

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$database ="bddecemyskill";
$db_handle = mysqli_connect('localhost','root','root');
$db_found = mysqli_select_db($db_handle, $database);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = test_input($_POST['email']);
    $password = test_input($_POST['mdp']);

    $requete = "SELECT * FROM Utilisateurs WHERE Email = '$email' AND Mdp = '$password'";
    $resultats = mysqli_query($db_handle, $requete);
    if($resultats){
        if(mysqli_num_rows($resultats) > 0){
            $row = mysqli_fetch_assoc($resultats);
            $_SESSION['Idutilisateur'] = $row['Idutilisateur'];
            $_SESSION['Idmatiere'] = $row['Idmatiere'];
            $role = $row['Role'];
            if ($role == 'professeur') {
                header("Location: PageAcceuilProfesseur.php"); // remplacer par la page prof d'Eva --> fait
            } 
            elseif ($role == 'etudiant') {
                header("Location: PAEleve.php"); // remplacer par la page eleve d'Amine --> fait
            } 
            elseif ($role == 'scolarite') {
                header("Location: menu.php"); // remplacer par la page scolarite mael --> fait
            } 
            else {
                echo "Rôle inconnu pour l'e-mail $email";
            }
        } 
        else {
            echo "Aucun utilisateur trouvé avec l'e-mail $email";
        }
    } 
    else {
        echo "Erreur lors de l'exécution de la requête : " . mysqli_error($db_handle);
    }
}
mysqli_close($db_handle);
?>
