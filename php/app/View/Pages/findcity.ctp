<?php
    $config = Configure::read('RupeeForadian');
?>
<!--- End Features -->
    <?php
            if(isset($google_api_key) && $google_api_key!=''){
                    ?>
                    <script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=<?=$google_api_key?>"></script>
                    <?php
            }
            else{
                    ?>
                    <script src="https://maps.googleapis.com/maps/api/js?libraries=places"></script>
                    <?php
            }
    ?>
    <script type="text/javascript">
            var autocomplete='';
            var searchcity="<?=$short_name?>";
            var map='';
            var basepath = "<?=$basepath?>";
            function initialize() {
                var input = document.getElementById('firstName');;
                var options = {componentRestrictions: {country: 'in'}};
                             
                autocomplete = new google.maps.places.Autocomplete(input, options);
                autocomplete.addListener('place_changed', function() {
                    var place = autocomplete.getPlace();
                    console.log(place);
                    if (!place.geometry) {
                            console.log(place.geometry.access_points[0].location.lat);
                            console.log(place.geometry.access_points[0].location.lat);
                    }
                    //get the state name
                    var founddata="administrative_area_level_1";
                    if (place.address_components.length>0) {
                            var short_name='';
                            for (var i=0;i<place.address_components.length;i++) {
                                    var addressplace = place.address_components[i];
                                    if ($.inArray(founddata,addressplace.types)>-1) {
                                            console.log("found : "+founddata+" with in : "+addressplace.types);
                                            short_name = addressplace.short_name;
                                            long_name = addressplace.long_name;
                                            console.log(short_name);
                                            break;
                                    }
                            }
                            if (short_name!='') {
                                    gotoCitylist(short_name);
                            }
                    }
                });
                //map load section
                var mapProp = {
                        center:new google.maps.LatLng(22.0576214,78.9537488),
                        zoom:4,
                        mapTypeId:google.maps.MapTypeId.ROADMAP,
                        draggable: false,
                        mapTypeControl : false,
                        scrollwheel: false
                };
                map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
                if (map) {
                        //load all city on the map
                        //allcities();
                }
            }
            
            google.maps.event.addDomListener(window, 'load', initialize);
            //mal loading section
            function allcities(){
                    
                    var cityfound="Cities/allcities";
                    $.ajax({
                            url:basepath+cityfound,
                            type:'post',
                            dataType:'json',
                            data:{short_name:searchcity},
                            success:function(response){
                                    console.log(response);
                                    console.log(response.status);
                                    console.log(response.allcities);
                                    var len = response.allcities.length;
                                    console.log(len);
                                    if (len>0) {
                                            //now create markers
                                            for (var i=0;i<len;i++) {
                                                    var city = response.allcities[i];
                                                    makeMarker(city);
                                            }
                                    }
                            }
                    });
            }
            function makeMarker(city){
                    console.log(city);
                    
                    var myLatlng = new google.maps.LatLng(city.lati,city.longi);
                    var marker = new google.maps.Marker({
                            position: myLatlng,
                            title:city.city_name
                    });
                    marker.setMap(map);
            }
            function gotoCitylist(short_name){
                    var path="Pages/findcity/"+short_name;
                    window.location=basepath+path;
            }
    </script>
