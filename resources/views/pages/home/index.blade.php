@extends('layouts.master')

@section('content')

	<div class="row">
		<div class="col-lg-12">
			<h3 class="gis-title">Geographical Information System Demo
				<select class="selectpicker show-menu-arrow" data-live-search="true" data-style="btn-primary">
					@foreach( $countries as $country )
						<option data-tokens="{{ $country['name'] }}">{{ $country['name'] }}</option>
					@endforeach
				</select>
			</h3>
			
		</div>
		<div class="col-lg-12">
			
			<div id='mapbox'></div>
		</div>
	</div>
	
@endsection

@push('stylesheet')
	<link href='https://api.mapbox.com/mapbox-gl-js/v0.47.0/mapbox-gl.css' rel='stylesheet' />
	<style>
		body {
			background: #CAD2D3;
		}
		.gis-title {
			padding: 10px 0;
			font-weight: bold;
		}
		#mapbox {
			width: 100%;
			height: 90vh;
		}

		.dropdown-menu {
			max-height: 300px !important;
		}
	</style>
@endpush

@push('javascript')
	<script src='https://api.mapbox.com/mapbox-gl-js/v0.47.0/mapbox-gl.js'></script>
	<script>
		$(function() {
			var GetCoords = "{{ route('country') }}"; 
			var map 	  = undefined;

			mapboxgl.accessToken = 'pk.eyJ1IjoiYW50aG55cnlzIiwiYSI6ImNqa2pzZzVxYjFpbmIzcW9hZTAweDR5NGQifQ.RBcyuvN0W1m7I_d_d7hyPQ';

			$('.selectpicker').selectpicker('val', 'Philippines');
			
			$('.selectpicker').on('changed.bs.select', function (e) {
				e.preventDefault();
				var country = $(this).val();
				getCoords(country);
			});

			$('.selectpicker').on('loaded.bs.select', function(e) {
				e.preventDefault();
				var country = $(this).val();
				getCoords(country);
			});

			function getCoords(country) {
				$.ajax({
					method: 'GET',
					url: GetCoords,
					data : { country: country },
					success: function(response) {
						console.log('response',response);
						map = setCoordinates(response);
						setMarker(response, map);
					}
				});
			}

			function setCoordinates(data) {
				var coordinates = data.coordinates.coordinates;
				return new mapboxgl.Map({
					container: 'mapbox',
					style: 'mapbox://styles/mapbox/light-v9',
					center: [coordinates[0], coordinates[1]], // starting position as [lng, lat]
					zoom: 5
				});
			}

			function setMarker(data,map) {
				var coordinates = data.coordinates.coordinates;

				var popup = new mapboxgl.Popup()
									.setHTML('<h3>' + data.name + '</h3>');
									
				var marker = new mapboxgl.Marker()
									.setLngLat([coordinates[0], coordinates[1]])
									.setPopup(popup)
									.addTo(map);
			}
		});
	</script>
@endpush