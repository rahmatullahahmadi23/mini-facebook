<?php
class Connexion{
    private $connexion;

    public function __construct(){
        $PARAM_hote='localhost';
        $PARAM_port= '3306';
        $PARAM_nom_bd= 'Mini-facebook';
        $PARAM_utilisateur= 'root';
        $PARAM_mot_passe= 'digital2018';
        
        try{
            $this->connexion = new PDO(
            'mysql: host='.$PARAM_hote. ';dbname=' .$PARAM_nom_bd,
            $PARAM_utilisateur,
            $PARAM_mot_passe);
        } catch(Exception $e) {
                echo 'Erreur : '.$e->getMessage().'<br/>';
                echo 'N° : '.$e->getCode();
        }
    }  
    public function getConnexion(){
        return $this->connexion;
    }
    

function insertHobby(string $hobby) {
 
     try{  
    $requete_prepare = $this->connexion->prepare(
        "INSERT INTO Hobby (Type) VALUES (:hobby)");
    $requete_prepare->execute(
        array ('hobby' => $hobby));        
        return true;  
    } catch (Exception $e) {
        return false;
        }
}

function insertMusique(string $musique) {
   
    try{
    $requete_prepare = $this->connexion->prepare(
        "INSERT INTO Musique (Type) VALUES (:musique)");
    $requete_prepare->execute(
        array ('musique' => $musique)); 
        return true; 
    } catch (Exception $e) {
        return false;
        }
}
function insertPersonne($nom, $prenom, $url_photo, $date_naissance, $statut_couple) {
   
    try{
    $requete_prepare = $this->connexion->prepare(
        "INSERT INTO Personne (Nom, Prenom, URL_Photo, Date_Naissance, Statut_couple) 
        VALUES (:nom, :prenom, :url_photo, :date_naissance, :statut_couple)");
    $requete_prepare->execute(
        array ('nom'=>$nom, 
            'prenom'=>$prenom, 
            'url_photo'=>$url_photo, 
            'date_naissance'=>$date_naissance, 
            'statut_couple'=>$statut_couple)
        ); 
        return true;  
    } catch (Exception $e) {
        return false;
        }
}
    function selectAllHobbies(){

    $requete_prepare= $this->connexion->prepare (
    "SELECT Type FROM Hobby");
    
    $requete_prepare->execute();
    $resultat=$requete_prepare->fetchAll (PDO::FETCH_OBJ);

    return $resultat;
}

    public function selectallpersonne(){
        $requete_prepare->$this->connexion->prepare("SELECT * FROM Personne");
        $requete_prepare->execute();
        $result = $requete_prepare->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }
    function selectAllMusique(){

    $requete_prepare=$this->connexion->prepare("SELECT Type FROM Musique");
        
    $requete_prepare->execute();
    $resultat=$requete_prepare->fetchAll(PDO::FETCH_OBJ);
    
    return $resultat;
}
function selectPersonneById($id){

    $requete_prepare = $this->connexion->prepare(
        "SELECT * FROM Personne WHERE Id =:id");

    $requete_prepare->execute(array("id"=>$id));
    $resultat=$requete_prepare->fetch(PDO::FETCH_OBJ);
return $resultat; 
}
function displayPersonne($personne){
        $string = $personne->Nom." "
                    .$personne->Prenom." "
                    .$personne->URL_Photo." "
                    .$personne->Date_Naissance." "
                    .$personne->Statut_couple;
        echo ($string);
}
function selectPersonneByNomPrenomLike($pattern){

    $requete_prepare = $this->connexion->prepare(
        "SELECT * FROM Personne WHERE Nom LIKE :nom 
        OR Prenom LIKE :prenom");
    $requete_prepare->execute(array("nom"=>"%$pattern%", 
        "prenom"=>"%$pattern%"));
    
        $resultat=$requete_prepare->fetchAll(PDO::FETCH_OBJ);
        return $resultat;
}
function getPersonneHobby($personneId){

    $requete_prepare= $this->connexion->prepare (
        "SELECT Type from RelationHobby INNER JOIN Hobby ON Hobby_Id = Id
        WHERE Personne_Id = :id");
    
    $requete_prepare->execute (
            array("id"=>$personneId));
    $hobbies = $requete_prepare->fetchAll (PDO::FETCH_OBJ);

    return $hobbies;
 }
 function getPersonneMusique($personneId){

    $requete_prepare= $this->connexion->prepare (
        "SELECT Type from RelationMusique INNER JOIN Musique ON Musique_Id = Id
        WHERE Personne_Id = :id");
    
    $requete_prepare->execute (
            array("id"=>$personneId));
    $musiques = $requete_prepare->fetchAll (PDO::FETCH_OBJ);

    return $musiques;
 }
 function getRelationPersonne($personneId){

    $requete_prepare= $this->connexion->prepare (
        "SELECT * from RelationPersonne rp
        INNER JOIN Personne p ON rp.Relation_Id = p.id
        WHERE rp.Personne_Id = :id");
    
    $requete_prepare->execute (
            array("id"=>$personneId));
    $relations = $requete_prepare->fetchAll (PDO::FETCH_OBJ);

    return $relations;
 }
 public function selectAllMusiqueById ($id){

    $requete_prepare=$this->connexion->prepare ("
        SELECT Type FROM Musique
        INNER JOIN RelationMusique
        ON Musique.Id = RelationMusique.Musique_Id
        WHERE RelationMusique.Personne_Id =:id
        ");
        
    $requete_prepare->execute(array("id"=>$id));

    $resultat=$requete_prepare->fetchAll (PDO::FETCH_OBJ);
    
    return $resultat;
}
public function selectAllHobbiesById ($id){

    $requete_prepare=$this->connexion->prepare ("
        SELECT Type FROM Hobby
        INNER JOIN RelationHobby
        ON Hobby.Id = RelationHobby.Hobby_Id
        WHERE RelationHobby.Personne_Id =:id
        ");
        
    $requete_prepare->execute(array("id"=>$id));

    $resultat=$requete_prepare->fetchAll (PDO::FETCH_OBJ);
    
    return $resultat;
}
public function selectAllRelationById ($id){

    $requete_prepare=$this->connexion->prepare ("
        SELECT Personne.Nom, Personne.Prenom, Personne.URL_Photo, Personne.Date_Naissance, RelationPersonne.Type 
        FROM Personne
        INNER JOIN RelationPersonne
        ON RelationPersonne.Relation_Id = Personne.id
        WHERE RelationPersonne.Personne_Id =:id
        ");
        
    $requete_prepare->execute(array("id"=>$id));

    $resultat=$requete_prepare->fetchAll (PDO::FETCH_OBJ);
    
    return $resultat;
}

public function getLastId(){
    return $this->connexion->lastInsertId();
}

}

 

?>