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
			/* background: rgba(0, 0, 0, 1); */
			background: #ecf0f1;
		}
		.gis-title {
			padding: 10px 0;
			font-weight: bold;
		}
		#mapbox {
			width: 100%;
			height: 90vh;
		}

		/* .bootstrap-select > .dropdown-menu + .open {
			max-height: 300px !important;
		}

		.bootstrap-select > .dropdown-menu + .open > .dropdown-menu + .inner {
			max-height: 300px !important;
		} */
		.dropdown-menu {
			max-height: 300px !important;
		}
	</style>
@endpush

@push('javascript')
	<script src='https://api.mapbox.com/mapbox-gl-js/v0.47.0/mapbox-gl.js'></script>
	<script>
		$(function() {
			$('.selectpicker').selectpicker();

			$('.selectpicker').on('changed.bs.select', function (e) {
				console.log($(this).val());
			});

			mapboxgl.accessToken = 'pk.eyJ1IjoiYW50aG55cnlzIiwiYSI6ImNqa2pzZzVxYjFpbmIzcW9hZTAweDR5NGQifQ.RBcyuvN0W1m7I_d_d7hyPQ';
			var map = new mapboxgl.Map({
				container: 'mapbox',
				style: 'mapbox://styles/mapbox/light-v9',
				center: [121.7740, 12.8797], // starting position as [lng, lat]
				zoom: 5
			});

			var popup = new mapboxgl.Popup()
									.setHTML('<h3>Mabuhay Philippines</h3><p>NAMBAWAN</p>');

			var marker = new mapboxgl.Marker()
									.setLngLat([121.7740, 12.8797])
									.setPopup(popup)
									.addTo(map);
		});
	</script>
@endpush