let baseUrl = '';
let currentUrl = '';
let currentLat = 0, currentLng = 0
let userLat = 0, userLng = 0;
let web, map;
let infoWindow = new google.maps.InfoWindow();
let userInfoWindow = new google.maps.InfoWindow();
let directionsService, directionsRenderer;
let userMarker = new google.maps.Marker();
let destinationMarker = new google.maps.Marker();
let routeArray = [], circleArray = [], markerArray = {};
let bounds = new google.maps.LatLngBounds();
// let selectedShape, drawingManager = new google.maps.drawing.DrawingManager();
let customStyled = [
    {
        "elementType": "labels",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "administrative.land_parcel",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "administrative.neighborhood",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "road",
        "elementType": "labels",
        "stylers": [
            {
                "visibility": "on"
            }
        ]
    }
];

function setBaseUrl(url) {
    baseUrl = url;
}

// Initialize and add the map
function initMap(lat = -0.7106133793157127, lng = 100.19519243888361) {
    directionsService = new google.maps.DirectionsService();
    const center = new google.maps.LatLng(lat, lng);
    map = new google.maps.Map(document.getElementById("googlemaps"), {
        zoom: 15,
        center: center,
        mapTypeId: 'roadmap',
    });
    var rendererOptions = {
        map: map
    }
    map.set('styles', customStyled);
    directionsRenderer = new google.maps.DirectionsRenderer(rendererOptions);
    digitVillage();
}

// Display tourism village digitizing
function digitVillage() {
    const village = new google.maps.Data();
    $.ajax({
        url: baseUrl + '/api/village',
        type: 'POST',
        data: {
            village: 'V0001'
        },
        dataType: 'json',
        success: function (response) {
            const data = response.data;
            village.addGeoJson(data);
            village.setStyle({
                fillColor:'#00b300',
                strokeWeight:0.5,
                strokeColor:'#ffffff',
                fillOpacity: 0.1,
                clickable: false
            });
            village.setMap(map);
        }
    });
}

// Remove user location
function clearUser() {
    userLat = 0;
    userLng = 0;
    userMarker.setMap(null);
}

// Set current location based on user location
function setUserLoc(lat, lng) {
    userLat = lat;
    userLng = lng;
    currentLat = userLat;
    currentLng = userLng;
}

// Remove any route shown
function clearRoute() {
    for(i in routeArray) {
        routeArray[i].setMap(null);
    }
    routeArray = [];
    $('#direction-row').hide();
}

// Remove any radius shown
function clearRadius() {
    for (i in circleArray) {
        circleArray[i].setMap(null);
    }
    circleArray = [];
}

// Remove any marker shown
function clearMarker() {
    for (i in markerArray) {
        markerArray[i].setMap(null);
    }
    markerArray = {};
}

// Get user's current position
function currentPosition() {
    clearRadius();
    clearRoute();

    google.maps.event.clearListeners(map, 'click');
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition((position) => {
                const pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude,
                };

                infoWindow.close();
                clearUser();
                markerOption = {
                    position: pos,
                    animation: google.maps.Animation.DROP,
                    map: map,
                };
                userMarker.setOptions(markerOption);
                userInfoWindow.setContent("<p class='text-center'><span class='fw-bold'>You are here.</span> <br> lat: " + pos.lat + "<br>long: " + pos.lng+ "</p>");
                userInfoWindow.open(map, userMarker);
                map.setCenter(pos);
                setUserLoc(pos.lat, pos.lng);

                userMarker.addListener('click', () => {
                    userInfoWindow.open(map, userMarker);
                });
            },
            () => {
                handleLocationError(true, userInfoWindow, map.getCenter());
            }
        );
    } else {
        // Browser doesn't support Geolocation
        handleLocationError(false, userInfoWindow, map.getCenter());
    }
}