<div class="allcommon_body findBODY">
    <div class="checkout">
            <div class="findcity">
                    <div class="mapDiv" id="googleMap">
                            <!--<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3633509.1117495685!2d79.63053017840285!3d27.208198568519247!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39994e9f7b4a09d3%3A0xf6a5476d3617249d!2sUttar+Pradesh!5e0!3m2!1sen!2sin!4v1459935891199" width="100%" height="286" frameborder="0" style="border:0" allowfullscreen></iframe>
                    -->
                    </div>
                    <div class="searchDiv">
                            <div class="search_locet sub_Search">
                                    <div class="col-sm-10 col-xs-10">
                                            <input class="inputfrom" name="firstName" id="firstName" placeholder="Find Your City" type="text" style="width:100%; height:60px; font-size:24px;">
                                    </div>
                                    <div class="col-sm-2 col-xs-2 searchicon" style="text-align:center; border-left:1px solid #e4e4e4; padding:9px;">
                                            <a href="javascript:void(0);"><img src="<?=$config['BaseUrl']?>img/ser_icon.png" class=""/></a>
                                    </div>
                                    <div class="clr"></div>
                            </div>
                    </div>
            </div>
            <div class="container">
                    <div class="row">
                            <div class="col-md-12 service_body">
                                    <div class="find">
                                            <h2><?=$satatename?></h2>
                                            <div>
                                                <div class="col-md-2 resCity">
                                                    <ul class="cityname">
                                                <?php
                                                    if(isset($cities) && is_array($cities) && count($cities)>0){
                                                        $i=1;
                                                        foreach($cities as $city){
                                                            $city_name=$city['City']['city_name'];
                                                            ?>
                                                            <li><a href="javascript:void(0);"><?=$city_name?></a></li>
                                                            <?php
                                                            
                                                            if($i%6==0){
                                                            ?>
                                                    </ul>
                                                </div>
                                                <div class="col-md-2 resCity">
                                                    <ul class="cityname">
                                                                
                                                                <?php
                                                            }
                                                            $i++;
                                                        }
                                                    }
                                                ?>
                                                    </ul>
                                                </div>
                                                    <!--<div class="col-md-2 resCity">
                                                            <ul class="cityname">
                                                                    <li><a href="javascript:void(0);">Agra</a></li>
                                                                    <li><a href="javascript:void(0);">Agra</a></li>
                                                                    <li><a href="javascript:void(0);">Allahabad</a></li>
                                                                    <li><a href="javascript:void(0);">Ambedkar Nagar</a></li>
                                                                    <li><a href="javascript:void(0);">Auraiya</a></li>
                                                                    <li><a href="javascript:void(0);">Azamgarh</a></li>
                                                            </ul>
                                                    </div>
                                                    <div class="col-md-2 resCity">
                                                            <ul class="cityname">
                                                                    <li><a href="javascript:void(0);">Agra</a></li>
                                                                    <li><a href="javascript:void(0);">Agra</a></li>
                                                                    <li><a href="javascript:void(0);">Allahabad</a></li>
                                                                    <li><a href="javascript:void(0);">Ambedkar Nagar</a></li>
                                                                    <li><a href="javascript:void(0);">Auraiya</a></li>
                                                                    <li><a href="javascript:void(0);">Azamgarh</a></li>
                                                            </ul>
                                                    </div>
                                                    <div class="col-md-2 resCity">
                                                            <ul class="cityname">
                                                                    <li><a href="javascript:void(0);">Agra</a></li>
                                                                    <li><a href="javascript:void(0);">Agra</a></li>
                                                                    <li><a href="javascript:void(0);">Allahabad</a></li>
                                                                    <li><a href="javascript:void(0);">Ambedkar Nagar</a></li>
                                                                    <li><a href="javascript:void(0);">Auraiya</a></li>
                                                                    <li><a href="javascript:void(0);">Azamgarh</a></li>
                                                            </ul>
                                                    </div>
                                                    <div class="col-md-2 resCity">
                                                            <ul class="cityname">
                                                                    <li><a href="javascript:void(0);">Agra</a></li>
                                                                    <li><a href="javascript:void(0);">Agra</a></li>
                                                                    <li><a href="javascript:void(0);">Allahabad</a></li>
                                                                    <li><a href="javascript:void(0);">Ambedkar Nagar</a></li>
                                                                    <li><a href="javascript:void(0);">Auraiya</a></li>
                                                                    <li><a href="javascript:void(0);">Azamgarh</a></li>
                                                            </ul>
                                                    </div>
                                                    <div class="col-md-2 resCity">
                                                            <ul class="cityname">
                                                                    <li><a href="javascript:void(0);">Agra</a></li>
                                                                    <li><a href="javascript:void(0);">Agra</a></li>
                                                                    <li><a href="javascript:void(0);">Allahabad</a></li>
                                                                    <li><a href="javascript:void(0);">Ambedkar Nagar</a></li>
                                                                    <li><a href="javascript:void(0);">Auraiya</a></li>
                                                                    <li><a href="javascript:void(0);">Azamgarh</a></li>
                                                            </ul>
                                                    </div>-->
                                                    
                                                    <div class="crl"></div>
                                            </div>
                                            <div class="crl"></div>
                                    </div>
                            </div>
                    </div>
            </div>
    </div>
</div>