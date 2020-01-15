
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Manipulation des formulaires</title>
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





