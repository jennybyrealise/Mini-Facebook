<?php

require('connexion.php');
$appliDB = new Connexion();

/*
$connexion = appliDB->connexionDB();

if (is_null($connexion)) {
   echo "connexion failed";
}else{ 
   echo "connexion réussi";
}

appliDB->insertHobby("musique");
appliDB->insertHobby("cuisine");
appliDB->insertHobby("gaming");

appliDB->insertMusique("jazz");
appliDB->insertMusique("raggae");
appliDB->insertMusique("rock");


$successMusique = appliDB->insertMusique("rock");

if ($successMusique) {
    echo "Ca a marché";
} else {
    echo "Grave échec";
}



$successHobby = $aplliDB->insertHobby("cuisine");

if ($successHobby) {
    echo "Ca a marché";
} else {
    echo "Grave échec";
}


$successPersonne = $appliDB->insertPersonne("Akaba","Jennifer","url","1981-10-24","Mariée");
if ($successPersonne) {
    echo "Ca a marché";
} else {
    echo "Grave échec";
}


$resultat = $appliDB->selectAllHobbies();
echo "Hobbies";
echo "<ul>";
foreach ($resultat as $value){
    echo"<li>".$value->Type."</li>";
}
echo "</ul>";

$resultat =$appliDB->selectAllMusique();
echo "Musique"."<br>";
foreach ($resultat as $value){
    echo'<input type="checkbox">'.$value->Type.'</input><br>';
}



$resultat = selectPersonneById(3);
$appliDB->displayPersonne($resultat);

$hobbies=["Animaux","Sortie","Gaming","Shopping","Cinéma","Danse"];
$appliDB->insertAllHobbies($hobbies);

$musiques =["Rock","Classique","Hip-Hop","Pop","jazz","Metal","Raggae","Salsa","Electro","Disco"];
$appliDB->insertAllMusiques($musiques);



$personne = $appliDB->selectPersonneByNomPrenomLike("ka");
 var_dump($personne);
 /*echo $personne[o]->Nom; 
echo $personne[0]->Type."<br>";
echo $personne[1]->Type."<br>";



$personne = $appliDB->getPersonneHobby(3);
foreach($personne as $hobby){ 
    echo $hobby->Type."<br>";
}


$successPersonne = insertPersonne("Moukid","Choukri","url","1981-10-29","Célibataire");$personne=getPersonneHobby(3);

$personne=$appliDB->getRelationPersonne(3);
foreach($personne as $RelationPersonne){ 
    echo    $RelationPersonne->Prenom." ". $RelationPersonne->Nom." ".$RelationPersonne->Type."<br>";
}

colorize("lapin");




$resultat =$appliDB->getRandomFriends();
echo "Liste de contacts"."<br>";
foreach ($resultat as $value){
    echo'<input type="checkbox">'.$value->Nom." ".$value->Prenom.'</input><br>';
}



$successPersonne = $appliDB->insertPersonne("Barakat","Mohamed","url","1965-06-26","Marié");
$successPersonne = $appliDB->insertPersonne("Degoumois","Joris","url","1981-03-29","Célibataire");
$successPersonne = $appliDB->insertPersonne("Monod","Virginie","url","1985-05-03","Célibataire");
$successPersonne = $appliDB->insertPersonne("Van Doornik","Adrien","url","1987-01-20","Célibataire");

$appliDB->insertPersonneHobbies(4,array(43,10));

$appliDB->insertPersonneMusique(6,array(55,56));

$appliDB->insertPersonneRelation(8,6,"ami");

$appliDB->insertPersonneHobbies(4,array(43,10));

$successPersonne = $appliDB->insertPersonne("Toto","tata","url","1981-10-29","Célibataire");
*/

$appliDB->insertPersonneMusique(8,array(53,56));
$appliDB->insertPersonneHobbies(8,array(42,47,51));

