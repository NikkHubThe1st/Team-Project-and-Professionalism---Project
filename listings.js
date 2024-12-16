// Display All Listings with Search Functionality
const listingsContainer = document.getElementById('listings-container');
const searchInput = document.getElementById('search-bar');
const listings = Array.from(listingsContainer.children);

// Add event listeners to search bar for filtering listings
searchInput.addEventListener('input', () => {
    const searchQuery = searchInput.value.toLowerCase();

    listings.forEach((listing) => {
        const title = listing.querySelector('h2').textContent.toLowerCase();
        if (title.includes(searchQuery)) {
            listing.style.display = ''; // Show matching listings
        } else {
            listing.style.display = 'none'; // Hide non-matching listings
        }
    });
});
const menuToggle = document.getElementById('menu-toggle');
const sideNav = document.getElementById('side-nav');


menuToggle.addEventListener('click', () => {
    if (sideNav.style.left === '0px') {
        sideNav.style.left = '-250px';
    } else {
        sideNav.style.left = '0px';
    }
});
