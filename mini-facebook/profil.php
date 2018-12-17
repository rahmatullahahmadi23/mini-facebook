<?php
require_once ("connexion.php");

$profil = new Connexion();
if(isset($_GET["id"]));
$result = intval($_GET["id"]);

?>
<html lang="en">

<head>
    <link href="https://fonts.googleapis.com/css?family=Aref+Ruqaa" rel="stylesheet">
    <link rel="stylesheet" href="profil.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mini-Book</title>
</head>

<body>
    <h1>PROFIL de:</h1>

    
    <?php 
        $fiche =$profil->selectPersonneById($result);
    
    
    ?>
    <div>
        <div>
            <p>
                <?php echo "<p class='userlist'><img class='img' src='".$fiche->URL_Photo."'>" ?>
            </p>
            <p class="NomPos">
                <?php echo $fiche->Nom." "; ?>
            </p>
            <p class="prenomPos">
                <?php echo $fiche->Prenom; ?>
            </p>    
        </div>
    
    
    
    </div>






    <div class="divTopRight">
        <br>
        <button type="submit" id="buttonDeSortir" class="buttonSize">Sortir</button>
    </div>
    <?php
        $fiche = $profil->selectPersonneById($result);
        /* foreach ($fiche as $key){ */
            
            
    ?>

   
    <div class="divTopLeft daTa">
        <div class="alignleft">
            <p><?php echo $fiche->Date_Naissance  ?></p>
        </div>
        <div class="alignright">
            <p>En Couple</p>
        </div>
    </div>
    <div class="divTopLeft song">
        <div class="alignleft">
            <p>Préférences Musicales</p>
        </div>
        <div class="divTopLeft diver">
            <div class="alignleft">
                <p>Rock, Classic, Autres...</p>
            </div>
        </div>
    </div>
    <div class="divTopLeft song">
        <div class="alignleft">
            <p>Hobbies</p>
        </div>
        <?php

//<?php

$hobi = $fiche->selectAllHobbiesById($data);

foreach($hobi as $key){

     echo "<li>".$key->Type."</li>";

 //} 

//?>



/* 
        $hobby = $profil->selectAllHobbiesById($result);
        foreach ($hobby as $key){
*/
        ?>
        <div class="divTopLeft diver">
            <div class="alignleft">
                <p><?php echo $key->Type?></p>
            </div>
        </div>
    </div>
        <?php
        }
        ?>
    <div class="divTopLeft song">
        <div class="alignleft">
            <p>Il connait personnellement...</p>
        </div>
    </div>
    <?php
        $friend = $profil->selectAllRelationById($result);
        foreach ($friend as $key){
    ?>
    <div class="divTopLeft diver">
        <div class="alignleft">
            <p><?php echo $key->URL_Photo." ".$key->Nom ." ". $key->Prenom ." "?></p>
        </div>
        <div class="alignright">
            <p><?php echo $key->Type ?><button type="submit" id="buttonVoirProfil" class="buttonProfil">- Voir le Profil -</button></p>
        </div>

    </div>
    <?php
        }
    ?>
    <script type="text/javascript">
        document.getElementById("buttonDeSortir").onclick = function(){
            location.href = "Recherche.php";
        };
    </script>
</body>

</html>