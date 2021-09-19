// var latitude;
// var longitude;
// var LatLng;
// var option;
// var marker;
// var markers;
//
// var customLabel = {
//     restaurant: {
//         label: 'type'
//     },
//     bar: {
//         label: 'type'
//     }
// };
//
//
// function initMap() {
//
//     window.onload = function () {
//         localise();
//         document.getElementById('recherche').onclick = function () {
//
//         }
//         localise();
//
//         function localise() {
//             if (navigator.geolocation) {
//                 navigator.geolocation.getCurrentPosition(affichePosition, gestionErreur, {
//                     timeout: 20000
//                 });
//             }
//         }
//
//
//         //afficher les coordonee dans une div
//         function affichePosition(position) {
//             latitude = position.coords.latitude;
//             longitude = position.coords.longitude;
//
//
//             downloadUrl('xml/testMarker.xml', function (data) {
//                 var xml = data.responseXML;
//                 var markers = xml.documentElement.getElementsByTagName('marker');
//                 Array.prototype.forEach.call(markers, function (markerElem) {
//                     var id = markerElem.getAttribute('id');
//                     var name = markerElem.getAttribute('name');
//                     var address = markerElem.getAttribute('address');
//                     var image = markerElem.getAttribute('image');
//                     var type = markerElem.getAttribute('type');
//                     var point = new google.maps.LatLng(
//                         parseFloat(markerElem.getAttribute('lat')),
//                         parseFloat(markerElem.getAttribute('lng')));
//
//
//
//                     var idt = id;
//                     var infoWindow = new google.maps.InfoWindow(infoWindowOptions);
//
//                     var infoWindowOptions = {
//                         content: '<h3> type</h3>' +
//                             '<a href="{{ path("evenement.statique",{\'id\':evenement.id}) }}" ><img src="{{ asset(\'image/\'~image) }}" alt="omg" style="height: 250px;"></a>'
//
//                     };
//
//                     var infowincontent = document.createElement('div');
//                     var infoWindow = new google.maps.InfoWindow(infoWindowOptions);
//                     var strong = document.createElement('strong');
//                     strong.textContent = type
//                     infowincontent.appendChild(strong);
//                     infowincontent.appendChild(document.createElement('br'));
//
//                     var strong = document.createElement('strong');
//                     strong.textContent = name
//                     infowincontent.appendChild(strong);
//
//
//                     var url = "{{ path('evenement.statique ','id':evenement.id) }}";
//                     var text = document.createElement('div');
//                     var imagela = "<a href= '+ url +>" + '<br>' + id + '<br>' +
//                         '<br>' + '<img width="80" src=' + /image/ + image + '/>'
//                     '<br>'
//                     '</a>';
//                     text.innerHTML = imagela;
//
//
//                     infowincontent.appendChild(document.createElement('br'));
//
//                     infowincontent.appendChild(text);
//                     var icon = customLabel[type] || {};
//                     var image = 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png';
//                     var marker = new google.maps.Marker({
//                         map: map,
//                         position: point,
//                         icon: image
//                     });
//
//                     google.maps.event.addListener(marker, 'click', function () {
//                         infoWindow.open(map, marker);
//                     });
//
//                     marker.addListener('click', function () {
//                         infoWindow.setContent(infowincontent);
//                         infoWindow.open(map, marker);
//                     });
//
//
//                 });
//             });
//
//
//             //afficher la nouvelle carte avec la ville de lutilisateur
//             var myLatLng = new google.maps.LatLng(latitude, longitude);
//             var latLng = 'myLatLng';
//             var map = new google.maps.Map(document.getElementById('mapx'), {
//                 center: myLatLng,
//                 zoom: 6
//             });
//
//
//             //ajouter le maker avek la nouvel position
//
//
//             /* marker = new google.maps.Marker({
//
//                 map: map,
//                 position: myLatLng,
//                 title: 'vous êtes ici'
//
//
//             }); */
//             /* var marker = new google.maps.Marker(markerOptions);
//             markers.push(marker);
//             oms.addMarker(marker); */
//
//             /*  var marqueur = new google.maps.Marker({
//                 map: maCarte,
//                 position: new google.maps.LatLng(latitude, longitude),
//                 href: "#",
//                 icon: {
//                     url: "",
//                     size: new google.maps.Size(100, 50),
//                     anchor: new google.maps.Point(50, 50)
//                 },
//             });
//
//             google.maps.event.addListener(marqueur, 'click',
//                 function () {
//                     window.location.href = $(this).attr('href');
//                 });
//         } */
//
//             var markerCluster = new MarkerClusterer(map, markers, {
//                 imagePath: 'https://webstockreview.net/images/clipart-map-location-sign-11.png',
//
//             }); //type de marker
//             var markerCluster = new MarkerClusterer(map, markers, {
//                 maxZoom: 9,
//                 imagePath: 'https://cdn.rawgit.com/googlemaps/js-marker-clusterer/gh-pages/images/m'
//             });
//
//             var markerClusterer = new MarkerClusterer(map, markers, {
//                 maxZoom: 9, // maxZoom set when clustering will stop
//                 imagePath: 'https://cdn.pixabay.com/photo/2013/07/13/11/57/landmark-159035_640.png'
//             });
//
//             var bounds = new google.maps.LatLngBounds();
//             for (var i = 0; i < markers.length; ++i) {
//                 bounds.extend(this.markers[i].position);
//             }
//             map.fitBounds(bounds);
//
//             google.maps.event.addListener(markerClusterer, 'clusterclick', function (cluster) {
//                 map.fitBounds(cluster.getBounds());
//                 if (map.getZoom() > 14) {
//                     map.setZoom(14);
//                 }
//             });
//         }
//
//     }
//     markers.push(marker);
//
//
// }
//
// function downloadUrl(url, callback) {
//     var request = window.ActiveXObject ?
//         new ActiveXObject('Microsoft.XMLHTTP') :
//         new XMLHttpRequest;
//
//     request.onreadystatechange = function () {
//         if (request.readyState == 4) {
//             request.onreadystatechange = doNothing;
//             callback(request, request.status);
//         }
//     };
//
//     request.open('GET', url, true);
//     request.send(null);
// }
//
// function doNothing() {}
//
// //evenementt click sur bouton
// initMap();
//
//
//
//
// function gestionErreur(erreur) {
//     switch (erreur) {
//         case 3:
//             alert('temp depasser');
//             break;
//         case 2:
//             alert('le navigateure ne parvien s a vous geolocaliser');
//             break;
//
//         case 1:
//             alert('vous ne souhaitez pas etre geolocaliser');
//             break;
//         case 1:
//             alert('ERREUR');
//             break;
//     }
//
// }
// if (window.addEventListener) {
//     window.addEventListener('load', initEvent, false);
// } else if (window.attachEvent) {
//     window.attachEvent('onload', initEvent);
// }
