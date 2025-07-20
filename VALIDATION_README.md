# Shop and Quantity Validation System

## Overview

This system ensures that both shop selection and quantity inputs are required when creating or editing orders. The validation occurs both on the client-side (JavaScript) and server-side (PHP) to provide a robust user experience.

## Features

### 1. Required Field Validation
- **Shop Selection**: Must select a shop from the dropdown
- **Items**: At least one item must be added to the order
- **Quantities**: All quantity fields must have valid values (> 0)

### 2. Real-time Validation
- **Instant Feedback**: Validation occurs as users interact with form fields
- **Visual Indicators**: Red borders and error messages for invalid fields
- **Tooltips**: Additional guidance for users

### 3. Server-side Validation
- **Double-check**: All validations are verified on the server
- **Error Messages**: Specific error messages for each validation failure
- **Data Integrity**: Prevents invalid data from being saved

## Implementation Details

### Form Structure

#### New Order Form (`application/views/orders/new_order.php`)
```html
<!-- Shop Selection (Required) -->
<select id="shopid" name="shopid" class="form-control" required>
    <option value="">Please select a shop</option>
    <!-- Shop options -->
</select>
<span class="error-message" id="shop-error">Please select a shop</span>

<!-- Order Items (Added via AJAX) -->
<input name="item_ids[]" type="hidden" value="item_id"/>
<input name="item_qty[]" type="number" min="1" value="1"/>
```

#### Edit Order Form (`application/views/orders/editorder.php`)
```html
<!-- Shop Selection (Required) -->
<select id="shopid" name="shopid" class="form-control" required>
    <option value="">Please select a shop</option>
    <!-- Shop options with current selection -->
</select>
<span class="error-message" id="shop-error">Please select a shop</span>

<!-- Existing Order Items -->
<input name="item_ids[]" type="hidden" value="item_id"/>
<input name="item_qty[]" type="number" min="1" value="quantity"/>
```

### JavaScript Validation (`assets/js/custom.js`)

#### Main Validation Function
```javascript
validateRequiredFields: function() {
    var isValid = true;
    var errorMessages = [];
    
    // Shop validation
    if (!shopSelect.val() || shopSelect.val() === '') {
        $('#shop-error').show();
        shopSelect.css('border-color', 'red');
        isValid = false;
        errorMessages.push('Please select a shop');
    }
    
    // Items validation
    if (itemIds.length === 0) {
        isValid = false;
        errorMessages.push('Please add at least one item to the order');
    }
    
    // Quantity validation
    $("input[name='item_qty[]']").each(function(index, el) {
        var qty = $(el).val();
        if (!qty || qty <= 0) {
            $(el).css('border-color', 'red');
            isValid = false;
            errorMessages.push('Please enter valid quantities for all items');
        }
    });
    
    return isValid;
}
```

#### Real-time Validation
```javascript
// Shop selection validation
$(document).on('change', '#shopid', function() {
    var shopSelect = $(this);
    if (!shopSelect.val() || shopSelect.val() === '') {
        $('#shop-error').show();
        shopSelect.css('border-color', 'red');
    } else {
        $('#shop-error').hide();
        shopSelect.css('border-color', '');
    }
});

// Quantity input validation
$(document).on('input', 'input[name="item_qty[]"]', function() {
    var qtyInput = $(this);
    var qty = qtyInput.val();
    if (!qty || qty <= 0) {
        qtyInput.css('border-color', 'red');
    } else {
        qtyInput.css('border-color', '');
    }
});
```

### Server-side Validation (`application/controllers/orders.php`)

#### New Order Validation
```php
public function draft_order() {
    // Server-side validation for required fields
    $validation_errors = array();
    
    // Validate shop selection
    $shop_id = $this->input->post('shopid');
    if (empty($shop_id) || $shop_id === '') {
        $validation_errors[] = 'Please select a shop';
    }
    
    // Validate that items are added
    $item_ids = $this->input->post('item_ids');
    if (empty($item_ids) || !is_array($item_ids) || count($item_ids) === 0) {
        $validation_errors[] = 'Please add at least one item to the order';
    }
    
    // Validate quantities
    $qty = $this->input->post('item_qty');
    if (!empty($qty) && is_array($qty)) {
        foreach ($qty as $quantity) {
            if (empty($quantity) || $quantity <= 0) {
                $validation_errors[] = 'Please enter valid quantities for all items';
                break;
            }
        }
    }
    
    // If validation fails, redirect back with errors
    if (!empty($validation_errors)) {
        $this->session->set_flashdata('validation_errors', $validation_errors);
        redirect(site_url() . 'orders');
        return;
    }
    
    // Continue with order processing...
}
```

