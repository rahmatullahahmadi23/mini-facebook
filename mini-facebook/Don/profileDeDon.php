<?php

require("connexion.php");

$obj = new Connexion();

$connexion = $obj->getConnnexion();

if(isset($_GET["id"])){


 //$data = intval($_GET["id"]); 

$userid = $obj->selectPersonneBYid(intval($_GET["id"]));



if(@(intval($_GET["id"]) ==intval($userid->id))){

   $data = intval($_GET["id"]); 





//$obj->selectPersonneBYid($data);





?>


<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<meta charset="utf-8">
</head>
<body>
    <div id="profil_container">
        <p id="searchprofile"><a href="contact_search.php">Chercher</a></p>
        <div id="profile">
            <?php
                
                $personne = $obj->selectPersonneBYid($data);
                echo '<img  id="user_image" src="'.$personne->URL_Photo.'">';
                echo "<h1>".$personne->Nom."</h1>";
                echo "<h2>".$personne->Prenom."</h2>";
                echo "<p>Date de naissance:".$personne->Date_Naissance."</p>";
                echo "<p>Status:".$personne->Status_couple."</p>";

            ?>
            <!--
            <img  id="user_image" src="user.png">
            <h1>User Name</h1>
            <h2>lastname</h2>
            <p>Date de naissance: 1994</p>
            <p>Statut: Célibataire</p>

             -->
        </div>

        <div id="userdetails">
            <div id="hobbies_details">
                <h2>Hobbies</h2>
                <ul>
                    <!--
                    <li>Hiking</li>
                    <li>Cinema</li>
                    <li>Danse</li>
                    <li>Swimming</li>
                    -->
                    

                    <?php

                       $hobi = $obj->selectAllHobbiesById($data);

                       foreach($hobi as $key){

                            echo "<li>".$key->Type."</li>";

                        } 

                    ?>

              
                </ul>
            </div>
            <div id="music_details">
                <h2>Music</h2>
                <ul>
                    <!--
                    <li>Rock</li>
                    <li>R&B</li>
                    <li>Pop</li>
                    <li>Metal</li>
                    -->

                    <?php

                       $hob = $obj->selectAllMusiqueById($data);
                        foreach($hob as $key){

                            echo "<li>".$key->Type."</li>";

                        }


                    ?>
                </ul>
            </div>  
        </div>

        
        <div id="user_friends">
            <h2 id="h2_friends">En Relation Avec</h2>
            
           <!--
           <a href="?id=1"><p><img src="user.png" alt="" srcset=""><span class="friendname_1">Vincent berset</span><span class="friendname_2">ami</span></p></a>
            -->
           <?php

           $ami = $obj->selectAllPersonneFriends($data);

            foreach($ami as $key){

                echo "<a href='?id=".$key->id."'><p><img src='".$key->URL_Photo."'><span class='friendname_1'>".$key->Prenom."</span><span class='friendname_2'>".$key->Type."</span></p></a>";

            }
 



 }//enterior if    

 else{

    echo "<p><h1 style='color:red;text-align:center;font-size:40pt;'>Id not found <h1></p>";
    echo "<p><h2 style='color:red;text-align:center;font-size:48pt;color:red;'>Error 404</h2></p>";
 }

 }//la fin de premier if isset          
?>        
        
        
        
        </div>  
    </div>
</body>
</html>
