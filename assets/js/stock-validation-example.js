/*
 * Example usage of stock validation functions for AJAX loaded content
 * 
 * This file demonstrates how to prevent unwanted form submissions
 * when using stock validation with dynamically loaded content.
 */

// Example 1: For AJAX loaded content - use validateStockForAjaxContent()
function handleAjaxLoadedForm() {
    // This function validates stock without submitting the form
    orders.validateStockForAjaxContent();
    
    // You can then handle the validation result manually
    // For example, show a warning message or disable submit button
}

// Example 2: For regular forms - use checkquantity()
// In your HTML form: onsubmit="orders.checkquantity()"

// Example 3: For validation only - use validateStockOnly()
function validateStockOnly() {
    return orders.validateStockOnly();
}

// Example 4: Custom validation with manual form submission
function customStockValidation() {
    // First validate stock
    var isValid = orders.validateStockOnly();
    
    if (isValid) {
        // If validation passes, manually submit the form
        $('#your-form-id').submit();
    } else {
        // If validation fails, show custom message
        alert('Please check stock levels before submitting');
    }
}

// Example 5: For AJAX loaded content with custom handling
$(document).on('click', '.ajax-submit-btn', function(e) {
    e.preventDefault(); // Prevent default form submission
    
    // Validate stock first
    orders.validateStockForAjaxContent();
    
    // Then handle the submission manually if needed
    // You can add your own logic here
});

// Example 6: Real-time validation for AJAX loaded inputs
$(document).on('change', '.ajax-quantity-input', function() {
    var item_id = $(this).data('item-id');
    var qty = $(this).val();
    
    // Check stock for this specific item
    $.ajax({
        url: baseurl + '/stocks/checkstock',
        type: 'POST',
        dataType: 'json',
        data: {
            item_id: item_id,
            brand: 0,
            grade: 0,
            model: 0,
            size: 0,
            type: 0,
            colour: 0,
            unit: 0
        }
    }).done(function(response) {
        var available = parseInt(response.balance) || 0;
        if (parseInt(qty) > available) {
            // Show warning but don't submit form
            console.log('Stock warning: Available ' + available + ', Requested ' + qty);
            // You can show a tooltip or highlight the field
        }
    });
}); 