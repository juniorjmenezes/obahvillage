mapboxgl.accessToken = 'pk.eyJ1IjoianVuaW9yam1lbmV6ZXMiLCJhIjoiY2tzb3kzMm01MDBrczJwcGRiaWhtY281NyJ9.xugSYnzfrs2kcrC7fwdr_w';
var map = new mapboxgl.Map({
    container: 'map',
    style: 'mapbox://styles/mapbox/light-v10',
	center: [-2.8220216123114095, -40.41290841915818], // starting position
    zoom: 13 // starting zoom
});
		
// create the popup
var popup = new mapboxgl.Popup({ offset: 40 }).setText(
    'Vila Preá, SN, Preá - Ceará - Brasil'
);

// create DOM element for the marker
var el = document.createElement('div');
el.id = 'marker';
 
// create the marker
new mapboxgl.Marker(el)
    .setLngLat([-73.9751,40.7289])
    .setPopup(popup) // sets a popup on this marker
    .addTo(map);

// Add zoom and rotation controls to the map.
map.addControl(new mapboxgl.NavigationControl(), 'bottom-right');

// disable map zoom when using scroll
map.scrollZoom.disable();