// Error handler for geolocation
function handleLocationError(browserHasGeolocation, infoWindow, pos) {
    infoWindow.setPosition(pos);
    infoWindow.setContent(
        browserHasGeolocation
            ? "Error: The Geolocation service failed."
            : "Error: Your browser doesn't support geolocation."
    );
    infoWindow.open(map);
}

// User set position on map
function manualPosition() {

    clearRadius();
    clearRoute();

    if (userLat == 0 && userLng == 0) {
        Swal.fire('Click on Map');
    }
    map.addListener('click', (mapsMouseEvent) => {

        infoWindow.close();
        pos = mapsMouseEvent.latLng;

        clearUser();
        markerOption = {
            position: pos,
            animation: google.maps.Animation.DROP,
            map: map,
        };
        userMarker.setOptions(markerOption);
        userInfoWindow.setContent("<p class='text-center'><span class='fw-bold'>You are here.</span> <br> lat: " + pos.lat().toFixed(8) + "<br>long: " + pos.lng().toFixed(8)+ "</p>");
        userInfoWindow.open(map, userMarker);

        userMarker.addListener('click', () => {
            userInfoWindow.open(map, userMarker);
        });

        setUserLoc(pos.lat().toFixed(8), pos.lng().toFixed(8))
    });
}

// Render route on selected object
function routeTo(lat, lng, routeFromUser = true) {

    clearRadius();
    clearRoute();
    google.maps.event.clearListeners(map, 'click')

    let start, end;
    if (routeFromUser) {
        if (userLat == 0 && userLng == 0) {
            return Swal.fire('Determine your position first!');
        }
        setUserLoc(userLat, userLng);
    }
    start = new google.maps.LatLng(currentLat, currentLng);
    end = new google.maps.LatLng(lat, lng)
    let request = {
        origin: start,
        destination: end,
        travelMode: 'DRIVING'
    };
    directionsService.route(request, function(result, status) {
        if (status == 'OK') {
            directionsRenderer.setDirections(result);
            showSteps(result);
            directionsRenderer.setMap(map);
            routeArray.push(directionsRenderer);
        }
    });
    boundToRoute(start, end);
}

// Display marker for loaded object
function objectMarker(id, lat, lng, anim = true) {

    google.maps.event.clearListeners(map, 'click');
    let pos = new google.maps.LatLng(lat, lng);
    let marker = new google.maps.Marker();

    let icon;
    if (id.substring(0,1) === "A") {
        icon = baseUrl + '/media/icon/marker_at.png';
    } else if (id.substring(0,2) === "CP") {
        icon = baseUrl + '/media/icon/marker_cp.png';
    } else if (id.substring(0,2) === "WP") {
        icon = baseUrl + '/media/icon/marker_wp.png';
    } else if (id.substring(0,2) === "SP") {
        icon = baseUrl + '/media/icon/marker_sp.png';
    } else if (id.substring(0,2) === "EV") {
        icon = baseUrl + '/media/icon/marker_ev.png';
    }

    markerOption = {
        position: pos,
        icon: icon,
        animation: google.maps.Animation.DROP,
        map: map,
    }
    marker.setOptions(markerOption);
    if (!anim) {
        marker.setAnimation(null);
    }
    marker.addListener('click', () => {
        infoWindow.close();
        objectInfoWindow(id);
        infoWindow.open(map, marker);
    });
    markerArray[id] = marker;
}

