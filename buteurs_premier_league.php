<!DOCTYPE html>
<html lang="fr"  style="font-size: 13px">
    <head>
        <title>Classement Premier League</title>
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
          <a class="dropdown-item" href="classement_liga.php">La liga</a>
          <a class="dropdown-item" href="classement_ligue1.php">Ligue 1</a>
        </div>
      </li>
    </ul>
  </div>
</nav>
    </body>
</html>




<?php
//<a href='classement_premier_league.php'></a>


    echo"
    <table class='table  mx-auto table-hover' style=' width:50%;'>
        <tbody >
        
            <tr>
            
                <td scope='col'  style='text-align:center;'>Classement</th>
                <td scope='col' class='text-white bg-secondary col-6' style='text-align:center; '>Buteurs</th>     
            </tr>
            </a>
        </tbody>
    </table>
    ";

    
    //je recupere le classement des buteurs
    $uri = 'https://api.football-data.org/v2/competitions/PL/scorers';
    $reqPrefs['http']['method'] = 'GET';
    $reqPrefs['http']['header'] = 'X-Auth-Token: 3154a11e27d24887ba08665b3ef3bb3a';
    $stream_context = stream_context_create($reqPrefs);
    $response = file_get_contents($uri, false, $stream_context);
    $buteurs = json_decode($response);
    
    $buteurs=$buteurs->{'scorers'};

    //je fais un tableau 

    echo "
    <table class='table mx-auto table-hover ' style=' width:50%;'>
        <thead class='thead-dark'>   
            <tr>
                <th scope='col'></td>
                <th scope='col' class='col-6'> Joueur</td>
                <th scope='col' class='col-6'> Equipe </td>
                <th scope='col'>B.</td>
            </tr>
        </thead>
    ";
    $rang=1;
    foreach($buteurs as $buteur){
        $nom_joueur=$buteur->{'player'}->{'name'};
        $poste=$buteur->{'player'}->{'position'};
        $nom_equipe=$buteur->{'team'}->{'name'};
        $nbr_buts=$buteur->{'numberOfGoals'};
        
        switch ($poste) {
            case 'Attacker':
                $poste='Attaquant';
                break;
            case 'Midfielder':
                $poste='milieu';
                break;
        }
        
        echo "
        <tbody>
            <tr>
                <td>".$rang."</td>
                <td >".$nom_joueur."<br>(".$poste.")</td>
                <td >".$nom_equipe."</td>
                <td >".$nbr_buts."</td>
            </tr>
        </tbody>
        ";
        $rang++;
    }
   echo "</table>";




?>