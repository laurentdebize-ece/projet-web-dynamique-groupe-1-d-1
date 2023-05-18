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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = test_input($_POST['email']);
    $password = test_input($_POST['mdp']);

    $userData = array(
        array('email' => 'scolarite@sco.com', 'password' => '123456'),
    );

    $userFound = false;
    foreach ($userData as $user) {
        if ($user['email'] === $email && $user['password'] === $password) {
            $userFound = true;
            break;
        }
    }

    if ($userFound) {
        // Redirect to the new page
        header('Location: pagescolarité.html');
        exit;
    } else {
    }
}

?>