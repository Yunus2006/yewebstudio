
const menu = document.querySelector('#mobile-menu');
const menuLinks = document.querySelector('.navbar__menu');

menu.addEventListener('click', function() {
    menu.classList.toggle('is-active');
    menuLinks.classList.toggle('active');
});
// Get all checkboxes
const checkboxes = document.querySelectorAll('input[type="checkbox"]');
const selectElementJS = document.getElementById("selectedOption");
const selectElementPHP = document.getElementById("selectedOption1");
const totalPriceElement = document.getElementById('totalPrice');
const selectedOptionText = document.getElementById('selectedOptionText');
const selectedOption1Text = document.getElementById('selectedOption1Text');

// Initialize prices for JS and PHP options
let jsOptionPrice = 0;
let phpOptionPrice = 0;

// Add event listener to each checkbox
checkboxes.forEach(checkbox => {
    checkbox.addEventListener('change', updateTotalPrice);
});

// Add an event listener to the JavaScript <select> element
selectElementJS.addEventListener("change", function() {
    // Update the price for JS options
    jsOptionPrice = parseInt(selectElementJS.value);
    updateTotalPrice();
    // Display the selected option for JavaScript
    const selectedOption = selectElementJS.options[selectElementJS.selectedIndex].text;
    selectedOptionText.textContent = `JavaScript Option: ${selectedOption}`;
});

// Add an event listener to the PHP <select> element
selectElementPHP.addEventListener("change", function() {
    // Update the price for PHP options
    phpOptionPrice = parseInt(selectElementPHP.value);
    updateTotalPrice();
    // Display the selected option for PHP
    const selectedOption = selectElementPHP.options[selectElementPHP.selectedIndex].text;
    selectedOption1Text.textContent = `PHP Option: ${selectedOption}`;
});

// Function to update the total price based on selected checkboxes and select elements
function updateTotalPrice() {
    // Variables to track selected options
    let customDomainPrice = 0;
    let cmsPrice = 0;
    let responsivePrice = 0;

    // Loop through all checkboxes to get the price of selected options
    checkboxes.forEach(checkbox => {
        if (checkbox.checked) {
            if (checkbox.name === 'domain') {
                customDomainPrice = parseInt(checkbox.value);
            } else if (checkbox.name === 'cms') {
                cmsPrice = parseInt(checkbox.value);
            } else if (checkbox.name === 'responsive') {
                responsivePrice = parseInt(checkbox.value);
            }
        }
    });

    // Calculate total price range for selected options
    let minPrice = 8990 + customDomainPrice + cmsPrice + responsivePrice + jsOptionPrice + phpOptionPrice;

    if (customDomainPrice > 0) {
        if (cmsPrice > 0 || responsivePrice > 0 || jsOptionPrice > 0 || phpOptionPrice > 0) {
            let maxPrice = minPrice + 900;
            totalPriceElement.textContent = `${minPrice} kr - ${maxPrice} kr`;
        } else {
            totalPriceElement.textContent = `${minPrice} kr`;
        }
    } else {
        totalPriceElement.textContent = `${minPrice} kr`;
    }
}

// Initial call to updateTotalPrice to set the initial state
updateTotalPrice();
