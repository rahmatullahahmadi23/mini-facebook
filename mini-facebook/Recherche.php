<?php
    require("connexion.php");

    $neoconnect = new Connexion();
    if (isset($_GET["Nom"])){
        $data = $_GET["Nom"];
    }else{
        $data = "";
    }


?>
<html lang="en">

<head>
    <link href="https://fonts.googleapis.com/css?family=Aref+Ruqaa" rel="stylesheet">
    <link rel="stylesheet" href="Recherche.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mini-Book</title>
</head>

<body>
    <h1>ANNUAIRE</h1>
    <form action="Recherche.php" method ="GET">

        <div class="check">
            <input type="text" name="Nom" placeholder="Rechercher un Profil" required>
            <input type="submit" class="checkList" value= "Lancer">

        </div>    
        <div class="divTopCenter">
        <button type="button" id="NewProfil" class="buttonSize">Créer un nouveau Profil</button>
        </div>


    </form>
    <div id ="listeDeroule">

        <?php
            $resultat = $neoconnect->selectPersonneByNomPrenomLike($data);

                foreach ($resultat as $key) {
                    echo "<a href='profil.php?id=".$key->id.">
                    <p class='userlist'><img class='liste_img' src='".$key->URL_Photo."'>
                    <span class='listcontact1'>".$key->Prenom."</span>
                    <span class= 'listcontact2'>".$key->Nom." "."</span></p></a>";
                }
        ?>

    </div>


    <script type="text/javascript">
        document.getElementById("NewProfil").onclick = function () {
            location.href = "inscription.php";
        };
    </script>

</body>

</html>