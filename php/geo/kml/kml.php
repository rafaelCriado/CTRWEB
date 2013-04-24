
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
  <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>Google Maps</title>
    <script src="http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=false&amp;key=AIzaSyC_1UPKnFUUj1ijsxwmHy4t3saVn6X6KZc" type="text/javascript"></script>
  </head>
  <body onunload="GUnload()">


    <div id="map" style="width: 768px; height: 512px"></div>
    <a href="geoxml.htm">Back to the tutorial page</a>
      <form action="#">
        <input type="button" value="hide" onclick="map.removeOverlay(kml)" />
        <input type="button" value="show" onclick="map.addOverlay(kml)" />
      </form>

    <noscript><b>JavaScript must be enabled in order for you to use Google Maps.</b> 
      However, it seems JavaScript is either disabled or not supported by your browser. 
      To view Google Maps, enable JavaScript by changing your browser options, and then 
      try again.
    </noscript>
 

    <script type="text/javascript">
    //<![CDATA[
    
    if (GBrowserIsCompatible()) { 


 
      var map = new GMap2(document.getElementById("map"));
      map.addControl(new GLargeMapControl());
      map.addControl(new GMapTypeControl());
      map.setCenter(new GLatLng(-5,-50), 9);

      // ==== Create a KML Overlay ====
    
      var kml = new GGeoXml("http://citrinoweb.admcitrino.com.br/sp.kml");
      map.addOverlay(kml);


    }
    
    // display a warning if the browser was not compatible
    else {
      alert("Sorry, the Google Maps API is not compatible with this browser");
    }

    // This Javascript is based on code provided by the
    // Community Church Javascript Team
    // http://www.bisphamchurch.org.uk/   
    // http://econym.org.uk/gmap/

    //]]>
    </script>
  </body>

</html>




