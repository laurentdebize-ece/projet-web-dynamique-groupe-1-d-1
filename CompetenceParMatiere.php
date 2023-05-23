<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="Fichier.css" rel="stylesheet" type="text/css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de Compétences Elève</title>
</head>

<body>
    <?php
    //identifier le nom de base de données
    $database = "bddecemyskill";
    //connectez-vous dans votre BDD
//Rappel : votre serveur = localhost | votre login = root | votre mot de pass = '' (rien)
    $db_handle = mysqli_connect('localhost', 'root', '');
    $db_found = mysqli_select_db($db_handle, $database);

    $id = $_GET['id'];
    ?>

    <div id="section">
        <?php if ($db_found) {
            $sql = "SELECT * FROM matiere
            JOIN utilisateurs ON utilisateurs.Idutilisateur = matiere.Idutilisateur
            WHERE matiere.Idmatiere = '$id'";
            $result = mysqli_query($db_handle, $sql);
            $row = mysqli_fetch_assoc($result) ?>
                <h1>
                    <?php echo " Compétence de la matière  " . $row['Noms'] . '<br>';
            }
        
        ?>
            <div class="container">
                <button onclick="window.location.href='EleveMatiere.php'">Retour à la page des matières</button>
            </div>
            <table>
                <tr>
                    <th>Titres</th>
                    <th>Description</th>
                    <th>Statut</th>

                </tr>
                <tr>
                    <?php //si le BDD existe, faire le traitement
                    if ($db_found) {
                        $sql = "SELECT * FROM competences
            JOIN matiere ON matiere.Idmatiere = competences.Idmatiere
                JOIN utilisateurs ON utilisateurs.Idutilisateur = matiere.Idutilisateur
                WHERE matiere.Idmatiere = '$id'";
                        $result = mysqli_query($db_handle, $sql);
                        while ($row = mysqli_fetch_assoc($result)) { ?>

                            <td>
                                <?php echo $row['Titre'] . '<br>'; ?>
                            </td>
                            <td>
                                <?php echo $row['Description'] . '<br>'; ?>
                            </td>
                            <td>
                            <form action="EleveCompetence.php" method="post">
                                <input type="radio" name="avis" value="Acquis"> Acquis
                                <br>
                                <input type="radio" name="avis" value="En Cours D'Acquisition"> En Cours D'Acquisition
                                <br>
                                <input type="radio" name="avis" value="Non Acquis">Non Acquis
                                <br>
                                <input type="submit" name="Enregistrer" value="Enregistrer">
                            </form>
                        </td>

                        <tr>


                        <?php }
                    } ?>
            </table>

    </div>

</body>

</html>