#### Edit Order Validation
```php
public function draft_order_updater($order_number) {
    // Server-side validation for required fields
    $validation_errors = array();
    
    // Validate shop selection
    $shop_id = $this->input->post('shopid');
    if (empty($shop_id) || $shop_id === '') {
        $validation_errors[] = 'Please select a shop';
    }
    
    // Validate that items are added
    $item_ids = $this->input->post('item_ids');
    if (empty($item_ids) || !is_array($item_ids) || count($item_ids) === 0) {
        $validation_errors[] = 'Please add at least one item to the order';
    }
    
    // Validate quantities
    $item_qty = $this->input->post('item_qty');
    if (!empty($item_qty) && is_array($item_qty)) {
        foreach ($item_qty as $quantity) {
            if (empty($quantity) || $quantity <= 0) {
                $validation_errors[] = 'Please enter valid quantities for all items';
                break;
            }
        }
    }
    
    // If validation fails, redirect back with errors
    if (!empty($validation_errors)) {
        $this->session->set_flashdata('validation_errors', $validation_errors);
        redirect(site_url() . 'orders/editorder/' . $order_number);
        return;
    }
    
    // Continue with order processing...
}
```

## Error Display

### Flash Messages
```php
<?php if ($this->session->flashdata('validation_errors')): ?>
    <div class="alert alert-danger">
        <h4>Please fix the following errors:</h4>
        <ul>
            <?php foreach ($this->session->flashdata('validation_errors') as $error): ?>
                <li><?php echo $error; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>
```

### Real-time Error Messages
```html
<span class="error-message" id="shop-error" style="color: red; display: none;">
    Please select a shop
</span>
```

## Validation Rules

### 1. Shop Selection
- **Required**: Must select a shop from dropdown
- **Validation**: Cannot be empty or "Please select a shop"
- **Error Message**: "Please select a shop"

### 2. Items
- **Required**: At least one item must be added to order
- **Validation**: Check if `item_ids[]` array has elements
- **Error Message**: "Please add at least one item to the order"

### 3. Quantities
- **Required**: All quantity fields must have values > 0
- **Validation**: Check each `item_qty[]` value
- **Error Message**: "Please enter valid quantities for all items"

### 4. Stock Availability
- **Triggered**: After required field validation passes
- **Validation**: Check stock levels for requested quantities
- **Error Message**: "Insufficient stock for [item]. Available: X, Requested: Y"

## User Experience

### 1. Form Submission Process
1. **User fills form** with shop, items, and quantities
2. **Client-side validation** occurs on form submission
3. **Visual feedback** shows validation errors immediately
4. **Server-side validation** double-checks all inputs
5. **Error messages** displayed if validation fails
6. **Success** if all validations pass

### 2. Real-time Feedback
- **Shop selection**: Error message appears/disappears as user selects
- **Quantity inputs**: Red border appears for invalid values
- **Tooltips**: Additional guidance for form fields
- **Visual indicators**: Clear indication of validation status

### 3. Error Handling
- **Client-side**: Prevents form submission with invalid data
- **Server-side**: Redirects back to form with error messages
- **User-friendly**: Clear, specific error messages
- **Non-blocking**: Allows users to fix errors and resubmit

## Configuration

### Validation Settings
The system can be configured to:
- Enable/disable specific validations
- Customize error messages
- Set minimum quantity thresholds
- Configure validation timing

### Error Message Customization
Error messages can be customized in:
- JavaScript validation functions
- Server-side validation arrays
- Language files for internationalization

## Best Practices

### 1. User Interface
- Provide clear, specific error messages
- Use visual indicators (red borders, icons)
- Show validation errors in context
- Allow easy error correction

### 2. Performance
- Client-side validation for immediate feedback
- Server-side validation for data integrity
- Efficient validation algorithms
- Minimal impact on form submission

### 3. Accessibility
- Clear error messages for screen readers
- Keyboard navigation support
- Color-independent error indicators
- Proper ARIA labels

## Troubleshooting

### Common Issues

1. **Validation not triggering**: Check JavaScript console for errors
2. **Error messages not displaying**: Verify flash message setup
3. **Form submission blocked**: Check validation function return values
4. **Server errors**: Review validation logic and database queries

### Debug Information

Enable debug logging to track:
- Validation function calls
- Error message generation
- Form submission process
- Server-side validation results

## Future Enhancements

### Planned Features
- Custom validation rules per shop
- Quantity limits based on item type
- Advanced validation scenarios
- Validation rule management interface

### Performance Optimizations
- Validation caching
- Batch validation processing
- Asynchronous validation
- Progressive form validation 