// Display info window for loaded object
function objectInfoWindow(id){
    let content = '';
    let contentButton = '';

    if (id.substring(0,1) === "A") {
        $.ajax({
            url: baseUrl + '/api/attraction/' + id,
            dataType: 'json',
            success: function (response) {
                let data = response.data;
                let aid = data.id;
                let name = data.name;
                let lat = data.lat;
                let lng = data.lng;
                let price = (data.price == 0) ? 'Free' : 'Rp ' + data.price;
                // let open = data.open.substring(0, data.open.length - 3);
                // let close = data.close.substring(0, data.close.length - 3);

                content =
                    '<div class="text-center">' +
                    '<p class="fw-bold fs-6">'+ name +'</p> <br>' +
                    // '<p><i class="fa-solid fa-clock me-2"></i> '+open+' - '+close+' WIB</p>' +
                    '<p><i class="fa-solid fa-money-bill me-2"></i> '+ price +'</p>' +
                    '</div>';
                contentButton =
                    '<br><div class="text-center">' +
                    '<a title="Route" class="btn icon btn-outline-primary mx-1" id="routeInfoWindow" onclick="routeTo('+lat+', '+lng+')"><i class="fa-solid fa-road"></i></a>' +
                    '<a title="Info" class="btn icon btn-outline-primary mx-1" target="_blank" id="infoInfoWindow" href='+baseUrl+'/web/attraction/'+aid+'><i class="fa-solid fa-info"></i></a>' +
                    '<a title="Nearby" class="btn icon btn-outline-primary mx-1" id="nearbyInfoWindow" onclick="openNearby(`'+ aid +'`,'+ lat +','+ lng +')"><i class="fa-solid fa-compass"></i></a>' +
                    '</div>'

                if (currentUrl.includes(id)) {
                    infoWindow.setContent(content);
                    infoWindow.open(map, markerArray[aid])
                } else {
                    infoWindow.setContent(content + contentButton);
                }
            }
        });
    } else if (id.substring(0,2) === "EV") {
        const months = [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December'
        ];
        $.ajax({
            url: baseUrl + '/api/event/' + id,
            dataType: 'json',
            success: function (response) {
                let data = response.data;
                let evid = data.id;
                let name = data.name;
                let lat = data.lat;
                let lng = data.lng;
                let ticket_price = (data.ticket_price == 0) ? 'Free' : 'Rp ' + data.ticket_price;
                let category = data.category;
                let date_next = new Date(data.date_next);
                let next = date_next.getDate() + ' ' + months[date_next.getMonth()] + ' ' + date_next.getFullYear();

                content =
                    '<div class="text-center">' +
                    '<p class="fw-bold fs-6">'+ name +'</p> <br>' +
                    '<p><i class="fa-solid fa-layer-group me-2"></i> '+ category +'</p>' +
                    '<p><i class="fa-solid fa-money-bill me-2"></i> '+ ticket_price +'</p>' +
                    '<p><i class="fa-solid fa-calendar-days me-2"></i> '+ next +'</p>' +
                    '</div>';
                contentButton =
                    '<br><div class="text-center">' +
                    '<a title="Route" class="btn icon btn-outline-primary mx-1" id="routeInfoWindow" onclick="routeTo('+lat+', '+lng+')"><i class="fa-solid fa-road"></i></a>' +
                    '<a title="Info" class="btn icon btn-outline-primary mx-1" target="_blank" id="infoInfoWindow" href='+baseUrl+'/web/event/'+evid+'><i class="fa-solid fa-info"></i></a>' +
                    '<a title="Nearby" class="btn icon btn-outline-primary mx-1" id="nearbyInfoWindow" onclick="openNearby(`'+ evid +'`,'+ lat +','+ lng +')"><i class="fa-solid fa-compass"></i></a>' +
                    '</div>'

                if (currentUrl.includes(id)) {
                    infoWindow.setContent(content);
                    infoWindow.open(map, markerArray[evid])
                } else {
                    infoWindow.setContent(content + contentButton);
                }
            }
        });
    } else if (id.substring(0,2) === "CP") {
        $.ajax({
            url: baseUrl + '/api/culinaryPlace/' + id,
            dataType: 'json',
            success: function (response) {
                let data = response.data;
                let name = data.name;

                content =
                    '<div class="text-center">' +
                    '<p class="fw-bold fs-6">'+ name +'</p>' +
                    '</div>';

                infoWindow.setContent(content);
            }
        });
    } else if (id.substring(0,2) === "WP") {
        $.ajax({
            url: baseUrl + '/api/worshipPlace/' + id,
            dataType: 'json',
            success: function (response) {
                let data = response.data;
                let name = data.name;

                content =
                    '<div class="text-center">' +
                    '<p class="fw-bold fs-6">'+ name +'</p>' +
                    '</div>';

                infoWindow.setContent(content);
            }
        });
    } else if (id.substring(0,2) === "SP") {
        $.ajax({
            url: baseUrl + '/api/souvenirPlace/' + id,
            dataType: 'json',
            success: function (response) {
                let data = response.data;
                let name = data.name;

                content =
                    '<div class="text-center">' +
                    '<p class="fw-bold fs-6">'+ name +'</p>' +
                    '</div>';

                infoWindow.setContent(content);
            }
        });
    }
}

