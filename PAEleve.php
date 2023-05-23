<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="Fichier.css" rel="stylesheet" type="text/css" />
    <title>Page d'acceuil Elève</title>
</head>

<body>
    <h1>Omnes MySkills</h1>
    <div id="nav">
        <button onclick="window.location.href='pagedegarde.php'">Acceuil</button>
        <button onclick="window.location.href='EleveMatiere.php'">Matière</button>
        <button onclick="window.location.href='EleveCompetence.php'">Compétences</button>
    </div>
    <?php
    //identifier le nom de base de données
    $database = "bddecemyskill";
    //connectez-vous dans votre BDD
//Rappel : votre serveur = localhost | votre login = root | votre mot de pass = '' (rien)
    $db_handle = mysqli_connect('localhost', 'root', '');
    $db_found = mysqli_select_db($db_handle, $database);

    ?>

    <div id="section">
        <?php if ($db_found) {
            $sql = "SELECT * FROM utilisateurs";
            $result = mysqli_query($db_handle, $sql);
            while ($row = mysqli_fetch_assoc($result)) { ?>

                <h2>
                    <?php echo " Bonjour  " . $row['Prenom'] . '<br>'; ?>
                </h2>
                <li>
                    <?php echo "ID Utilisateur: " . $row['Idutilisateur'] . '<br>'; ?>
                </li>
                <li>
                    <?php echo "Nom:" . $row['Nom'] . '<br>'; ?>
                </li>
                <li>
                    <?php echo "Prénom: " . $row['Prenom'] . '<br>'; ?>
                </li>
                <li>
                    <?php echo "Statut: " . $row['Role'] . '<br>'; ?>
                </li>
                <li>
                    <?php echo "Email: " . $row['Email'] . '<br>'; ?>
                </li>
                <li>
                    <?php echo "Mot de passe: " . $row['Mdp'] . '<br>'; ?>
                </li>

            <?php }
        } ?>
    </div>

</body>

</html>
