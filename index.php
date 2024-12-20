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
                <h2>Understanding Food Waste: A Global Crisis</h2>
                <p>Food waste is a pressing issue that affects the environment, economy,
                     and society. Every year, nearly one-third of all food produced
                      globally goes to waste, amounting to 1.3 billion tons. 
                      This waste happens across the supply chain, from farms 
                      to households. Reducing food waste is crucial for combating 
                      climate change, as discarded food contributes significantly
                       to greenhouse gas emissions when it decomposes in landfills.</p>
            </div>
            <div class="article">
                <h2>The Environmental Impact of Food Waste</h2>
                <p>When food is wasted, it’s not just the food itself that’s 
                    lost but also the resources used to produce it—water,
                     energy, and labor. Food waste is responsible for about
                      8-10% of global greenhouse gas emissions. Preventing
                       waste can help conserve these resources and reduce
                        the strain on our planet.</p>
            </div>
            <div class="article">
                <h2>The Economic Cost of Wasted Food</h2>
                <p>Food waste has a massive financial toll. Globally,
                     the economic cost is estimated at $1 trillion 
                     annually. Households, restaurants, and
                      retailers all lose money due to over-purchasing, 
                      spoilage, or improper storage. By adopting smarter 
                      shopping and storage habits, consumers can save 
                      hundreds of dollars per year.</p>
            </div>
			<div class="article">
                <h2>Food Waste in Households: The Silent Culprit</h2>
                <p>In many countries, the majority of food waste occurs 
                    at the household level. Leftovers, expired products, 
                    and misunderstood “best before” labels contribute 
                    significantly. Simple actions like planning meals, 
                    freezing leftovers, and understanding food labeling 
                    can make a big difference.</p>
            </div>
			<div class="article">
                <h2>How Restaurants Can Reduce Food Waste</h2>
                <p>The food service industry generates vast amounts 
                    of waste. Restaurants can tackle this by improving
                     portion sizes, donating surplus food, and 
                     implementing composting systems. Digital tools for 
                     inventory management can also minimize waste by 
                     tracking stock levels effectively</p>
            </div>
			<div class="article">
                <h2>Fighting Food Waste with Technology</h2>
                <p>Innovative technology is playing a critical
                     role in combating food waste. Apps like Too 
                     Good To Go and OLIO connect consumers with 
                     surplus food from businesses and neighbors. 
                     Smart refrigerators and AI tools can also help 
                     monitor and manage food inventories, preventing 
                     spoilage.</p>
            </div>
        
		    <div class="article">
                <h2>The Role of Food Donations in Reducing Waste</h2>
                <p>Donating edible but unsellable food is an effective 
                    way to reduce waste while addressing food insecurity.
                     Many charities and food banks accept surplus 
                     from farms, stores, and restaurants. Governments 
                     can incentivize donations through tax breaks and 
                     legal protections for donors.</p>
            </div>
			            <div class="article">
                <h2>Composting: A Sustainable Solution for Food Scraps</h2>
                <p>Not all food waste can be avoided, but composting 
                    offers a sustainable way to deal with inedible 
                    scraps. Composting turns organic waste into 
                    nutrient-rich fertilizer, reducing the need 
                    for chemical alternatives and keeping food waste 
                    out of landfills.</p>
            </div>
			            <div class="article">
                <h2>Consumer Power in Reducing Food Waste</h2>
                <p>Individuals play a vital role in tackling food waste.
                     By adopting mindful shopping habits, meal planning,
                      and creative cooking techniques, everyone can 
                      contribute to a more sustainable food system. 
                      Simple steps, like using leftovers creatively 
                      or freezing surplus produce, can make a big impact.</p>
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
                <li>Be sure to review the details and then select "Create a listing" to make your compost avaliable to buyers on the platform.</li>
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