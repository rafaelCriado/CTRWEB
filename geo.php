<html>
<head>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>Google Maps JavaScript API v3 Example: Common Loader</title>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="php/geo/util.js"></script>
<script type="text/javascript">
	$(function(){
		$.ajax({
			url: 'php/geo/busca.php'
		});
		$('input[name="geo_localiza_cliente"]').click(function(){
			$.ajax({
				url: 'php/geo/busca.php'
			});
		})
		
	});

  var infowindow;
  var map;

  function initialize() {
    var myLatlng = new google.maps.LatLng(-20.8075745	, -49.4949209);
    var myOptions = {
      zoom: 13,
      center: myLatlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
    downloadUrl("php/geo/clientes.xml", function(data) {
      var markers = data.documentElement.getElementsByTagName("marker");
      for (var i = 0; i < markers.length; i++) {
        var latlng = new google.maps.LatLng(parseFloat(markers[i].getAttribute("lat")),
                                    parseFloat(markers[i].getAttribute("lng")));
        var marker = createMarker(markers[i].getAttribute("name"), latlng);
       }
     });
  }

  function createMarker(name, latlng) {
    var marker = new google.maps.Marker({position: latlng, map: map});
    google.maps.event.addListener(marker, "click", function() {
      if (infowindow) infowindow.close();
      infowindow = new google.maps.InfoWindow({content: name});
      infowindow.open(map, marker);
    });
    return marker;
	
	
  }

  function appendBootstrap() {
	setTimeout(function(){
		var script = document.createElement("script");
		script.type = "text/javascript";
		script.src = "http://maps.google.com/maps/api/js?sensor=false&callback=initialize";
		document.body.appendChild(script);
	},2000);
  }



</script>
</head>
    <body style="margin:0px; padding:0px;">
      <input type="button" name="geo_localiza_cliente" value="Localizar Clientes" class="k-button" onclick="appendBootstrap()" style="position:absolute; left:10; top:10; z-index:9999">
      <div id="map_canvas" style="width:100%; height:100%"></div>
    </body>
</html>