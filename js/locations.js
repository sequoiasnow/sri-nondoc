/**
 * Called upon the loading of the google maps javascript.
 */
function initMap() {
    // Create the map
    var map = new google.maps.Map(document.getElementById('locations-map'), {
        zoom: 2,
        center: {lat: -25.363, lng: 131.044},
        mapTypeId: google.maps.MapTypeId.SATELLITE,
        mapTypeControl: false,
        navigationControl: false,
        streetViewControl: false
     });



    // First retrieve all the locations that are mentioned in the locations list.
    $( '#locations-list > .location' ).each(function() {
        var cordinates = {
            lat: Number( $( this ).attr( 'data-lat' ) ),
            lng: Number( $( this ).attr( 'data-lng' ) )
        };
        var content    = $( this ).html();
        var title      = $( this ).find( 'a.location-name' ).html();

        var infowindow = new google.maps.InfoWindow({
            content: content
        });

        console.log(cordinates);

        var marker = new google.maps.Marker({
          position: cordinates,
          map: map,
          title: title,
          visible: true
        });

        infowindow.open(map, marker);
    });

}
