<!DOCTYPE html>
<html>
<head>
    <title>Mapa de Regiones Geográficas de Argentina</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <style>
        body, html {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        #map {
            height: 100%;
            width: 100%;
        }
    </style>
</head>
<body>
    <h1>Mapa de Regiones Geográficas de Argentina</h1>
    <div id="map"></div>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        function initMap() {
            var map = L.map('map').setView([-34.0, -64.0], 5); // Centro de Argentina y nivel de zoom
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
                maxZoom: 18
            }).addTo(map);
            var regions = [
                { name: 'Patagonia', coordinates: [[-41.0, -73.0], [-41.0, -63.0],  [-56.0, -63.0], [-56.0, -73.0]], color: 'blue', link: 'https://example.com/patagonia' },
                { name: 'Cuyo', coordinates: [  
                    [-29.0, -72.0],
                    [-29.0, -64.0],
                    [-37.0, -64.0],
                    [-37.0, -72.0]
                ], color: 'green', link: 'https://example.com/cuyo' },
                { name: 'Llanura Pampeana', coordinates: [
                   [-33.0, -65.0],
                   [-33.0, -59.0],
                   [-41.0, -59.0],
                   [-41.0, -65.0]
                ], color: 'orange', link: 'https://example.com/pampeana' },
            ];
            for (var i = 0; i < regions.length; i++) {
                var region = regions[i];
                var polygon = L.polygon(region.coordinates, { color: region.color }).addTo(map);
                polygon.bindPopup('<strong>' + region.name + '</strong><br><a href="' + region.link + '">Más información</a>');
            }
        }
    </script>
    <script>
        window.onload = function() {
            initMap();
        };
    </script>
</body>
</html>
