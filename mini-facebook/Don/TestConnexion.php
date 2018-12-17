<?php 
include ('connexion.php');







$connexion_obj = new Connexion();

$connexion = $connexion_obj->getConnnexion();

if($connexion != null) {

  //echo $connexion_obj->relationPersonne(4,1,"ami");

}   
else {
    echo "connexion BD échouée";

  }


// insertHobby("Football");
// insertHobby("Cinema");
// insertHobby("Lire");
// insertHobby("Jeux");
// insertHobby("Fashion");
// insertHobby("Hockey");

// insertMusique("Rock");
// insertMusique("Hip-Hop");
// insertMusique("Metal");
// insertMusique("Jazz");
// insertMusique("R&B");
// insertMusique("POP");

// if(insertHobby ("Poker")) {
//     echo "réussi";
// }
// else {
//     echo "Houston y a un probleme";
// }

// insertPersonne(Paul, Hemique, "http://www.willsmith.net/", "1968.09.25", marie);
//$err = $connexion_obj->insertPersonne("Paul", "Hemique", "non definie", "2012-02-02", "marie");
    
    // $hobbies=selectAllHobbies();
    // echo "<ul>";
    // foreach($hobbies as $Hobby) {
    //    echo  "<li>".$Hobby->Type."</li>"."<br />";
    // }
    // echo "</ul>";

// $music=selectAllMusique();

//     foreach($music as $Musique) {
//         echo "<input type=\"checkbox\" name=\"genre\" valeur=\"Musique\" >"; 
//         echo  "$Musique->Type"."<br />";
// }

// $personID=selectPersonneBYid(6);
// echo $personID->Nom;

//$personne=selectPersonneByNomPrenomLike("au");
    //var_dump ($personne);
    
?>