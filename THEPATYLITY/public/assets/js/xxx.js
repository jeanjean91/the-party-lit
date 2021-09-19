var latitude;
var longitude;
var LatLng;
var option;
var marker;
var markers;
var lat;
var lng;
var geojson;
var point;
var image;

var customLabel = {
    restaurant: {
        label: 'type'
    },
    bar: {
        label: 'type'
    }
};


function initMap() {


     if (document.getElementById('localise').onclick) {
         
          recentrer()
           
        
                   
         
     }else{

        window.onload = function () {
                localise();
                document.getElementById('localise').onclick = function () {
                    localise();
                }


                function localise() {
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(affichePosition, gestionErreur, {
                            timeout: 20000
                        });
                    }
                }
     }
    


        //afficher les coordonee dans une div
        function affichePosition(position) {

            
           
            latitude = position.coords.latitude;
            longitude = position.coords.longitude;

                /*  document.getElementById('recherche').onclick = function () {
                     latitude = lat;
                     longitude = lng;
                     myLatLng = new google.maps.LatLng(latitude, longitude);

                 }
                 } */

            downloadUrl('xml/point.xml', function (data) {
                var xml = data.responseXML;
                markers = xml.documentElement.getElementsByTagName('marker');
                Array.prototype.forEach.call(markers, function (markerElem) {
                    var id = markerElem.getAttribute('id');
                    var name = markerElem.getAttribute('name');
                    var address = markerElem.getAttribute('address');
                     var image = markerElem.getAttribute('image');
                    var type = markerElem.getAttribute('type');
                    var LatLng = new google.maps.LatLng(
                        parseFloat(markerElem.getAttribute('lat')),
                        parseFloat(markerElem.getAttribute('lng')));


 
                   alert(LatLng);
                     console.log(markers);

                        var latlng = L.latLng(parseFloat(markerElem.getAttribute('lat')),
                            parseFloat(markerElem.getAttribute('lng')));
                            
                   /*   marker = JSON.parse();
                    console.log(markers); */
            //Setting Location with jQuery
             mapboxgl.accessToken = 'pk.eyJ1IjoidHJpbGw5MSIsImEiOiJjazVlbWZiMGsxN3NwM2xucXFuOG1mOXluIn0.oOSekCAu1sx63Zv9rgdp3A';
            var map = new mapboxgl.Map({
                container: 'mapx',
                style: 'mapbox://styles/mapbox/dark-v10',
                center: [-46.9, 25.8],
                zoom: 2
            });
                      geojson = {
                         type: 'FeatureCollection',
                         features: [{
                                 type: 'Feature',
                                 geometry: {
                                     type: 'Point',
                                     coordinates: [latlng]
                                 },
                                 properties: {
                                     title: 'name',
                                     image: 'image'
                                 }
                             }
                         ]
                     };
                    console.log(geojson);
      
            // add markers to map
             geojson.features.forEach(function (marker) {

                // create a HTML element for each feature
                var el = document.createElement('div');
                el.className = 'marker';

                // make a marker for each feature and add to the map
                new mapboxgl.Marker(el)
                    .setLngLat(marker)
                    .setPopup(new mapboxgl.Popup({
                        offset: 25
                    }) // add popups
                    
                    .setHTML('<h3>' + marker.properties.name + '</h3><br><p>'
                     +'<img width="80" src=' + /image/ + marker.properties.image + '/>'
                     + '</p>'))
                    .addTo(map);
            });
            var icon = customLabel[type] || {};
            var image = 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png';
            var marker = new mapboxgl.Map.Marker({
                map: map,
                position: point,
                icon: image
            });

            google.maps.event.addListener(marker, 'click', function () {
                infoWindow.open(map, marker);
            });

            marker.addListener('click', function () {
            infoWindow.setContent(infowincontent);
            infoWindow.open(map, marker);
            });


            });
            });
           /*  new mapboxgl.Marker(el)
                .setLngLat(marker.geometry.coordinates)
                .setPopup(new mapboxgl.Popup({
                        offset: 25
                    }) // add popups
                    .setHTML('<h3>' + marker.properties.title + '</h3><p>' + marker.properties.description + '</p>'))
                .addTo(map); */




/* 
                    var infoWindow = new mapboxgl.Map.InfoWindow(infoWindowOptions);

                    
                    
                    var infowincontent = document.createElement('div');
                    var infoWindow = new mapboxgl.Map.InfoWindow(infoWindowOptions);
                    var strong = document.createElement('strong');
                    strong.textContent = type
                    infowincontent.appendChild(strong);
                    infowincontent.appendChild(document.createElement('br'));
 
                    var strong = document.createElement('strong');
                    strong.textContent = name
                    infowincontent.appendChild(strong);
                    
 
                    var url = 'evenement-statique' + '-' + id;
                    var text = document.createElement('a');
                    text.setAttribute("href", url);
                    var imagela = 
                        '<br>' + '<img width="80" src=' + /image/ + image + '/>'
                        '<br>'
                        '</a>';
                    text.innerHTML = imagela;
                    
                   
                     
                   
                    
                    infowincontent.appendChild(document.createElement('br'));
                    
                    infowincontent.appendChild(text); */
                   
                    
            

           

              



             

            /* new mapboxgl.Marker().setLngLat(feature.center).addTo(map);

            var geocoder = new MapboxGeocoder({
                accessToken: mapboxgl.accessToken,
                mapboxgl: mapboxgl
            });
            
            document.getElementById('geocoder').appendChild(geocoder.onAdd(map)); 

             */
            /* var myLatLng = new google.maps.LatLng(latitude, longitude);
           
            var latLng = 'myLatLng';
             var map = new google.maps.Map(document.getElementById('mapx'), {
                center: myLatLng  || map.setCenter(marker.getPosition()),
                zoom: 6

                
                
            });   */
             /* var map = new mapboxgl.Map({
                container: 'mapx',
                style: 'mapbox://styles/mapbox/streets-v11',
                center: myLatLng,
                zoom: 13
            });  */
           
            
           
             /* $(document).ready(function () {
                         $("#cherche").on('click', function () {
                             

                             newLatLng = new google.maps.LatLng(parseFloat(markerElem.getAttribute('lat')), parseFloat(markerElem.getAttribute('lng')));
                             var newMap = new google.maps.Map(document.getElementById('mapx'), {
                                 center: newLatLng || map.setCenter(marker.getPosition()),
                                 zoom: 2, 


                                 

                             });
                              var bounds = new google.maps.newLatLngBounds();
                              map.fitBounds(bounds);
                              window.onload = newMap;
                               

                       
                }); 

                         });
             */


              var markerCluster = new MarkerClusterer(map, markers, {
                 imagePath: 'https://webstockreview.net/images/clipart-map-location-sign-11.png',

             }); //type de marker
             var markerCluster = new MarkerClusterer(map, markers, {
                 maxZoom: 9,
                 imagePath: 'https://cdn.rawgit.com/googlemaps/js-marker-clusterer/gh-pages/images/m'
             });

            var markerClusterer = new MarkerClusterer(map, markers, {
                maxZoom: 9, // maxZoom set when clustering will stop
                imagePath: 'https://cdn.pixabay.com/photo/2013/07/13/11/57/landmark-159035_640.png'
            });

           /*  var bounds = new google.maps.LatLngBounds();
            for (var i = 0; i < markers.length; ++i) {
                bounds.extend(this.markers[i].position);
            }
            map.fitBounds(bounds);

            google.maps.event.addListener(markerClusterer, 'clusterclick', function(cluster) {
                map.fitBounds(cluster.getBounds());
                if (map.getZoom() > 14) {
                    map.setZoom(14);
                }
            }); */
        } 

    }
    


}
 

