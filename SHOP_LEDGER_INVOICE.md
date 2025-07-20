# Shop Ledger Integration in Invoice Generation

## Overview

This document explains the integration of shop ledger information into the invoice generation process, providing a comprehensive financial view for both individual orders and the overall shop financial status.

## Features Added

### 1. Shop Ledger Display
- **Complete Transaction History**: Shows all ledger entries for the shop
- **Real-time Balance Calculation**: Displays running balance for each transaction
- **Order Linking**: Clickable order numbers to navigate between invoices
- **Current Order Highlighting**: Visual distinction for the current order being viewed

### 2. Financial Summary Dashboard
- **Total Debits**: Sum of all debit transactions
- **Total Credits**: Sum of all credit transactions  
- **Current Balance**: Net balance after all transactions
- **Current Order Amount**: Amount of the invoice being viewed

### 3. Enhanced User Experience
- **Visual Indicators**: Color-coded financial data
- **Responsive Design**: Works on all device sizes
- **Print-Friendly**: Optimized for printing invoices
- **Navigation**: Easy switching between related orders

## Technical Implementation

### 1. Controller Updates (`show_invoice` method)

```php
// Fetch shop ledger entries if shop info is available
$this->data['shop_ledger'] = array();
if (isset($this->data['order_info'][0]['shop_id']) && $this->data['order_info'][0]['shop_id']) {
    $this->data['shop_ledger'] = $this->model_order->getShopLedger($this->data['order_info'][0]['shop_id']);
}
```

### 2. Model Method (`getShopLedger`)

```php
public function getShopLedger($shop_id) {
    $this->db->select('order_ledger.*, orders.shop_id');
    $this->db->from('order_ledger');
    $this->db->join('orders', 'orders.order_number = order_ledger.order_number');
    $this->db->where('orders.shop_id', $shop_id);
    $this->db->order_by('order_ledger.date', 'DESC');
    $query = $this->db->get();
    return $query->result_array();
}
```

### 3. View Integration

#### Shop Ledger Table
```php
<?php if(isset($shop_ledger) && count($shop_ledger) > 0): ?>
<div class="invoice-ledger">
    <h4><i class="fa fa-store"></i> Shop Ledger - <?php echo $shop_info['shop_name']; ?></h4>
    <table class="table table-striped table-bordered">
        <!-- Table headers and data -->
    </table>
</div>
<?php endif; ?>
```

#### Financial Summary Cards
```php
<div class="invoice-summary">
    <h4><i class="fa fa-chart-line"></i> Shop Financial Summary</h4>
    <div class="row">
        <div class="col-md-3">
            <div class="summary-card">
                <h5>Total Debits</h5>
                <h3><?php echo $currency . number_format($shop_total_debit, 2); ?></h3>
            </div>
        </div>
        <!-- More summary cards -->
    </div>
</div>
```

## Data Structure

### Shop Ledger Entry
```php
array(
    'ledger_id' => '1',
    'order_number' => 'ORD-001',
    'date' => '2024-01-15 10:30:00',
    'amount' => '1500.00',
    'payment_method' => 'Cash',
    'remarks' => 'Payment received',
    'type' => 'credit',
    'shop_id' => '5'
)
```

### Financial Calculations
```php
// Running balance calculation
$shop_balance = 0;
foreach($shop_ledger as $entry) {
    $debit = $entry['type'] == 'debit' ? $entry['amount'] : 0;
    $credit = $entry['type'] == 'credit' ? $entry['amount'] : 0;
    $shop_balance += ($credit - $debit);
}
```

## User Interface Elements

### 1. Shop Ledger Table
- **Date Column**: Transaction timestamp
- **Order # Column**: Clickable link to order invoice
- **Debit/Credit Columns**: Amount with currency formatting
- **Balance Column**: Running balance after each transaction
- **Type Column**: Transaction type (debit/credit)
- **Payment Method**: How payment was made
- **Remarks**: Additional transaction notes

