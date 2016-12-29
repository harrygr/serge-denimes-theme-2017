function initAutocomplete() {
    var map = new google.maps.Map(document.getElementById('stockists-map'), {
        center: {lat: 53.3891015, lng: -3.2201794},
        zoom: 6,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        scrollwheel: false
    });

    map.setOptions({
        styles: [{"featureType": "landscape", "stylers": [{"saturation": -100}, {"lightness": 65}, {"visibility": "on"}]}, {"featureType": "poi", "stylers": [{"saturation": -100}, {"lightness": 51}, {"visibility": "simplified"}]}, {"featureType": "road.highway", "stylers": [{"saturation": -100}, {"visibility": "simplified"}]}, {"featureType": "road.arterial", "stylers": [{"saturation": -100}, {"lightness": 30}, {"visibility": "on"}]}, {"featureType": "road.local", "stylers": [{"saturation": -100}, {"lightness": 40}, {"visibility": "on"}]}, {"featureType": "transit", "stylers": [{"saturation": -100}, {"visibility": "simplified"}]}, {"featureType": "administrative.province", "stylers": [{"visibility": "off"}]}, {"featureType": "water", "elementType": "labels", "stylers": [{"visibility": "on"}, {"lightness": -25}, {"saturation": -100}]}, {"featureType": "water", "elementType": "geometry", "stylers": [{"hue": "#ffff00"}, {"lightness": -25}, {"saturation": -97}]}]
    });

    // Create the search box and link it to the UI element.
    var input = document.getElementById('pac-input');
    var searchBox = new google.maps.places.SearchBox(input);
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

    // Bias the SearchBox results towards current map's viewport.
    map.addListener('bounds_changed', function () {
        searchBox.setBounds(map.getBounds());
    });

    var markers = [
        new google.maps.Marker({
            position: {lat: 52.4789047, lng: -1.9034363},
            map: map
        }),
        new google.maps.Marker({
            position: {lat: 51.6709036, lng: -1.2833993},
            map: map
        }),
        new google.maps.Marker({
            position: {lat: 51.7865622, lng: -1.4851151},
            map: map
        }),
        new google.maps.Marker({
            position: {lat: 51.400823, lng: -1.3262302},
            map: map
        }),
        new google.maps.Marker({
            position: {lat: 51.6192291, lng: 0.2986243},
            map: map
        }),
        new google.maps.Marker({
            position: {lat: 52.6277675, lng: 1.2918805},
            map: map
        }),
        new google.maps.Marker({
            position: {lat: 53.5914913, lng: -0.6518736},
            map: map
        }),
        new google.maps.Marker({
            position: {lat: 54.5723124, lng: -1.2405668},
            map: map
        }),
        new google.maps.Marker({
            position: {lat: 53.3702302, lng: -3.1863646},
            map: map
        }),
        new google.maps.Marker({
            position: {lat: 51.4952661, lng: -3.1674072},
            map: map
        }),
        new google.maps.Marker({
            position: {lat: 53.5719576, lng: -0.0872343},
            map: map
        }),
        new google.maps.Marker({
            position: {lat: 51.3383853, lng: -0.7487736},
            map: map
        }),
        new google.maps.Marker({
            position: {lat: 51.4567355, lng: -2.5919337},
            map: map
        }),
        new google.maps.Marker({
            position: {lat: 51.3783554, lng: -2.3609249},
            map: map
        }),
        new google.maps.Marker({
            position: {lat: 50.9060441, lng: -1.4080894},
            map: map
        }),
        new google.maps.Marker({
            position: {lat: 25.1837592, lng: 55.2238993},
            map: map
        })
    ];
    // Listen for the event fired when the user selects a prediction and retrieve
    // more details for that place.
    searchBox.addListener('places_changed', function () {
        var places = searchBox.getPlaces();

        if (places.length == 0) {
            return;
        }

        // For each place, get the icon, name and location.
        var bounds = new google.maps.LatLngBounds();
        places.forEach(function (place) {
            var icon = {
                url: place.icon,
                size: new google.maps.Size(71, 71),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(17, 34),
                scaledSize: new google.maps.Size(25, 25)
            };

            // Create a marker for each place.
            markers.push(new google.maps.Marker({
                map: map,
                icon: icon,
                title: place.name,
                position: place.geometry.location
            }));

            if (place.geometry.viewport) {
                // Only geocodes have viewport.
                bounds.union(place.geometry.viewport);
            } else {
                bounds.extend(place.geometry.location);
            }
        });
        map.fitBounds(bounds);
    });
}

google.maps.event.addDomListener(window, "load", initAutocomplete);
