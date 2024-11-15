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

// Circular Queue Articles
const articlesContainer = document.getElementById('articles-container');
const prevButton = document.getElementById('prev');
const nextButton = document.getElementById('next');

// Get article width
const getArticleWidth = () => {
    const firstArticle = articlesContainer.children[0];
    const style = getComputedStyle(articlesContainer);
    const gap = parseInt(style.gap); // Get the gap value between articles
    return firstArticle.offsetWidth + gap;
};

// Clone the first and last articles
const cloneArticles = () => {
    const articles = articlesContainer.children;
    const firstArticle = articles[0];
    const lastArticle = articles[articles.length - 1];

    // Clone the first and last articles
    const firstClone = firstArticle.cloneNode(true);
    const lastClone = lastArticle.cloneNode(true);

    // Insert the cloned articles at the beginning and end of the container
    articlesContainer.insertBefore(lastClone, firstArticle);
    articlesContainer.appendChild(firstClone);

    // Ensure the container starts from the first article (index 0)
    articlesContainer.style.transform = `translateX(0)`;
    articlesContainer.style.transition = "none"; // Disable transition during initial setup
};

// Initialize circular queue
cloneArticles();

let scrollIndex = 1;  // Start at the second article (index 1, skipping the first clone)
const articleWidth = getArticleWidth();

// Set the width of the articles container to fit all articles
const setContainerWidth = () => {
    const totalWidth = articleWidth * (articlesContainer.children.length - 2); // Subtract 2 for the cloned articles
    articlesContainer.style.width = `${totalWidth}px`;
};

// Initialize the container width
setContainerWidth();

// Scroll right (next button)
nextButton.addEventListener('click', () => {
    if (scrollIndex < articlesContainer.children.length - 4) {  // Stop before the last cloned article
        scrollIndex++;
        articlesContainer.style.transition = "transform 0.3s ease";
        articlesContainer.style.transform = `translateX(-${scrollIndex * articleWidth}px)`;
    } else {
        // If we're at the end (the last original article), jump to the second article (real article)
        scrollIndex = 0;  // Reset scrollIndex to the second article
        articlesContainer.style.transition = "transform 0.3s ease";
        articlesContainer.style.transform = `translateX(-${scrollIndex * articleWidth}px)`;
    }
});

// Scroll left (prev button)
prevButton.addEventListener('click', () => {
    if (scrollIndex > 0) {  // Don't go past the first original article
        scrollIndex--;
        articlesContainer.style.transition = "transform 0.3s ease";
        articlesContainer.style.transform = `translateX(-${scrollIndex * articleWidth}px)`;
    } else {
        // If we're at the start (the first original article), jump to the second last article
        scrollIndex = articlesContainer.children.length - 4;  // Go to the second last original article
        articlesContainer.style.transition = "transform 0.3s ease";
        articlesContainer.style.transform = `translateX(-${scrollIndex * articleWidth}px)`;
    }
});