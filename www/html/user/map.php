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
		<title>Monitoring des moutons</title>
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
					center: new google.maps.LatLng(46.0001577,6.7202198424),
					mapTypeId: 'satellite'
				}
				var maCarte = new google.maps.Map( document.getElementById("Carte"), optionsCarte );
				
				var zoneMarqueurs = new google.maps.LatLngBounds();
				// tableau des points
				var tableauMarqueurs = [
					<?php
						$reponse1 = $bdd->query('SELECT max(`datation`), idmoutton, lat, lng FROM positions GROUP BY `idmoutton`');
						while ($donnees1 = $reponse1->fetch())
						{
					?>
					{ lat:<?php echo $donnees1['lat'];?>,  lng:<?php echo $donnees1['lng'];?>, title:"<?php echo $donnees1['idmoutton'];?>", refresh:"<?php echo $donnees1['max(`datation`)'];?>", content:"<h1>Sheep n° <?php echo $donnees1['idmoutton'];?></h1><p>Last position refresh <?php echo $donnees1['max(`datation`)'];?></p><p><b>POSITION</b>: latitude: <?php echo $donnees1['lat'];?>, longitude: <?php echo $donnees1['lng'];?>.</p><p><a href='history.php?idmoutton=<?php echo $donnees1['idmoutton'];?>'/>Position history</a></p>"},
					<?php
						}
						$reponse1->closeCursor();
					?>
				]
				console.log(tableauMarqueurs[1]["content"]);
				var infoWindow = new google.maps.InfoWindow();
				// boucle de parcour du tableau des mouttons
				for( var i = 0, I = tableauMarqueurs.length; i < I; i++ ) {
					// tableau de lat lng d'un seul point
					var latlng = tableauMarqueurs[i],
						latitude = latlng["lat"],
						longitude = latlng["lng"];
						title = latlng["title"];
						refresh = latlng["refresh"];
						
					// définition et ajout des points sur la carte
					var optionsMarqueur = {
						map: maCarte,
						position: new google.maps.LatLng( latitude, longitude),	
						title: "Sheep n° "+ title,
					};
					
					var marqueur = new google.maps.Marker( optionsMarqueur );
					zoneMarqueurs.extend( marqueur.getPosition() );
					
					(function(marker, data) {
						// Attaching a click event to the current marker
						google.maps.event.addListener(marker, "click", function(e) {
							infoWindow.setContent(data);
							infoWindow.open(maCarte, marker);
						});
					})(marqueur, tableauMarqueurs[i]["content"]);
				}
				// centre la carte sur les points
				maCarte.fitBounds( zoneMarqueurs );
				
				// definition de la zone du champ et ajout par php
				var tableauPointsPolygone = [
				<?php
					$reponse = $bdd->query('SELECT * FROM `area`');				
					while ($donnees = $reponse->fetch())
					{	
				?>
				
					new google.maps.LatLng(<?php echo $donnees['lat']; ?>,<?php echo $donnees['longi']; ?>),
				<?php
					}
					$reponse->closeCursor();
				?>
				];
				// definition et ajout des points sur le polygone
				var optionsPolygone = {
					map: maCarte,
					paths: tableauPointsPolygone
				};
				var monPolygone = new google.maps.Polygon( optionsPolygone );
			}
			// event : chargement de la map au chargement de la page
			google.maps.event.addDomListener(window, 'load', initialize);
		</script>
		
	</body>
</html>
