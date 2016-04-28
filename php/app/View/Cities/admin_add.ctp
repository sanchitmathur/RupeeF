<!--- Location --->
<?php
	if($google_mape_user_api_key!=''){
		?>
<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=<?=$google_mape_user_api_key?>"></script>
		<?php
	}
	else{
		?>
<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key="></script>
		<?php
	}
?>

<script type="text/javascript">
	var autocomplete='';
	function initialize() {
	    var input = document.getElementById('cityname');
	    var options = {
			type:['regions'],
			componentRestrictions: {country: 'in'}
		};
			 
		autocomplete = new google.maps.places.Autocomplete(input, options);
		autocomplete.addListener('place_changed', function() {
			var place = autocomplete.getPlace();
			console.log(place);
			//console.log(place.name);
			if (place.geometry) {
				var lat=0;
				var lon=0
				if (place.geometry.access_points) {
					lat = place.geometry.access_points[0].location.lat;
					lon = place.geometry.access_points[0].location.lng;
				}
				console.log(lat);
				console.log(lon);
				$("#lat").val(lat);
				$("#lon").val(lon);
			}
			//get the state name
			var founddata="administrative_area_level_1";
			if (place.address_components.length>0) {
				var short_name='';
				var long_name="";
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
				$("#state_name").val(short_name);
				$("#long_state_name").val(long_name);
			}
		});
	}
		     
	google.maps.event.addDomListener(window, 'load', initialize);
</script>

<div class="cities form">
<?php echo $this->Form->create('City'); ?>
	<fieldset>
		<legend><?php echo __('Admin Add City'); ?></legend>
	<?php
		echo $this->Form->input('city_name',array('id'=>'cityname'));
		echo $this->Form->input('lati',array('label'=>'Latitude','id'=>'lat'));
		echo $this->Form->input('longi',array('label'=>'Longitude','id'=>'lon'));
		echo $this->Form->input('region',array('options'=>$cityregions));
		echo $this->Form->hidden('state_name',array('id'=>'state_name'));
		echo $this->Form->hidden('long_state_name',array('id'=>'long_state_name'));
		echo $this->Form->hidden('is_blocked',array('value'=>'0'));
		echo $this->Form->hidden('is_deleted',array('value'=>'0'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
<div class="actions" style="margin: -62px 0 0px 80px;font-size: 22px;">
	<?php echo $this->Html->link(__('Back'), array('action' => 'index','admin'=>true)); ?>
</div>
</div>