// Render map to contains all object marker
function boundToObject() {
    if (Object.keys(markerArray).length > 0) {
        bounds = new google.maps.LatLngBounds();
        for (i in markerArray) {
            bounds.extend(markerArray[i].getPosition())
        }
        map.fitBounds(bounds, 80);
    } else {
        let pos = new google.maps.LatLng(-0.7106133793157127, 100.19519243888361);
        map.panTo(pos);
    }
}

// Render map to contains route and its markers
function boundToRoute(start, end) {
    bounds = new google.maps.LatLngBounds();
    bounds.extend(start);
    bounds.extend(end);
    map.panToBounds(bounds, 100);
}

// Add user position to map bound
function boundToRadius(lat, lng, rad) {
    let userBound = new google.maps.LatLng(lat, lng);
    const radiusCircle = new google.maps.Circle({
        center: userBound,
        radius: Number(rad)
    });
    map.fitBounds(radiusCircle.getBounds());
}

// Draw radius circle
function drawRadius(position, radius) {
    const radiusCircle = new google.maps.Circle({
        center: position,
        radius: radius,
        map: map,
        strokeColor: "#FF0000",
        strokeOpacity: 0.8,
        strokeWeight: 2,
        fillColor: "#FF0000",
        fillOpacity: 0.35,
    });
    circleArray.push(radiusCircle);
    boundToRadius(currentLat, currentLng, radius);
}

// Update radiusValue on search by radius
function updateRadius(postfix) {
    document.getElementById('radiusValue' + postfix).innerHTML = (document.getElementById('inputRadius' + postfix).value * 100) + " m";
}

// Render search by radius
function radiusSearch({postfix= null, } = {}) {

    if (userLat == 0 && userLng == 0) {
        document.getElementById('radiusValue' + postfix).innerHTML = "0 m";
        document.getElementById('inputRadius' + postfix).value = 0;
        return Swal.fire('Determine your position first!');
    }

    clearRadius();
    clearRoute();
    clearMarker();
    destinationMarker.setMap(null);
    google.maps.event.clearListeners(map, 'click');
    closeNearby();

    let pos = new google.maps.LatLng(currentLat, currentLng);
    let radiusValue = parseFloat(document.getElementById('inputRadius' + postfix).value) * 100;
    map.panTo(pos);

    // find object in radius
    if (postfix === 'AT') {
        $.ajax({
            url: baseUrl + '/api/attraction/findByRadius',
            type: 'POST',
            data: {
                lat: currentLat,
                long: currentLng,
                radius: radiusValue
            },
            dataType: 'json',
            success: function (response) {
                displayFoundObject(response);
                drawRadius(pos, radiusValue);
            }
        });
    } 
    // else if (postfix === 'EV') {
    //     $.ajax({
    //         url: baseUrl + '/api/event/findByRadius',
    //         type: 'POST',
    //         data: {
    //             lat: currentLat,
    //             long: currentLng,
    //             radius: radiusValue
    //         },
    //         dataType: 'json',
    //         success: function (response) {
    //             displayFoundObject(response);
    //             drawRadius(pos, radiusValue);
    //         }
    //     });
    // }

}

// pan to selected object
function focusObject(id) {
    google.maps.event.trigger(markerArray[id], 'click');
    map.panTo(markerArray[id].getPosition())
}

