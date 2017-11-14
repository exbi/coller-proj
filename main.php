<!DOCTYPE html>
<html>
<head> <meta http-equiv="refresh" content="1" ></head>
    
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
     <meta http-equiv=\"refresh\" content=\"10\" >
  </head>
  <div class = \"content\">
  <body>
    <h2>Smart Collar </h2> <p>By D. Tsymbala, S. Budinoski, K. de Asis, A. Hedhli</p> <br/>".
     $TimeStamp."<br/>".
     "<p> Latitude : "       . $var1 . " </p>".
     "<p> Longitude : " . $var2 . " </p> <br/>".
     "<button type=\"button\">Activate Dog Whistle</button>
     <input type=\"button\" value=\"Clear Safe Zone\" id=\"DeletePolygons\" >
    <div id=\"map\"></div>
    <script>
    
      $(document).ready(function(){
    $('#DeletePolygons').click(function(){
       localStorage.clear();
    });
  });
    
    
      var map;
      function initMap() {
        var uluru = {lat: " . $var1 . " , lng: " . $var2 . "};
        map = new google.maps.Map(document.getElementById('map'), {
          zoom: 15,
          center: uluru,
          mapTypeId: google.maps.MapTypeId.ROADMAP,
          mapTypeControl: false
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map
        });
          map.data.setControls(['Polygon']);
    map.data.setStyle({
        editable: true,
        draggable: true
    });
    
    
    bindDataLayerListeners(map.data);

    //load saved data
    loadPolygons(map);
    
         var safeZone = new google.maps.Polygon();
         
         google.maps.event.addListener(drawingManager, 'polygoncomplete', function(polygon) {
        if(google.maps.geometry.poly.containsLocation(marker.getPosition(),polygon)){
         safeZone = polygon;
         alert(\"Your pet zone has been created!\");
        }
        
        
        
});
            bindDataLayerListeners(map.data);

    //load saved data
            loadPolygons(map);

      }
      
      
      function bindDataLayerListeners(dataLayer) {
    dataLayer.addListener('addfeature', savePolygon);
    dataLayer.addListener('removefeature', savePolygon);
    dataLayer.addListener('setgeometry', savePolygon);
}

function loadPolygons(map) {
    var data = JSON.parse(localStorage.getItem('geoData'));
    map.data.forEach(function (f) {
        map.data.remove(f);
    });
    map.data.addGeoJson(data)
}



function savePolygon() {
    map.data.toGeoJson(function (json) {
        localStorage.setItem('geoData', JSON.stringify(json));
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
