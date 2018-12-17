<?php
// On se connecte à la base de données
require_once('connexion.php');
$appliDB = new Connexion();

/* echo $_POST["nom"];
echo "<br>";
echo $_POST["prenom"];
echo "<br>";
echo $_POST["date_de_naissance"];
echo "<br>";
echo $_POST["statut"];
echo "<br>";
echo $_POST["url"];
echo "<br>";

echo "<br> Les loisirs: <br>";
$musiques = $_POST["musique"];
foreach ($musiques as $musique){
    echo $musique;
    echo "<br>";
}
echo "<br> Les musiques: <br>";
$hobbies = $_POST["loisirs"];
foreach ($hobbies as $hobby){
    echo $hobby;
    echo "<br>";
}

echo "<br> Les personnes: <br>";
$personnes = $_POST["personnes"];
foreach ($personnes as $personne){
    echo $personne;
    echo " a la relation: "; 
    echo $_POST["$personne"];
    echo "<br>"; 
}
 */

$id = $appliDB->insertPersonne($_POST["nom"],$_POST["prenom"],$_POST["url"],$_POST["date_de_naissance"],$_POST["statut"]);

 
foreach ($_POST["musique"] as $musique){
    $appliDB->insertPersonneMusique($id,$musique);
}


foreach ($_POST["loisirs"] as $hobby){
    $appliDB->insertPersonneHobbies($id,$hobby);
}

foreach ($_POST["personnes"] as $personne){
    $appliDB->insertPersonneRelation($id,$personne,$_POST["$personne"]);
}


echo "connexion réussie";


//Script de redirection

  header ("Location:http://127.0.1.17//projets/Mini-Facebook/PersonneID.php?id=$id");
  exit();



?>