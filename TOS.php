<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms of Service</title>
    <link rel="stylesheet" href="styles.css"> <!-- Reuse the same stylesheet -->
</head>
<body>
    <?php
    include("functions.php");
    createNavbar();
    ?>

    <!-- Main Content for Terms of Service -->
    <div id="tos-content">
        <h2>Terms of Service</h2>
        <p>Last updated: 18/12/24</p>

        <h3>1. Introduction</h3>
        <p>Welcome to Compost Connect. These Terms of Service ("Terms") govern your use of our website and services. By accessing or using the website, you agree to comply with these Terms. If you do not agree to these Terms, you must not use the website.</p>

        <h3>2. Account Registration</h3>
        <p>To use certain features of our site, you may need to create an account. You are responsible for maintaining the confidentiality of your account information and for all activities that occur under your account.</p>

        <h3>3. User Conduct</h3>
        <p>When using our website, you agree not to engage in any unlawful activities, such as hacking, spamming, or distributing viruses. You are also responsible for complying with all applicable laws and regulations while using the site.</p>

        <h3>4. Content Ownership</h3>
        <p>All content on this website, including text, images, and videos, is owned by CompostConnect and its licensors. You may not reproduce, modify, or distribute any content without proper authorization.</p>

        <h3>5. Privacy Policy</h3>
        <p>Your privacy is important to us. Please refer to our <a href="index.php">Privacy Policy</a> for information on how we collect, use, and protect your personal data.</p>

        <h3>6. Termination</h3>
        <p>We reserve the right to suspend or terminate your access to the website at any time, without notice, for violations of these Terms or any other reason at our discretion.</p>

        <h3>7. Disclaimers</h3>
        <p>Our website and services are provided "as is" without any warranties. We do not guarantee the accuracy or completeness of the content or the availability of the services at all times.</p>

        <h3>8. Governing Law</h3>
        <p>These Terms are governed by the laws of Indonesia. Any disputes arising from these Terms will be resolved in the courts of Idonesia.</p>

        <h3>9. Changes to Terms</h3>
        <p>We may update these Terms of Service from time to time. Any changes will be posted on this page, and the updated version will be effective as of the date of posting. Please review the Terms periodically.</p>

        <h3>10. Contact Us</h3>
        <p>If you have any questions or concerns about these Terms, please contact us at CompostConnect.com.</p>

        <!-- Terms Agreement Section -->
        <div id="tos-agreement">
            <input type="checkbox" id="agreeCheckbox">
            <label for="agreeCheckbox">I agree to the Terms of Service</label>
        </div>

        <!-- Submit Button (disabled initially) -->
        <button id="submitBtn" disabled>Agree and Continue</button>
    </div>

    <!-- Separate JavaScript file -->
    <script src="script.js"></script>
	<script src ="TOS.js"></script>
</body>
</html>