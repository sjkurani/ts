<footer>
<div id="footer" class="container-fluid">
    <div class="row-fluid footer-rows ">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="container">
                <div class="row">
                        <ul class="text-center">
                            <li><a href="#" title="Would you like to know about us?">About Us</a></li>
                            <li><a href="#" title="Feel free to contact us">Contact Us</a></li>
                            <li><a href="#" title="Frequently asked questions">FAQS</a></li>
                            <li><a href="#" title="Privacy policy">Privacy</a></li>
                            <?php
                                if(!$this->session->userdata('logged_in')) {
                                echo '<li><a href="#" title="Signin now">Sign in</a></li>
                                      <li><a href="#" title="Register now">Sign up</a></li>';

                                }
                            ?>
                        </ul>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 notice text-center muted">
                        <div class="footer-social">
                            
        <div class="icons">
            <a target="_blank" href="#"><i class="fa fa-twitter fa-2x"></i></a>
            <a target="_blank" href="#"><i class="fa fa-facebook fa-2x"></i></a>
            <a target="_blank" href="#"><i class="fa fa-linkedin fa-2x"></i></a>
            <a target="_blank" href="#"><i class="fa fa-google-plus fa-2x"></i></a>
        </div>
        
                        </div>
                        <small>© 2017 Mediabasket. All rights reserved.</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>
        <a href="JavaScript:void(0);" title="Back To Top" id="backtop" style="display: inline;"></a>
    </div>
</footer>

    <script>
      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

      var placeSearch, autocomplete;
      var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        country: 'long_name',
        postal_code: 'short_name'
      };

      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 12.9715987, lng: 77.59456269999998},
          zoom: 13
        });
        var card = document.getElementById('pac-card');
        var input = document.getElementById('pac-input');
        var types = document.getElementById('type-selector');
        var strictBounds = document.getElementById('strict-bounds-selector');

        map.controls[google.maps.ControlPosition.TOP_RIGHT].push(card);

        var autocomplete = new google.maps.places.Autocomplete(input);

        // Bind the map's bounds (viewport) property to the autocomplete object,
        // so that the autocomplete requests use the current map bounds for the
        // bounds option in the request.
        autocomplete.bindTo('bounds', map);

        var infowindow = new google.maps.InfoWindow();
        var infowindowContent = document.getElementById('infowindow-content');
        infowindow.setContent(infowindowContent);
        var marker = new google.maps.Marker({
          map: map,
          anchorPoint: new google.maps.Point(0, -29),
          draggable : true
        });
        //Draggable 
        google.maps.event.addListener(marker, 'dragend', function (event) {
            document.getElementById("map_lat").value = this.getPosition().lat();
            document.getElementById("map_lang").value = this.getPosition().lng();
            console.log(this);
        });
        //AutoComplete.
        autocomplete.addListener('place_changed', function() {
          infowindow.close();
          marker.setVisible(false);
          var place = autocomplete.getPlace();
          console.log(place);

        for (var component in componentForm) {
          document.getElementById(component).value = '';
          document.getElementById(component).disabled = false;
        }

        // Get each component of the address from the place details
        // and fill the corresponding field on the form.
        for (var i = 0; i < place.address_components.length; i++) {
          var addressType = place.address_components[i].types[0];
          if (componentForm[addressType]) {
            var val = place.address_components[i][componentForm[addressType]];
            document.getElementById(addressType).value = val;
            console.log(val);
          }
        }

          if (!place.geometry) {
            // User entered the name of a Place that was not suggested and
            // pressed the Enter key, or the Place Details request failed.
            window.alert("No details available for input: '" + place.name + "'");
            return;
          }
          document.getElementById("map_lat").value = place.geometry.location.lat();
          document.getElementById("map_lang").value = place.geometry.location.lng();
          if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
          } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);  // Why 17? Because it looks good.
          }
          marker.setPosition(place.geometry.location);
          marker.setVisible(true);

          var address = '';
          if (place.address_components) {
            address = [
              (place.address_components[0] && place.address_components[0].short_name || ''),
              (place.address_components[1] && place.address_components[1].short_name || ''),
              (place.address_components[2] && place.address_components[2].short_name || '')
            ].join(' ');
          }

          infowindowContent.children['place-icon'].src = place.icon;
          infowindowContent.children['place-name'].textContent = place.name;
          infowindowContent.children['place-address'].textContent = address;
          infowindow.open(map, marker);
        });

        // Sets a listener on a radio button to change the filter type on Places
        // Autocomplete.
        function setupClickListener(id, types) {
          var radioButton = document.getElementById(id);
          radioButton.addEventListener('click', function() {
            autocomplete.setTypes(types);
          });
        }

        setupClickListener('changetype-all', []);
        setupClickListener('changetype-address', ['address']);
        setupClickListener('changetype-establishment', ['establishment']);
        setupClickListener('changetype-geocode', ['geocode']);

        document.getElementById('use-strict-bounds')
            .addEventListener('click', function() {
              console.log('Checkbox clicked! New state=' + this.checked);
              autocomplete.setOptions({strictBounds: this.checked});
            });
      }
    </script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAsIHVkCj_kVBr7XwCmVaVEJU8S_poNKYw&libraries=places&callback=initMap"
        async defer></script>
</body>
</html>