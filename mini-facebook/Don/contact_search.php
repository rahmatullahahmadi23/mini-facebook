<?php
require("connexion.php");

$obj = new Connexion();

if(isset($_GET["Nom"])){
$data = $_GET["Nom"];

}else {
$data = "abcdefgh";    
}

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<meta charset="utf-8">
</head>
<body>
    <div id="contact_container">
        <p id="contactlist">Liste de contact <a href="signup.php"> Create a profile</a></p>
        
        <form action="contact_search.php" method="GET">
            
            <input type="text" name="Nom" placeholder="Chercher un profil" required>
            <button>submit</button>

        </form>


        <div id="content_search">

                
            <?php
                    $resultat = $obj->selectPersonneByNomPrenomLike($data);
                    
                    foreach ($resultat as $key) {
                        echo "<a href='profile.php?id=".$key->id."'><p class='userlist'><img class='listed_images' src='".$key->URL_Photo."'><span class='listcontact1'>".$key->Prenom."</span><span class='listcontact2'>".$key->Nom."</span></p></a>";
                    }



            ?>

        </div>



        <!--

        <p class="userlist"><img class="listed_images" src="user.png" alt="" srcset=""><span class="listcontact1">Vincent berset</span><span class="listcontact2">ami</span> </p>
        <p class="userlist"><img class="listed_images" src="user.png" alt="" srcset=""><span class="listcontact1">Vincent berset</span><span class="listcontact2">ami</span> </p>
        <p class="userlist"><img class="listed_images" src="user.png" alt="" srcset=""><span class="listcontact1">Vincent berset</span><span class="listcontact2">ami</span> </p>
        <p class="userlist"><img class="listed_images" src="user.png" alt="" srcset=""><span class="listcontact1">Vincent berset</span><span class="listcontact2">ami</span> </p>

        -->

    </div>
</body>
</html>