$(document).ready(function () {
    if(document.getElementById("mapa_ubi") != null){
      var script = document.createElement('script');
      script.src = "https://maps.googleapis.com/maps/api/js?key="+keymaps+"&libraries=places";
      script.async;
      script.defer;
      document.getElementsByTagName('script')[0].parentNode.appendChild(script);
    }

    $('#ubi').on('click',function(){
        window.location.href=amigable('?module=shop&function=list_map')
    });
    ///saca el mapa de la provincia buscada
    if(sessionStorage.getItem('provincia')!='null'){
        ubi={'ubi':sessionStorage.getItem('provincia'),'muni':sessionStorage.getItem('local')}
    }else{
        ubi={'ubi':'España'}
    }
        $.ajax({
            type: "POST",
            url: amigable('?module=shop&function=ubication'), 
            data: ubi//{'ubi':sessionStorage.getItem('provincia')},
        })
        .done(function( data, textStatus, jqXHR ) {
                ubic=JSON.parse(data);
                console.log(ubic);
                console.log(ubic['lat']);
                console.log(ubic['long']);
                initMap1()
        })
    
  })
  var provi=sessionStorage.getItem('provincia');
  var local= sessionStorage.getItem('local'); 
  var val= sessionStorage.getItem('val'); 
  if(!val){
      ///console.log('entra');
      val=null;
  }
  if((local=='false')||(local==0)){
      local=null;
  }
  if(provi==0){
      provi=null;
  }
  var map, places, infoWindow;
  var ubic;
  var zoom;
      var markers = [];
      var autocomplete;
      var countryRestrict = {'country': 'us'};
      var MARKER_PATH = 'https://maps.gstatic.com/intl/en_us/mapfiles/marker_green';
      var hostnameRegexp = new RegExp('^https?://.+?/');

      var countries = {
        'au': {
          center: {lat: -25.3, lng: 133.8},
          zoom: 4
        },
        'br': {
          center: {lat: -14.2, lng: -51.9},
          zoom: 3
        },
        'ca': {
          center: {lat: 62, lng: -110.0},
          zoom: 3
        },
        'fr': {
          center: {lat: 46.2, lng: 2.2},
          zoom: 5
        },
        'de': {
          center: {lat: 51.2, lng: 10.4},
          zoom: 5
        },
        'mx': {
          center: {lat: 23.6, lng: -102.5},
          zoom: 4
        },
        'VALENCIA': {
          center: {lat: -40.9, lng: 174.9},
          zoom: 5
        },
        'it': {
          center: {lat: 41.9, lng: 12.6},
          zoom: 5
        },
        'za': {
          center: {lat: -30.6, lng: 22.9},
          zoom: 5
        },
        'es': {
          center: {lat: 40.5, lng: -3.7},
          zoom: 5
        },
        'pt': {
          center: {lat: 39.4, lng: -8.2},
          zoom: 6
        },
        'us': {
          center: {lat: 37.1, lng: -95.7},
          zoom: 3
        },
        'uk': {
          center: {lat: 54.8, lng: -4.6},
          zoom: 5
        }
      };
      
    //   var ubiprovi=sessionStorage.getItem('provincia');
     //console.log(sessionStorage.getItem('provincia'));
      function initMap1() {
          console.log(provi);
          console.log(local);//null
        if(provi==='null'){
            zoom=6;
         }else if((local===null)&&(provi!='null')){
            zoom=8;
        }else if((local!=null)&&(provi!=null)){
            zoom=11;
        }
        console.log(zoom);
        map = new google.maps.Map(document.getElementById('mapa_ubi'), {
          zoom: zoom,
          center: {lat:ubic['lat'], lng:ubic['long']},
          mapTypeControl: false,
          panControl: false,
          zoomControl: false,
          streetViewControl: false
        });

        infoWindow = new google.maps.InfoWindow({
          content: document.getElementById('info-content')
        });
        search();
        // Create the autocomplete object and associate it with the UI input control.
        // Restrict the search to the default country, and to place type "cities".
        // autocomplete = new google.maps.places.Autocomplete(
        //     /** @type {!HTMLInputElement} */ (
        //         document.getElementById('autocomplete')), {
        //       types: ['(cities)'],
        //       componentRestrictions: countryRestrict
        //     });
        // places = new google.maps.places.PlacesService(map);

        // autocomplete.addListener('place_changed', onPlaceChanged);

        // // Add a DOM event listener to react when the user selects a country.
        // document.getElementById('country').addEventListener(
        //     'change', setAutocompleteCountry);
      }

      // When the user selects a city, get the place details for the city and
      // zoom the map in on the city.
      function onPlaceChanged() {
        var place = autocomplete.getPlace();
        if (place.geometry) {
          map.panTo(place.geometry.location);
          map.setZoom(15);
          search();
        } else {
          document.getElementById('autocomplete').placeholder = 'Enter a city';
        }
      }

      // Search for hotels in the selected city, within the viewport of the map.
      function search() {
        var search = {
          bounds: map.getBounds(),
          types: ['lodging']
        };
            // var provi=sessionStorage.getItem('provincia');
            // var local= sessionStorage.getItem('local'); 
            // var val= sessionStorage.getItem('val'); 
            // if(!val){
            //     ///console.log('entra');
            //     val=null;
            // }
            // if((local=='false')||(local==0)){
            //     local=null;
            // }
            // if(provi==0){
            //     provi=null;
            // }
            var searchmap = JSON.stringify({'provi':provi,'local':local,'val':val});
        //places.nearbySearch(search, function(results, status) {
            
            //console.log(provi);
           $.ajax({
              
              type: "POST",
              dataType: "json",
              url:'../../shop/productsmap',
              data:{searchmap}
          })
          .done(function( data, textStatus, jqXHR ) {
                    console.log(data);
                //if (status === google.maps.places.PlacesServiceStatus.OK) {
                    clearResults();
                    clearMarkers();
                    // Create a marker for each hotel found, and
                    // assign a letter of the alphabetic to each marker icon.
                    for (var i = 0; i < data.length; i++) {
                            var markerLetter = String.fromCharCode('A'.charCodeAt(0) + i);
                            var markerIcon = MARKER_PATH + markerLetter + '.png';
                            var latlng = new google.maps.LatLng(38.5983587, -0.0520992);
                            // Use marker animation to drop the icons incrementally on the map.
                            markers[i] = new google.maps.Marker({
                                //position: data[i].geometry.location,
                                position:latlng,
                                animation: google.maps.Animation.DROP,
                                icon: markerIcon
                            });
                            // If the user clicks a hotel marker, show the details of that hotel
                            // in an info window.
                            markers[i].placeResult = data[i];
                            google.maps.event.addListener(markers[i], 'click', showInfoWindow);
                            setTimeout(dropMarker(i), i * 100);
                            addResult(data[i], i);
                    }
                //}
        })
        .fail(function( data, textStatus, jqXHR ) {
                console.log(data);
        });
      }

      function clearMarkers() {
        for (var i = 0; i < markers.length; i++) {
          if (markers[i]) {
            markers[i].setMap(null);
          }
        }
        markers = [];
      }

      // Set the country restriction based on user input.
      // Also center and zoom the map on the given country.
      function setAutocompleteCountry() {
        var country = document.getElementById('provinciaini').value;//country
        if (country == 'all') {
          autocomplete.setComponentRestrictions([]);
          map.setCenter({lat: 15, lng: 0});
          map.setZoom(2);
        } else {
          autocomplete.setComponentRestrictions(country);
        //   map.setCenter(countries[country].center);
        //   map.setZoom(countries[country].zoom);
        }
        clearResults();
        clearMarkers();
      }

      function dropMarker(i) {
        return function() {
          markers[i].setMap(map);
        };
      }

      function addResult(result, i) {
        var results = document.getElementById('results');
        var markerLetter = String.fromCharCode('A'.charCodeAt(0) + i);
        var markerIcon = MARKER_PATH + markerLetter + '.png';

        var tr = document.createElement('tr');
        tr.style.backgroundColor = (i % 2 === 0 ? '#F0F0F0' : '#FFFFFF');
        tr.onclick = function() {
          google.maps.event.trigger(markers[i], 'click');
        };

        var iconTd = document.createElement('td');
        var nameTd = document.createElement('td');
        var icon = document.createElement('img');
        icon.src = markerIcon;
        icon.setAttribute('class', 'placeIcon');
        icon.setAttribute('className', 'placeIcon');
        var name = document.createTextNode(result.name);
        iconTd.appendChild(icon);
        nameTd.appendChild(name);
        tr.appendChild(iconTd);
        tr.appendChild(nameTd);
        results.appendChild(tr);
      }

      function clearResults() {
        var results = document.getElementById('results');
        while (results.childNodes[0]) {
          results.removeChild(results.childNodes[0]);
        }
      }

      // Get the place details for a hotel. Show the information in an info window,
      // anchored on the marker for the hotel that the user selected.
      function showInfoWindow() {
        var marker = this;
        places.getDetails({placeId: marker.placeResult.place_id},
            function(place, status) {
              if (status !== google.maps.places.PlacesServiceStatus.OK) {
                return;
              }
              infoWindow.open(map, marker);
              buildIWContent(place);
            });
      }

      // Load the place information into the HTML elements used by the info window.
      function buildIWContent(place) {
        document.getElementById('iw-icon').innerHTML = '<img class="hotelIcon" ' +
            'src="' + place.icon + '"/>';
        document.getElementById('iw-url').innerHTML = '<b><a href="' + place.url +
            '">' + place.name + '</a></b>';
        document.getElementById('iw-address').textContent = place.vicinity;

        if (place.formatted_phone_number) {
          document.getElementById('iw-phone-row').style.display = '';
          document.getElementById('iw-phone').textContent =
              place.formatted_phone_number;
        } else {
          document.getElementById('iw-phone-row').style.display = 'none';
        }

        // Assign a five-star rating to the hotel, using a black star ('&#10029;')
        // to indicate the rating the hotel has earned, and a white star ('&#10025;')
        // for the rating points not achieved.
    //     if (place.rating) {
    //       var ratingHtml = '';
    //       for (var i = 0; i < 5; i++) {
    //         if (place.rating < (i + 0.5)) {
    //           ratingHtml += '&#10025;';
    //         } else {
    //           ratingHtml += '&#10029;';
    //         }
    //       document.getElementById('iw-rating-row').style.display = '';
    //       document.getElementById('iw-rating').innerHTML = ratingHtml;
    //       }
    //     } else {
    //       document.getElementById('iw-rating-row').style.display = 'none';
    //     }

    //     // The regexp isolates the first part of the URL (domain plus subdomain)
    //     // to give a short URL for displaying in the info window.
    //     if (place.website) {
    //       var fullUrl = place.website;
    //       var website = hostnameRegexp.exec(place.website);
    //       if (website === null) {
    //         website = 'http://' + place.website + '/';
    //         fullUrl = website;
    //       }
    //       document.getElementById('iw-website-row').style.display = '';
    //       document.getElementById('iw-website').textContent = website;
    //     } else {
    //       document.getElementById('iw-website-row').style.display = 'none';
    //     }
       }