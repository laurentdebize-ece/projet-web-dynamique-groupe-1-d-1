<?php session_start() ?>
<?php 

    require ('./Global/Header.php'); ?>

<div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="PageAcceuilProfesseur.php">Acceuil</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<?php

    $Classe = $_GET['classe'];
    $Promo = $_GET['promo'];

?>

    <a href="PageProf.php?classe=<?php echo $Classe;?>&promo=<?php echo $Promo;?>">
    <input type="button" name="Retour" value="Retour">
    </a>

<table border=1>
		<tr>
			<th>Competence</th>
			<th>Prenom</th>
            <th>Nom</th>
            <th>Statut</th>
            <th>Avis</th>
		</tr>
    
	<?php 

$database = "bddecemyskill";

$db_handle = mysqli_connect('localhost', 'root', 'root');
$db_found = mysqli_select_db($db_handle, $database);

$titre = $_GET['id'];
$classe = isset($_POST["classe"]) ? $_POST["classe"] : "";

$sql = "SELECT DISTINCT utilisateurs.prenom, utilisateurs.nom, acquis.statutEleve FROM utilisateurs 
        JOIN matiere
        JOIN competences ON competences.Idmatiere=matiere.Idmatiere 
        JOIN acquis ON acquis.Idcompetences=competences.IdCompetences AND acquis.Idutilisateur=utilisateurs.Idutilisateur
        JOIN classe
        WHERE utilisateurs.role LIKE 'etudiant' AND classe.Groupe LIKE '%$classe%' AND competences.Titre LIKE '%$titre%'";

$result = mysqli_query($db_handle, $sql);

    if ($result === false) {
        echo "ca marche pas";
    } elseif(mysqli_num_rows($result) != 0) {
            while($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                <td><?php echo $titre ;?></td>
                <td><?php echo $row['prenom'];?></td>
                <td><?php echo $row['nom'];?></td>
                <td><?php echo $row['statutEleve'];?></td>
                <td>
                <form action="CodeAvisProf.php?classe=<?php echo $Classe; ?>&promo=<?php echo $Promo; ?>" method="post" >    
                <input type="radio" name="avis" value="Valide"> D'accord
                <br>
                <input type="radio" name="avis" value="A revoir"> Pas d'accord
                <br>
                <input type="submit" name="Enregistrer" value="Enregistrer">
                </form> 
                </td>
                </tr>
                <?php
            }
        } else {
            echo "Aucun résultat trouvé.";
        }
    
	
	?>
    
    <?php require('./Global/Footer.php');?>