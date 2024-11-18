// Handle checkbox interaction for TOS agreement
const agreeCheckbox = document.getElementById('agreeCheckbox');
const submitBtn = document.getElementById('submitBtn');

// Enable or disable the submit button based on the checkbox state
agreeCheckbox.addEventListener('change', () => {
    if (agreeCheckbox.checked) {
        submitBtn.disabled = false;  // Enable button if checkbox is checked
    } else {
        submitBtn.disabled = true;   // Disable button if checkbox is unchecked
    }
});

// Action when the submit button is clicked
submitBtn.addEventListener('click', () => {
    if (agreeCheckbox.checked) {
        // Logic for when the user agrees and clicks "Continue"
        // For now, we can just redirect or display a success message
        alert("Thank you for agreeing to the Terms of Service!");
        // You can redirect the user to another page (e.g., the Dashboard)
        window.location.href = "Dashboard.html"; // Replace with your redirect URL
    } else {
        alert("Please agree to the Terms of Service before continuing.");
    }
});