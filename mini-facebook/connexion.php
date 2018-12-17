<?php

class Connexion {
    private $connexion;


    public function __construct(){

            $PARAM_hote='localhost';
            $PARAM_port='3306';
            $PARAM_nom_bd='Mini-facebook';
            $PARAM_utilisateur='root';
            $PARAM_mot_passe='digital2018';

         try{

            $this->connexion = new PDO ('mysql:host='.$PARAM_hote.';dbname='.$PARAM_nom_bd,
                $PARAM_utilisateur,
                $PARAM_mot_passe);

         }catch (Exception $e) {
            echo 'Erreur : '.$e->getMessage().'<br />';
            echo 'N° : '.$e->getcode();
        }
    
    }//la fin de constructor 


    public function insertHobby(string $hobby) {
        try{

            $requete_prepare = $this->connexion->prepare("INSERT INTO Hobby (Type) values (:hobby)");

            $requete_prepare->execute(array('hobby' => $hobby));
            return true;   
        
        }catch (Exception $e) {
        
            return false;
        }
    }

    public function insertMusique(string $musique) {

        $requete_prepare = $this->connexion->prepare(
          "INSERT INTO Musique (Type) values (:musique)");

        $requete_prepare->execute(
            array('musique' => $musique));   
    }

    public function insertPersonne($nom, $prenom, $URL, $Date, $Statut) {

         $requete_prepare = $this->connexion->prepare(
            "INSERT INTO Personne (Nom, Prenom, URL_Photo, Date_Naissance, Status_couple) 
             values (:Nom, :Prenom, :URL_Photo, :Date_Naissance, :Statut_couple)");
         $requete_prepare->execute(
            array('Nom' => "$nom", 'Prenom' => "$prenom", 'URL_Photo' => "$URL", 'Date_Naissance' => "$Date", 'Statut_couple' => "$Statut"));
         /*
           $requete_prepare->bindValue(":Nom",$nom);
           $requete_prepare->bindValue(":Prenom",$prenom); 
           $requete_prepare->bindValue(":URL_Photo",$URL); 
           $requete_prepare->bindValue(":Date_Naissance",$Date); 
           $requete_prepare->bindValue(":Statut_couple",$Statut); 

           $requete_prepare->execute();
        */
    }


    public function relationPersonne($personne_1, $personne_2,$type){

        $requete_prepare = $this->connexion->prepare(
            
            "INSERT INTO RelationPersonne (Personne_Id, Relation_Id, Type) values (:personne_1, :personne_2, :type)
            "
        );
       $requete_prepare->execute(array("personne_1"=>$personne_1,"personne_2"=>$personne_2,"type"=>$type));

    }


    public function RelationMusique($personne_id, $musique_id){

        $requete_prepare = $this->connexion->prepare(
            
            "INSERT INTO RelationMusique (Personne_Id, Musique_Id) values (:personne_id, :musique_id)
            "
        );
       $requete_prepare->execute(array("personne_id"=>$personne_id,"musique_id"=>$musique_id));
    }


    public function RelationHobby($personne_id, $Hobby_id){

        $requete_prepare = $this->connexion->prepare(
            
            "INSERT INTO RelationHobby (Personne_Id, Hobby_Id) values (:personne_id, :Hobby_id)
            "
        );
       $requete_prepare->execute(array("personne_id"=>$personne_id,"Hobby_id"=>$Hobby_id));
    }


    public function selectAllHobbies() {

            $requete_prepare = $this->connexion->prepare (
            "SELECT Type FROM Hobby");
        $requete_prepare->execute();
        $resultat=$requete_prepare->fetchAll(PDO::FETCH_OBJ);
        return $resultat;  
    }


    public function selectAllHobbiesById(int $id) {


        $requete_prepare = $this->connexion->prepare (
            "SELECT Hobby.Type FROM Hobby
             INNER JOIN RelationHobby
             on RelationHobby.Hobby_Id = Hobby.id
             WHERE RelationHobby.Personne_Id = :id");

        $requete_prepare->execute(array('id' => $id));
        $resultat=$requete_prepare->fetchAll(PDO::FETCH_OBJ);
            return $resultat;  
    }




    public function selectAllMusique() {

        $requete_prepare = $this->connexion->prepare (
            "SELECT Type FROM Musique");
        $requete_prepare->execute();
        $resultat=$requete_prepare->fetchAll(PDO::FETCH_OBJ);
            return $resultat;  
    }


    public function selectAllPersonne() {

        $requete_prepare = $this->connexion->prepare (
            "SELECT * FROM Personne");
        $requete_prepare->execute();
        $resultat=$requete_prepare->fetchAll(PDO::FETCH_OBJ);
            return $resultat;  
    }





     //exercise 9 selectioner les personne qui aiment les musique 

    
    public function selectAllMusiqueById(int $id){

        $requete_prepare = $this->connexion->prepare(

            "SELECT Musique.Type From Musique
            INNER JOIN RelationMusique

            ON RelationMusique.Musique_Id  = Musique.id
            WHERE RelationMusique.Personne_Id = :id ");
        $requete_prepare->execute(array("id"=>$id));

        $resultat = $requete_prepare->fetchAll(PDO::FETCH_OBJ);

        return $resultat;


    }



    public function selectAllPersonneFriends(int $pid){

        $requete_prepare = $this->connexion->prepare("

                SELECT Personne.id,Personne.Nom,Personne.Prenom,Personne.URL_Photo,RelationPersonne.Type FROM Personne
                INNER JOIN RelationPersonne
                ON RelationPersonne.Relation_Id = Personne.id

                WHERE RelationPersonne.Personne_Id = :id 


            ");

        $requete_prepare->execute(array("id"=>$pid));

        $resultat = $requete_prepare->fetchAll(PDO::FETCH_OBJ);

        return $resultat;

    }

    



    public function selectPersonneBYid(int $id) {


        $requete_prepare = $this->connexion->prepare (
            "SELECT * FROM Personne WHERE Id = :id");

        $requete_prepare->execute(array('id' => $id));
        $resultat=$requete_prepare->fetch(PDO::FETCH_OBJ);
            return $resultat;  
    }

    public function selectPersonneByNomPrenomLike($pattern){

        $requete_prepare = $this->connexion->prepare (
            "SELECT * FROM Personne WHERE Nom Like :nom OR Prenom Like :prenom");

        $requete_prepare->execute(array("nom"=>"%$pattern%", "prenom"=>"%$pattern%"));
        $resultat=$requete_prepare->fetchAll(PDO::FETCH_OBJ);
        return $resultat;
    }


    public function getConnnexion(){

        return $this->connexion;
    }

    public function getLastId(){

        return $this->connexion->lastInsertId();
    }

    


}//Fin de la class




?>


