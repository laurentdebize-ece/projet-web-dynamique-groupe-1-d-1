<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=git, initial-scale=1.0">
    <link href="Fichier.css" rel="stylesheet" type="text/css" />
    <title>Page des Matières Elève</title>
</head>

<body>
    <h1>Matières</h1>
    <div class="container">
        <button onclick="window.location.href='PAEleve.php'">Mon Compte</button>
        <button onclick="window.location.href='PageDeConnexion.php'">Acceuil</button>
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
        <table>
            <tr>
                <th>Les Matières</th>
            </tr>
            <tr>
                <?php //si le BDD existe, faire le traitement
                if ($db_found) {
                    $sql = "SELECT * FROM matiere
            JOIN utilisateurs ON utilisateurs.Idutilisateur = matiere.Idutilisateur";
                    $result = mysqli_query($db_handle, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {  ?>
                
                        <td>
                        <a href="CompetenceParMatiere.php?id=<?php echo $row['Idmatiere']; ?>"><?php echo $row['Noms']. '<br>'; ?> </a>
                        </td>
                        <tr>


                    <?php }
                } ?>
        </table>

    </div>

</body>

</html>