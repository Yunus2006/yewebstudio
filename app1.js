const menu = document.querySelector('#mobile-menu');
const menuLinks = document.querySelector('.navbar__menu');

menu.addEventListener('click', function() {
    menu.classList.toggle('is-active');
    menuLinks.classList.toggle('active');
});

// Get all checkboxes
const checkboxes = document.querySelectorAll('input[type="checkbox"]');
const selectElement = document.getElementById("selectedOption");
const totalPriceElement = document.getElementById('totalPrice');
const selectedOptionText = document.getElementById('selectedOptionText');

// Initialize prices for JS options
let jsOptionPrice = 0;

// Set initial total price to 5990 kr
let totalPrice = 5990;
totalPriceElement.textContent = `${totalPrice} kr`;

// Add event listener to each checkbox
checkboxes.forEach(checkbox => {
    checkbox.addEventListener('change', updateTotalPrice);
});

// Add an event listener to the <select> element
selectElement.addEventListener("change", function() {
    // Update the price for JS options
    jsOptionPrice = parseInt(selectElement.value);
    updateTotalPrice();
    // Display the selected option for JavaScript
    const selectedOption = selectElement.options[selectElement.selectedIndex].text;
    selectedOptionText.textContent = `JavaScript Option: ${selectedOption}`;
});

// Function to update the total price based on selected checkboxes
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
    let minPrice = 5990 + customDomainPrice + cmsPrice + responsivePrice + jsOptionPrice;

    if (customDomainPrice > 0) {
        if (cmsPrice > 0 || responsivePrice > 0 || jsOptionPrice > 0) {
            let maxPrice = minPrice + 900;
            totalPriceElement.textContent = `${minPrice} kr - ${maxPrice} kr`;
        } else {
            let maxPrice = minPrice + 1000;
            totalPriceElement.textContent = `${minPrice} kr - ${maxPrice} kr`;
        }
    } else {
        totalPriceElement.textContent = `${minPrice} kr`;
    }
}

// Initial call to updateTotalPrice to set the initial state
updateTotalPrice();
