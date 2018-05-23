<?php
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=maxime1_favier;charset=utf8', 'root', 'root');
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}
session_start(); 
if(!isset($_SESSION['iduser'])){
	header('Location: ../index.html');
}

if(!isset($_POST['array1']))
{
	echo 'remplissez tous les champs';
	header('Location: home.php?erreur=1');
}
else
{
	echo $_POST['array1'];
	$reponse = $bdd->query('TRUNCATE TABLE area');
	$id = htmlspecialchars($_POST['array1']); 
	$tab = explode(',', $id);
	
	$collectionLength = count($tab);

	for($i = 0; $i < $collectionLength; $i+=2)
	{
		$req = $bdd->prepare('INSERT INTO area (lat, longi) VALUES (:lat, :longi)');
		$req->execute(array(
		'lat' => $tab[$i],
		'longi' => $tab[$i + 1],
		));
	}
	header('Location: home.php?done=1');
}
