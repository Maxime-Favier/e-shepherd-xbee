<?php
	$bdd = new PDO('mysql:host=localhost;dbname=maxime1_favier;charset=utf8', 'root', 'root');
	
	
	if (isset($_POST['login']) AND isset($_POST['mdp']) AND isset($_POST['email']))
	{
		$mdp = htmlspecialchars($_POST['mdp']);
		$login = htmlspecialchars($_POST['login']);
		$email = htmlspecialchars($_POST['email']);
		
		if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['email']) AND $mdp!== '' AND $login!== '')
		{
			$reqa = $bdd->prepare('SELECT email FROM auth WHERE email=?');
			$reqa->execute(array($email));
			$data = $reqa->fetch();
			
			if ($data)
			{
				header('Location: register-send.php?error=2');
			}
			else
			{
				
				$pass_hache = hash('sha256', $_POST['mdp']);
				$req = $bdd->prepare('INSERT INTO auth (userid, login, email, mdp) VALUES (NULL, :login, :email, :mdp)');
				$req->execute(array(
					'login' => $login,
					'email' => $email,
					'mdp' => $pass_hache));
				echo 'vous avez bien été enregistré';
				header('Location: /..login.php');
			}
		}
		
		else
		{
			//echo 'remplissez tous les champs';
			header('Location: register-send.php?error=1');
			
		}
	}
	
	else
	{
		//echo 'remplissez tous les champs';
		header('Location: register-send.php?error=1');
	}	
?>
