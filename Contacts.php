
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
  require('connexion.php');
  require('Parametre.php');
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
                <?php colorize("contact"); ?>
            </h1>

			<div id="Rechercher" >
			<form action="Contacts.php" method="get" id="rechercheID">
				<?php
				echo '<input type="text" name="RechercherContacts" placeholder="Rechercher Contacts">';
				echo '<input type="submit" name="OK" value="OK">'
				?>
			</form>
			

			</div>

			<a id="inscription" href="Inscription.php"><em> Je désire m'inscrire</em></a>
			

		<div id="contenuPage">

			<div id="groupe1">

					
					<?php 
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

