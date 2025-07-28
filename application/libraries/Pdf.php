<?php
/**
 * PDF Library for CodeIgniter using DOMPDF
 * 
 * This library provides PDF generation functionality using DOMPDF
 */

class Pdf {
    
    private $dompdf;
    
    public function __construct() {
        // Check if dompdf is available
        if (!class_exists('Dompdf\Dompdf')) {
            // Try to autoload from vendor directory
            $vendor_path = FCPATH . 'vendor/autoload.php';
            if (file_exists($vendor_path)) {
                require_once $vendor_path;
            } else {
                // Fallback to simple HTML if dompdf is not available
                log_message('error', 'DOMPDF not found. Using fallback HTML generation.');
                $this->dompdf = null;
                return;
            }
        }
        
        // Check if DOMPDF class is now available
        if (!class_exists('Dompdf\Dompdf')) {
            log_message('error', 'DOMPDF class not found even after autoload. Using fallback HTML generation.');
            $this->dompdf = null;
            return;
        }
        
        try {
            // Initialize DOMPDF
            $this->dompdf = new \Dompdf\Dompdf();
            
            // Configure DOMPDF options
            $this->dompdf->setOptions(new \Dompdf\Options([
                'isHtml5ParserEnabled' => true,
                'isPhpEnabled' => true,
                'isRemoteEnabled' => true,
                'defaultFont' => 'Arial',
                'defaultPaperSize' => 'A4',
                'defaultPaperOrientation' => 'portrait'
            ]));
        } catch (Exception $e) {
            log_message('error', 'Failed to initialize DOMPDF: ' . $e->getMessage());
            $this->dompdf = null;
        }
    }
    
    /**
     * Create PDF from HTML content
     * 
     * @param string $html HTML content to convert
     * @param string $filename Output filename
     * @param bool $download Whether to download or display
     */
    public function createPDF($html, $filename = 'document.pdf', $download = true) {
        // If dompdf is not available, use fallback
        if (!$this->dompdf) {
            $this->createFallbackPDF($html, $filename, $download);
            return;
        }
        
        try {
            // Prepare HTML with proper styling
            $html_content = $this->prepareHTML($html, $filename);
            
            // Load HTML into DOMPDF
            $this->dompdf->loadHtml($html_content);
            
            // Render PDF
            $this->dompdf->render();
            
            // Output PDF
            if ($download) {
                $this->dompdf->stream($filename, array('Attachment' => 1));
            } else {
                $this->dompdf->stream($filename, array('Attachment' => 0));
            }
        } catch (Exception $e) {
            log_message('error', 'DOMPDF generation failed: ' . $e->getMessage());
            $this->createFallbackPDF($html, $filename, $download);
        }
    }
    
    /**
     * Generate a simple table PDF
     * 
     * @param array $data Table data
     * @param array $headers Table headers
     * @param string $title Report title
     * @param string $filename Output filename
     */
    public function generateTablePDF($data, $headers, $title, $filename = 'report.pdf') {
        $html = '<h2>' . $title . '</h2>';
        
        if (!empty($data)) {
            $html .= '<table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">';
            
            // Headers
            $html .= '<tr style="background-color: #f2f2f2;">';
            foreach ($headers as $header) {
                $html .= '<th style="border: 1px solid #ddd; padding: 8px; text-align: left; font-weight: bold;">' . $header . '</th>';
            }
            $html .= '</tr>';
            
            // Data rows
            foreach ($data as $row) {
                $html .= '<tr>';
                foreach ($row as $cell) {
                    $html .= '<td style="border: 1px solid #ddd; padding: 8px; text-align: left;">' . $cell . '</td>';
                }
                $html .= '</tr>';
            }
            
            $html .= '</table>';
        } else {
            $html .= '<p>No data available</p>';
        }
        
        $this->createPDF($html, $filename);
    }
    
    /**
     * Prepare HTML content with proper styling for PDF
     * 
     * @param string $html Raw HTML content
     * @param string $title Document title
     * @return string Formatted HTML
     */
    private function prepareHTML($html, $title) {
        return '
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <title>' . $title . '</title>
            <style>
                body { 
                    font-family: Arial, sans-serif; 
                    margin: 20px; 
                    font-size: 12px;
                    line-height: 1.4;
                }
                table { 
                    width: 100%; 
                    border-collapse: collapse; 
                    margin-bottom: 20px; 
                    font-size: 11px;
                }
                th, td { 
                    border: 1px solid #ddd; 
                    padding: 6px; 
                    text-align: left; 
                    vertical-align: top;
                }
                th { 
                    background-color: #f2f2f2; 
                    font-weight: bold; 
                    font-size: 11px;
                }
                h1, h2, h3 { 
                    color: #333; 
                    margin-bottom: 10px; 
                    margin-top: 20px;
                }
                h1 { font-size: 18px; }
                h2 { font-size: 16px; }
                h3 { font-size: 14px; }
                .header { 
                    text-align: center; 
                    margin-bottom: 30px; 
                    border-bottom: 2px solid #333;
                    padding-bottom: 10px;
                }
                .summary { 
                    margin-bottom: 20px; 
                    background-color: #f9f9f9;
                    padding: 10px;
                    border-radius: 5px;
                }
                .footer { 
                    margin-top: 30px; 
                    text-align: center; 
                    font-size: 10px; 
                    color: #666; 
                    border-top: 1px solid #ddd;
                    padding-top: 10px;
                }
                .text-right { text-align: right; }
                .text-center { text-align: center; }
                .text-bold { font-weight: bold; }
                .currency { font-family: monospace; }
                @page {
                    margin: 1cm;
                    size: A4;
                }
            </style>
        </head>
        <body>
            <div class="header">
                <h1>Ultra Marketing - Reports</h1>
                <p>Generated on: ' . date('Y-m-d H:i:s') . '</p>
            </div>
            
            ' . $html . '
            
            <div class="footer">
                <p>This report was generated by Ultra Marketing System</p>
                <p>Page {PAGENO} of {nbpg}</p>
            </div>
        </body>
        </html>';
    }
    
    /**
     * Fallback PDF generation using simple HTML
     * 
     * @param string $html HTML content
     * @param string $filename Output filename
     * @param bool $download Whether to download or display
     */
    private function createFallbackPDF($html, $filename, $download) {
        $html_content = $this->prepareHTML($html, $filename);
        
        if ($download) {
            header('Content-Type: application/pdf');
            header('Content-Disposition: attachment; filename="' . $filename . '"');
        } else {
            header('Content-Type: text/html');
        }
        
        echo $html_content;
        exit;
    }
    
    /**
     * Set PDF options
     * 
     * @param array $options DOMPDF options
     */
    public function setOptions($options) {
        if ($this->dompdf) {
            $this->dompdf->setOptions(new \Dompdf\Options($options));
        }
    }
    
    /**
     * Set paper size and orientation
     * 
     * @param string $size Paper size (A4, Letter, etc.)
     * @param string $orientation Paper orientation (portrait, landscape)
     */
    public function setPaper($size = 'A4', $orientation = 'portrait') {
        if ($this->dompdf) {
            $this->dompdf->setPaper($size, $orientation);
        }
    }
} 