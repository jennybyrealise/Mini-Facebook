
<!doctype html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>INSCRIPTION</title>

 <link href="common.css" rel="stylesheet">
 <link href="contacts.css" rel="stylesheet">
 <link href='https://fonts.googleapis.com/css?family=Chango' rel='stylesheet'>

 <?php
 //  inclut le contenu d'un autre fichier appelé, et provoque une erreur bloquante s'il est indisponible
  require('connexion.php');
  require('Parametre.php');
  // appel de mes fonctions qui se trouvent dans mon fichier "connexion.php"
  $appliDB = new Connexion();
  $pattern = "";
  // Si mon pattern existe et est rempli
  if(isset($_GET["RechercherContacts"])){
	  // Alors je set mon pattern
	$pattern = $_GET["RechercherContacts"];
  }
  $relation = $appliDB->selectPersonneByNomPrenomLike($pattern);
  ?>

</head>

<body>
	<div id="page">

		<h1 id='titre'>
			<?php colorize("contact"); ?><!--appel fonction "colorize"pour avoir nom et prénom avec couleur aléatoire-->
		</h1>

		<div id="Rechercher" >
		<!--tag <form> utilisé pour collecter l'entrée d'utilisateur -->
		<form action="Contacts.php" method="get" id="rechercheID">

			<?php //barre de recherche & boutton submit
			echo '<input type="text" name="RechercherContacts" placeholder="Rechercher Contacts">';
			echo '<input type="submit" class="submit" name="OK" value="OK">'
			?>

		</form>
		

		</div>

		<!--tag <a> est un hyperlien, qui est utilisé pour relier d'une page à l'autre(à la page inscription) -->
			<a id="inscription" href="Inscription.php"><em> Je désire m'inscrire</em></a>
			
		<div id="contenuPage">

		<div>

			<?php 
			// foreach passe en revue les informations  de chaque entrée de relation à chaque itération
			foreach ($relation as $value){ 
				echo '<div class="blockImg">';
					echo '<a href="PersonneID.php?id='.$value->ID.'">';
						echo '<img class="photoProfil" src="'.$value->URL_Photo.'" alt="photo profil">';
						echo '<div class="blockInfo">'.$value->Prenom." ".'</div>';
						echo '<div class="blockInfo">'." ".$value->Nom.'</div>';
					echo '</a>';
				echo '</div>';					
				} 
			?>

		</div>


		</div>

</div>
</body>
</html>

