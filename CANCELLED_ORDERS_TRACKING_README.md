# Cancelled Orders Tracking System

## Overview
This system provides comprehensive tracking and management of cancelled invoices/orders with automatic stock restoration and detailed analytics.

## Features Implemented

### 1. **Database Structure**
- **New Table**: `cancelled_orders` - Tracks all cancellation details
- **Updated Table**: `orders` - Added 'cancelled' status to order_status enum
- **Indexes**: Added performance indexes for better query performance

### 2. **Cancellation Tracking**
- **Cancellation Date**: Records when order was cancelled
- **Cancelled By**: Tracks which user cancelled the order
- **Cancellation Reason**: Optional reason field for cancellation
- **Original Status**: Records the status before cancellation (draft/confirm)
- **Stock Restoration Status**: Tracks whether stock was successfully restored

### 3. **Stock Management**
- **Automatic Restoration**: Stock quantities are automatically restored when orders are cancelled
- **Restoration Tracking**: Records when stock was restored
- **Comprehensive Coverage**: Handles both simple items and items with attributes (grade, model, size, type, colour, unit)

### 4. **User Interface**
- **Modal Form**: Professional cancellation form with reason field
- **Confirmation**: Clear warnings about stock restoration
- **Real-time Updates**: AJAX-based cancellation for better user experience

### 5. **Analytics Dashboard**
- **Total Cancelled Orders**: Overall count of cancelled orders
- **Monthly Cancellations**: Orders cancelled this month
- **Daily Cancellations**: Orders cancelled today
- **Recent Activity**: Cancellations in the last 7 days
- **Cancellation Reasons**: Summary of why orders were cancelled

## Database Schema

### Cancelled Orders Table
```sql
CREATE TABLE `cancelled_orders` (
  `cancellation_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `order_number` bigint(20) NOT NULL,
  `cancelled_date` datetime NOT NULL DEFAULT current_timestamp(),
  `cancelled_by` bigint(20) NOT NULL,
  `cancellation_reason` varchar(255) DEFAULT NULL,
  `original_status` enum('draft','confirm') NOT NULL,
  `stock_restored` tinyint(1) DEFAULT 0,
  `stock_restoration_date` datetime DEFAULT NULL,
  PRIMARY KEY (`cancellation_id`),
  KEY `order_number` (`order_number`),
  KEY `cancelled_by` (`cancelled_by`),
  KEY `cancelled_date` (`cancelled_date`)
);
```

### Orders Table Update
```sql
ALTER TABLE `orders` MODIFY COLUMN `order_status` 
enum('draft','confirm','cancelled') NOT NULL DEFAULT 'draft';
```

## How to Use

### 1. **Cancel an Order**
1. Navigate to "All Complete Orders" or "All Draft Orders"
2. Click the dropdown menu for the order you want to cancel
3. Select "Cancel Order"
4. Fill in the optional cancellation reason
5. Confirm the cancellation
6. Stock will be automatically restored

### 2. **View Cancelled Orders**
1. Navigate to "Cancelled Orders" in the Manage Orders menu
2. View cancellation statistics dashboard
3. See detailed information about each cancelled order
4. Check stock restoration status

### 3. **Monitor Cancellations**
- **Navigation Badge**: Shows count of cancelled orders in the menu
- **Statistics Dashboard**: Real-time counts and trends
- **Detailed Tracking**: Full audit trail of cancellations

## API Endpoints

### Cancel Order (AJAX)
- **URL**: `/orders/cancel_order_ajax`
- **Method**: POST
- **Parameters**:
  - `order_number`: Order number to cancel
  - `cancellation_reason`: Optional reason for cancellation
- **Response**: JSON with success status and message

### View Cancelled Orders
- **URL**: `/orders/cancelledorders`
- **Method**: GET
- **Features**: Statistics dashboard and detailed list

## Stock Restoration Process

1. **Order Cancellation**: Order status changed to 'cancelled'
2. **Stock Calculation**: System calculates quantities to restore
3. **Attribute Handling**: Processes items with specific attributes
4. **Database Update**: Updates stock balances in `stocks` table
5. **Logging**: Records restoration in `stocks_logs` table
6. **Status Update**: Marks stock as restored in `cancelled_orders`

## Security Features

- **User Authentication**: Only logged-in users can cancel orders
- **Status Validation**: Prevents cancelling already cancelled orders
- **Stock Verification**: Ensures stock restoration is successful
- **Audit Trail**: Complete record of who cancelled what and when

## Benefits

1. **Inventory Accuracy**: Automatic stock restoration prevents inventory discrepancies
2. **Business Intelligence**: Track cancellation patterns and reasons
3. **Compliance**: Maintain audit trail for cancelled orders
4. **User Experience**: Professional interface with clear warnings
5. **Performance**: Optimized database queries with proper indexing

## Future Enhancements

- **Email Notifications**: Alert relevant parties when orders are cancelled
- **Approval Workflow**: Require manager approval for high-value cancellations
- **Reporting**: Export cancellation data for analysis
- **Integration**: Connect with accounting systems for credit note generation

## Installation

1. **Run Database Updates**:
   ```sql
   -- Execute the SQL from cancelled_orders_tracking.sql
   ```

2. **Clear Cache**: Clear any application cache if applicable

3. **Test Functionality**: 
   - Try cancelling a test order
   - Verify stock restoration
   - Check cancellation tracking

## Support

For technical support or questions about the cancelled orders tracking system, please refer to the system documentation or contact the development team. 