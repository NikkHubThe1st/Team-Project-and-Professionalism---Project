
const agreeCheckbox = document.getElementById('agreeCheckbox');
const submitBtn = document.getElementById('submitBtn');


agreeCheckbox.addEventListener('change', () => {
    if (agreeCheckbox.checked) {
        submitBtn.disabled = false; 
    } else {
        submitBtn.disabled = true;   
    }
});


submitBtn.addEventListener('click', () => {
    if (agreeCheckbox.checked) {
        
        alert("Thank you for agreeing to the Terms of Service!");
       
        window.location.href = "index.php"; 
    } else {
        alert("Please agree to the Terms of Service before continuing.");
    }
});