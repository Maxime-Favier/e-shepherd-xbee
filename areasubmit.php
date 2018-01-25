<?php
$bdd = new PDO('mysql:host=maxime1.favier.sql.free.fr;dbname=maxime1_favier;charset=utf8', 'maxime1.favier', 'xxxxxxxx');
if(!isset($_POST['array1']))
{
	echo 'remplissez tous les champs';
}
else
{
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
}
