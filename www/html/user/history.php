<!DOCTYPE html>
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
	header('Location: ../index.php');
}
?>
<html lang="fr">
	<head>
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no"/>
		<meta charset="UTF-8" />
		<title>Sheep Monitoring</title>
		<style>
			html, body {
				height: 100%;
				margin: 0;
				padding: 0
			}
			#Carte {
				height: 100%
			}
			.logout{
				height:92px;
				width: 88px;
			}
		</style>
		<link rel="stylesheet" href="ESheepSM.css" />
	</head>
	
	<body>
	<header>
          <div class="element">
            <img class="imga" src = "../img/logo_small.png" alt="logo"/>
    	  </div>
            <div class="element">
               <h1>E-Sheep</h1>
               <h3>Stay in touch with your livestock</h3>
            </div>
           <nav>
                <div class="navelement">
                   <a href="home.php"><img class="logout" src = "../img/Home.png" alt="Home" /></a>
                </div>
                <div class="navelement">
                   <a href="area.php"><img class="logout" src = "../img/SearchSheep.png" alt="Find"/></a>
                </div>
                <div class="navelement">
                  <a href="map.php"><img class="logout" src = "../img/Geoloc.png" alt="Map"/></a>
               </div>
               <div class="navelement">
                   <a href="../deco.php"><img class="logout" src = "../img/logout.png" alt="logout"/></a>
               </div>
            </nav>
     </header>
     
     
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDvxBydr2xpzERF4kQe7jaWHztxKqdktVw&libraries=drawing"></script>
		<div id="Carte"></div>

		<script>
			function initialize() {
				
				// options et ajout de la carte sur la page
				var optionsCarte = {
					zoom: 15,
					<?php 
						$response = $bdd->prepare('SELECT max(`datation`), lat, lng FROM positions WHERE `idmoutton` = :idmoutton GROUP BY `idmoutton`');
						$response->execute(array(
							'idmoutton' => htmlspecialchars($_GET['idmoutton']),
						));
						$donnees = $response->fetch();
					?>
					center: new google.maps.LatLng(<?php echo $donnees['lat'];?>,<?php echo $donnees['lng'];?>),
					
					mapTypeId: 'satellite'
				}
				var maCarte = new google.maps.Map( document.getElementById("Carte"), optionsCarte );
				var tableauPointsPolyline = [
					<?php
						$req = $bdd->prepare('SELECT * FROM `positions` WHERE idmoutton=:idmoutton');
						$req->execute(array(
							'idmoutton' => htmlspecialchars($_GET['idmoutton']),
						));
						while ($donnees1 = $req->fetch())
						{
					?>
					{ lat:<?php echo $donnees1 ['lat'];?>,  lng:<?php echo $donnees1 ['lng'];?>},
					<?php
						}
						$req->closeCursor();
					?>
				]
				var optionsPolyline = {
					map: maCarte,
					path: tableauPointsPolyline
				};
				var maPolyline = new google.maps.Polyline( optionsPolyline );
				
				var contenuInfoBulle =	'<h1>Sheep n°<?php echo $_GET['idmoutton'];?></h1>' +	
						'<p>Last position refresh <?php echo $donnees['max(`datation`)'];?></p>' +
						'<p><b>POSITION</b>: latitude:<?php echo $donnees['lat'];?>, longitude:<?php echo $donnees['lng'];?>.';
				var optionsInfoBulle = {
					content: contenuInfoBulle
				};
				var infoBulle = new google.maps.InfoWindow( optionsInfoBulle );
				
				var optionsMarqueur = {
					position: new google.maps.LatLng(<?php echo $donnees['lat'];?>,<?php echo $donnees['lng'];?>),
					title: "Sheep n° <?php echo $_GET['idmoutton'];?>",
					map: maCarte,
				};
				
				var marqueur = new google.maps.Marker(optionsMarqueur);
				<?php
					$response->closeCursor();
				?>
				google.maps.event.addListener(marqueur, 'click', function() {
					infoBulle.open(maCarte, marqueur);
				});
			}
			// event : chargement de la map au chargement de la page
			google.maps.event.addDomListener(window, 'load', initialize);
			
		</script>
		
	</body>
</html>
