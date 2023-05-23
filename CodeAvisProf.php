<?php session_start() ?>
<?php 

    require ('./Global/Header.php'); 

    $Classe = $_GET['classe'];
    $Promo = $_GET['promo'];

    ?>

    <a href="PageProf.php?classe=<?php echo $Classe;?>&promo=<?php echo $Promo;?>">
    <input type="button" name="Retour" value="Retour">
    </a>

    <?php
    $database = "bddecemyskill";

    $db_handle = mysqli_connect('localhost', 'root', 'root');
    $db_found = mysqli_select_db($db_handle, $database);


    $avis = isset($_POST["avis"])? $_POST["avis"] : "";
    
    if ($db_found) {
        if (isset($_POST["Enregistrer"])){
                    $sql = "UPDATE acquis SET StatutProf = '$avis' WHERE acquis.Idacquis = '1'";
                    mysqli_query($db_handle, $sql);
                    
                    if (mysqli_affected_rows($db_handle) != 0) {
                        echo "Votre avis a été envoyé avec succès.";
                    } else {
                        echo "Votre avis ne s'est pas enregistré";
                    }
                }
    
        
    } else {
        echo "Erreur : Impossible de se connecter à la base de données.";
    }


require('./Global/Footer.php');?>
    