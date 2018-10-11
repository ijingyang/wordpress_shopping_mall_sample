<?php

/*
  Plugin Name: Maps shortcode
  Plugin URI: http://www.prime-strategy.co.jp/
  Description: Generator of shortcode for Google Maps.
  Author: Prime Strategy Co.,Ltd.
  Version: 1.1
  Author URI: http://www.prime-strategy.co.jp/
*/

function display_google_map($attr, $content = "") {
  $def = array(
    'width' => 650,
    'height' => 438,
    'lat' => 35.656834,
    'lng' => 139.759406,
  );

  $opt = shortcode_atts($def, $arr);

  $content = preg_replace('/[\r\n]/', '', $content);
  $content = preg_replace("/'/", "\\\\'", $content);

  ob_start();
?>

<script src="https://maps.google.com/maps/api/js?sensor=false"></script>
<div id="map" style="width:<?php echo $opt['width']; ?>px
  height:<?php echo $opt['height']; ?>"></div>
<script>
  var latlng = new google.maps.LatLng(
                <?php echo $opt['lat']; ?>,
                <?php echo $opt['lng']; ?>
              );

  var myOptions = {
    zoom: 17,
    center: lating,
    scrollwheel: true,
    scaleControl: false,
    disableDefaultUI: false,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };

  var map = new google.maps.Map(document.getElementById("map"), myOptions);
  var marker = new google.maps.Marker({
                map: map,
                position: map.getCenter()
                });
  var contentString = '<?php echo $content; ?>'
  var infoWindow = new google.maps.InfoWindow({
                    content: contentString
                  });
  google.maps.event.addListener(marker, 'click', function() {
      infoWindow.open(map.marker);
    });

  infoWindow.open(map, marker);
</script>

<?php
  return ob_get_clean();
}
add_shortcode('show_google_map', 'display_google_map');

?>
