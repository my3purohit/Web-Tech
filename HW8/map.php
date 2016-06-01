  <html>
  <head>
  
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <script src="http://openlayers.org/api/OpenLayers.js"></script>
  
  <script>
  $(document).ready(function() {
  getMap();
   function getMap(){
           try{
           
                var lonlat = new OpenLayers.LonLat(0,0);

                var map = new OpenLayers.Map("basicMap");
                // Create OSM overlays
                var mapnik = new OpenLayers.Layer.OSM();

                var layer_cloud = new OpenLayers.Layer.XYZ(
                    "clouds",
                    "http://${s}.tile.openweathermap.org/map/clouds/${z}/${x}/${y}.png",
                    {
                        isBaseLayer: false,
                        opacity: 0.7,
                        sphericalMercator: true
                    }
                );

                var layer_precipitation = new OpenLayers.Layer.XYZ(
                    "precipitation",
                    "http://${s}.tile.openweathermap.org/map/precipitation/${z}/${x}/${y}.png",
                    {
                        isBaseLayer: false,
                        opacity: 0.7,
                        sphericalMercator: true
                    }
                );


                map.addLayers([mapnik, layer_precipitation, layer_cloud]);
               }
               catch(e){
                        alert("map is screwed");
               }    
           } 
           
        });
        
        </script>
        
        <body>
        <div id="basicMap"></div>