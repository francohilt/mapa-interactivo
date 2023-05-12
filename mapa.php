<!DOCTYPE html>
<html>

<head>
  <title>Mapa interactivo</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.js"></script>
  <style>
    #map {
      height: 600px;
      width: 100%;
    }

    /* Estilo para las etiquetas de texto de los países */
    .label {
      font-size: 12px;
      font-weight: bold;
      background-color: #fff;
      color: #555;
      padding: 5px;
      border-radius: 5px;
      box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
    }

    /* Estilo para los popups de los países */
    .popup h3 {
      margin-top: 0;
    }

    .popup p {
      margin-bottom: 5px;
    }
  </style>
</head>

<body>
  <div id="map"></div>
  <script>
    // Crear un objeto de mapa y establecer su vista inicial
    var map = L.map('map').setView([-34.61, -58.38], 5);

    // Establecer la extensión de los límites del mapa
    var southWest = L.latLng(-55.0, -75.0);
    var northEast = L.latLng(-20.0, -53.0);
    var bounds = L.latLngBounds(southWest, northEast);
    map.setMaxBounds(bounds);
    map.on('drag', function() {
      map.panInsideBounds(bounds, {
        animate: false
      });
    });
    map.setMinZoom(2);

    // Agregar una capa de mosaico de OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
      maxZoom: 18,
    }).addTo(map);

    // Agregar una capa de GeoJSON para mostrar los límites de los países
    var geojsonLayer = L.geoJSON(null, {
      style: function(feature) {
        return {
          color: '#555',
          weight: 1,
          fillOpacity: 0.5,
          fillColor: getColor(feature.properties.nam) // Obtener el color basado en el nombre de la provincia
        };
      },
      onEachFeature: function(feature, layer) {
        layer.on('mouseover', function(e) {
          layer.setStyle({
            fillOpacity: 0.2 // Cambia la opacidad de relleno al 50%
          });
        });

        layer.on('mouseout', function(e) {
          layer.setStyle({
            fillOpacity: 0.5 // Vuelve a la opacidad de relleno original
          });
        });

        // Agregar etiquetas de texto para cada país y mostrarlas solo cuando se pasa el mouse sobre el país
        var label = L
          .tooltip({
            permanent: false,
            direction: 'center',
            className: 'label',
            opacity: 0.8,
            offset: [0, 0],
            sticky: true,
          }).setContent(feature.properties.nam);

        layer.bindTooltip(label);

        // Agregar información adicional para cada país y mostrarla en una ventana emergente cuando se hace clic en el país
        var popupContent = '<a href="https://sites.google.com/view/nticx-' + feature.properties.nam + '">' + feature.properties.nam + '</a>';

        layer.on({
          click: function(e) {
            L.popup()
              .setLatLng(e.latlng)
              .setContent(popupContent)
              .openOn(map);
          },
          mouseover: function(e) {
            this.openTooltip();
          },
          mouseout: function(e) {
            this.closeTooltip();
          },
        });
      },
    }).addTo(map);

    // Cargar datos geográficos de las provincias desde un archivo GeoJSON
    fetch('prov.json')
      .then(response => response.json())
      .then(data => geojsonLayer.addData(data));

    // Función para obtener el color basado en el nombre de la provincia
    function getColor(province) {
      // Aquí puedes definir los colores para cada provincia
      switch (province) {
        case 'Tierra del Fuego, Antártida e Islas del Atlántico Sur':
          return 'blue'; 
        case 'Santa Cruz':
          return 'blue'; 
        case 'Chubut':
          return 'blue'; 
        case 'Río Negro':
          return 'blue';
        case 'Neuquén':
          return 'blue';
   

        case 'Mendoza':
          return 'green'; 
        case 'San Juan':
          return 'green'; 
        case 'San Luis':
          return 'green';
        case 'La Rioja':
          return 'green';

        case 'Misiones':
          return '#7FFF00';

        case 'Buenos Aires':
          return 'orange';
        case 'La Pampa':
          return 'orange';
        case 'Entre Ríoss':
          return 'orange';
        case 'Santa Fe':
          return 'orange';
        case 'Corrientes':
          return 'orange';
        case 'Chaco':
          return 'orange';
        case 'Formosa':
          return 'orange';
        case 'Córdoba':
          return 'orange';
        case 'Santiago del Estero':
          return 'orange';
        case 'Tucumán':
          return 'orange';

        case 'Catamarca':
          return '#DC143C';

        case 'Jujuy':
          return '#6495ED';
        case 'Salta':
          return '#6495ED';
          // Añade más casos para cada provincia con el color correspondiente
        default:
          return '#000000'; // Negro por defecto
      }
    }
  </script>
</body>

</html>