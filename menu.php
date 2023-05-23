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
<body>
    <h1>
        <p class="Bienvenue">Bienvenue sur votre compte amdinistrateur</p>
        <img src="omnes.jpg" alt="Logo OMNES" width="15" height="10">
    </h1>

    <nav>
        <button><a href="matiere.php">Matières</a></button>
        <button><a href="eleve.php">Elèves</a></button>
        <button><a href="prof.php">Professeurs</a></button>
        <button><a href="competence.php">Compétences</a></button>
    </nav>

<?php require('./Global/Footer.php');?>
