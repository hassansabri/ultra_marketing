/*
 * Stock Deduction System Example
 * 
 * This file demonstrates how the automatic stock deduction works
 * when orders are created or updated.
 */

// Example 1: When a new order is created
function createNewOrder() {
    // 1. User fills order form with items and quantities
    // 2. Form is submitted to draft_order() method
    // 3. Stock is validated first
    // 4. If stock is sufficient, order is created
    // 5. Stock is automatically deducted
    
    console.log('Order creation process:');
    console.log('1. Validate stock availability');
    console.log('2. Create order if stock is sufficient');
    console.log('3. Automatically deduct stock from inventory');
    console.log('4. Log stock deduction in stocks_logs table');
}

// Example 2: When an order is updated
function updateExistingOrder() {
    // 1. User modifies order quantities
    // 2. Form is submitted to draft_order_updater() method
    // 3. Stock is validated for new quantities
    // 4. If stock is sufficient, order is updated
    // 5. Stock is automatically deducted for new quantities
    
    console.log('Order update process:');
    console.log('1. Validate stock for new quantities');
    console.log('2. Update order if stock is sufficient');
    console.log('3. Automatically deduct additional stock needed');
    console.log('4. Log stock deduction in stocks_logs table');
}

// Example 3: When an order is cancelled/deleted
function cancelOrder() {
    // 1. User cancels order
    // 2. Stock is automatically restored to inventory
    // 3. Order is deleted from system
    
    console.log('Order cancellation process:');
    console.log('1. Restore stock to inventory');
    console.log('2. Log stock restoration in stocks_logs table');
    console.log('3. Delete order from system');
}

// Example 4: Stock validation before order submission
function validateStockBeforeOrder() {
    // This happens in the checkquantity() function
    // It validates stock before allowing form submission
    
    console.log('Pre-order validation:');
    console.log('1. Check stock for each item');
    console.log('2. Check stock for each attribute combination');
    console.log('3. Prevent order if insufficient stock');
    console.log('4. Allow order if stock is sufficient');
}

// Example 5: Real-time stock checking
function realTimeStockCheck() {
    // This happens when user changes quantities
    // It provides immediate feedback without submitting form
    
    console.log('Real-time stock checking:');
    console.log('1. User changes quantity input');
    console.log('2. AJAX call to check stock');
    console.log('3. Show warning if insufficient stock');
    console.log('4. Highlight field in red if needed');
}

/*
 * Database Tables Involved:
 * 
 * 1. orders - Stores order information
 * 2. order_detail - Stores order attribute details
 * 3. stocks - Stores current stock levels
 * 4. stocks_logs - Stores all stock transactions (additions/deductions)
 * 
 * Stock Deduction Process:
 * 
 * 1. When order is created/updated:
 *    - Check stock availability
 *    - If sufficient, deduct from stocks table
 *    - Log deduction in stocks_logs table
 * 
 * 2. When order is cancelled:
 *    - Restore stock to stocks table
 *    - Log restoration in stocks_logs table
 * 
 * 3. Stock logs include:
 *    - item_fk, brand_fk, grade_fk, model_fk, size_fk, type_fk, colour_fk, unit_fk
 *    - balance (positive for additions, negative for deductions)
 *    - stock_type ('addition', 'deduction', 'restoration')
 *    - entry_date
 */ 