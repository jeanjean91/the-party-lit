
function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 8,
        center: {lat: -34.397, lng: 150.644}
    });
    var geocoder = new google.maps.Geocoder();

    document.getElementById('evenement_address').addEventListener('mouseout', function() {
        geocodeAddress(geocoder, map);
    });
}
initMap();



function geocodeAddress(geocoder, resultsMap) {
    var address = document.getElementById('evenement_address').value;
    geocoder.geocode({'address': address}, function(results, status) {
        if (status === 'OK') {
            resultsMap.setCenter(results[0].geometry.location);
            var marker = new google.maps.Marker({
                map: resultsMap,
                position: results[0].geometry.location
            });
            var lat = " "+results[0].geometry.location.lat();
            var lng = " "+results[0].geometry.location.lng();



            document.getElementById("evenement_lat").value = lat;
            document.getElementById("evenement_lng").value= lng;
            alert('Votre adresse est  conforme !');

        } else {
            alert('Entrée une adresse valid!: ' + status);
        }
    });
}





/*
function initialize() {
    var address = (document.getElementById('address'));
    var autocomplete = new google.maps.places.Autocomplete(address);
    autocomplete.setTypes(['geocode']);
    google.maps.event.addListener(autocomplete, 'place_changed', function() {
        var place = autocomplete.getPlace();
        if (!place.geometry) {
            return;
        }

        var address = '';
        if (place.address_components) {
            address = [
                (place.address_components[0] && place.address_components[0].short_name || ''),
                (place.address_components[1] && place.address_components[1].short_name || ''),
                (place.address_components[2] && place.address_components[2].short_name || '')
            ].join(' ');
        }
    });
}
function codeAddress() {
    geocoder = new google.maps.Geocoder();
    var address = document.getElementById("address").value;
    /!*alert( );*!/
    geocoder.geocode( { 'address': address}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            alert('yahoo');
            alert("Latitude: "+results[0].geometry.location.lat());
            alert("Longitude: "+results[0].geometry.location.lng());
        }

        else {
            alert("Geocode was not successful for the following reason: " + status);
        }
    });
}
google.maps.event.addDomListener(window, 'load', initialize);
*/




