// Initialize the map centered on Jakarta, Indonesia
var map = L.map('map').setView([-6.2088, 106.8456], 13);

// Add OpenStreetMap Tiles
L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

// Add a Marker with Popup
L.marker([-6.2088, 106.8456]).addTo(map)
    .bindPopup('Welcome to Jakarta, Indonesia!<br> Find your location.')
    .openPopup();

// 10-mile radius in meters (1 mile ≈ 1609.34 meters)
const radiusInMeters = 10 * 1609.34;  // 10 miles in meters

// Add a green circle overlay with a 10-mile radius around Jakarta
const greenCircle = L.circle([-6.2088, 106.8456], {
    color: 'green',  // Outline color
    fillColor: '#0f3',  // Fill color
    fillOpacity: 0.5,  // Fill opacity
    radius: radiusInMeters  // Radius in meters
}).addTo(map).bindPopup('Area C: Green Circle');

// Add a red circle inside the green circle (for example, a smaller radius)
const redCircleRadius = radiusInMeters * 0.04;  // 40% of the 10-mile radius
L.circle([-6.2088, 106.8456], {
    color: 'red',  // Outline color
    fillColor: '#f03',  // Fill color
    fillOpacity: 0.5,  // Fill opacity
    radius: redCircleRadius  // Smaller radius
}).addTo(map).bindPopup('Red Circle Inside Green Circle');

// Add multiple blue circles inside the green circle
const blueCirclesData = [
    [-6.1888, 106.8456], // Coordinates for first blue circle
    [-6.1988, 106.8356], // Coordinates for second blue circle
    [-6.2088, 106.8256], // Coordinates for third blue circle
    [-6.2188, 106.8156]  // Coordinates for fourth blue circle
];

// Loop through the data and create blue circles
blueCirclesData.forEach(function (coords) {
    L.circle(coords, {
        color: 'blue',  // Outline color
        fillColor: '#03f',  // Fill color
        fillOpacity: 0.5,  // Fill opacity
        radius: 500  // Radius in meters for each blue circle
    }).addTo(map).bindPopup('Blue Circle');
});

// Add a legend (if you have a legend element in HTML)
const legend = document.getElementById('legend');
map.getContainer().appendChild(legend); // Append the legend to the map container