
var map = L.map('map').setView([-6.2088, 106.8456], 13);

// Add OpenStreetMap Tiles
//API used here
L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);
//get random coordinates
function getRandomCoordinates(center, radiusInMeters) {
    // Convert radius from meters to degrees (rough estimate)
    const radiusInDegrees = radiusInMeters / 111320; 

   
    const angle = Math.random() * 2 * Math.PI;  
    const distance = Math.random() * radiusInMeters;  

  
    const deltaLat = (distance / 111320); 
    const deltaLon = (distance / (111320 * Math.cos(center[0] * Math.PI / 180))); 

 
    const randomLat = center[0] + deltaLat * Math.sin(angle);
    const randomLon = center[1] + deltaLon * Math.cos(angle);

    return [randomLat, randomLon];
}

const center = [-6.2088, 106.8456]; 
const radiusInMeters = 5 * 1609.34;  

// Add a Marker with Popup
L.marker([-6.2088, 106.8456]).addTo(map)
    .bindPopup('Welcome to Jakarta, Indonesia!<br> Find Some Compost!.')
    .openPopup();

// Add a green circle overlay with a 5-mile radius around Jakarta
const greenCircle = L.circle([-6.2088, 106.8456], {
    color: 'green',  
    fillColor: '#0f3',  
    fillOpacity: 0.5, 
    radius: radiusInMeters  
}).addTo(map).bindPopup('5 mile radius of your location');

// Add a your location circle inside the green circle 
const redCircleRadius = radiusInMeters * 0.04;  
L.circle([-6.2088, 106.8456], {
    color: 'red',  
    fillColor: '#f03',  
    fillOpacity: 0.5,  
    radius: redCircleRadius  
}).addTo(map).bindPopup('your location');

// Generate random coordinates inside the green circle and add the blue circles
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
        color: 'blue',  
        fillColor: '#03f',  
        fillOpacity: 0.5,  
        radius: 500  
    }).addTo(map).bindPopup('Compost');
});


