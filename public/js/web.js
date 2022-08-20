let baseUrl = '';
let currentUrl = '';
let web;
let bounds = new google.maps.LatLngBounds();
let json;

var map;
var marker;
var coords;
var markersManual = [];
var m = [];

function setBaseUrl(url) {
    baseUrl = url;
}

// Initialize and add the map
// function initMap(lat = -0.7106133793157127, lng = 100.19519243888361) {
//     const center = new google.maps.LatLng(lat, lng);
//     map = new google.maps.Map(document.getElementById("googlemaps"), {
//         zoom: 15,
//         center: center,
//         mapTypeId: 'roadmap',
//     });
// }

function initMap(lat = -0.7106133793157127, lng = 100.19519243888361) {
    const center = new google.maps.LatLng(lat, lng);
    map = new google.maps.Map(document.getElementById("googlemaps"), {
        zoom: 15,
        center: center,
        mapTypeId: 'roadmap',
    });

    tm = new google.maps.Data();
      tm.loadGeoJson(digi);
      tm.setStyle(function(feature)
      {
        return({
                fillColor: '#ffc76e',
                strokeColor: '#ffc76e',
                strokeWeight: 2,
                fillOpacity: 0.8
              });          
        }
      );
      tm.setMap(map);

    console.log("testt");
    console.log(jsonData);

    $.ajax({ 
        url: baseUrl+'home/web', data: "", dataType: 'json', success: function(rows) 
        { 
            for (var i in jsonData){ 
              var row = jsonData[i];
              var id = row.id;
              var name = row.name;
              console.log(id);
              console.log(name);
              var latitude = row.lat;
              var longitude = row.lng;
            //   $('#kanan_table').append("<tr><td>"+name+"</td><td><a role='button' class='btn btn-success fa fa-info' title='info' onclick='data_tourism_1_info(\""+id+"\")'></a></td><td><a role='button' class='btn btn-danger fa fa-taxi' title='Local Transportation' style='padding: 6px' onclick='angkot_sekitar(\""+id+"\")'></a></td></tr>");  
  
              centerBaru = new google.maps.LatLng(latitude, longitude);
            
              map.setCenter(centerBaru);
              map.setZoom(10); 
  
              var marker = new google.maps.Marker({
                position: centerBaru,              
                // icon:'icon/marker_tw.png',
                animation: google.maps.Animation.DROP,
                map: map
                });
              m.push(marker);
              map.setCenter(centerBaru);

              marker.info = new google.maps.InfoWindow({
                content: "<center><a style='color:black;'>Digitasi talao !</a></center>",
                pixelOffset: new google.maps.Size(0, -1)
                  });
                marker.info.open(name, marker);
            //   klikInfoWindow(id,marker);
  
            }               
          } 
        });
}

// Geolocation
function viewLocation() {
    // var x = navigator.geolocation;
    // x.getCurrentPosition(success, failure);

    // function success(location) {
    //     var myLat = location.coords.latitude;
    //     var myLong = location.coords.longitude;
    //     coords = new google.maps.LatLng(myLat, myLong);
    //     map.setCenter(coords);

    //     marker = new google.maps.Marker( {map: map, position: coords, animation: google.maps.Animation.DROP} );
        
    //     marker.info = new google.maps.InfoWindow( {
    //         content: "<center><a style='color:black;'>You are here!<br>Lat : " + myLat + " <br>Lng : " + myLong + "</a></center>",
    //         pixelOffset: new google.maps.Size(0, -1)
    //     } );
    //     marker.info.open(map, marker);
    // }
    // function failure() {
    //     alert('Geolocation failure!');
    // }

    google.maps.event.clearListeners(map, 'click');
    navigator.geolocation.getCurrentPosition(function(position)
    {
      pos = {
        lat: position.coords.latitude,
        lng: position.coords.longitude};
      koordinat = {
        lat: position.coords.latitude,
        lng: position.coords.longitude };

      centerBaru = new google.maps.LatLng(koordinat.lat, koordinat.lng);
      centerLokasi = centerBaru;
      map.setCenter(centerBaru)
      map.setZoom(13);
      
      var marker = new google.maps.Marker({
                position: koordinat,
                animation: google.maps.Animation.DROP,
                map: map});

      marker.info = new google.maps.InfoWindow({
          content: "<center><a style='color:black;'>You Are Here ! <br> lat : "+koordinat.lat+" <br> long : "+koordinat.lng+"</a></center>",
          pixelOffset: new google.maps.Size(0, -1)
            });
          marker.info.open(map, marker);

      pos_lat = koordinat.lat;
      pos_lng = koordinat.lng;
    //   document.getElementById('myLatLocation').value = koordinat.lat;
    //   document.getElementById('myLngLocation').value = koordinat.lng;
      console.log(pos_lat);
      console.log(pos_lng);
    })
}

