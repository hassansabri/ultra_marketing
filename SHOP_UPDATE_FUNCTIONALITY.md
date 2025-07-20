# Shop Update Functionality in Order Ledger

## Overview

This document explains the enhanced shop update functionality in the order ledger system, which allows users to quickly update shop associations for ledger entries both through the form and directly in the table.

## Features Added

### 1. Quick Shop Update in Table
- **Inline Editing**: Click edit button to change shop directly in the table
- **Dropdown Selection**: Select from all available shops
- **Real-time Updates**: AJAX-based updates without page refresh
- **Visual Feedback**: Success/error messages and visual confirmation

### 2. Shop Filtering
- **Filter Dropdown**: Filter ledger entries by shop
- **Real-time Filtering**: Instant filtering without page reload
- **Clear Filter**: Option to show all entries

### 3. Enhanced Form Updates
- **Shop Dropdown**: Required shop selection in add/edit forms
- **Validation**: Ensures shop is selected before saving
- **Auto-update**: Updates order-shop association when saving

## Technical Implementation

### 1. Quick Update Interface

#### HTML Structure
```php
<td>
    <div class="shop-display">
        <span class="badge badge-primary">Shop Name</span>
    </div>
    <div class="shop-update" style="display: none;">
        <select class="form-control input-sm shop-select" data-order="ORDER-001">
            <option value="">Select Shop</option>
            <option value="1">Shop A</option>
            <option value="2">Shop B</option>
        </select>
    </div>
    <button type="button" class="btn btn-xs btn-warning toggle-shop-edit" data-ledger-id="1">
        <i class="fa fa-edit"></i>
    </button>
</td>
```

#### JavaScript Functionality
```javascript
$('.toggle-shop-edit').click(function() {
    var ledgerId = $(this).data('ledger-id');
    var row = $(this).closest('td');
    var displayDiv = row.find('.shop-display');
    var updateDiv = row.find('.shop-update');
    var button = $(this);
    
    if (updateDiv.is(':visible')) {
        // Save the shop update via AJAX
        saveShopUpdate(updateDiv, displayDiv, button);
    } else {
        // Show edit mode
        displayDiv.hide();
        updateDiv.show();
        button.html('<i class="fa fa-save"></i>');
    }
});
```

### 2. AJAX Update Method

#### Controller Method
```php
public function update_shop_ajax() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $order_number = $this->input->post('order_number');
        $shop_id = $this->input->post('shop_id');
        
        if ($order_number && $shop_id) {
            $success = $this->model_order->updateOrderShop($order_number, $shop_id);
            
            if ($success) {
                echo json_encode(array('success' => true, 'message' => 'Shop updated successfully'));
            } else {
                echo json_encode(array('success' => false, 'message' => 'Failed to update shop'));
            }
        } else {
            echo json_encode(array('success' => false, 'message' => 'Invalid order number or shop ID'));
        }
    } else {
        echo json_encode(array('success' => false, 'message' => 'Invalid request method'));
    }
}
```

#### AJAX Call
```javascript
$.ajax({
    url: '<?php echo site_url("orders/update_shop_ajax"); ?>',
    type: 'POST',
    data: {
        order_number: orderNumber,
        shop_id: shopId
    },
    dataType: 'json',
    success: function(response) {
        if (response.success) {
            // Update display and show success message
            updateShopDisplay(shopName);
            showAlert('Shop updated successfully!', 'success');
        } else {
            showAlert('Failed to update shop: ' + response.message, 'danger');
        }
    },
    error: function() {
        showAlert('Error updating shop. Please try again.', 'danger');
    }
});
```

### 3. Shop Filtering

#### Filter Dropdown
```php
<div class="panel-heading">
    All Ledger Entries
    <div class="pull-right">
        <select id="shop-filter" class="form-control input-sm" style="width: 200px;">
            <option value="">Filter by Shop</option>
            <?php foreach($all_shops as $shop): ?>
                <option value="<?php echo $shop['shop_name']; ?>"><?php echo $shop['shop_name']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</div>
```

#### Filter JavaScript
```javascript
$('#shop-filter').change(function() {
    var selectedShop = $(this).val();
    if (selectedShop) {
        $('tbody tr').each(function() {
            var shopName = $(this).find('.shop-display .badge').text();
            if (shopName && shopName.trim() !== selectedShop) {
                $(this).hide();
            } else {
                $(this).show();
            }
        });
    } else {
        $('tbody tr').show();
    }
});
```

## User Interface Elements

### 1. Quick Update Button
- **Edit Icon**: Pencil icon to start editing
- **Save Icon**: Checkmark icon to save changes
- **Position**: Located next to shop name in table

### 2. Shop Dropdown
- **Inline Display**: Appears in place of shop name when editing
- **All Shops**: Shows all available shops in system
- **Current Selection**: Pre-selects current shop if assigned

