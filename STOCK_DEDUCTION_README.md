# Automatic Stock Deduction System

## Overview

This system automatically deducts stock from inventory when orders are created or updated, and restores stock when orders are cancelled. The system ensures accurate inventory management by maintaining real-time stock levels.

## Features

### 1. Automatic Stock Deduction
- **New Orders**: Stock is automatically deducted when a new order is created
- **Updated Orders**: Stock is deducted when order quantities are increased
- **Order Cancellation**: Stock is automatically restored when orders are cancelled

### 2. Stock Validation
- **Pre-order Validation**: Stock is checked before allowing order submission
- **Real-time Validation**: Stock levels are validated as users change quantities
- **Attribute-based Validation**: Stock is checked for specific attribute combinations (grade, model, size, type, colour, unit)

### 3. Comprehensive Logging
- All stock transactions are logged in the `stocks_logs` table
- Deductions, additions, and restorations are tracked with timestamps
- Stock type is recorded for audit purposes

## Implementation Details

### Database Tables

#### 1. `stocks` Table
Stores current stock levels for items and their attributes:
```sql
- item_fk (Item ID)
- brand_fk (Brand ID)
- grade_fk (Grade ID)
- model_fk (Model ID)
- size_fk (Size ID)
- type_fk (Type ID)
- colour_fk (Colour ID)
- unit_fk (Unit ID)
- balance (Current stock quantity)
```

#### 2. `stocks_logs` Table
Stores all stock transactions:
```sql
- item_fk (Item ID)
- brand_fk, grade_fk, model_fk, size_fk, type_fk, colour_fk, unit_fk
- balance (Transaction amount: positive for additions, negative for deductions)
- stock_type ('addition', 'deduction', 'restoration')
- entry_date (Transaction date)
```

#### 3. `orders` Table
Stores order information:
```sql
- order_number (Unique order identifier)
- item_fk (Item ID)
- order_quantity (Ordered quantity)
- order_price (Item price)
- order_status ('draft', 'confirm', 'cancelled')
```

#### 4. `order_detail` Table
Stores order attribute details:
```sql
- order_number_fk (Order number)
- attribute_fk (Attribute ID)
- attribute_quantity (Quantity for this attribute)
- item_fk (Item ID)
- attribute_type ('grade', 'model', 'size', 'type', 'colour', 'unit')
```

### Key Methods

#### 1. Stock Model (`application/models/stocks/m_stocks.php`)

```php
// Deduct stock for an order
public function deductStock($data, $quantity)

// Restore stock (for order cancellation)
public function restoreStock($data, $quantity)

// Check current stock levels
public function checkstock($data)
```

#### 2. Orders Model (`application/models/orders/m_orders.php`)

```php
// Deduct stock for entire order
public function deductStockForOrder($order_number)

// Restore stock for entire order
public function restoreStockForOrder($order_number)

// Check stock availability
public function checkStockAvailability($item_id, $order_quantity, $attributes = array())
```

#### 3. Orders Controller (`application/controllers/orders.php`)

```php
// Create new order with stock deduction
public function draft_order()

// Update existing order with stock deduction
public function draft_order_updater($order_number)

// Delete order with stock restoration
public function deleteorderdetail()
```

## Workflow

### 1. Creating a New Order

1. **User fills order form** with items and quantities
2. **Stock validation** occurs via `checkquantity()` function
3. **Form submission** to `draft_order()` method
4. **Stock availability check** for all items
5. **Order creation** if stock is sufficient
6. **Automatic stock deduction** via `deductStockForOrder()`
7. **Success message** displayed to user

### 2. Updating an Existing Order

1. **User modifies order** quantities
2. **Stock validation** for new quantities
3. **Form submission** to `draft_order_updater()` method
4. **Stock availability check** for updated quantities
5. **Order update** if stock is sufficient
6. **Automatic stock deduction** for new quantities
7. **Success message** displayed to user

### 3. Cancelling an Order

1. **User cancels order**
2. **Stock restoration** via `restoreStockForOrder()`
3. **Order deletion** from system
4. **Success message** displayed to user

## JavaScript Integration

### Stock Validation Functions

```javascript
// For regular forms (validates and submits)
orders.checkquantity()

// For validation only (no form submission)
orders.validateStockOnly()

// For AJAX loaded content (no form submission)
orders.validateStockForAjaxContent()
```

### Real-time Validation

The system includes real-time stock validation that:
- Triggers when users change quantity inputs
- Shows visual feedback (red highlighting) for insufficient stock
- Displays tooltips with available stock information
- Prevents unwanted form submissions for AJAX content

## Error Handling

### Stock Insufficient
- Order creation/update is prevented
- User receives clear error message
- Available stock levels are displayed

### Stock Deduction Failure
- Order process continues but warning is logged
- Administrator is notified via flash messages
- Manual intervention may be required

### Stock Restoration Failure
- Order cancellation continues but warning is logged
- Administrator is notified via flash messages
- Manual stock adjustment may be required

## Configuration

### Stock Validation Settings

The system can be configured to:
- Enable/disable automatic stock deduction
- Set minimum stock thresholds
- Configure stock warning levels
- Customize error messages

### Logging Configuration

Stock logs can be configured to:
- Set log retention periods
- Enable/disable detailed logging
- Configure log file locations
- Set log rotation policies

## Best Practices

### 1. Regular Stock Audits
- Periodically verify stock levels against physical inventory
- Review stock logs for discrepancies
- Investigate unusual stock movements

### 2. Backup Procedures
- Regular database backups before stock operations
- Test stock restoration procedures
- Document manual stock adjustment procedures

### 3. User Training
- Train users on stock validation messages
- Explain the automatic deduction process
- Provide guidance on handling stock errors

## Troubleshooting

### Common Issues

1. **Stock not deducted**: Check if order status is 'draft' or 'confirm'
2. **Stock restoration failed**: Verify order details exist before restoration
3. **Validation errors**: Check stock data structure and attribute combinations

### Debug Information

Enable debug logging to track:
- Stock check results
- Deduction/restoration operations
- Database transaction status
- Error messages and stack traces

## Future Enhancements

### Planned Features
- Stock reservation system for pending orders
- Automatic reorder notifications
- Stock movement reports and analytics
- Integration with external inventory systems

### Performance Optimizations
- Database query optimization
- Caching of stock levels
- Batch processing for large orders
- Asynchronous stock operations 