// Set manual position
function getLocation() {
    // alert('Click on map!');
    // google.maps.event.addListener(map, 'click', function(event) {
    //     addLocation(this, event.latLng);
    // });

    alert('Click on Map');
    map.addListener('click', function(event) {
      addLocation(event.latLng);
      });
}

// function addLocation(map, location) {
function addLocation(location) {
    // if(marker)
    // {
    //     marker.setPosition(location);
    // }
    // else
    // {
    //     coords = {
    //         lat: location.lat(),
    //         lng: location.lng() 
    //     };
    //     // center = new google.maps.LatLng(coords.lat, coords.lng);        
    //     map.setCenter(coords);

    //     marker = new google.maps.Marker( {
    //         position : location,
    //         map: map,
    //         animation: google.maps.Animation.DROP,
    //     } );
    // }   

    for (var i = 0; i < markersManual.length; i++) {
        markersManual[i].setMap(null);       
    } 

    marker = new google.maps.Marker({
       //icon: "assets/img/biru1.ico",
        position : location,
        map: map,
        animation: google.maps.Animation.DROP,
    });

    koordinat = {
        lat: location.lat(),
        lng: location.lng() 
    };

    centerLokasi = new google.maps.LatLng(koordinat.lat, koordinat.lng);        

    marker.info = new google.maps.InfoWindow({
          content: "<center><a style='color:black;'>You Are Here ! <br> lat : "+koordinat.lat+" <br> long : "+koordinat.lng+"</a></center>",
          pixelOffset: new google.maps.Size(0, -1)
    });
    marker.info.open(map, marker);
    map.setCenter(koordinat)
    map.setZoom(13);
    markersManual.push(marker);
    // document.getElementById('myLatLocation').value = koordinat.lat;
    // document.getElementById('myLngLocation').value = koordinat.lng;
        
    pos_lat = koordinat.lat;
    pos_lng = koordinat.lng;
    console.log(pos_lat);
    console.log(pos_lng);
}

// Update radiusValue on search by radius
function updateRadius(postfix) {
    document.getElementById('radiusValue' + postfix).innerHTML = (document.getElementById('inputRadius' + postfix).value * 100) + " m";
}

// display steps of direction to selected route
function showSteps() {
    $('#direction-row').show();
    $('#table-direction').empty();
    for (let i = 0; i < 2; i++) {
        let row =
            '<tr>' +
            '<td>400</td>' +
            '<td>Instruksi ditulis disini</td>' +
            '</tr>';
        $('#table-direction').append(row);
    }
}

// close nearby search section
function closeNearby() {
    $('#direction-row').hide();
    $('#check-nearby-col').hide();
    $('#result-nearby-col').hide();
    $('#list-rg-col').show();
    $('#list-ev-col').show();
}

// open nearby search section
function openNearby() {
    $('#list-rg-col').hide();
    $('#list-ev-col').hide();
    $('#list-rec-col').hide();
    $('#check-nearby-col').show();
}

// Search Result Object Around
function checkNearby() {
    $('#table-cp').empty();
    $('#table-wp').empty();
    $('#table-sp').empty();
    $('#table-cp').hide();
    $('#table-wp').hide();
    $('#table-sp').hide();

    const checkCP = document.getElementById('check-cp').checked;
    const checkWP = document.getElementById('check-wp').checked;
    const checkSP = document.getElementById('check-sp').checked;

    if (!checkCP && !checkWP && !checkSP) {
        document.getElementById('radiusValueNearby').innerHTML = "0 m";
        document.getElementById('inputRadiusNearby').value = 0;
        return Swal.fire('Please choose one object');
    }

    if (checkCP) {
        let table =
            '<thead><tr>' +
            '<th>Culinary Name</th>' +
            '<th>Action</th>' +
            '</tr></thead>' +
            '<tbody id="data-cp">' +
            '</tbody>';
        $('#table-cp').append(table);
        $('#table-cp').show();
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
            name: 'Rumah Gadang',
            icon: baseUrl + '/media/icon/marker_rg.png',
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