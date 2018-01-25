<!DOCTYPE html>

<?php
$bdd = new PDO('mysql:host=maxime1.favier.sql.free.fr;dbname=maxime1_favier;charset=utf8', 'maxime1.favier', 'xxxxxx');
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
	<script src="https://maps.googleapis.com/maps/api/js?key=xxxxxxxxxxxxxxxxxxxxxxxx&libraries=drawing"></script>
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
					{ lat:46.0001577, lng:6.7202198424 },
					{ lat:46.0031677, lng: 6.7202198424 },
					<?php
						$reponse1 = $bdd->query('SELECT * FROM `positions`');
						while ($donnees1 = $reponse1->fetch())
						{
					?>
					{ lat:<?php echo $donnees1['lat'];?>,  lng:<?php echo $donnees1['lng'];?>},
					<?php
						}
						$reponse1->closeCursor();
					?>
				]
				// boucle de parcour du tableau des mouttons
				for( var i = 0, I = tableauMarqueurs.length; i < I; i++ ) {
					// tableau de lat lng d'un seul point
					var latlng = tableauMarqueurs[i],
						latitude = latlng["lat"],
						longitude = latlng["lng"];
					// définition et ajout des points sur la carte
					var optionsMarqueur = {
						map: maCarte,
						position: new google.maps.LatLng( latitude, longitude )	
					};
					var marqueur = new google.maps.Marker( optionsMarqueur );
					zoneMarqueurs.extend( marqueur.getPosition() );
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
