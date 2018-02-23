<?php
/*
 * user/area.php
 */

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
<!DOCTYPE html>
<html>
  <head>
    <title>Sélection du champ</title>
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
    <link rel="stylesheet" href="ESheepSM.css" />
	<style>
			html, body {
				height: 100%;
				margin: 0;
				padding: 0
			}
			#Carte {
				height: 100%
			}
			#zone{
				display:hidden;
			}
			.logout{
				height:92px;
				width: 88px;
			}
	</style>


	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDvxBydr2xpzERF4kQe7jaWHztxKqdktVw&libraries=drawing"></script>
	
	<script>
	function postToURL(a,b,c){
		document.getElementById("zone").action= a;
		document.getElementById("array1").name  = b;
		document.getElementById("array1").value = c;
		document.getElementById("zone").submit();
	}
	</script>
	
	<script>
	//This variable gets all coordinates of polygone 
	var coordinates = [];
	//This variable saves polygon.
	var polygons = [];
	</script>

	<script>
	//save latitude and longitude to the polygons[] variable
	function save_coordinates_to_array(polygon)
	{
		polygons.push(polygon);
		var polygonBounds = polygon.getPath();
		for(var i = 0 ; i < polygonBounds.length ; i++)
		{
			coordinates.push(polygonBounds.getAt(i).lat(), polygonBounds.getAt(i).lng());
		}   
		console.log(coordinates);
		postToURL("areasubmit.php","array1",coordinates);
	}
	</script>
  </head>


<body>
	<header>
          <div class="headerelement">
            <img class="imga" src = "../img/logo_small.png" alt="logo"/>
    	  </div>
            <div class="headerelement">
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
         
	<div id="Carte"></div>

<form id="zone" action="areasubmit.php" method="post">
  <input id="array1" type="hidden" name="array1" value="a">
</form>


</body>


<script>
function initialize()
{
    //Create map.
    var map = new google.maps.Map(document.getElementById('Carte'), {zoom: 15, mapTypeId: 'satellite', center: new google.maps.LatLng(46.0001577,6.7202198,424)});
    //Create drawing manager panel
    var drawingManager = new google.maps.drawing.DrawingManager({
	drawingControlOptions: {
      position: google.maps.ControlPosition.TOP_CENTER,
      drawingModes: ['polygon']
    }
	});
    drawingManager.setMap(map);
    // event creation of polygon completed 
    google.maps.event.addDomListener(drawingManager, 'polygoncomplete', function(polygon) {
        polygon.setEditable(false);
        save_coordinates_to_array(polygon);
    });
	
}
google.maps.event.addDomListener(window, 'load', initialize);
</script>


</html>
