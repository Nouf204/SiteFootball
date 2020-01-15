
<!DOCTYPE html>
<html lang="fr"  style="font-size: 13px">
    <head>
        <title>Matches en live</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> 
    </head>
   <body>
    
<nav class="navbar navbar-expand-lg mx-auto mt-2" style=" width:98%; height: 1px; background-color: #333;">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse " id="navbarNavDropdown" >
    <ul class="navbar-nav ">
      <li class="nav-item active">
        <a class="nav-link text-white" href="index.html" >Accueil<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="matchs_en_cours.php">Matches en live</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          League
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="classement_premier_league.php">Premier League</a>
          <a class="dropdown-item" href="#">La liga</a>
          <a class="dropdown-item" href="#">Ligue 1</a>
        </div>
      </li>
    </ul>
  </div>
</nav>
    </body>
</html>



<?php

// recupere les objets json
$json_scores_live = file_get_contents("https://livescore-api.com/api-client/scores/live.json?key=cYkCcSWIQ2s9WrFu&secret=yqjeC0UrjSuW4K2hImUUeQC5S5fOxUj6");
$json_toutes_competition = file_get_contents("https://livescore-api.com/api-client/competitions/list.json?key=cYkCcSWIQ2s9WrFu&secret=yqjeC0UrjSuW4K2hImUUeQC5S5fOxUj6");

//convertir les objets json en php
$parsed_json_scores_live = json_decode($json_scores_live);
$parsed_json_toutes_competition=json_decode($json_toutes_competition);


//recupere toutes les matches (en cours) et competions
$matchs = $parsed_json_scores_live->{'data'}->{'match'};
$competitions = $parsed_json_toutes_competition->{'data'}->{'competition'};




echo"<table class='table mx-auto table-hover' style=' width:50%;'>";

//pour chaque competition, on regarde s'il existe un match en cours 
for($i = 0; $i < count($competitions); $i++){
    $tableau=1;
    $nom_competition=$competitions[$i]->{'name'};
    $nom_pays=$competitions[$i]->{'countries'}[0]->name;
    
    for($j = 0; $j < count($matchs); $j++){
        
        if($competitions[$i]->{'id'}==$matchs[$j]->{'competition_id'}){ 
            if($tableau==1) {
                $nom_competition_pays =$nom_pays." : ".$nom_competition;
                if($nom_competition=='Club Friendlies'){
                    $nom_competition_pays='Match Amical';
                }
                
                $tableau=0;
                echo "
                <thead class='thead-dark'>
                    <tr>     
                        <th scope='col'>".$nom_competition_pays."</td>
                        <th scope='col'></td>
                        <th scope='col'></td>
                        <th scope='col'></td>
                        <th scope='col'></td>
                    </tr>
                </thead>";
                
            }
            
            $statut=$matchs[$j]->{'status'};
            $home=$matchs[$j]->{'home_name'};
            $score=$matchs[$j]->{'score'};
            $away=$matchs[$j]->{'away_name'};
            $minute=$matchs[$j]->{'time'};
            
            if($statut=='FINISHED'){
                $statut='Terminé';
            }
            elseif($statut=='NOT STARTED'){
                $statut=$minute;
            }
            elseif($statut=='HALF TIME BREAK'){
                $statut='Mi-temps';
            }
            else{
                $statut=$minute.'\'';
            }
            

            echo "
            <tbody>
                <tr>
                    <td >".$statut."</td>
                    <td >".$home."</td>
                    <td >".$score."</td>
                    <td >".$away."</td>
                    <td ></td>      
                </tr>
            </tbody>
            ";
        }
    }  
}

echo"</table>";

?>



