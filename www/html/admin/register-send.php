<?php
/*
 * register-send.php
 */

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>login</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 1.24.1" />
	<link rel="stylesheet" href="../ESheepSM.css" />
	<style>
	h4
	{
		border-radius: 25px;
		background: rgba(255,0,0,0.65);
		padding: 10px;
		width:300px;
		margin:auto;
		margin-top: 10%;
	}
	</style>
</head>

<body>
 	
	<header>
			<div class="element">
            <img class='imga'src = "../img/logo_small.png" />
    	  </div>
            <div class="element">
               <h1>e-Shepherd</h1>
               <h3>Stay in touch with your livestock</h3>
            </div>
           <nav>
                <div class="navelement">
                   <a href="#"><img src="../img/Home.png" alt="Home"/></a>
                </div>
                <div class="navelement">
                   <a href="ESheepLogon.html"><img src = "../img/SearchSheep.png" alt="Find"/></a>
                </div>
                <div class="navelement">
                  <a href="#"><img src = "../img/Geoloc.png" alt="Map"/></a>
               </div>
            </nav>
 
        </header>
 
	<section class="login">
	    <h2>New user</h2>
	    <div class="log_s2">
			<form action="register.php" method="post" id="formulaire" style="display: block;">
					<label for="login">username :</label>
					<input type="text" name="login" id="login" placeholder="login" required/><br/>
					<label for="email">E-mail :</label>
					<input type="email" name="email" id="email" placeholder="email" required/><br/>
					<label for="mdp">password :</label>
					<input type="password" id="mdp" name="mdp" placeholder="mdp" required/><br/>
					<input type="submit" value="SUBMIT"/>
				</form>	
            </div>
            <?php
					if(isset($_GET['error']) AND $_GET['error'] == 1)
					{
				?>
					<h4>Remplissez tous les champs et mettez une adresse email valide</h4>
				<?php
					}
				?>
				<?php
					if(isset($_GET['error']) AND $_GET['error'] == 2)
					{
				?>
					<h4>Un compte avec le même Email existe déjà.</h4>
				<?php
					}
				?>
	</section>
	

    </body>

</html>