// display objects by feature used
function displayFoundObject(response) {
    $('#table-data').empty();
    let data = response.data;
    let counter = 1;
    const months = [
        'January',
        'February',
        'March',
        'April',
        'May',
        'June',
        'July',
        'August',
        'September',
        'October',
        'November',
        'December'
    ];
    for (i in data) {
        let item = data[i];
        let row;
        if (item.hasOwnProperty('date_next')){
            let date_next = new Date(item.date_next);
            let next = date_next.getDate() + ' ' + months[date_next.getMonth()] + ' ' + date_next.getFullYear();
            row =
                '<tr>'+
                '<td>'+ counter +'</td>' +
                '<td class="fw-bold">'+ item.name +'<br><span class="text-muted">' + next + '</span></td>' +
                '<td>'+
                '<a data-bs-toggle="tooltip" data-bs-placement="bottom" title="More Info" class="btn icon btn-primary mx-1" onclick="focusObject(`'+ item.id +'`);">' +
                '<span class="material-symbols-outlined">info</span>' +
                '</a>' +
                '</td>'+
                '</tr>';
        } else {
            row =
                '<tr>'+
                '<td>'+ counter +'</td>' +
                '<td class="fw-bold">'+ item.name +'</td>' +
                '<td>'+
                '<a data-bs-toggle="tooltip" data-bs-placement="bottom" title="More Info" class="btn icon btn-primary mx-1" onclick="focusObject(`'+ item.id +'`);">' +
                '<span class="material-symbols-outlined">info</span>' +
                '</a>' +
                '</td>'+
                '</tr>';
        }
        $('#table-data').append(row);
        objectMarker(item.id, item.lat, item.lng);
        counter++;
    }
}

// display steps of direction to selected route
function showSteps(directionResult) {
    $('#direction-row').show();
    $('#table-direction').empty();
    let myRoute = directionResult.routes[0].legs[0];
    for (let i = 0; i < myRoute.steps.length; i++) {
        let distance = myRoute.steps[i].distance.value;
        let instruction = myRoute.steps[i].instructions;
        let row =
            '<tr>' +
            '<td>'+ distance.toLocaleString("id-ID") +'</td>' +
            '<td>'+ instruction +'</td>' +
            '</tr>';
        $('#table-direction').append(row);
    }
}

// close nearby search section
function closeNearby() {
    $('#direction-row').hide();
    $('#check-nearby-col').hide();
    $('#result-nearby-col').hide();
    $('#list-at-col').show();
    $('#list-ev-col').show();
}

// open nearby search section
function openNearby() {
    $('#list-at-col').hide();
    $('#list-ev-col').hide();
    $('#list-rec-col').hide();
    $('#check-nearby-col').show();
}

