
<?php
require("connexion.php");

$fiche  = new Connexion();
$connexion =$fiche->getConnnexion();


if(isset($_GET["Fname"])){
    $Nom        =$_GET["Fname"];
    $Prenom     =$_GET["Pnom"];
    $PURL       =$_GET["pUrl"];
    $Date_naissance=$_GET["bDate"];
    $Statut     =$_GET["Status"];


    echo $Nom,"<br>",$Prenom,"<br>",$PURL,"<br>",$Date_naissance,"<br>",$Statut,"<br>";


#Musique
    $musique=array();
    $musique_filter = array();

    $musique[1]     = @$_GET["Rock"];
    $musique[2]     = @$_GET["Pop"];
    $musique[3]     = @$_GET["Rap"];
    $musique[6]     = @$_GET["Country"];
    $musique[7]     = @$_GET["Chill-Out"];
    $musique[8]     = @$_GET["Jazz"];
    $musique[9]     = @$_GET["Autres"];
    foreach ($musique as $key =>$value){

        if($value== "on"){
            $musique_filter[$key] = 1;
        }
    }

//Hobby
$hobby = array();
$hobby_filter =array();

$hobby[1] 			= @$_GET["Camping"]; 
$hobby[3]			= @$_GET["Tennis"];
$hobby[4]			= @$_GET["Golf"];
$hobby[5]			= @$_GET["Echecs"];
$hobby[6] 			= @$_GET["Velo"];
$hobby[7] 			= @$_GET["Lecture"];
$hobby[8] 			= @$_GET["Cinema"];
$hobby[9] 			= @$_GET["Autres"];

foreach($hobby as $key => $value){
    if($value == "on"){
        $hobby_filter[$key]=1;
    }
}

//Personne

$personne_get = $fiche->selectAllPersonne();

$per = array();

		foreach($personne_get as $value=>$key){

			if(@$_GET["$key->Prenom"]){
				$per["$key->id"] = @$_GET["$key->Prenom"];
			}

		}
}

if(isset($_GET["Fname"])){

    $fiche->insertPersonne($Nom,$Prenom,$PURL,$Dnaissance,$Statut);
    $personne_id = $connexion->lastInsertId();


        foreach($per as $key =>$vlaue){
            $fiche->relationPersonne($personne_id, $key, $value);
        }
        foreach ($musique_filter as $key => $value){
            $fiche->RelationMusique($personne_id, $key);
        }
       // header('Location: profil.php?id='.$personne_id);
}

?>




<!DOCTYPE html>
<html>
<head>
    <link href="https://fonts.googleapis.com/css?family=Aref+Ruqaa" rel="stylesheet">
    <link rel="stylesheet" href="inscription.css">
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Annuaire</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>

</head>

<body>
    <button id="myButton">Retour</button>
    <h1>INSCRIPTION</h1>
    <div class="inscription">
        <form method="get" id="inscription" action="inscription.php">
            <label class="text">Nom de Famille :</label><br>
            <input type="text" name="Fname" id="NomDeFamille" class="meme" placeholder="Inserez ici votre nom"><br>
            
            <label>Prénom</label><br>
            <input type="text" name="Pnom" id="prenom" class="meme" placeholder="Inserez ici votre prénom"><br>
            
            <label for="">Insertion photo</label><br>
            <input type="text" id="url" name="pUrl" class="meme" placeholder="URL de Photo"><br>
            
            <label>Date de Naissance :</label><br>
            <input type="date" id="date" name="bDate" class="meme" min="2000-01-01" max="2500-01-01"><br><br>
            
            <label>Status :</label><br>                
                <input type="radio" name="Status" id="celib">
                <label for="celib">Célibataire </label>              
                <input type="radio" name="Status" id="couple">
                <label for="couple">En couple </label>               
                <input type="radio" name="Status" id="pasDef">
                <label for="pasDef">Pas Défini </label><br><br>
            
            <label>Préférences Musicales :</label><br>                
                <input type="checkbox" name="Rock" id="Rock">
                <label for="Rock">Rock </label>                
                <input type="checkbox" name="Pop" id="Pop">
                <label for="Pop">Pop </label>                
                <input type="checkbox" name="Rap" id="Rap">
                <label for="Rap">Rap </label>               
                <input type="checkbox" name="Country" id="Country">
                <label for="Country">Country </label>

                <input type="checkbox" name="Chill-Out" id="Chill-Out">
                <label for="Chill-Out" >Chill-Out</label>

                <input type="checkbox" name="Jazz" id="Jazz">
                <label for="Jazz" >Jazz</label>

                <input type="checkbox" name="Autres" id="Autres...">
                <label for="Autres..." >Autres...</label><br><br>

            <label>Hobbies :</label><br>               
                <input type="checkbox" name="Camping" id="Camping">
                <label for="velo"> Camping </label>
                <input type="checkbox" name="Tennis" id="Tennis">
                <label for="Tennis"> Tennis </label>                
                <input type="checkbox" name="Golf" id="Golf">
                <label for="Golf"> Golf </label>
                <input type="checkbox" name="Echecs" id="Echecs">
                <label for="Echecs"> Echecs </label>
                <input type="checkbox" name="Velo" id="Velo">
                <label for="Velo"> Velo </label>
                <input type="checkbox" name="Lecture" id="Lecture">
                <label for="Lecture"> Lecture </label>
                <input type="checkbox" name="Cinema" id="Cinema">
                <label for="Cinema"> Cinéma </label>

                <input type="checkbox" name="Autres" id="Autres">
                <label for="Autres"> Autres...</label> <br><br>
            
            <label>Je connais...</label><br>
            <div id="ami">
            <?php
					$personne = $fiche->selectAllPersonne();
					 foreach($personne as $key){

                            echo '<p><label name="'.$key->Prenom.'">'.$key->Prenom.' '.$key->Nom.'
                            <select id="select_option" name="'.$key->Prenom.'">
                            	<option default></option>
                            	<option>ami</option>
                            	<option>famille</option>
                            	<option>collège</option>

                            </select>

                            </label></p>';

                        } 

					//<input type="text" name="'.$key->Prenom.'">
					
                ?>
                </div>
        
            <input type="submit" value="J'ai terminé !" class="submit_buttons">
            <input type="reset" value="Reset" class="submit_buttons"><br><br>
        </form>
    </div>
    
</body>

</html>