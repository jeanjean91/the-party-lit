var latitude;
var longitude;
var LatLng;
var option;
var marker;
//evenementt click sur bouton
 function initMap() {
     downloadUrl('xml/point.xml', function (data) {
         var xml = data.responseXML;
         var markers = xml.documentElement.getElementsByTagName('marker');
         Array.prototype.forEach.call(markers, function (markerElem) {
             var id = markerElem.getAttribute('id');
             var name = markerElem.getAttribute('name');
             var address = markerElem.getAttribute('address');
             var image = markerElem.getAttribute('image');
             var type = markerElem.getAttribute('type');

             var point = new mapboxgl.Map(

                 parseFloat(markerElem.getAttribute('lat')),
                 parseFloat(markerElem.getAttribute('lng')));




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

             infowincontent.appendChild(text);

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
var myLatLng = {
    lat: 27.90317834397969,
    lng: -32.50013699735485
};

// map dacceuil  avek position 
var map = new google.maps.Map(document.getElementById('mapx'), {
    center: myLatLng,
    zoom: 3

});

      }

window.onload = function () {

    
        document.getElementById('localise').onclick = function () {
            localise();
        }
        //fonction geolocalisation
        function localise() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(affichePosition, gestionErreur, {
                    timeout: 20000
                });
            }
        }
        

        //afficher les coordonee dans une div
        function affichePosition(position) {
            latitude = position.coords.latitude;
            longitude = position.coords.longitude;
            /*  document.getElementById('geolocal').innerHTML = 'Latitude :' + latitude + '<br> ' + 'longitude :' + longitude; */



          

            //afficher la nouvelle carte avec la ville de lutilisateur
            var myLatLng = new google.maps.LatLng(latitude, longitude);
            var map = new google.maps.Map(document.getElementById('mapx'), {
                center: myLatLng,
                zoom: 12
            });
            //ajouter le maker avek la nouvel position
            var marker = new google.maps.Marker({
                map: map,
                position: myLatLng,
                title: 'vous êtes ici'

            });
            var markerCluster = new MarkerClusterer(Map.map, markers, {
                imagePath: 'img/m/m',

            }); //type de marker
            var markerCluster = new MarkerClusterer(map, markers, {
                imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'
            });



    var marker = new google.maps.Marker({
        map: map,
        position: myLatLng,
        title: 'Toronto'
    });
    var markerCluster = new MarkerClusterer(Map.map, marker, {
        imagePath: 'img/m/m',

    });
    var markerCluster = new MarkerClusterer(map, marker, {
        imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'
    }); 
 
}
  addmarker();
}
   initMap()
 
   





/* function initMap() {
    var myLatLng = {
        lat: 29.90317834397969,
        lng: -36.50013699735485
    };

    // map dacceuil  avek position 
    var map = new google.maps.Map(document.getElementById('mapx'), {
        center: myLatLng,
        zoom: 2
    });

    var marker = new google.maps.Marker({
        map: map,
        position: myLatLng,
        title: 'Toronto'
    });
    var markerCluster = new MarkerClusterer(Map.map, marker, {
        imagePath: 'img/m/m',

    });
    var markerCluster = new MarkerClusterer(map, marker, {
        imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'
    });


}
 */




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
if (window.addEventListener) {
    window.addEventListener('load', initEvent, false);
} else if (window.attachEvent) {
    window.attachEvent('onload', initEvent);
}