### 2. Financial Summary Cards
- **Total Debits**: Red color (#e74c3c)
- **Total Credits**: Green color (#27ae60)
- **Current Balance**: Blue color (#3498db)
- **This Order**: Orange color (#f39c12)

### 3. Visual Enhancements
- **Current Order Highlighting**: Green background and border
- **Hover Effects**: Subtle background color changes
- **Responsive Design**: Cards stack on mobile devices
- **Print Optimization**: Hides navigation elements when printing

## Benefits

### 1. Financial Transparency
- Complete transaction history for the shop
- Real-time balance tracking
- Clear separation of debits and credits
- Historical payment patterns

### 2. Better Decision Making
- Quick overview of shop financial health
- Payment history analysis
- Outstanding balance identification
- Revenue tracking

### 3. Improved User Experience
- Single-page financial overview
- Easy navigation between related orders
- Professional invoice presentation
- Mobile-friendly design

### 4. Business Intelligence
- Shop performance metrics
- Payment method preferences
- Transaction frequency analysis
- Financial trend identification

## Usage Scenarios

### 1. Invoice Generation
- **Action**: Generate invoice for completed order
- **Result**: Shows order details + shop ledger + financial summary
- **Benefit**: Complete financial context for the transaction

### 2. Financial Review
- **Action**: View invoice for any order
- **Result**: Access to complete shop financial history
- **Benefit**: Historical context for financial decisions

### 3. Payment Tracking
- **Action**: Monitor shop payment status
- **Result**: Real-time balance and payment history
- **Benefit**: Accurate financial position assessment

### 4. Audit Trail
- **Action**: Review transaction history
- **Result**: Complete audit trail with timestamps
- **Benefit**: Compliance and accountability

## Configuration Options

### 1. Currency Display
```php
$currency = 'PKR'; // Change to your preferred currency
```

### 2. Date Format
```php
date('Y-m-d H:i', strtotime($entry['date'])); // Customize date format
```

### 3. Color Scheme
```css
/* Customize colors in CSS */
.invoice-ledger h4 i.fa-store { color: #e74c3c; }
.summary-card h5[style*="e74c3c"] { color: #e74c3c; } /* Debits */
.summary-card h5[style*="27ae60"] { color: #27ae60; } /* Credits */
```

### 4. Table Columns
- Add/remove columns as needed
- Customize column headers
- Adjust column widths
- Modify sorting options

## Security Considerations

### 1. Data Access Control
- Ensure only authorized users can view shop ledgers
- Implement role-based access control
- Log access to sensitive financial data

### 2. Data Validation
- Validate shop_id before fetching ledger data
- Sanitize output to prevent XSS attacks
- Verify user permissions for shop access

### 3. Privacy Protection
- Mask sensitive financial information if needed
- Implement data retention policies
- Secure transmission of financial data

## Performance Optimization

### 1. Database Queries
- Use proper indexing on shop_id and date columns
- Limit ledger entries if needed (e.g., last 12 months)
- Implement pagination for large datasets

### 2. Caching
- Cache shop ledger data for frequently accessed shops
- Implement cache invalidation on new transactions
- Use Redis or similar for session-based caching

### 3. Frontend Optimization
- Lazy load ledger data if needed
- Implement virtual scrolling for large tables
- Optimize CSS and JavaScript for faster rendering

## Troubleshooting

### Common Issues

1. **Shop Ledger Not Displaying**
   - Check if shop_id exists in order_info
   - Verify getShopLedger method returns data
   - Check database connection and permissions

2. **Balance Calculation Errors**
   - Verify transaction types (debit/credit)
   - Check for null or invalid amounts
   - Ensure proper currency formatting

3. **Performance Issues**
   - Check database query performance
   - Implement proper indexing
   - Consider pagination for large datasets

4. **Display Issues**
   - Check CSS compatibility
   - Verify responsive design on mobile
   - Test print functionality

### Debug Information
- Check browser console for JavaScript errors
- Review server logs for PHP errors
- Verify database query results
- Test with different shop data

## Future Enhancements

### 1. Advanced Filtering
- Date range filters
- Transaction type filters
- Payment method filters
- Amount range filters

### 2. Export Functionality
- PDF export of shop ledger
- Excel/CSV export options
- Email functionality for reports

### 3. Analytics Dashboard
- Charts and graphs
- Trend analysis
- Comparative reporting
- Forecasting tools

### 4. Real-time Updates
- WebSocket integration
- Live balance updates
- Push notifications
- Auto-refresh functionality 