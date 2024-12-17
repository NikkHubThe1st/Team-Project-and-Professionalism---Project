<?php
include("functions.php");
check_login(); //ensure user is logged in to access listings to php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Map</title>
    <link rel="stylesheet" href="styles.css">
    <!-- Leaflet.js CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" crossorigin=""/>
  
</head>
<body>
    
    <?php
    createNavbar();
    ?>
    

<div id="legend" class="legend">
    <h3>Map Legend</h3>
    <ul>
        <li><span class="circle" style="background-color: red;"></span> Your Location</li>
        <li><span class="circle" style="background-color: blue;"></span> Compost</li>
        <li><span class="polygon" style="background-color: rgba(0, 255, 0, 0.5);"></span> Local Area</li>
    </ul>
</div>
    <!-- Main Content -->
    <div id="main-content">
        <div id="map"></div> <!-- Map Container -->
    </div>

    <!-- Leaflet.js JavaScript -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" crossorigin=""></script>
    <script src ="map.js"></script>
	<script src="script.js"></script>
</body>
</html>