### 3. Filter Dropdown
- **Header Position**: Located in panel header
- **All Shops**: Dropdown with all available shops
- **Clear Option**: "Filter by Shop" option to show all entries

### 4. Alert Messages
- **Success**: Green alert for successful updates
- **Error**: Red alert for failed updates
- **Warning**: Yellow alert for validation issues
- **Auto-dismiss**: Messages fade out after 5 seconds

## Usage Scenarios

### 1. Quick Shop Update
1. **Click Edit**: Click the edit button next to shop name
2. **Select Shop**: Choose new shop from dropdown
3. **Save**: Click save button to update
4. **Confirm**: See success message and updated display

### 2. Filter by Shop
1. **Select Filter**: Choose shop from filter dropdown
2. **View Results**: See only entries for selected shop
3. **Clear Filter**: Select "Filter by Shop" to show all entries

### 3. Form-based Update
1. **Edit Entry**: Click edit button on ledger entry
2. **Change Shop**: Select new shop from dropdown
3. **Save Form**: Submit form to update all fields including shop

## Benefits

### 1. Improved Efficiency
- **Quick Updates**: No need to open full edit form for shop changes
- **Real-time Updates**: Instant feedback without page refresh
- **Bulk Operations**: Easy to update multiple entries quickly

### 2. Better User Experience
- **Intuitive Interface**: Clear visual indicators for edit mode
- **Immediate Feedback**: Success/error messages for all actions
- **Responsive Design**: Works on all device sizes

### 3. Enhanced Data Management
- **Accurate Associations**: Ensures proper order-shop relationships
- **Data Integrity**: Validates shop selection before saving
- **Audit Trail**: Maintains history of shop changes

### 4. Improved Navigation
- **Shop Filtering**: Easy to find entries for specific shops
- **Quick Access**: Direct links to related invoices
- **Organized View**: Clear visual separation of shop information

## Error Handling

### 1. Validation Errors
- **Required Fields**: Ensures shop is selected before saving
- **Invalid Data**: Validates order number and shop ID
- **User Feedback**: Clear error messages for validation issues

### 2. AJAX Errors
- **Network Issues**: Handles connection problems gracefully
- **Server Errors**: Displays appropriate error messages
- **Timeout Handling**: Manages long-running requests

### 3. Data Integrity
- **Duplicate Prevention**: Prevents duplicate shop assignments
- **Referential Integrity**: Maintains proper database relationships
- **Rollback Capability**: Reverts changes on errors

## Security Considerations

### 1. Input Validation
- **Server-side Validation**: Validates all input on server
- **SQL Injection Prevention**: Uses prepared statements
- **XSS Prevention**: Sanitizes all output

### 2. Access Control
- **User Permissions**: Ensures only authorized users can update
- **Data Ownership**: Validates user access to specific data
- **Audit Logging**: Logs all shop update activities

### 3. CSRF Protection
- **Token Validation**: Validates CSRF tokens for all requests
- **Request Verification**: Ensures requests come from valid sources
- **Session Security**: Maintains secure session management

## Performance Optimization

### 1. AJAX Optimization
- **Minimal Data Transfer**: Only sends necessary data
- **Efficient Queries**: Optimized database queries
- **Caching**: Caches shop data where appropriate

### 2. UI Performance
- **Lazy Loading**: Loads shop data as needed
- **Efficient DOM Updates**: Minimal DOM manipulation
- **Responsive Design**: Optimized for different screen sizes

### 3. Database Optimization
- **Indexed Queries**: Proper indexing on shop_id and order_number
- **Efficient Joins**: Optimized JOIN operations
- **Query Caching**: Caches frequently used queries

## Troubleshooting

### Common Issues

1. **Shop Not Updating**
   - Check if order exists in database
   - Verify shop_id is valid
   - Check database permissions

2. **AJAX Errors**
   - Check browser console for JavaScript errors
   - Verify AJAX URL is correct
   - Check server logs for PHP errors

3. **Filter Not Working**
   - Ensure shop names match exactly
   - Check for extra spaces in shop names
   - Verify JavaScript is loaded properly

### Debug Information
- Check browser console for JavaScript errors
- Review server logs for PHP errors
- Verify database query results
- Test with different shop data

## Future Enhancements

### 1. Advanced Filtering
- **Multiple Shop Selection**: Filter by multiple shops
- **Date Range Filtering**: Filter by date ranges
- **Amount Range Filtering**: Filter by amount ranges

### 2. Bulk Operations
- **Bulk Shop Updates**: Update multiple entries at once
- **Bulk Export**: Export filtered data
- **Bulk Delete**: Delete multiple entries

### 3. Advanced Features
- **Shop History**: Track shop change history
- **Shop Analytics**: Analyze shop performance
- **Shop Reports**: Generate shop-specific reports

### 4. Integration Features
- **API Integration**: REST API for external access
- **Webhook Support**: Notifications for shop changes
- **Third-party Integration**: Connect with external systems 