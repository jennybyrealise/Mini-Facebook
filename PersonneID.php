<!doctype html>
<html lang="fr">

<head>

  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>INSCRIPTION</title>

  <link href="common.css" rel="stylesheet">
  <link href="PersonneID.css" rel="stylesheet">
  <link href='https://fonts.googleapis.com/css?family=Chango' rel='stylesheet'>
  
<?php
 //  inclut le contenu d'un autre fichier appelé, et provoque une erreur bloquante s'il est indisponible
require('connexion.php');
require('Parametre.php');
// appel de mes fonctions qui se trouvent dans mon fichier "connexion.php"
$appliDB = new Connexion();
$personne = $appliDB->selectPersonneById($_GET["id"]);//($_GET["id"])=récupération de l'id en BDD
$musiques = $appliDB->getPersonneMusique($_GET["id"]);
$hobbies = $appliDB->getPersonneHobby($_GET["id"]);
$relation = $appliDB->getRelationPersonne($_GET["id"]);
?>
  
</head>

<body>

	<div class="page">

	<div class="contenu">

		<div id="blockInfo">

			<div id="image">

			<!--photo du profil-->
			<?php
				echo '<img id="photo" src="'.$personne->URL_Photo.'" alt="photo profil">';
			?>

			</div>


			<!--info de la personne à droite de la photo-->
			<div id="info">
				<h1>
				<?php colorize($personne->Nom." ".$personne->Prenom." " ); ?><!--appel fonction "colorize"pour avoir nom et prénom avec couleur aléatoire-->
				</h1>

				<p>
				<?php echo($personne->Date_Naissance." "); ?>
				</p>

				<p>
				<?php echo($personne->Statut_Couple); ?>
				</p>

			</div>

		</div>

		<div id="blockButton">


			<!--boutton pour accéder à la page contact d'oùle tag <form>-->
			<div id="buttonContacts">
				<form action="Contacts.php" method="get">
					<input type="submit" name="Contacts" value="Contacts">
				</form>
			</div>

			<!--boutton pour accéder à la page inscription d'oÛ le tag <form>-->
			<div id="buttonIns">
				<form action="Inscription.php" method="get">
					<input type="submit" name="Inscription" value="Inscription">
				</form>
			</div>

		</div>

		<div id="blockMusique">

			<h2>Mes goûts musicaux :</h2>

			<!--récupérer dans la BDD le type de musique de la liste de musique de la personne sous forme de liste-->
			<?php
			echo "<ul>";
			foreach ($musiques as $value){
				echo"<li>".$value->Type."</li>";
			}
			echo "</ul>";
			?>

		</div>

		<div id="blockHobbies">

			<h2>Mes hobbies préférés:</h2>

			<!--récupérer dans la BDD le type de hobby de la liste de hobby de la personne sous forme de liste-->
			<?php
			echo "<ul>";
			foreach ($hobbies as $value){
				echo"<li>".$value->Type."</li>";
			}
			echo "</ul>";
			?>

		</div>

		

		<div id="blockAmis">

		<h2>Mes Contacts:</h2>	

			<!--récupérer dans la BDD le type de relation de la liste de relation de la personne avec ID dans l'Url
			sa phot,nom,prenom et date de naissance de la personne-->
			<?php foreach ($relation as $value){ 
				echo '<div class="blockImg">';
					echo '<a href="PersonneID.php?id='.$value->ID.'">';
						echo '<img class="icon" src="'.$value->URL_Photo.'" alt="photo profil">'; 
						echo '<p class="block1"> '.$value->Prenom." ". $value->Nom .' <br><span class="birth">'. $value->Date_Naissance .'</span></p>';
					echo '</a>';
				echo '</div>';					
				} 
			?>

		</div>
		
	</div>
	</div>

</body>
</html>
