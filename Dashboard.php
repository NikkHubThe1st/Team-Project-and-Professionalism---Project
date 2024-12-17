<?php include("functions.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Navigation & Scrolling Articles</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <?php createNavbar(); //Using php function to make nav bar?>
	
    <!-- Articles Section with Scroll -->
    <div id="articles-section">
        <button id="prev" class="scroll-arrow">&#8249;</button>
        <div id="articles-container" class="articles-container">
            <div class="article">
                <h2>Article 1</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras volutpat dui nec justo gravida...</p>
            </div>
            <div class="article">
                <h2>Article 2</h2>
                <p>Phasellus luctus orci a auctor pharetra. Nunc tincidunt erat vel felis fermentum, non suscipit...</p>
            </div>
            <div class="article">
                <h2>Article 3</h2>
                <p>Curabitur euismod odio id ante hendrerit, non fermentum sapien ultricies. Nam aliquet lorem vitae...</p>
            </div>
			<div class="article">
                <h2>Article 4</h2>
                <p>Curabitur euismod odio id ante hendrerit, non fermentum sapien ultricies. Nam aliquet lorem vitae...</p>
            </div>
			<div class="article">
                <h2>Article 5</h2>
                <p>Curabitur euismod odio id ante hendrerit, non fermentum sapien ultricies. Nam aliquet lorem vitae...</p>
            </div>
			<div class="article">
                <h2>Article 6</h2>
                <p>Curabitur euismod odio id ante hendrerit, non fermentum sapien ultricies. Nam aliquet lorem vitae...</p>
            </div>
        
		    <div class="article">
                <h2>Article 7</h2>
                <p>Phasellus luctus orci a auctor pharetra. Nunc tincidunt erat vel felis fermentum, non suscipit...</p>
            </div>
			            <div class="article">
                <h2>Article 8</h2>
                <p>Phasellus luctus orci a auctor pharetra. Nunc tincidunt erat vel felis fermentum, non suscipit...</p>
            </div>
			            <div class="article">
                <h2>Article 9</h2>
                <p>Phasellus luctus orci a auctor pharetra. Nunc tincidunt erat vel felis fermentum, non suscipit...</p>
            </div>
		</div>
        <button id="next" class="scroll-arrow">&#8250;</button>
    </div>

    <!-- Composting Guide -->
    <div class="grid-container">
        <div class="grid-item">
            <!-- using grid so that on mobile it auto resizes to fit the screen -->
            <h2>About us</h2>
            <p>Welcome to Compost Connect, your go-to platform for sustainable living and community-driven composting.</p>
            <p>At Compost Connect, we aim to bring people together to reduce waste, enrich our soil, and make a positive impact on the environment. Our platform allows users to easily buy and sell compost, creating a network where individuals, gardeners, and farmers can exchange resources while promoting eco-friendly practices.</p>
            <p>But we’re more than just a marketplace. Compost Connect is a space for learning and growth. Through our educational resources, we empower individuals to transform food waste into valuable compost, contributing to a cleaner planet and a greener future.</p>
            <p>Whether you’re a composting enthusiast, a sustainable gardener, or someone looking to make a difference, Compost Connect is here to help you on your journey. Together, let’s reduce waste, nurture the earth, and build a connected, sustainable community.</p>
            <p>Join us today—because every handful of compost makes a difference!</p>
        </div>
        <div class="grid-img-index_aboutUs"></div>
        <!-- Setting as a class to use image as a background so that the image is resized and cut depending on the size of the text in the same row -->
        <div class="grid-img-index_step1"></div>
        <div class="grid-item">
            <h2>Step 1 - Composting</h2>
            <ul>
                <li>Choose a composting method (backyard, indoor, or municipal).</li>
                <p></p>
                <li>Add a mix of "greens" (e.g., vegetable scraps, coffee grounds) and "browns" (e.g., leaves, cardboard).</li>
                <p></p>
                <li>Keep the pile moist but not waterlogged.</li>
                <p></p>
                <li>Turn the compost regularly to aerate it.</li>
                <p></p>
                <li>Monitor for proper decomposition, and harvest compost when ready.</li>
                <p></p>
            </ul>
            <p>Composting reduces waste and enriches soil. Start your composting journey today!</p>
        </div>
        <div class="grid-item">
            <h2>Step 2 - Listing</h2>
            <ul>
                <li>First login in to your account, if you are new create an account by signing up with your email and password</li>
                <p></p>
                <li>Navigate to the "Profile" page and select the "Create Listing" button.</li>
                <p></p>
                <li>Provide key details like compost type, weight and price.</li>
                <p></p>
                <li>Upload a photo (optional) of the compost to help buyers make an informed decision.</li>
                <p></p>
                <li>Indicate whether buyers can pick up the compost, or specify delivery avaliability and times.</li>
                <p></p>
                <li>Be sure to review the details and then select "Post" to make your compost avaliable to buyers on the platform.</li>
                <p></p>
            </ul>
            <p>And thats it! You have successfully posted your first listing, and remember every handful of compost makes a difference!</p>
        </div>
        <div class="grid-img-index_step2"></div>
        <div class="grid-img-index_step3"></div>
        <div class="grid-item">
            <h2>step 3 - Purchasing and Collection</h2>
            <h3>Purchasing: </h3>
            <ul>
                <li>Navigate to the "Listings" page to view all avaliable compost in your area.</li>
                <p></p>
                <li>Use the filters provided to search compost by price, location and weight.</li>
                <p></p>
                <li>Select a listing to see detailed information about the compost and the avaliability for collection or delivery.</li>
                <p></p>
                <li>If you're ready to buy, select "Add to Basket" to continue shopping or "Checkout Now" to proceed directly to payment.</li>
                <p></p>
                <li>Review your order details, choose a payment option and confirm your purchase.</li>
                <p></p>
            </ul>
            <h3>Collecting: </h3>
            <ul>
                <li>After purchasing, navigate to the "Profile" page and select "My Orders". Then select the current order you are looking to collect.</li>
                <p></p>
                <li>Use the "Map" feature to locate the sellers collection point and check the collection times specified by the seller.</li>
                <p></p>
                <li>Coordinate with the seller if needed and prepare transportation to collect the compost.</li>
                <p></p>
                <li>Once you've collected the compost, mark the order as "Collected" in your account to complete the transaction.</li>
                <p></p>
            </ul>
            <p>Tip: Bring suitable containers or bags if the compost isn't pre-packaged!</p>
        </div>
    </div>   

    <script src="script.js"></script>
</body>
</html>


<!--
<div id="compost-guide">
    <h2>How to Compost</h2>
    <ol>
        <li>Choose a composting method (backyard, indoor, or municipal).</li>
        <li>Add a mix of "greens" (e.g., vegetable scraps, coffee grounds) and "browns" (e.g., leaves, cardboard).</li>
        <li>Keep the pile moist but not waterlogged.</li>
        <li>Turn the compost regularly to aerate it.</li>
        <li>Monitor for proper decomposition, and harvest compost when ready.</li>
    </ol>
    <p>Composting reduces waste and enriches soil. Start your composting journey today!</p>
</div>
-->