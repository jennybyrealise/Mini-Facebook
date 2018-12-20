<!doctype html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 

  <title>INSCRIPTION</title>

  <link href="inscription.css" rel="stylesheet">
  <link href="common.css" rel="stylesheet">
  <link href='https://fonts.googleapis.com/css?family=Chango' rel='stylesheet'>
  
  <?php
  //  inclut le contenu d'un autre fichier appelé, et provoque une erreur bloquante s'il est indisponible
  require('connexion.php');
  require('Parametre.php');
  // appel de mes fonctions qui se trouvent dans mon fichier "connexion.php"
  $appliDB = new Connexion();
 
  ?>

</head>

<body>
	
<div id="formulaire">
	
<div id="contenu">

	<h1 id="insForm">
	<?php colorize("Inscription"); ?><!--appel fonction "colorize"pour avoir nom et prénom avec couleur aléatoire-->
	</h1>

	<!-- formulaire inscription !-->

	<!--tag <form> utilisé pour collecter l' entrée d'utilisateur -->
	<form action="SubmitInscription.php" method="post" id="formID">

		<!-- barre insertion !-->

		<input type="url" id="url" name="url" placeholder="Entrez votre Photo" required><br>
       	<input type="text" id="nom" name="nom" placeholder="Entrez votre Nom" required><br>
       	<input type="text" id="prenom" name="prenom" placeholder="Entrez votre prénom" required><br>
       	<input type="date" id="ddn" name="date_de_naissance" required><br>


		<p>Choisissez votre statut:</p>

		<!-- button radio !-->

		<input type="radio" id="Marié(e)" name="statut" value="Marié(e)" required>
		<label for="Marié(e)">Marié(e)</label>
			
		<input type="radio" id="Célibataire" name="statut" value="Célibataire" required>
		<label for="Célibataire">Célibataire</label>
			
       	<input type="radio" id="en_couple" name="statut" value="En couple" required>
		<label for="en_couple">En couple</label>

		<input type="radio" id="non_defini" name="statut" value="En couple" required>
		<label for="non_defini">Je veux pas le dire</label>

       <div>
       		<div id="Musiques">
       			<h2 class="sous-titre">Musique</h2>

				<?php  
				
				// checkbox musique
					$resultat =$appliDB->selectAllMusique();
					foreach ($resultat as $value){
						echo'<label><input type="checkbox" name="musique[]" value='.$value->ID.'>'.$value->Type.'</label><br>';
					}

                ?>
       		</div>

       		<div id="Loisirs">
				   <h2 class="sous-titre">Loisirs</h2>	
				   
                <?php  
				
				//checkbox Hobbies
				// foreach passe en revue les informations de chaque hobby ddes hobbies à chaque itération
                $resultat = $appliDB->selectAllHobbies();
                foreach ($resultat as $value){
                    echo'<label><input type="checkbox" name="loisirs[]" value='.$value->ID.'>'.$value->Type.'</label><br>';
                }
                            
            	?>

			</div>

       </div>

       <div>
	       	<h4 class="sous-titre">Liste de contacts</h4>

				<?php

				//checkbox liste de contact
				// foreach passe en revue les informations de chaque ami des amis à chaque itération
				$friends = $appliDB->getRandomFriends();
				foreach ($friends as $friend){
					 echo '<table width=45% id="table">';
					    echo '<tr>';
					    echo'<td><input type="checkbox" name="personnes[]" value="' . $friend->ID . '"> '.$friend->Nom." ".$friend->Prenom.'</input></td>';

						//liste déroulante de la relation
					    echo '<td align=right>';
						echo "<select id=box name='$friend->ID'>";
							echo '<option label="Famille" value="Famille">Famille</option>';
							echo '<option label="Collègue" value="Collègue">Collègue</option>';
							echo '<option label="Ami(e)" value="Ami(e)">Ami(e)</option>';
						echo '</select>';
						echo '</td>';
						echo '</tr>';
					echo '</table>';
				   }
				?>
       </div>

	   <div id="validation">

			<!-- boutton retour qui renvoie sur page contacts !-->
			<div id="Retour">
				<a href="Contacts.php">
					<input type="button" name="Contacts" value="Retour">
				</a>
			</div>

			 <!-- boutton de validation-envoie formulaire BDD !--> 
       		<div id="submite"><input class="submit" type="submit" value="Valider"></div>

		</div>

	</form>

</div>	
</div>
</body>
</html>

