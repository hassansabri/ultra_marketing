# Orders Reports System

## Overview

The Orders Reports System is a comprehensive reporting solution for the Ultra Marketing application that provides detailed analytics, insights, and data visualization for order management, sales tracking, and business performance monitoring.

## Features

### 📊 Dashboard
- **Overview Statistics**: Total orders, sales, shops, and recent activity
- **Monthly Sales Trend**: Visual chart showing sales performance over time
- **Top Selling Items**: List of best-performing products
- **Recent Orders**: Latest order activity with quick access links

### 📈 Sales Reports
- **Filtered Reports**: Date range, shop, and status filtering
- **Summary Statistics**: Total orders, sales, quantities, and average order values
- **Detailed Data Table**: Complete sales data with export capabilities
- **Export Options**: CSV and PDF export functionality

### 🏪 Shop Reports
- **Shop Information**: Complete shop details and contact information
- **Shop Performance**: Orders, sales, and quantity summaries
- **Shop Ledger**: Payment transactions and balance tracking
- **Individual Shop Analysis**: Detailed breakdown by shop

### 📦 Item Reports
- **Item Performance**: Sales analysis for individual items
- **Top Items Ranking**: Best-selling products with metrics
- **Category Filtering**: Filter by product categories
- **Item Sales History**: Complete transaction history per item

### 💳 Payment Reports
- **Payment Method Analysis**: Breakdown by payment type
- **Transaction History**: Complete payment records
- **Payment Summary**: Credit/debit analysis with running balances
- **Method Performance**: Transaction counts and amounts per method

### 📅 Date Range Reports
- **Flexible Grouping**: Daily, weekly, or monthly views
- **Trend Analysis**: Sales and order trends over time
- **Growth Tracking**: Percentage growth calculations
- **Quick Presets**: Common date ranges (this month, last month, etc.)

### 📊 Analytics & Insights
- **Sales Trends**: 12-month sales trend visualization
- **Top Performers**: Best shops and items
- **Monthly Comparisons**: Period-over-period analysis
- **Payment Analytics**: Payment method distribution charts

## File Structure

```
application/
├── controllers/
│   └── orders_reports.php          # Main reports controller
├── models/
│   └── orders/
│       └── m_orders_reports.php    # Reports data model
├── views/
│   └── orders_reports/
│       ├── dashboard.php           # Main dashboard view
│       ├── sales_report.php        # Sales reports view
│       ├── shop_report.php         # Shop reports view
│       ├── item_report.php         # Item reports view
│       ├── payment_report.php      # Payment reports view
│       ├── date_range_report.php   # Date range reports view
│       └── analytics.php           # Analytics dashboard view
└── libraries/
    └── Pdf.php                     # PDF generation library
```

## Installation

1. **Copy Files**: Ensure all files are placed in their correct directories
2. **Database**: The system uses existing database tables (orders, shops, items, etc.)
3. **Navigation**: The reports menu is automatically added to the left navigation panel
4. **Permissions**: Access is controlled by the existing login system

## Usage

### Accessing Reports

1. **Login** to the Ultra Marketing system
2. **Navigate** to "Reports & Analytics" in the left menu
3. **Select** the desired report type from the dropdown menu

### Report Features

#### Filters
- **Date Range**: Select start and end dates for data filtering
- **Shop Filter**: Filter data by specific shops
- **Status Filter**: Filter by order status (draft/confirmed)
- **Payment Method**: Filter by payment type
- **Category**: Filter items by category

#### Export Options
- **CSV Export**: Download data in CSV format for Excel analysis
- **PDF Export**: Generate printable PDF reports
- **Print**: Use browser print function for hard copies

#### Data Visualization
- **Charts**: Interactive charts using Chart.js
- **Tables**: Sortable and searchable data tables
- **Summary Cards**: Key metrics displayed prominently
- **Progress Bars**: Visual representation of percentages

## API Endpoints

### Controller Methods

- `index()` - Dashboard overview
- `sales_report()` - Sales analysis reports
- `shop_report()` - Shop-specific reports
- `item_report()` - Item performance reports
- `payment_report()` - Payment transaction reports
- `date_range_report()` - Time-based reports
- `analytics()` - Business insights and trends
- `export_report()` - CSV export functionality
- `pdf_report()` - PDF generation

### Model Methods

- `getTotalOrders()` - Count total orders
- `getTotalSales()` - Calculate total sales
- `getSalesReport()` - Generate sales data
- `getShopOrders()` - Get shop-specific orders
- `getItemSales()` - Get item sales data
- `getPaymentReport()` - Get payment transactions
- `getDateRangeReport()` - Get time-based data
- `getTopSellingItems()` - Get best-performing items
- `getTopShops()` - Get best-performing shops

## Customization

### Adding New Reports

1. **Create Controller Method**: Add new method in `orders_reports.php`
2. **Create Model Method**: Add data retrieval method in `m_orders_reports.php`
3. **Create View**: Add new view file in `views/orders_reports/`
4. **Update Navigation**: Add menu item in `views/common/header.php`

### Styling

The system uses:
- **Bootstrap**: For responsive layout and components
- **Font Awesome**: For icons
- **Chart.js**: For data visualization
- **DataTables**: For interactive tables
- **Custom CSS**: For specific styling

### Database Queries

All queries are optimized for performance and include:
- Proper JOIN statements
- Indexed column usage
- Efficient date filtering
- Aggregation functions for summaries

## Security

- **Authentication**: All reports require user login
- **Session Management**: Uses existing session system
- **Input Validation**: All user inputs are validated
- **SQL Injection Protection**: Uses CodeIgniter's query builder

## Performance

- **Optimized Queries**: Efficient database queries with proper indexing
- **Pagination**: Large datasets are paginated
- **Caching**: Consider implementing caching for frequently accessed reports
- **Lazy Loading**: Charts and data load as needed

## Browser Compatibility

- **Modern Browsers**: Chrome, Firefox, Safari, Edge
- **Responsive Design**: Works on desktop, tablet, and mobile
- **JavaScript**: Requires JavaScript for interactive features
- **Print Support**: Optimized for printing reports

## Troubleshooting

### Common Issues

1. **No Data Displayed**: Check date filters and ensure data exists
2. **Charts Not Loading**: Verify Chart.js is loaded and check browser console
3. **Export Not Working**: Check file permissions and PHP memory limits
4. **Slow Performance**: Consider database indexing and query optimization

### Debug Mode

Enable CodeIgniter debug mode to see:
- Database queries
- Error messages
- Performance metrics

## Future Enhancements

- **Real-time Updates**: Live data refresh capabilities
- **Advanced Filtering**: More complex filter combinations
- **Scheduled Reports**: Automated report generation and email delivery
- **Custom Dashboards**: User-configurable dashboard layouts
- **Mobile App**: Native mobile application for reports
- **API Integration**: REST API for external system integration

## Support

For technical support or feature requests:
1. Check the existing documentation
2. Review the code comments
3. Test with sample data
4. Contact the development team

---

**Version**: 1.0  
**Last Updated**: July 2025  
**Compatibility**: Ultra Marketing System v1.0+ 