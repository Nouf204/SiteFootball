




<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>formulaires d'inscription</title>
    </head>
    
    <body>
        <form action="inscription.php" method="post">
            <h1>Formulaire d'inscription</h1>
            <p>
                <label for="nom">Nom</label><br>
                <input type="text" name="nom" id="nom" required>
                <span id="aideNom"></span>
            </p>
            <p>
                <label for="prenom">Prenom</label><br>
                <input type="text" name="prenom" id="prenom" required>
                <span id="aidePrenom"></span>
            </p>
            <p>
                <label for="courriel">Courriel</label><br>
                <input type="email" name="email" id="courriel" required placeholder="utilisateur@domaine.fr">
                <span id="aideCourriel"></span>
            </p>
            <p>
                <label for="mdp">Mot de passe</label><br>
                <input type="password" name="mdp" id="mdp" required>
                <span id="aideMdp"></span>
            </p>
            <p>
                <label for="cmdp">Confirmation mot de passe</label><br>
                <input type="password" name="cmdp" id="cmdp" required>
                <span id="aideCmdp"></span>
            </p>

            <input type="submit" value="Envoyer" name="inscription">
            <input type="reset" value="Annuler">
            </form>
        <script src="js/inscription.js"> </script>
    </body>
</html>






<?php

    ////https://rapidapi.com/sportsop/api/soccer-sports-open-data/details
//Go to https:\/\/docs.rapidapi.com\/docs\/keys
//https://public.opendatasoft.com/explore/dataset/resultats-ligue-1/api/

	$servername = "localhost";
	$username = "root";
	$password = "root";	
	try 
	{
		$conn = new PDO("mysql:host=$servername;dbname=BDFoot",$username, $password);
	}
	catch(PDOException $e)
	{
		echo "Connection echouée: " . $e->getMessage();
	}
	if (isset($_POST['inscription'])) 
	{
		try
		{
            $nom=$_POST['nom'];
			$prenom=$_POST['prenom'];
            $email=$_POST['email'];
			$mdp=$_POST['mdp'];
            $cMdp=$_POST['cmdp'];

			$resultat=$conn->query("SELECT count(*) FROM utilisateur WHERE email='$email'");
            
			$compte=$resultat->fetch();

			if($compte['count(*)']==0)
			{
                if($mdp==$cMdp){
					$sql = "INSERT INTO utilisateur (nom, prenom, email, mdp)
    				VALUES ('$nom', '$prenom','$email','$mdp')";
    				$conn->exec($sql);
					header('Location: inscription.php');
				}

				else
				{
					echo "<div>";
					echo "Attention! Mots de passe non identiques.";
					echo "</div> <br><br>";
				}
			}

			else
			{
				echo "<h4>
						Attention ! <br>
                        l'email est déjà utilisé. <br>
						Vérifiez que vous n'avez pas déjà de compte avec et email.
						</h4>";
			}

		
    	}

		catch(PDOException $e)
    	{
    		echo $sql . "<br>" . $e->getMessage();
    	}

    }
?>


























