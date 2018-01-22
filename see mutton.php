<!DOCTYPE html>

<?php
$bdd = new PDO('mysql:host=xxxxxxxxxxxxx;dbname=maxime1_favier;charset=utf8', 'xxxxxxxxxxx', 'xxxxxxxxxxxx');
?>

<html lang="fr">
	<head>
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no"/>
		<meta charset="UTF-8" />
		<title>Titre de votre page</title>
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
	<script src="https://maps.googleapis.com/maps/api/js?key=xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx&libraries=drawing"></script>
		<div id="Carte"></div>

		<script>
			function initialize() {
				var optionsCarte = {
					zoom: 8,
					center: {lat: 47.251037, lng: 0.786379},
					mapTypeId: google.maps.MapTypeId.ROADMAP
				}
				var maCarte = new google.maps.Map( document.getElementById("Carte"), optionsCarte );
				

						
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
