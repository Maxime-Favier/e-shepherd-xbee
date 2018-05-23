    <?php
/*
 * user/home.php
 */

include_once("point-in-polygon.php");
$pointLocation = new pointLocation();
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
        header('Location: ../index.html');
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
<title>E-Sheep</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta name="generator" content="Geany 1.24.1" />
    <link rel="stylesheet" href="ESheepSM.css" />
    <style>
            .logout{
                height:92px;
                width: 88px;
            }
    </style>
</head>

<body>

    <header>
          <div class="headerelement">
            <img class="imga" src = "../img/logo_small.png" />
          </div>
            <div class="headerelement">
               <h1>e-Shepherd</h1>
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
       
    <section class="welcome">

            <h1>Welcome to e-sheep application</h1>
           <div>
            <h2>Control pannel</h2>
            
            <table>
               <tr>
                   <th>Sheep ID</th>
                   <th>Last refresh</th>
                   <th>Status</th>
                   <th>History</th>
               </tr>
            <?php
            $champ = $bdd->query('select `lat`, `longi` from area');
            $limite = array();
            while($arra = $champ->fetch())
                {
                    array_push($limite, ''.floatval($arra['lat']).' '.floatval($arra['longi']).'');
                }
                
            $champ->closeCursor();
            
            $reponse = $bdd->query('select `lat`, `lng`, `idmoutton`, max(`datation`) from positions group by `idmoutton`');                
                    while ($donnees = $reponse->fetch())
                    {   
                        
                ?>
                    <tr>
                       <td><?php echo $donnees['idmoutton']; ?></td>
                       <td><?php echo $donnees['max(`datation`)']; ?></td>
                       <td><?php echo "Sheep " . $pointLocation->pointInPolygon("".$donnees['lat']." ".$donnees['lng']."", $limite) . " the field" ?></td>
                       <td><a href='history.php?idmoutton=<?php echo $donnees['idmoutton']; ?>'>click here</a></td>
                   </tr>
                <?php
                    }
                    $reponse->closeCursor();
             ?>  
            </table>
            </div> 
    </section>

    </body>
    
</html>
