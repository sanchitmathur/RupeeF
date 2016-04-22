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
			type:['cities'],
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
				lon = place.geometry.access_points[0].location.lat;
			}
			console.log(lat);
			console.log(lon);
			$("#lat").val(lat);
			$("#lon").val(lon);
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
		echo $this->Form->hidden('is_blocked',array('value'=>'0'));
		echo $this->Form->hidden('is_deleted',array('value'=>'0'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Cities'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
