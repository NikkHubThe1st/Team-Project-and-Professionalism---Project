
var map = L.map('map').setView([-6.2088, 106.8456], 13);

// Add OpenStreetMap Tiles
L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

function getRandomCoordinates(center, radiusInMeters) {
    // Convert radius from meters to degrees (rough estimate)
    const radiusInDegrees = radiusInMeters / 111320; // 1 degree of latitude ≈ 111.32 km

    // Generate a random angle and distance from the center
    const angle = Math.random() * 2 * Math.PI;  // Random angle in radians
    const distance = Math.random() * radiusInMeters;  // Random distance within radius

    // Calculate random latitude and longitude offset
    const deltaLat = (distance / 111320); // Convert distance to latitude degrees
    const deltaLon = (distance / (111320 * Math.cos(center[0] * Math.PI / 180))); // Adjust for longitude

    // Apply the offsets to the center coordinates
    const randomLat = center[0] + deltaLat * Math.sin(angle);
    const randomLon = center[1] + deltaLon * Math.cos(angle);

    return [randomLat, randomLon];
}

const center = [-6.2088, 106.8456]; // Center of the green circle
const radiusInMeters = 5 * 1609.34;  // 10 miles in meters, for the large green circle radius

// Add a Marker with Popup
L.marker([-6.2088, 106.8456]).addTo(map)
    .bindPopup('Welcome to Jakarta, Indonesia!<br> Find Some Compost!.')
    .openPopup();

// Add a green circle overlay with a 10-mile radius around Jakarta
const greenCircle = L.circle([-6.2088, 106.8456], {
    color: 'green',  // Outline color
    fillColor: '#0f3',  // Fill color
    fillOpacity: 0.5,  // Fill opacity
    radius: radiusInMeters  // Radius in meters
}).addTo(map).bindPopup('5 mile radius of your location');

// Add a red circle inside the green circle (for example, a smaller radius)
const redCircleRadius = radiusInMeters * 0.04;  // 40% of the 10-mile radius
L.circle([-6.2088, 106.8456], {
    color: 'red',  // Outline color
    fillColor: '#f03',  // Fill color
    fillOpacity: 0.5,  // Fill opacity
    radius: redCircleRadius  // Smaller radius
}).addTo(map).bindPopup('your location');

// Generate random coordinates inside the green circle and add blue circles
const blueCirclesData = [
    getRandomCoordinates(center, radiusInMeters),
    getRandomCoordinates(center, radiusInMeters),
    getRandomCoordinates(center, radiusInMeters),
    getRandomCoordinates(center, radiusInMeters),
	getRandomCoordinates(center, radiusInMeters),
    getRandomCoordinates(center, radiusInMeters),
    getRandomCoordinates(center, radiusInMeters),
	getRandomCoordinates(center, radiusInMeters),
    getRandomCoordinates(center, radiusInMeters),
    getRandomCoordinates(center, radiusInMeters)
];

// Loop through the data and create blue circles
blueCirclesData.forEach(function (coords) {
    L.circle(coords, {
        color: 'blue',  // Outline color
        fillColor: '#03f',  // Fill color
        fillOpacity: 0.5,  // Fill opacity
        radius: 500  // Radius in meters for each blue circle
    }).addTo(map).bindPopup('Compost');
});


