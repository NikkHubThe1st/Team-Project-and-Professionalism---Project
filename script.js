// Toggle navigation menu
const menuToggle = document.getElementById('menu-toggle');
const sideNav = document.getElementById('side-nav');


menuToggle.addEventListener('click', () => {
    if (sideNav.style.left === '0px') {
        sideNav.style.left = '-250px';
    } else {
        sideNav.style.left = '0px';
    }
});

// Circular Queue Articles with Transitions
const articlesContainer = document.getElementById('articles-container');
const prevButton = document.getElementById('prev');
const nextButton = document.getElementById('next');

// Get all articles
const articles = Array.from(articlesContainer.children);
const totalArticles = articles.length;

// Initialize pointers
let frontPointer = 0; 
let isAnimating = false;

// update container transform with transition
const updateTransform = (direction) => {
    if (isAnimating) return;
    isAnimating = true;

    // Apply transform based on direction
    if (direction === 'next') {
        articlesContainer.style.transition = 'transform 0.5s ease';
        articlesContainer.style.transform = `translateX(-${articles[0].offsetWidth + 20}px)`; 
    } else if (direction === 'prev') {
        articlesContainer.style.transition = 'none';
        articlesContainer.style.transform = `translateX(-${articles[0].offsetWidth + 20}px)`; 
        const lastArticle = articlesContainer.lastElementChild;
        articlesContainer.prepend(lastArticle);
        setTimeout(() => {
            articlesContainer.style.transition = 'transform 0.5s ease';
            articlesContainer.style.transform = 'translateX(0px)';
        });
    }

    setTimeout(() => {
        // Rearrange articles to maintain circular behavior after animation
        if (direction === 'next') {
            const firstArticle = articlesContainer.firstElementChild;
            articlesContainer.appendChild(firstArticle);
            articlesContainer.style.transition = 'none';
            articlesContainer.style.transform = 'translateX(0px)';
        }
        isAnimating = false;
    }, 500); 
};

// Function to increment pointer
const incrementPointer = () => {
    frontPointer = (frontPointer + 1) % totalArticles;
    updateTransform('next');
};

// Scroll right 
nextButton.addEventListener('click', incrementPointer);

// Scroll left 
prevButton.addEventListener('click', () => {
    frontPointer = (frontPointer - 1 + totalArticles) % totalArticles;
    updateTransform('prev');
});

// Auto-Increment Pointer Every 3 Seconds
setInterval(() => {
    incrementPointer();
}, 5000);


const listingsContainer = document.getElementById('listings-container');
const verticalPrevButton = document.getElementById('Verticalprev');
const verticalNextButton = document.getElementById('Verticalnext');

//  vertical scroll buttons
verticalPrevButton.addEventListener('click', () => {
    listingsContainer.scrollBy({
        top: -100, 
        behavior: 'smooth'
    });
});

verticalNextButton.addEventListener('click', () => {
    listingsContainer.scrollBy({
        top: 100, 
        behavior: 'smooth'
    });
});

// scroll wheel behavior
listingsContainer.addEventListener('wheel', (event) => {
    // Prevent default scroll behavior
    event.preventDefault();

    // Scroll up or down based on wheel direction
    if (event.deltaY > 0) {
        listingsContainer.scrollBy({
            top: 100, 
            behavior: 'smooth'
        });
    } else {
        listingsContainer.scrollBy({
            top: -100, 
            behavior: 'smooth'
        });
    }
});

// Search functionality
searchBar.addEventListener('input', (e) => {
    const searchQuery = e.target.value.toLowerCase();
    document.querySelectorAll('.listing').forEach(listing => {
        const title = listing.querySelector('h2').textContent.toLowerCase();
        if (title.includes(searchQuery)) {
            listing.style.display = 'flex';
        } else {
            listing.style.display = 'none';
        }
    });
});