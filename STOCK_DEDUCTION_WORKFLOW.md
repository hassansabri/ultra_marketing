# Stock Deduction Workflow Documentation

## Overview

This document explains the updated stock deduction workflow where stock is only deducted when an order is completed, not when it's created or edited as a draft.

## Workflow Changes

### Before (Old Workflow)
1. **Draft Order Creation**: Stock deducted immediately
2. **Draft Order Editing**: Stock deducted again
3. **Order Completion**: No additional stock deduction
4. **Order Cancellation**: Stock restored regardless of status

### After (New Workflow)
1. **Draft Order Creation**: No stock deduction
2. **Draft Order Editing**: No stock deduction
3. **Order Completion**: Stock deducted with validation
4. **Order Cancellation**: Stock restored only for completed orders

## Key Components

### 1. Order Creation (`draft_order` method)
- **Location**: `application/controllers/orders.php`
- **Action**: Creates draft order without stock deduction
- **Message**: "Draft order created successfully. Stock will be deducted when order is completed."

### 2. Order Editing (`draft_order_updater` method)
- **Location**: `application/controllers/orders.php`
- **Action**: Updates draft order without stock deduction
- **Message**: "Draft order updated successfully. Stock will be deducted when order is completed."

### 3. Order Completion (`save` method)
- **Location**: `application/controllers/orders.php`
- **Actions**:
  1. Check stock availability for all items
  2. Validate sufficient stock exists
  3. Update order status to 'confirm'
  4. Deduct stock from inventory
  5. Show success/error messages

### 4. Order Cancellation (`deleteorderdetail` method)
- **Location**: `application/controllers/orders.php`
- **Action**: Restore stock only for completed orders (status = 'confirm')

## Stock Validation Process

### Pre-Completion Validation
```php
// Check stock availability before completing the order
$order_info = $this->model_order->getOrder($order_number);
$stock_errors = array();
$has_stock_issues = false;

foreach($order_info as $oi){
    $item_id = $oi['item_id'];
    $quantity = $oi['order_quantity'];
    
    // Check stock availability
    $stock_check = $this->model_order->checkStockAvailability($item_id, $quantity);
    if (!$stock_check['sufficient']) {
        $item_detail = $this->model_order->getitemdetail($item_id);
        $item_name = isset($item_detail[0]['item_name']) ? $item_detail[0]['item_name'] : 'Item';
        $stock_errors[] = "Insufficient stock for {$item_name}. Available: {$stock_check['available']}, Requested: {$stock_check['requested']}";
        $has_stock_issues = true;
    }
}
```

### Stock Deduction After Validation
```php
// Deduct stock after successful order completion
$stock_deduction_success = $this->model_order->deductStockForOrder($order_number);
if (!$stock_deduction_success) {
    $this->session->set_flashdata('stock_errors', ['Failed to deduct stock for completed order. Please contact administrator.']);
} else {
    $this->session->set_flashdata('success', 'Order completed successfully and stock deducted.');
}
```

## User Interface Changes

### 1. Review Order Page
- **Button Text**: Changed from "Save Price and Complete Order" to "Complete Order & Deduct Stock"
- **Confirmation Dialog**: Added confirmation before order completion
- **Flash Messages**: Added display for stock validation results

### 2. Form Validation
- **Client-side**: Only validates required fields (shop, quantity)
- **Server-side**: Stock validation moved to completion stage
- **Real-time**: Removed stock checking from form submission

## JavaScript Functions

### Order Completion Function
```javascript
function completeOrder(orderNumber) {
    if (confirm('Are you sure you want to complete this order? This will:\n\n1. Change order status to confirmed\n2. Deduct stock from inventory\n3. This action cannot be undone\n\nDo you want to proceed?')) {
        // Show loading indicator
        var button = event.target;
        var originalText = button.innerHTML;
        button.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Processing...';
        button.disabled = true;
        
        // Redirect to save method which will handle stock validation and deduction
        window.location.href = baseurl + '/orders/save/' + orderNumber;
    }
}
```

### Form Submission Handler
```javascript
$(document).on('submit', '#orderForm', function(e) {
    e.preventDefault();
    
    var form = $(this);
    
    // Check if already processing
    if (form.data('processing')) {
        return false;
    }
    
    // Set processing flag
    form.data('processing', true);
    
    // Validate required fields first
    if (!orders.validateRequiredFields()) {
        form.removeData('processing');
        return false;
    }
    
    // Submit the form (stock validation will be done when order is completed)
    form[0].submit();
    
    return false;
});
```

## Database Operations

### Stock Deduction
- **Method**: `deductStockForOrder($order_number)`
- **Location**: `application/models/orders/m_orders.php`
- **Process**:
  1. Get order details
  2. For each item, check if it has attributes
  3. Deduct stock for each attribute combination
  4. Log stock transactions

### Stock Restoration
- **Method**: `restoreStockForOrder($order_number)`
- **Location**: `application/models/orders/m_orders.php`
- **Process**:
  1. Check if order is completed (status = 'confirm')
  2. Restore stock for each item and attribute combination
  3. Log stock transactions

## Error Handling

### Stock Validation Errors
- **Display**: Flash messages on review order page
- **Format**: List of specific stock shortages
- **Action**: Prevent order completion

### Stock Deduction Errors
- **Display**: Error message in flash data
- **Action**: Order status remains draft
- **Recovery**: Manual intervention required

## Benefits of New Workflow

### 1. Better Stock Management
- Stock is only reserved when order is actually confirmed
- Prevents stock shortages due to abandoned draft orders
- More accurate inventory tracking

### 2. Improved User Experience
- Users can create and edit draft orders without affecting stock
- Clear indication when stock will be deducted
- Confirmation dialog prevents accidental completions

### 3. Reduced Errors
- Stock validation happens at the right time
- Prevents overselling due to draft orders
- Better error reporting and recovery

### 4. Audit Trail
- Clear separation between draft and confirmed orders
- Stock transactions only for confirmed orders
- Better tracking of order lifecycle

## Testing Scenarios

### 1. Draft Order Creation
- **Action**: Create new draft order
- **Expected**: No stock deduction, success message about future deduction

### 2. Draft Order Editing
- **Action**: Edit existing draft order
- **Expected**: No stock deduction, success message about future deduction

### 3. Order Completion with Sufficient Stock
- **Action**: Complete order with adequate stock
- **Expected**: Stock deducted, order status changed to 'confirm'

### 4. Order Completion with Insufficient Stock
- **Action**: Complete order with insufficient stock
- **Expected**: Error message, order remains draft, no stock deduction

### 5. Order Cancellation (Draft)
- **Action**: Cancel draft order
- **Expected**: No stock restoration (none was deducted)

### 6. Order Cancellation (Completed)
- **Action**: Cancel completed order
- **Expected**: Stock restored to inventory

## Migration Notes

### For Existing Systems
- Existing draft orders will not have stock deducted until completed
- Existing completed orders already have stock deducted
- No data migration required

### For New Orders
- All new orders follow the new workflow
- Stock validation happens at completion time
- Better inventory accuracy

## Troubleshooting

### Common Issues

1. **Order won't complete**
   - Check stock availability
   - Verify all required fields are filled
   - Check for JavaScript errors

2. **Stock not deducted**
   - Verify order status is 'confirm'
   - Check stock deduction logs
   - Ensure stock model is working correctly

3. **Stock not restored on cancellation**
   - Verify order was previously completed
   - Check order status before cancellation
   - Review stock restoration logs

### Debug Information
- Check browser console for JavaScript errors
- Review server logs for PHP errors
- Verify database transactions are completing
- Check flash messages for specific error details 