// Search Result Object Around
function checkNearby() {
    $('#table-cp').empty();
    $('#table-ev').empty();
    $('#table-gp').empty();
    $('#table-ho').empty();
    $('#table-sp').empty();
    $('#table-wp').empty();
    $('#table-cp').hide();
    $('#table-ev').hide();
    $('#table-gp').hide();
    $('#table-ho').hide();
    $('#table-sp').hide();
    $('#table-wp').hide();

    const checkCP = document.getElementById('check-cp').checked;
    const checkEV = document.getElementById('check-ev').checked;
    const checkGP = document.getElementById('check-gp').checked;
    const checkHO = document.getElementById('check-ho').checked;
    const checkSP = document.getElementById('check-sp').checked;
    const checkWP = document.getElementById('check-wp').checked;

    if (!checkCP && !checkEV && !checkGP && !checkHO && !checkSP && !checkWP) {
        document.getElementById('radiusValueNearby').innerHTML = "0 m";
        document.getElementById('inputRadiusNearby').value = 0;
        return Swal.fire('Please choose one object');
    }

    if (checkCP) {
        let table =
            '<thead><tr>' +
            '<th>Culinary Place Name</th>' +
            '<th>Action</th>' +
            '</tr></thead>' +
            '<tbody id="data-cp">' +
            '</tbody>';
        $('#table-cp').append(table);
        $('#table-cp').show();
    }
    if (checkEV) {
        let table =
            '<thead><tr>' +
            '<th>Event Name</th>' +
            '<th>Action</th>' +
            '</tr></thead>' +
            '<tbody id="data-ev">' +
            '</tbody>';
        $('#table-ev').append(table);
        $('#table-ev').show();
    }
    if (checkWP) {
        let table =
            '<thead><tr>' +
            '<th>Worship Name</th>' +
            '<th>Action</th>' +
            '</tr></thead>' +
            '<tbody id="data-wp">' +
            '</tbody>';
        $('#table-wp').append(table);
        $('#table-wp').show();
    }
    if (checkSP) {
        let table =
            '<thead><tr>' +
            '<th>Souvenir Name</th>' +
            '<th>Action</th>' +
            '</tr></thead>' +
            '<tbody id="data-sp">' +
            '</tbody>';
        $('#table-sp').append(table);
        $('#table-sp').show();
    }
    $('#result-nearby-col').show();
}

// Set star by user input
function setStar(star) {
    switch (star) {
        case 'star-1' :
            $("#star-1").addClass('star-checked');
            $("#star-2,#star-3,#star-4,#star-5").removeClass('star-checked');
            document.getElementById('star-rating').value = '1';
            break;
        case 'star-2' :
            $("#star-1,#star-2").addClass('star-checked');
            $("#star-3,#star-4,#star-5").removeClass('star-checked');
            document.getElementById('star-rating').value = '2';
            break;
        case 'star-3' :
            $("#star-1,#star-2,#star-3").addClass('star-checked');
            $("#star-4,#star-5").removeClass('star-checked');
            document.getElementById('star-rating').value = '3';
            break;
        case 'star-4' :
            $("#star-1,#star-2,#star-3,#star-4").addClass('star-checked');
            $("#star-5").removeClass('star-checked');
            document.getElementById('star-rating').value = '4';
            break;
        case 'star-5' :
            $("#star-1,#star-2,#star-3,#star-4,#star-5").addClass('star-checked');
            document.getElementById('star-rating').value = '5';
            break;
    }
    console.log(document.getElementById('star-rating').value)
}

// Create legend
function getLegend() {
    const icons = {
        rg :{
            name: 'Attraction',
            icon: baseUrl + '/media/icon/marker_at.png',
        },
        ev :{
            name: 'Event',
            icon: baseUrl + '/media/icon/marker_ev.png',
        },
        cp :{
            name: 'Culinary Place',
            icon: baseUrl + '/media/icon/marker_cp.png',
        },
        wp :{
            name: 'Worship Place',
            icon: baseUrl + '/media/icon/marker_wp.png',
        },
        sp :{
            name: 'Souvenir Place',
            icon: baseUrl + '/media/icon/marker_sp.png',
        },
    }

    const title = '<p class="fw-bold fs-6">Legend</p>';
    $('#legend').append(title);

    for (key in icons) {
        const type = icons[key];
        const name = type.name;
        const icon = type.icon;
        const div = '<div><img src="' + icon + '"> ' + name +'</div>';

        $('#legend').append(div);
    }
    map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(legend);
}

// toggle legend element
function viewLegend() {
    if ($('#legend').is(':hidden')) {
        $('#legend').show();
    } else {
        $('#legend').hide();
    }
}

// Validate if star rating picked yet
function checkStar(event) {
    const star = document.getElementById('star-rating').value;
    if (star == '0') {
        event.preventDefault();
        Swal.fire('Please put rating star');
    }
}

// Update preview of uploaded photo profile
function showPreview(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function (e) {
            $('#avatar-preview').attr('src', e.target.result).width(300).height(300);
        };
        reader.readAsDataURL(input.files[0]);
    }
}