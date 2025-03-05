<?php 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MapLibre GL JS Map</title>

    <!-- Include MapLibre CSS for styling -->
    <link href="https://unpkg.com/maplibre-gl@2.10.0/dist/maplibre-gl.css" rel="stylesheet">

    <style>
        /* Set height for the map container */
        #map {
            width: 100%;
            height: 100vh; /* Full viewport height */
        }
    </style>
</head>
<body>
<?php 
require_once('header.php');
?>
    <!-- Map container -->
    <div id="map"></div>

    <!-- Include MapLibre JS library -->
    <script src="https://unpkg.com/maplibre-gl@^5.2.0/dist/maplibre-gl.js"></script>
    <link href="https://unpkg.com/maplibre-gl@^5.2.0/dist/maplibre-gl.css" rel="stylesheet" />

    <script>
        // Initialize the MapLibre map
        const map = new maplibregl.Map({
            container: 'map', // The ID of the container element
            style: 'https://demotiles.maplibre.org/style.json', // A map style URL or style object
            center: [0, 0], // Longitude, Latitude
            zoom: 2, // Zoom level
        });

        // Add a navigation control (zoom and rotation)
        map.addControl(new maplibregl.NavigationControl());

        // Optional: Add a marker to the map
        new maplibregl.Marker()
            .setLngLat([0, 0])
            .setPopup(new maplibregl.Popup().setHTML('<h3>Center of the Map</h3>'))
            .addTo(map);
    </script>

</body>
</html>