function downloadUrl(url, callback) {
    var request = window.ActiveXObject ?
        new ActiveXObject('Microsoft.XMLHTTP') :
        new XMLHttpRequest;

    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            request.onreadystatechange = doNothing;
            callback(request, request.status);
        }
    };

    request.open('GET', url, true);
    request.send(null);
}

function doNothing() {}

//evenementt click sur bouton
initMap();







function gestionErreur(erreur) {
    switch (erreur) {
        case 3:
            alert('temp depasser');
            break;
        case 2:
            alert('le navigateure ne parvien s a vous geolocaliser');
            break;

        case 1:
            alert('vous ne souhaitez pas etre geolocaliser');
            break;
        case 1:
            alert('ERREUR');
            break;
    }

}

function recentrer() {
    latitude = parseFloat(markerElem.getAttribute('lat'));

    longitude = parseFloat(markerElem.getAttribute('lng'));

    var LatLng = new mapboxgl.Map.LatLng(latitude, longitude);
    map.setCenter(myLatLng);
    map.setZoom(2);
    var myOptions = {
        zoom: 2,
        center: map.setCenter(marker.getPosition()),
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    /* var map = new mapboxgl.Map({
        container: 'mapx',
        style: 'mapbox://styles/mapbox/streets-v11',
        center: myLatLng,
        zoom: 13
    }); */
    
    /*  new google.maps.Map(document.getElementById("mapx"), myOptions);
     */
    
}


  $(document).ready(function () {
    $("#cherche").on('click', function () {
        /* alert('yo'); */

        recentrer();
         
         



        }); 
       
 





    }); 
/* 
mapboxgl.accessToken = 'pk.eyJ1IjoidHJpbGw5MSIsImEiOiJjazVlbWZiMGsxN3NwM2xucXFuOG1mOXluIn0.oOSekCAu1sx63Zv9rgdp3A';
var map = new mapboxgl.Map({
    container: 'mapx',
    style: 'mapbox://styles/mapbox/streets-v11',
    center: [-79.4512, 43.6568],
    zoom: 13
});

var geocoder = new MapboxGeocoder({
    accessToken: mapboxgl.accessToken,
    mapboxgl: mapboxgl
});

document.getElementById('geocoder').appendChild(geocoder.onAdd(map));




 */


