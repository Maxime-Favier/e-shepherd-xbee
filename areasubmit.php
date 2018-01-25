<?php
$bdd = new PDO('mysql:host=maxime1.favier.sql.free.fr;dbname=maxime1_favier;charset=utf8', 'xxxxx', 'xxxxxxx');

// test de l'existance de données
if(!isset($_POST['array1']))
{
	echo 'remplissez tous les champs';
}
else
{
	// suppression de la table avec les anciens points
	$reponse = $bdd->query('TRUNCATE TABLE area');
	// protection injection sql
	$id = htmlspecialchars($_POST['array1']); 
	// convertit en liste
	$tab = explode(',', $id);
	
	$collectionLength = count($tab);
	// parcour de la liste
	for($i = 0; $i < $collectionLength; $i+=2)
	{
		// envoir des données dans la bdd
		$req = $bdd->prepare('INSERT INTO area (lat, longi) VALUES (:lat, :longi)');
		$req->execute(array(
		'lat' => $tab[$i],
		'longi' => $tab[$i + 1],
		));
	}
}
