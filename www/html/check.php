<?php
/*
 * check.php
 */
	$bdd = new PDO('mysql:host=localhost;dbname=maxime1_favier;charset=utf8', 'root', 'root');
	
	$id = htmlspecialchars($_POST['user']);
	$mdp = htmlspecialchars($_POST['pass']);
	
	$pass_hache = hash('sha256', $_POST['pass']);
	
	$req = $bdd->prepare('SELECT email,userid FROM auth WHERE login = :id AND mdp = :mdp');
	$req->execute(array(
		'id' => $id,
		'mdp' => $pass_hache));
	$resultat = $req->fetch();
	
	if ($resultat)
	{
		echo 'Vous êtes co élève';
		session_start();
		$_SESSION['iduser'] = $resultat['userid'];
		$_SESSION['email'] = $resultat['email'];
		header('Location: user/home.php');
		
	}
	else{
		//echo 'Mauvais identifiant ou mot de passe !';
		header('Location: ESheepLogon.html');
	}
?>
