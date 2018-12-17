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
  
require('connexion.php');
require('Parametre.php');
$appliDB = new Connexion();
$personne = $appliDB->selectPersonneById($_GET["id"]);
$musiques = $appliDB->getPersonneMusique($_GET["id"]);
$hobbies = $appliDB->getPersonneHobby($_GET["id"]);
$relation = $appliDB->getRelationPersonne($_GET["id"]);

?>
  
</head>

<body>

	<div id=page>

		<div id="blockInfo">

			<div id="image">

			<?php
				echo '<img id="photo" src="'.$personne->URL_Photo.'" alt="photo profil">';
			?>

			</div>

	    	<div id="info">
				<h1>
				<?php colorize($personne->Nom." ".$personne->Prenom." " ); ?>
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

			<div id="buttonContacts">
				<form action="Contacts.php" method="get">
					<input type="submit" name="Contacts" value="Contacts">
				</form>
			</div>

			<div id="buttonIns">
				<form action="Inscription.php" method="get">
					<input type="submit" name="Inscription" value="Inscription">
				</form>
			</div>

		</div>

		<div id="blockMusique">
            <h2>Mes goûts musicaux :</h2>

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

			<?php
			echo "<ul>";
			foreach ($hobbies as $value){
				echo"<li>".$value->Type."</li>";
			}
            echo "</ul>";
			?>

		</div>

		<h2>Mes Contacts:</h2>
		<div id="blockAmis">
			
			
		

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

</body>
</html>
