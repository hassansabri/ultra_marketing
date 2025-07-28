# DOMPDF Setup Instructions

This document provides instructions for setting up DOMPDF for PDF generation in the Ultra Marketing system.

## Prerequisites

1. **PHP**: Make sure PHP is installed and available in your system PATH
2. **Composer**: Make sure Composer is installed on your system
3. **XAMPP**: The project is running on XAMPP, so PHP should be available at `C:\xampp\php\php.exe`

## Installation Steps

### 1. Add PHP to System PATH (Windows)

1. Open System Properties (Win + Pause/Break)
2. Click "Advanced system settings"
3. Click "Environment Variables"
4. Under "System variables", find and select "Path"
5. Click "Edit"
6. Click "New" and add: `C:\xampp\php`
7. Click "OK" on all dialogs
8. Restart your command prompt/terminal

### 2. Install DOMPDF via Composer

Open a command prompt/terminal in your project directory and run:

```bash
composer require dompdf/dompdf
```

### 3. Verify Installation

After installation, you should see:
- A `vendor` directory in your project root
- `dompdf/dompdf` listed in `composer.json`
- The `vendor/autoload.php` file should exist

## Configuration

The PDF library has been configured to automatically:
- Load DOMPDF from the vendor directory
- Set default options for HTML5 parsing, PHP execution, and remote content
- Use Arial font and A4 paper size
- Provide fallback HTML generation if DOMPDF is not available

## Usage

The PDF functionality is now available throughout the application:

### In Controllers:
```php
// The PDF library is autoloaded, so you can use it directly
$this->pdf->createPDF($html_content, 'filename.pdf', true);
```

### Available Methods:
- `createPDF($html, $filename, $download)` - Create PDF from HTML
- `generateTablePDF($data, $headers, $title, $filename)` - Generate table PDF
- `setOptions($options)` - Set DOMPDF options
- `setPaper($size, $orientation)` - Set paper size and orientation

## Testing

1. Go to any report page (Sales Report, Shop Report, etc.)
2. Click the "Export PDF" button
3. The PDF should download with proper formatting

## Troubleshooting

### If PHP is not found:
- Make sure PHP is in your system PATH
- Try running: `C:\xampp\php\php.exe composer require dompdf/dompdf`

### If DOMPDF doesn't load:
- Check that the `vendor` directory exists
- Verify `vendor/autoload.php` exists
- Check PHP error logs for any issues

### If PDF generation fails:
- The system will fall back to HTML generation
- Check the browser's developer console for errors
- Verify that the HTML content is valid

## Features

The updated PDF system includes:
- Professional PDF generation using DOMPDF
- Fallback HTML generation if DOMPDF is unavailable
- Proper styling for tables, headers, and content
- Page numbering and headers/footers
- Currency formatting
- Responsive table layouts
- Print-friendly styling

## File Structure

```
application/
├── libraries/
│   └── Pdf.php (Updated with DOMPDF support)
├── views/orders_reports/
│   ├── pdf_sales_report.php (PDF template for sales)
│   └── pdf_shop_report.php (PDF template for shops)
└── config/
    └── autoload.php (PDF library autoloaded)

vendor/ (Created by Composer)
└── dompdf/dompdf/ (DOMPDF library)

composer.json (Updated with DOMPDF dependency)
```

## Notes

- The system will work even without DOMPDF installed (fallback mode)
- PDF generation is much faster and more reliable with DOMPDF
- All existing PDF export buttons will work with the new system
- The styling is optimized for both screen viewing and printing 