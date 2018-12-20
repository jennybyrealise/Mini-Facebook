<?php

//function pour couleurcoloré les lettre aléatoirement
function colorize($string){
    
    for($i = 0; $i < strlen($string); $i++) {
        $lettre = $string[$i];
        $couleurAleatoire = rand (1,30);
        echo "<span class=\"couleur$couleurAleatoire\">$lettre</span>";
    }
}

?>