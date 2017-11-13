<!DOCTYPE html>
<html>

    
<?php 
date_default_timezone_set("America/New_York");
$TimeStamp = "The current time is " . date("h:i:sa");
//file_put_contents('dataDisplayer.html', $TimeStamp, FILE_APPEND);
   if( isset($_POST["Latitude"]) ||  isset($_POST["Longitude"]) ) 
   {
   echo " The Humidity is: ". $_POST['Latitude']. "%<br />";
   echo " The Temperature is: ". $_POST['Longitude']. " Celcius<br />";
   }
$var1 = isset($_POST['Latitude']) ? $_POST['Latitude'] : '';	  
$var2 = isset($_POST['Longitude']) ? $_POST['Longitude'] : '';
$WriteMyRequest = "<!DOCTYPE html>
<html>
  <head>
      <link href='https://fonts.googleapis.com/css?family=Alef' rel='stylesheet'>
    <style>
       #map {
        height: 400px;
        width: 50%;
       }
        body {
        width: auto;
        margin: 20px;
        font-family: 'Alef';font-size: 22px;
        }
        h2, h2+p {display: inline;}
    </style>
    <script type=\"text/javascript\" src=\"https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js\"></script>
    <script type=\"text/javascript\" src=\"http://jquery.offput.ca/js/jquery.timers.js\"></script>
  </head>
  <div class = \"content\">
  <body>
    <h2>Smart Collar </h2> <p>By D. Tsymbala, S. Budinoski, K. de Asis, A. Hedhli</p> <br/>".
     $TimeStamp."<br/>".
     "<p> Latitude : "       . $var1 . " </p>".
     "<p> Longitude : " . $var2 . " </p> <br/>".
     "<button type=\"button\">Activate Dog Whistle</button>
    <div id=\"map\"></div>
    <script>
      function initMap() {
        var uluru = {lat: " . $var1 . " , lng: " . $var2 . "};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 4,
          center: uluru
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map
        });
         var drawingManager = new google.maps.drawing.DrawingManager({
          drawingMode: google.maps.drawing.OverlayType.MARKER,
          drawingControl: true,
          drawingControlOptions: {
            position: google.maps.ControlPosition.TOP_CENTER,
            drawingModes: ['circle', 'polygon']
          },
          markerOptions: {icon: 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png'},
          circleOptions: {
            fillColor: '#ffff00',
            fillOpacity: .2,
            strokeWeight: 1,
            clickable: false,
            editable: true,
            zIndex: 1
          }
        });
         drawingManager.setMap(map);
         var safeZone = new google.maps.Polygon();
         
         google.maps.event.addListener(drawingManager, 'polygoncomplete', function(polygon) {
        if(google.maps.geometry.poly.containsLocation(marker.getPosition(),polygon)){
         safeZone = polygon;
         alert(\"Your pet zone has been created!\");
        }
});
  
        
      }
    </script>
    <script async defer
    src=\"https://maps.googleapis.com/maps/api/js?key=AIzaSyBdZlGc7e2SPKvzRuPaoASDAzYHofsdBRk&libraries=drawing&callback=initMap\">
    </script>
  </body>
  </div>
</html>" ;
echo $WriteMyRequest;
file_put_contents('index.html', $WriteMyRequest);
?>

</html>
