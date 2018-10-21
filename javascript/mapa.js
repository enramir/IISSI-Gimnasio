/**
 * @author lizeth
 */

function myMap() {
  var mycenter=new google.maps.LatLng(37.257692, -5.55124);
  var mapCanvas = document.getElementById("map");
  var mapOptions = {
    center: mycenter, zoom: 15
  };
  var map = new google.maps.Map(mapCanvas, mapOptions);
  var marker = new google.maps.Marker({position:mycenter});
  marker.setMap(map);
  var infowindow = new google.maps.InfoWindow({
    content: "GYM La Venta"
  });
  infowindow.open(map,marker);
}