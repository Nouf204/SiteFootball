<!DOCTYPE html>
<html lang="fr"  style="font-size: 13px">
    <head>
        <title>Accueil</title>
        
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
                    
                    <li class="nav-item dropdown-submenu" >
                        <a class="nav-link test " tabindex="-1" href="#">League <span class="caret"></span></a>
            <ul class="dropdown-menu">
          <li><a tabindex="-1" href="#">2nd level dropdown</a></li>
          <li><a tabindex="-1" href="#">2nd level dropdown</a></li>
          <li class="dropdown-submenu">
            <a class="test" href="#">Another dropdown <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="#">3rd level dropdown</a></li>
              <li><a href="#">3rd level dropdown</a></li>
            </ul>
          </li>
        </ul>
      </li>
                    
                    
                    <li class="nav-item dropdown">
                        
                        
                        
                        
                        <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        League
                        </a> 
                        
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            
                            

                            
                            <a class="dropdown-item" href="classement.php?league=pl">Premier League</a>
                            <a class="dropdown-item" href="classement.php?league=liga">La liga</a>
                            <a class="dropdown-item" href="classement.php?league=serieA">Serie A</a>
                            <a class="dropdown-item" href="classement.php?league=ligue1">Ligue 1</a>
                            <a class="dropdown-item" href="classement.php?league=bdl">Bundesliga</a>
                        </div>
                    </li>
                    
 
                    
                    
                </ul>
            </div>
        </nav>
        
        
        <!-- pour gerer la barre des menus-->
        <script>
            $(document).ready(function(){
                $('.dropdown-submenu a.test').on("click", function(e){
                    $(this).next('ul').toggle();
                    e.stopPropagation();
                    e.preventDefault();
                });
            });
        </script>
        

</body>
</html>



<?php

    /*
      /*                         
                    <li class="dropdown-submenu">
        <a class="test" tabindex="-1" href="#">New dropdown <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a tabindex="-1" href="#">2nd level dropdown</a></li>
          <li><a tabindex="-1" href="#">2nd level dropdown</a></li>
          <li class="dropdown-submenu">
            <a class="test" href="#">Another dropdown <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="#">3rd level dropdown</a></li>
              <li><a href="#">3rd level dropdown</a></li>
            </ul>
          </li>
        </ul>
      </li>
        
        
        
        
    
    */

    

    $league = $_GET['league'];
    
    switch($league){
        case 'ligue1':
            $lien = 'http://api.football-data.org/v2/competitions/FL1/standings';
            break;
        case 'pl' :
            $lien = 'http://api.football-data.org/v2/competitions/PL/standings';  
            break;
        case 'liga':
            $lien = 'http://api.football-data.org/v2/competitions/PD/standings';
            break;
        case 'serieA':
            $lien = 'http://api.football-data.org/v2/competitions/SA/standings';
            break;
        case 'bdl':
            $lien = 'http://api.football-data.org/v2/competitions/BL1/standings';
            break;
        
            
    }
    

    echo"
    <table class='table  mx-auto table-hover' style=' width:50%;'>
        <tbody >
            <tr >
                <td scope='col' class='text-white bg-secondary col-6' style='text-align:center; '>Classement</th>
                <td scope='col'  style='text-align:center;'>Buteurs</th>
            </tr>
        </tbody>
    </table>
    ";
    
    // je recupere le classement de chaque league   
    $reqPrefs['http']['method'] = 'GET';
    $reqPrefs['http']['header'] = 'X-Auth-Token: 3154a11e27d24887ba08665b3ef3bb3a';
    $stream_context = stream_context_create($reqPrefs);
    $response = file_get_contents($lien, false, $stream_context);
    $classements = json_decode($response);
    $classements=$classements->{'standings'}[0]->{'table'};


    //je fais un tableau pour afficher les stats
    echo "
    <table class='table mx-auto table-hover ' style=' width:50%;'>
        <thead class='thead-dark'>
            <tr>
                <th scope='col'></th>
                <th scope='col'></th>
                <th scope='col' class='col-6'></th>  
                <th scope='col'>J</th>
                <th scope='col'>But</th>
                <th scope='col'>Df</th>
                <th scope='col'>Pts</th>
            </tr>
        </thead>
    ";
    foreach($classements as $classement){
    
        $journee=$classement->{'playedGames'};
        $position=$classement->{'position'};
        $nom_equipe=$classement->{'team'}->{'name'};
        $logo=$classement->{'team'}->{'crestUrl'};
        $buts=$classement->{'goalsFor'}.":".$classement->{'goalsAgainst'};
        $difference=$classement->{'goalDifference'};
        $points=$classement->{'points'};
       
        echo "
        
            <tbody>
                <tr>
                    <td >".$position."</td>
                    <td > <img src=".$logo." height='25' width='25' /></td>
                    <td >".$nom_equipe."</td>
                    <td >".$journee."</td>
                    <td >".$buts."</td>
                    <td >".$difference."</td>
                    <td>".$points."</td>
                </tr>
            </tbody>
        ";
    }
   echo "</table>";


?>