<!DOCTYPE html>
<html>
  <head>
      <link href='https://fonts.googleapis.com/css?family=Alef' rel='stylesheet'>
    <style>
       #map {
        height: 400px;
        width: 25%;
       }
        body {
        font-family: 'Alef';font-size: 22px;
        }
        h2, h2+p {display: inline;}
    </style>
  </head>
  <body>
    <h2>Smart Collar </h2> <p>By D. Tsymbala, S. Budinoski, K. de Asis, A. Hedhli</p> 
    
<?php 
$var1 = "";
$var2 = "";
if(!empty($_POST['Longitude']) and !empty($_POST['Latitude'])){
  $var1 = $_POST['Longitude'];
  $var2 = $_POST['Latitude'];
}

/*
$WriteMyRequest=
"<p> The Humidity is : "       . $var1 . "% </p>".
"<p>And the Temperature is : " . $var2 . " Celcius </p>".
"<p>And the Temperature is : " . $var3 . " Fehreinheit</p>".
"<p>And The Heat Index is : "  . $var4 . " Heat Index Celcius </p>".
"<p>And The Heat Index is : "  . $var5 . " Heat Index Fehrenheit </p><br/>";*/
   
 

    echo '<p>Latitude : </p>' . $var1 . '<p> Longitude : ' . $var2 . ' </p> ';
?>
<button type="button">Activate Dog Whistle</button>
    <div id="map"></div>
    <script>
      function initMap() {
        var uluru = {lat: 40.7282 , lng: -74.0776};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 4,
          center: uluru
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map
        });
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBdZlGc7e2SPKvzRuPaoASDAzYHofsdBRk&callback=initMap">
    </script>
  </body>
</html>
