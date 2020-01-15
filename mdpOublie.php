<!doctype html>
<html>
<head>
	<meta charest="utf-8">
	<title>Mot de passe oublié</title>
</head>
<body>
	<div id='bloc'>
	<form>
        <h1>Formulaire d'inscription</h1>
        <p>
            <label for="Prenom">Pseudo</label> :
            <input type="text" name="prenom" id="prenom" required>
            <span id="aidePrenom"></span>
        </p>

        <p>
            <label for="mail">Mail</label> :
            <input type="email" name="mail" id="mail" required placeholder="utilisateur@domaine.fr">
            <span id="aideMail"></span>
        </p>

        <input id="envoyer" type="submit" name="envoyer" value="Envoyer">
        <input type="reset" name="annuler" value="Annuler">
    </form>
    </div>

</body>
</html>

<script type="text/javascript">
function envoie () {
	document.getElementById('bloc').textContent='Mail envoye';
	document.getElementById('envoyer').color='red';
	
}
</script>


<?php
if(isset(envoyer)){
	echo"envoie();"
}
?>