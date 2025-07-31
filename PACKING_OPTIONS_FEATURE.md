# Packing Options Feature Documentation

## Overview

The Packing Options feature allows users to select different packing options when creating or editing orders. This feature enhances the order management system by providing customers with various packing choices, each with different costs and descriptions.

## Features

### 1. Packing Options Management
- **Add New Packing Options**: Create new packing options with title, description, and cost
- **Edit Existing Options**: Modify packing option details
- **Enable/Disable Options**: Toggle packing option status
- **Delete Options**: Remove packing options (with validation to prevent deletion if used in orders)

### 2. Order Integration
- **Edit Order**: Select packing options for each item individually when editing orders
- **Order Review**: View selected packing options and costs for each item in order review
- **Cost Calculation**: Individual packing costs are displayed and totaled in order review

### 3. User Interface
- **Dropdown Selection**: Easy-to-use dropdown for selecting packing options
- **Dynamic Descriptions**: Show packing option descriptions when selected
- **Cost Display**: Clear display of packing costs in the interface

## Database Structure

### New Tables

#### `packing_options` Table
```sql
CREATE TABLE `packing_options` (
  `packing_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `packing_title` varchar(255) NOT NULL,
  `packing_description` text,
  `packing_cost` decimal(10,2) DEFAULT 0.00,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_date` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`packing_id`)
);
```

### Modified Tables

#### `orders` Table
- Added `packing_id` column to store the selected packing option for the order (legacy support)

#### `order_detail` Table  
- Added `packing_id` column to store item-specific packing options

## File Structure

### Controllers
- `application/controllers/packing_options.php` - Packing options management controller

### Models
- `application/models/orders/m_orders.php` - Updated with packing options methods

### Views
- `application/views/packing_options/index.php` - Packing options listing
- `application/views/packing_options/form.php` - Add/edit packing option form
- `application/views/orders/editorder.php` - Updated with packing options section
- `application/views/orders/review_order.php` - Updated to show packing information

### Database
- `packing_options.sql` - SQL file to create packing options table and modify existing tables

## Installation

### 1. Database Setup
Run the SQL file to create the packing options table and modify existing tables:
```bash
mysql -u root -p ultra_marketing < packing_options.sql
```

### 2. File Placement
Ensure all files are placed in their correct directories:
- Controller: `application/controllers/packing_options.php`
- Views: `application/views/packing_options/` directory
- Updated files: `application/views/orders/editorder.php` and `application/views/orders/review_order.php`

### 3. Access Control
The packing options management is accessible through:
- Direct URL: `your-domain.com/packing_options`
- Can be added to navigation menu for admin users

## Usage

### For Administrators

#### Managing Packing Options
1. **Access**: Navigate to `/packing_options`
2. **Add New**: Click "Add New Packing Option" button
3. **Edit**: Click "Edit" button on any packing option
4. **Toggle Status**: Click "Enable/Disable" to activate/deactivate options
5. **Delete**: Click "Delete" to remove options (only if not used in orders)

#### Creating Packing Options
- **Title**: Required field for the packing option name
- **Description**: Optional detailed description
- **Cost**: Set to 0.00 for free packing, or enter the cost amount

### For Users

#### Selecting Packing Options in Orders
1. **Edit Order**: Go to order edit page
2. **Item Packing**: Each item has its own packing option dropdown
3. **Select Options**: Choose different packing options for each item
4. **View Descriptions**: Descriptions appear when options are selected
5. **Save Order**: Packing options are saved for each item

#### Reviewing Orders with Packing
1. **Order Review**: View order details
2. **Item Packing Info**: See selected packing option and cost for each item
3. **Packing Summary**: View total packing costs and breakdown
4. **Complete Order**: Packing information is included in final order

## API Methods

### Model Methods (m_orders.php)

```php
// Get all active packing options
getAllPackingOptions()

// Get packing option details by ID
getPackingOptionDetail($packing_id)

// Update order packing option
updateOrderPacking($order_number, $packing_id)

// Update order detail packing option
updateOrderDetailPacking($order_number, $item_id, $packing_id)

// Get order packing information
getOrderPacking($order_number)

// Get item-specific packing information for an order
getItemPackingInfo($order_number)

// Get packing information for a specific item in an order
getItemPackingDetail($order_number, $item_id)
```

### Controller Methods (packing_options.php)

```php
// List all packing options
index()

// Add new packing option
add()

// Edit existing packing option
edit($packing_id)

// Delete packing option
delete($packing_id)

// Toggle packing option status
toggle_status($packing_id)
```

## Default Packing Options

The system comes with 5 default packing options:

1. **Standard Packing** - Basic packing with bubble wrap and cardboard box ($5.00)
2. **Premium Packing** - Premium packing with extra protection and branded box ($15.00)
3. **Gift Packing** - Special gift packing with decorative wrapping ($10.00)
4. **Bulk Packing** - Economical packing for large quantities ($2.00)
5. **No Packing** - No additional packing required (Free)

## Customization

### Adding New Packing Options
1. Access the packing options management page
2. Click "Add New Packing Option"
3. Fill in the details and save

### Modifying Costs
1. Edit any existing packing option
2. Update the cost field
3. Save changes

### Custom Descriptions
1. Edit packing options to add detailed descriptions
2. Descriptions help users understand what each option includes

## Integration Points

### Order Management
- Packing options are integrated into the order editing workflow
- Packing costs can be included in order totals
- Packing information is displayed in order reviews

### Future Enhancements
- Item-specific packing options
- Bulk packing discounts
- Packing cost calculations in invoices
- Packing option analytics and reporting

## Security Considerations

- Packing options can only be deleted if not used in any orders
- Status toggling prevents accidental deletion
- Form validation ensures data integrity
- Access control should be implemented for admin functions

## Troubleshooting

### Common Issues

1. **Packing options not showing in edit order**
   - Check if packing options are active (status = 1)
   - Verify database connection and table structure

2. **Cannot delete packing option**
   - Check if the option is being used in any orders
   - Use the toggle status function instead of deletion

3. **Packing cost not displaying**
   - Verify the packing_cost field in the database
   - Check the view file for proper formatting

### Database Queries

```sql
-- Check packing options usage
SELECT po.packing_title, COUNT(o.order_id) as usage_count
FROM packing_options po
LEFT JOIN orders o ON po.packing_id = o.packing_id
GROUP BY po.packing_id;

-- Check active packing options
SELECT * FROM packing_options WHERE status = 1;
```

## Support

For technical support or feature requests related to the packing options feature, please refer to the main system documentation or contact the development team. 