<!DOCTYPE html>

<?php
$bdd = new PDO('mysql:host=maxime1.favier.sql.free.fr;dbname=maxime1_favier;charset=utf8', 'xxxxxxx', 'xxxxx');
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
		</style>
	</head>
	
	<body>
	<script src="https://maps.googleapis.com/maps/api/js?key=xxxxxxxxxxxxxxxxxx&libraries=drawing"></script>
		<div id="Carte"></div>

		<script>
			function initialize() {
				var optionsCarte = {
					zoom: 15,
					center: new google.maps.LatLng(46.0001577,6.7202198,424),
					mapTypeId: 'satellite'
				}
				var maCarte = new google.maps.Map( document.getElementById("Carte"), optionsCarte );
				
				
				var zoneMarqueurs = new google.maps.LatLngBounds();

				// definition de la zone du champ
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
				var optionsPolygone = {
					map: maCarte,
					paths: tableauPointsPolygone
				};
				var monPolygone = new google.maps.Polygon( optionsPolygone );
			}
			google.maps.event.addDomListener(window, 'load', initialize);
		</script>
		
	</body>
</html>
