<?php

/*
 * lisnter.php
 */
 
 try
{
	$bdd = new PDO('mysql:host=localhost;dbname=maxime1_favier;charset=utf8', 'root', 'root');
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}

if(!isset($_POST['idmoutton']) OR !isset($_POST['lat']) OR !isset($_POST['lng']) OR !isset($_POST['mdp']))
{
	echo 'remplissez tous les champs';
}
elseif($_POST['mdp'] !== "2788223e73728d8339cbc5366945c90b0a394bfa6bafe1426cc5eb221fd36bba")
{
	echo 'mdp incorect';
}
else
{
	$req = $bdd->prepare('INSERT INTO positions (lat, lng, idmoutton, datation) VALUES (:lat, :lng, :idmoutton, NOW())');
	$req->execute(array(
		'lat' => htmlspecialchars($_POST['lat']),
		'lng' => htmlspecialchars($_POST['lng']),
		'idmoutton' => htmlspecialchars($_POST['idmoutton']),
	));
}
echo "done";
?>

<!DOCTYPE html>
<html>
  <head>
    <title>listner</title>
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">

  </head>

<body>

  <form id="zone" action="lisnter.php" method="post">
    <input id="lat" type="text" name="lat" value="a">
    <input id="lng" type="text" name="lng" value="a">
    <input id="mdp" type="text" name="mdp" value="a">
    <input id="idmoutton" type="text" name="idmoutton" value="a">
    <input type="submit" value="Connexion"/>
  </form>

</body>

</html>

