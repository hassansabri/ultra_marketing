/*
 * Shop and Quantity Validation System Example
 * 
 * This file demonstrates the validation requirements for creating and editing orders.
 */

// Example 1: Required Fields Validation
function validateOrderForm() {
    console.log('Order form validation process:');
    console.log('1. Check if shop is selected');
    console.log('2. Check if at least one item is added');
    console.log('3. Check if all quantities are valid (> 0)');
    console.log('4. Check stock availability');
    console.log('5. Submit form if all validations pass');
}

// Example 2: Shop Selection Validation
function validateShopSelection() {
    var shopSelect = $('#shopid');
    var isValid = true;
    
    if (!shopSelect.val() || shopSelect.val() === '') {
        $('#shop-error').show();
        shopSelect.css('border-color', 'red');
        isValid = false;
        console.log('Shop validation failed: No shop selected');
    } else {
        $('#shop-error').hide();
        shopSelect.css('border-color', '');
        console.log('Shop validation passed: Shop ID ' + shopSelect.val());
    }
    
    return isValid;
}

// Example 3: Quantity Validation
function validateQuantities() {
    var isValid = true;
    var invalidFields = [];
    
    $("input[name='item_qty[]']").each(function(index, el) {
        var qty = $(el).val();
        if (!qty || qty <= 0) {
            $(el).css('border-color', 'red');
            invalidFields.push('Item ' + (index + 1));
            isValid = false;
        } else {
            $(el).css('border-color', '');
        }
    });
    
    if (!isValid) {
        console.log('Quantity validation failed for: ' + invalidFields.join(', '));
    } else {
        console.log('Quantity validation passed for all items');
    }
    
    return isValid;
}

// Example 4: Items Validation
function validateItemsAdded() {
    var itemIds = $("input[name='item_ids[]']");
    
    if (itemIds.length === 0) {
        console.log('Items validation failed: No items added to order');
        return false;
    } else {
        console.log('Items validation passed: ' + itemIds.length + ' items added');
        return true;
    }
}

// Example 5: Complete Form Validation
function completeFormValidation() {
    var isValid = true;
    var errors = [];
    
    // Validate shop
    if (!validateShopSelection()) {
        isValid = false;
        errors.push('Please select a shop');
    }
    
    // Validate items
    if (!validateItemsAdded()) {
        isValid = false;
        errors.push('Please add at least one item to the order');
    }
    
    // Validate quantities
    if (!validateQuantities()) {
        isValid = false;
        errors.push('Please enter valid quantities for all items');
    }
    
    if (!isValid) {
        alert('Please fix the following errors:\n' + errors.join('\n'));
        console.log('Form validation failed');
    } else {
        console.log('Form validation passed - proceeding to stock validation');
    }
    
    return isValid;
}

// Example 6: Real-time Validation
function setupRealTimeValidation() {
    // Shop selection validation
    $('#shopid').on('change', function() {
        validateShopSelection();
    });
    
    // Quantity input validation
    $(document).on('input', 'input[name="item_qty[]"]', function() {
        var qtyInput = $(this);
        var qty = qtyInput.val();
        
        if (!qty || qty <= 0) {
            qtyInput.css('border-color', 'red');
            qtyInput.attr('title', 'Please enter a valid quantity');
        } else {
            qtyInput.css('border-color', '');
            qtyInput.removeAttr('title');
        }
    });
    
    console.log('Real-time validation setup complete');
}

// Example 7: Server-side Validation Response
function handleServerValidationErrors(errors) {
    console.log('Server validation errors received:');
    errors.forEach(function(error) {
        console.log('- ' + error);
    });
    
    // Display errors to user
    var errorHtml = '<div class="alert alert-danger"><h4>Please fix the following errors:</h4><ul>';
    errors.forEach(function(error) {
        errorHtml += '<li>' + error + '</li>';
    });
    errorHtml += '</ul></div>';
    
    // Insert error message at top of form
    $('#content').prepend(errorHtml);
}

// Example 8: Validation Before Stock Check
function validateBeforeStockCheck() {
    console.log('Pre-stock validation process:');
    
    // Step 1: Validate required fields
    if (!completeFormValidation()) {
        console.log('Required field validation failed - stopping process');
        return false;
    }
    
    // Step 2: Proceed to stock validation
    console.log('Required field validation passed - checking stock availability');
    return true;
}

/*
 * Validation Rules Summary:
 * 
 * 1. Shop Selection:
 *    - Must select a shop from dropdown
 *    - Cannot be empty or "Please select a shop"
 * 
 * 2. Items:
 *    - At least one item must be added to order
 *    - Items are added via autocomplete search
 * 
 * 3. Quantities:
 *    - All quantity fields must have values > 0
 *    - Cannot be empty, null, or zero
 * 
 * 4. Stock Availability:
 *    - Checked after required field validation
 *    - Prevents order if insufficient stock
 * 
 * 5. Real-time Feedback:
 *    - Red border for invalid fields
 *    - Error messages displayed immediately
 *    - Tooltips for additional guidance
 * 
 * 6. Server-side Validation:
 *    - Double-check all validations on server
 *    - Return specific error messages
 *    - Prevent invalid data from being saved
 */

// Example 9: Form Submission Process
function orderFormSubmission() {
    console.log('Order form submission process:');
    
    // Step 1: Client-side validation
    if (!validateBeforeStockCheck()) {
        console.log('Client-side validation failed');
        return false;
    }
    
    // Step 2: Stock validation (if client-side passes)
    console.log('Proceeding to stock validation...');
    
    // Step 3: Form submission (if all validations pass)
    console.log('All validations passed - submitting form');
    return true;
}

// Example 10: Error Message Display
function displayValidationErrors(errors) {
    var errorContainer = $('#validation-errors');
    if (errorContainer.length === 0) {
        errorContainer = $('<div id="validation-errors" class="alert alert-danger"></div>');
        $('form').prepend(errorContainer);
    }
    
    var errorHtml = '<h4>Please fix the following errors:</h4><ul>';
    errors.forEach(function(error) {
        errorHtml += '<li>' + error + '</li>';
    });
    errorHtml += '</ul>';
    
    errorContainer.html(errorHtml).show();
    
    // Scroll to error message
    $('html, body').animate({
        scrollTop: errorContainer.offset().top - 100
    }, 500);
} 