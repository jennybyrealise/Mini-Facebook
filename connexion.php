<?php
class Connexion{
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
   
    public function getConnexion(){
        return $this->connexion;
    }
    

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

            $id = $this->connexion->lastInsertId();
        }catch(Exception $e){
            echo "Erreur:".$e -> getMessage()."<br>";
            $succes = false;
        }
        return $id;
    }

    public function selectAllHobbies(){
         
        
        $requete_prepare = $this->connexion -> prepare (
                "SELECT * FROM Hobby");
                
        $requete_prepare->execute();

        $resultat=$requete_prepare->fetchAll(PDO::FETCH_OBJ);  

        return $resultat;
    }  


    public function selectAllMusique(){
      
        
        $requete_prepare = $this->connexion -> prepare (
                "SELECT * FROM Musique");
                
        $requete_prepare->execute();

        $resultat=$requete_prepare->fetchAll(PDO::FETCH_OBJ);  

        return $resultat;
    }  


    public function selectPersonneById(int $id){
       
        $requete_prepare=$this->connexion -> prepare(
            "SELECT * FROM Personne WHERE Id = :id");

        $requete_prepare ->execute (array("id"=>$id));

        $resultat=$requete_prepare->fetch(PDO::FETCH_OBJ);

        return $resultat;
    }


    public function displayPersonne($personne){
        $str = $personne->Nom." "
                .$personne->Prenom." "
                .$personne->URL_Photo." "
                .$personne->Date_Naissance." "
                .$personne->Statut_Couple;
        
        echo $str;
    }



    public function insertAllHobbies($hobbies){
        foreach($hobbies as $hobby){
            insertHobby($hobby);
        }
    }

    public function insertAllMusiques($musiques){
        foreach($musiques as $musique){
           $this->insertMusique($musique);
        }
    }


    public function SelectPersonneByNomPrenomLike($pattern){
   
        $requete_prepare = $this->connexion -> prepare (
            "SELECT * FROM Personne WHERE Nom LIKE :Nom
                OR Prenom LIKE :Prenom");
        $requete_prepare ->execute (array("Nom"=>"%$pattern%", "Prenom"=>"%$pattern%"));
        $resultat=$requete_prepare->fetchAll(PDO::FETCH_OBJ);
        
        return $resultat;
    }

    public function getPersonneHobby($peronneId){
        
        $requete_prepare = $this->connexion->prepare(
            "SELECT Type FROM RelationHobby
            INNER Join Hobby ON Hobby_Id = Id
            WHERE Personne_Id = :id");
        $requete_prepare ->execute(array("id" => $peronneId));
        $hobbies = $requete_prepare->fetchAll(PDO::FETCH_OBJ);
        
        return $hobbies;
    }


    

    public function getPersonneMusique($personneId){
       
        $requete_prepare = $this->connexion->prepare(
            "SELECT Type FROM Musique m
            INNER Join RelationMusique rm ON rm.Musique_Id = m.Id
            WHERE Personne_Id = :id");
        $requete_prepare ->execute(array("id" => $personneId));
        $musiques = $requete_prepare->fetchAll(PDO::FETCH_OBJ);
        
        return $musiques;
    }


    public function getRelationPersonne($relationId){
       
        $requete_prepare = $this->connexion->prepare(
            "SELECT * FROM RelationPersonne rp
            INNER Join Personne p ON rp.Relation_Id = p.Id
            WHERE rp.Personne_Id = :id");
        $requete_prepare ->execute(array("id" => $relationId));
        $RelationPersonne = $requete_prepare->fetchAll(PDO::FETCH_OBJ);
        
        return $RelationPersonne;
    }

   
    public function selectAllFriend(){
      
        
        $requete_prepare = $this->connexion -> prepare (
                "SELECT * FROM Personne");
                
        $requete_prepare->execute();

        $resultat=$requete_prepare->fetchAll(PDO::FETCH_OBJ);  

        return $resultat;
    }  

    private function isIdExist($id, $existingId){
        foreach($existingId as $e){
            if($e==$id){
                return true;
            }
        } 
        return false; 
    }

    private function getNewRandomId($maxId, $existingId){
        $nb_min = 0;
        $nb_max = $maxId-1;
        $id = mt_rand($nb_min,$nb_max);
        $nbrloop = 0;
        while($this->isIdExist($id, $existingId) && $nbrloop < $maxId){
            $id = mt_rand($nb_min,$nb_max);
        }
        return $id;
    }       


    public function getRandomFriends(){
        $requete_prepare = $this->connexion -> prepare (
            "SELECT * FROM Personne");
            
        $requete_prepare->execute();
        $resultat=$requete_prepare->fetchAll(PDO::FETCH_OBJ);  

        $max = sizeof($resultat);
        $nb_min = 0;
        $nb_max = $max-1;
        $existingId = [];

        for($i = 0; $i < 5; $i++){
            $id = $this->getNewRandomId($nb_max,$existingId);
            $existingId[$i] = $id; 
            $friends [$i] = $resultat[$id]; 
        }
        return $friends;
    }

    
    public function insertPersonneHobbies($Personne_Id,$Hobby_Id){
    
    
        $requete_prepare = $this->connexion->prepare(
            "INSERT INTO  RelationHobby (Personne_Id,Hobby_Id)
                    VALUES (:personne_Id,:hobby_Id)");

        $requete_prepare->execute(
            array(  "personne_Id" => $Personne_Id, 
                    "hobby_Id" => $Hobby_Id)
        );
    
    }


    public function insertPersonneMusique($Personne_Id,$Musique_Id){

            $requete_prepare = $this->connexion->prepare(
                "INSERT INTO  RelationMusique (Personne_Id,Musique_Id)
                        VALUES (:personne_Id,:musique_Id)");

            $requete_prepare->execute(
                array(  "personne_Id" => $Personne_Id, 
                        "musique_Id" => $Musique_Id)
            );
    }


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
