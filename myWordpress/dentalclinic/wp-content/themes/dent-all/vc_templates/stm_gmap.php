<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

wp_enqueue_script( 'stm_gmap' );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
if ( ! empty( $el_class ) ) {
	$css_class .= ' ' . $el_class;
}
$id = rand();

if ( empty( $lat ) ) {
	$lat = 36.169941;
}
if ( empty( $lng ) ) {
	$lng = - 115.139830;
}

$map_style = array();
if ( $map_width ) {
	$map_style['width'] = ' width: ' . $map_width . ';';
}
if ( $map_height ) {
	$map_style['height'] = ' height: ' . $map_height . ';';
}
if ( $disable_mouse_whell == 'disable' ) {
	$disable_mouse_whell = 'false';
} else {
	$disable_mouse_whell = 'true';
}
?>
<?php $google_api_key = stm_option( 'google_api_key', false );
if( current_user_can('administrator') && empty( $google_api_key ) ){ ?>
	<div class="alert alert-danger alert-dismissible fade in stm_gmap_alert text-center">
		<button class="close" type="button" data-dismiss="alert">×</button>
		You need to enter your <strong>Google Maps API key</strong> under Theme options > General.
	</div>
<?php } ?>
<div<?php echo( ( $map_style ) ? ' style="' . esc_attr( implode( ' ', $map_style ) ) . '"' : '' ); ?> id="stm_map-<?php echo esc_attr( $id ); ?>" class="stm_gmap<?php echo esc_attr( $css_class ); ?>"></div>
<script type="text/javascript">
	jQuery(document).ready(function ($) {
		google.maps.event.addDomListener(window, 'load', init);

		function init() {
			var LatLng = new google.maps.LatLng(<?php echo esc_js( $lat ); ?>, <?php echo esc_js( $lng ); ?>);
			var mapOptions = {
				zoom: <?php echo esc_js( $map_zoom ); ?>,
				center: LatLng,
				scrollwheel: <?php echo esc_js( $disable_mouse_whell ); ?>,
				styles: [{
					"featureType": "water",
					"elementType": "geometry",
					"stylers": [{"color": "#e9e9e9"}, {"lightness": 17}]
				}, {
					"featureType": "landscape",
					"elementType": "geometry",
					"stylers": [{"color": "#f5f5f5"}, {"lightness": 20}]
				}, {
					"featureType": "road.highway",
					"elementType": "geometry.fill",
					"stylers": [{"color": "#ffffff"}, {"lightness": 17}]
				}, {
					"featureType": "road.highway",
					"elementType": "geometry.stroke",
					"stylers": [{"color": "#ffffff"}, {"lightness": 29}, {"weight": 0.2}]
				}, {
					"featureType": "road.arterial",
					"elementType": "geometry",
					"stylers": [{"color": "#ffffff"}, {"lightness": 18}]
				}, {
					"featureType": "road.local",
					"elementType": "geometry",
					"stylers": [{"color": "#ffffff"}, {"lightness": 16}]
				}, {
					"featureType": "poi",
					"elementType": "geometry",
					"stylers": [{"color": "#f5f5f5"}, {"lightness": 21}]
				}, {
					"featureType": "poi.park",
					"elementType": "geometry",
					"stylers": [{"color": "#dedede"}, {"lightness": 21}]
				}, {
					"elementType": "labels.text.stroke",
					"stylers": [{"visibility": "on"}, {"color": "#ffffff"}, {"lightness": 16}]
				}, {
					"elementType": "labels.text.fill",
					"stylers": [{"saturation": 36}, {"color": "#333333"}, {"lightness": 40}]
				}, {"elementType": "labels.icon", "stylers": [{"visibility": "off"}]}, {
					"featureType": "transit",
					"elementType": "geometry",
					"stylers": [{"color": "#f2f2f2"}, {"lightness": 19}]
				}, {
					"featureType": "administrative",
					"elementType": "geometry.fill",
					"stylers": [{"color": "#fefefe"}, {"lightness": 20}]
				}, {
					"featureType": "administrative",
					"elementType": "geometry.stroke",
					"stylers": [{"color": "#fefefe"}, {"lightness": 17}, {"weight": 1.2}]
				}]
			};
			var mapElement = document.getElementById('stm_map-<?php echo esc_js( $id ); ?>');
			var map = new google.maps.Map(mapElement, mapOptions);
			var marker = new google.maps.Marker({
				position: LatLng,
				icon: '<?php echo get_template_directory_uri(); ?>/assets/images/map-marker.png',
				map: map
			});
		}
	});
</script>