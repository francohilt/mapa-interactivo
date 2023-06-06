<!DOCTYPE html>
<html>
<head>
    <title>Mapa de Regiones Geográficas de Argentina</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        .legend {
            position: absolute;
            background-color: white;
            padding: 10px;
            border-radius: 5px;
            font-family: Arial, sans-serif;
            font-size: 14px;
            line-height: 1.5;
        }
        .legend-item {
            display: flex;
            align-items: center;
            margin-bottom: 5px;
        }
        .legend-color {
            width: 20px;
            height: 20px;
            margin-right: 5px;
        }

        /* CSS para dispositivos móviles */
        @media only screen and (max-width: 600px) {
            .legend {
               
                bottom: 20px;
                left: 20px;
                right: 20px;
            }
        }

        /* CSS para dispositivos de escritorio */
        @media only screen and (min-width: 601px) {
            .legend {
                bottom: 20px;
                right: 20px;
            }
        }
    </style>
</head>
<body>
    <!-- <h1>Mapa de Regiones Geográficas de Argentina</h1> -->
    <div id="map"></div>
    <div id="coordinates"></div>
    <div id="legend" class="legend"></div>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        function initMap() {
            var map = L.map('map').setView([-34.0, -64.0], 5); // Centro de Argentina y nivel de zoom
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
                maxZoom: 18
            }).addTo(map);
            var regions = [
                { name: 'Patagonia', coordinates: [
                    [-38.0, -72.0], 
                    [-38.0, -68.0], 
                    [-39.5, -68.0], 
                    [-39.5, -62.0],
                    [-55.0, -62.0], 
                    [-55.0, -72.0],  
                ], 
                    color: 'rgba(0, 51, 102, 0.8)', link: 'https://example.com/patagonia' },
                
                { name: 'Cuyo', coordinates: [  
                    [-38.0, -71.0], 
                    [-38.0, -68.0], 
                    [-27.0, -68.0], 
                    [-27.0, -71.0], 
                ], color: 'rgba(255, 215, 0, 0.8)', link: 'https://example.com/cuyo' },
                
                { name: 'Sierras Pampeanas', coordinates: [  
                    [-34.0, -68.0], 
                    [-34.0, -63.8], 
                    [-27.0, -63.8], 
                    [-27.0, -68.0], 
                ], color: 'rgba(102, 51, 0, 0.8)', link: 'https://example.com/sierrasPampeanas' },

                { name: 'Llanura Pampeana', coordinates: [  
                    [-34.0, -68.0], 
                    [-34.0, -63.8], 
                    [-31.0, -63.8], 
                    [-31.0, -57.0],
                    [-39.5, -57.0],
                    [-39.5, -68.0],
                ], color: 'rgba(255, 102, 0, 0.8)', link: 'https://example.com/llanuraPampeana' },

                { name: 'Noroeste', coordinates: [  
                    [-27, -68.8],
                    [-27, -63.8], 
                    [-21.7, -63.8],
                    [-21.7, -68.8],
                ], color: 'rgba(204, 0, 0, 0.8)', link: 'https://example.com/noroeste' },

                { name: 'Llanura Subtropical', coordinates: [  
                    [-31.0, -63.8], 
                    [-31.0, -57.0],
                    [-21.7, -57.0],
                    [-21.7, -63.8],
                ], color: 'rgba(255, 102, 153, 0.8)', link: 'https://example.com/llanuraSubtropical' },

                { name: 'Meseta Subtropical', coordinates: [  
                    [-29.8, -57.0], 
                    [-29.8, -53.0], 
                    [-25.3, -53.0], 
                    [-25.3, -57.0],

                ], color:'rgba(0, 100, 0, 0.8)', link: 'https://example.com/mesestaSubtropical' },
            ];
            for (var i = 0; i < regions.length; i++) {
                var region = regions[i];
                var polygon = L.polygon(region.coordinates, {color: 'black', fillColor: region.color, fillOpacity: 0.4 }).addTo(map);
                polygon.bindPopup('<strong>' + region.name + '</strong><br><a href="' + region.link + '">Más información</a>');
                // polygon.on('click', function (event) {
                //     var latLng = event.latlng;
                //     document.getElementById('coordinates').innerHTML = 'Latitud: ' + latLng.lat.toFixed(4) + ', Longitud: ' + latLng.lng.toFixed(4);
                // });
            }
            var legend = L.control({ position: 'bottomright' });
            legend.onAdd = function (map) {
                var div = L.DomUtil.create('div', 'legend');
                var labels = [];
                labels.push('<strong>Regiones Geográficas</strong>');
                for (var i = 0; i < regions.length; i++) {
                    labels.push('<div class="legend-item"><span class="legend-color" style="background-color:' + regions[i].color + '"></span>' + regions[i].name + '</div>');
                }
                div.innerHTML = labels.join('');
                return div;
            };
            legend.addTo(map);
        }
    </script>
    <script>
        window.onload = function() {
            initMap();
        };
    </script>
</body>
</html>
