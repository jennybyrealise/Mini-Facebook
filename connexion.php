<?php
class Connexion{

    //initialisation paramètre de connection
    //try-catch récupère les errreurs
    private $connexion;
    public function __construct(){
        $PARAM_hote = "localhost";
        $PARAM_port = "3306";
        $PARAM_nom_bd = "adminMiniFacebook";
        $PARAM_utilisateur = "adminMiniFacebook";
        $PARAM_mot_passe = "minifacebook";

        try{
            $this->connexion = new PDO (
                "mysql:host=".$PARAM_hote.";dbname=".$PARAM_nom_bd,
                $PARAM_utilisateur,
                $PARAM_mot_passe
            );
            $this->connexion->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND,"SET NAMES 'utf8'");
        }catch(Exception $e){
            echo "Erreur:".$e -> getMessage()."<br>";
            echo "N°:".$e -> getCode();
        }
      
    }
    
    //récupération de la connexion
    public function getConnexion(){
        return $this->connexion;
    }
    
    //Insertion hobby dans BDD
    public function insertHobby($hobby){

        try{
            $requete_prepare = $this->connexion -> prepare(
                "INSERT INTO Hobby (Type) values (:hobby)");
        
            $requete_prepare -> execute(
                array("hobby" => $hobby)
            );
            return True;

        }catch(Exception $e){
            return False;
        }
        return $connexion;
    }

    //insertion musique dans BDD
    public function insertMusique($musique){
       
        $succes = true;
        try{
            $requete_prepare = $this->connexion -> prepare(
                "INSERT INTO Musique (Type) values (:musique)");
        
            $requete_prepare -> execute(
                array("musique" => $musique)
            );

        }catch(Exception $e){
            $succes = false;
        }
        return $succes;
    }

    //insertion Information de la  personne dans BDD
    public function insertPersonne($nom, $prenom,$url_photo,$date_naissance,$statut_couple){
        $succes = true;
        try{
            $requete_prepare = $this->connexion -> prepare(
                "INSERT INTO  Personne (Nom, Prenom, URL_Photo, Date_Naissance, Statut_Couple)
                        VALUES (:nom,:prenom,:photo,:date_naissance,:statut_couple)");

            $requete_prepare->execute(
                array(  "nom" =>$nom, 
                        "prenom" =>$prenom, 
                        "photo" =>$url_photo, 
                        "date_naissance" =>$date_naissance, 
                        "statut_couple" =>$statut_couple)
            );

            //Récupération de l'ID de la dernière indertion
            $id = $this->connexion->lastInsertId();

        }catch(Exception $e){
            echo "Erreur:".$e -> getMessage()."<br>";
            $succes = false;
        }
        return $id;
    }

    //seletionner tous les hobbiesen BDD
    public function selectAllHobbies(){
         
        $requete_prepare = $this->connexion -> prepare (
                "SELECT * FROM Hobby");
                
        $requete_prepare->execute();

        $resultat=$requete_prepare->fetchAll(PDO::FETCH_OBJ);  

        return $resultat;
    }  

    //selectionner toutes les musiques en BDD
    public function selectAllMusique(){
        
        $requete_prepare = $this->connexion -> prepare (
                "SELECT * FROM Musique");
                
        $requete_prepare->execute();

        $resultat=$requete_prepare->fetchAll(PDO::FETCH_OBJ);  

        return $resultat;
    }  

    //selectionner les personne par leur ID
    public function selectPersonneById( $id){
       
        $requete_prepare=$this->connexion -> prepare(
            "SELECT * FROM Personne WHERE Id = :id");

        $requete_prepare ->execute (array("id"=>$id));

        $resultat=$requete_prepare->fetch(PDO::FETCH_OBJ);

        return $resultat;
    }

    //visualiser-afficher toutes les informations de la personne
    public function displayPersonne($personne){
        $str = $personne->Nom." "
                .$personne->Prenom." "
                .$personne->URL_Photo." "
                .$personne->Date_Naissance." "
                .$personne->Statut_Couple;
        
        echo $str;
    }


    //insertion de plusieurs Hobbies dans BDD
    public function insertAllHobbies($hobbies){
        foreach($hobbies as $hobby){
            insertHobby($hobby);
        }
    }

    //insertion de plusieurs Musiques dans BDD
    public function insertAllMusiques($musiques){
        foreach($musiques as $musique){
           $this->insertMusique($musique);
        }
    }

    //Rechercher une personne par son nom,prénom,ou en donnant quelques lettre( pour barre de recherche) 
    public function SelectPersonneByNomPrenomLike($pattern){
   
        $requete_prepare = $this->connexion -> prepare (
            "SELECT * FROM Personne WHERE LOWER(Nom) LIKE LOWER(:Nom)
                OR LOWER(Prenom) LIKE LOWER(:Prenom)");
        $requete_prepare ->execute (array("Nom"=>"%$pattern%", "Prenom"=>"%$pattern%"));
        $resultat=$requete_prepare->fetchAll(PDO::FETCH_OBJ);
        
        return $resultat;
    }

    //récupérer les hobbies d'une personne par son id
    public function getPersonneHobby($personneId){
        
        $requete_prepare = $this->connexion->prepare(
            "SELECT Type FROM RelationHobby
            INNER Join Hobby ON Hobby_Id = Id
            WHERE Personne_Id = :id");
        $requete_prepare ->execute(array("id" => $personneId));
        $hobbies = $requete_prepare->fetchAll(PDO::FETCH_OBJ);
        
        return $hobbies;
    }

    //récupérer les musiques d'une personne par son id
    public function getPersonneMusique($personneId){
       
        $requete_prepare = $this->connexion->prepare(
            "SELECT Type FROM Musique m
            INNER Join RelationMusique rm ON rm.Musique_Id = m.Id
            WHERE Personne_Id = :id");
        $requete_prepare ->execute(array("id" => $personneId));
        $musiques = $requete_prepare->fetchAll(PDO::FETCH_OBJ);
        
        return $musiques;
    }

    //récupérer les relation d'une personne par son id
    public function getRelationPersonne($relationId){
       
        $requete_prepare = $this->connexion->prepare(
            "SELECT * FROM RelationPersonne rp
            INNER Join Personne p ON rp.Relation_Id = p.Id
            WHERE rp.Personne_Id = :id");
        $requete_prepare ->execute(array("id" => $relationId));
        $RelationPersonne = $requete_prepare->fetchAll(PDO::FETCH_OBJ);
        
        return $RelationPersonne;
    }

    //sélectionner les contacts de la personne
    public function selectAllFriend(){
      
        $requete_prepare = $this->connexion -> prepare (
                "SELECT * FROM Personne");
                
        $requete_prepare->execute();

        $resultat=$requete_prepare->fetchAll(PDO::FETCH_OBJ);  

        return $resultat;
    }  

    //on a créer une fonction privée pour quelle ne soit pas modifiée
    //si l'ID de la personne existe return true sinon false
    private function isIdExist($id, $existingId){
        foreach($existingId as $e){
            if($e==$id){
                return true;
            }
        } 
        return false; 
    }

    //on a créer une fonction privée pour quelle ne soit pas modifiée
    //fonction qui permet de faire un random des ID(des personnes) qui sont présente dans la BDD
    private function getNewRandomId($maxId, $existingId){
        $nb_min = 0; // min à o
        $nb_max = $maxId-1;// max le nbre de personnes de la liste
        $id = mt_rand($nb_min,$nb_max);//apelle d'une fonction prédéfinie qui Génère une valeur aléatoire 
        $nbrloop = 0;//nombre de loop initialisé 0 afin que le même nom n'apparaisse qu'une seule est unique fois(évite le doublon)
        // on fait une boucle while avec pour condition :
        //un appelant la fonction ci-dessus "isIdExist" (avec en paramètre l'id et l'id existant) et l'Id max supérieur au nombre de loop
        // donc défini la variable $id qui sera égale à un nombre aléatoire
        while($this->isIdExist($id, $existingId) && $nbrloop < $maxId){
            $id = mt_rand($nb_min,$nb_max);
        }
        return $id;
    }       

    // d'oû la fonction ci-dessoous pour récupérer des 5 contacts max de la BDD
    public function getRandomFriends(){
        $requete_prepare = $this->connexion -> prepare (
            "SELECT * FROM Personne");
            
        $requete_prepare->execute();
        $resultat=$requete_prepare->fetchAll(PDO::FETCH_OBJ);  

        $max = sizeof($resultat);// variable max qui sera égale à la longueur de la liste de personnes de la BDD
        $nb_min = 0; // initialisation à o pour le min
        $nb_max = $max-1; // initialisation à la longueur de la liste de personnes de la BDD
        $existingId = []; // "$existingId" qui prendra l'Id de la personne

    // boucle for qui a pour condition 
    //la variable $i=0 (initialisé à 0) et $i soit inférieur à 5 et que celle-ci soit incrémentée
        for($i = 0; $i < 5; $i++){
            $id = $this->getNewRandomId($nb_max,$existingId);// appelle de la fonction ci-dessus
            $existingId[$i] = $id;
    //creation d'une variable "friends" qui a pour index $i ci-dessus est égale à la variable "$resultat" avec conmme index l'ID
            $friends [$i] = $resultat[$id];
        }
        return $friends;
    }

    // insertion des hobbies de la personne par l'ID de la personne et l'ID de l'hobby(relation Hobbies BDD)
    public function insertPersonneHobbies($Personne_Id,$Hobby_Id){
    
        $requete_prepare = $this->connexion->prepare(
            "INSERT INTO  RelationHobby (Personne_Id,Hobby_Id)
                    VALUES (:personne_Id,:hobby_Id)");

        //insérer dans la BDD le type de hobby que la personne aime
        //foreach($Hobby_Id as $Hobby){
        $requete_prepare->execute(
            array(  "personne_Id" => $Personne_Id, 
                    "hobby_Id" => $Hobby_Id)
        );
        //}
    }

    // insertion des musiques de la personne par l'ID de la personne et l'ID de la musique(relation Musique BDD )
    public function insertPersonneMusique($Personne_Id,$Musique_Id){

        $requete_prepare = $this->connexion->prepare(
            "INSERT INTO  RelationMusique (Personne_Id,Musique_Id)
                    VALUES (:personne_Id,:musique_Id)");

        //insérer dans la BDD le type de musique que la personne aime
        //foreach($Musique_Id as $Musique){
        $requete_prepare->execute(
            array(  "personne_Id" => $Personne_Id, 
                    "musique_Id" => $Musique_Id)
        );
        //}
    }

    // insertion des relations de la personne par l'ID de la personne et l'ID de la relation et le type de relation(relation personnes )   
    public function insertPersonneRelation($Personne_Id,$Relation_Id,$RelationType){
      
        $requete_prepare = $this->connexion->prepare(
            "INSERT INTO  RelationPersonne (Personne_Id,Relation_Id,Type)
                    VALUES (:personne_Id,:relation_Id,:type)");

        $requete_prepare->execute(
            array(  "personne_Id" => $Personne_Id, 
                    "relation_Id" => $Relation_Id,
                    "type" => $RelationType)
        );
}
  
}

?>
