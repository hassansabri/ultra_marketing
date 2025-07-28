<?php
// reference the Dompdf namespace
use Dompdf\Dompdf;
/**
 * Orders Reports Controller
 * 
 * @property m_orders_reports $model_reports
 * @property CI_Session $session
 * @property CI_Input $input
 * @property CI_Form_validation $form_validation
 */

class orders_reports extends CI_Controller {

    public $data = array();

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
        $this->load->model("orders/m_orders_reports", "model_reports");
        $this->load->library('form_validation');
    }

    /**
     * Main reports dashboard
     */
    public function index() {
        $this->data['page_title'] = 'Orders Reports Dashboard';
        $this->data['total_orders'] = $this->model_reports->getTotalOrders();
        $this->data['total_sales'] = $this->model_reports->getTotalSales();
        $this->data['total_shops'] = $this->model_reports->getTotalShops();
        $this->data['monthly_sales'] = $this->model_reports->getMonthlySales();
        $this->data['top_items'] = $this->model_reports->getTopSellingItems(5);
        $this->data['recent_orders'] = $this->model_reports->getRecentOrders(10);
        
        $this->load->view('orders_reports/dashboard', $this->data);
    }

    /**
     * Sales reports with filters
     */
    public function sales_report() {
        $this->data['page_title'] = 'Sales Report';
        
        // Get filter parameters
        $start_date = $this->input->get('start_date') ?: date('Y-m-01');
        $end_date = $this->input->get('end_date') ?: date('Y-m-t');
        $shop_id = $this->input->get('shop_id');
        $status = $this->input->get('status');
        
        $this->data['filters'] = array(
            'start_date' => $start_date,
            'end_date' => $end_date,
            'shop_id' => $shop_id,
            'status' => $status
        );
        
        // Get report data
        $this->data['sales_data'] = $this->model_reports->getSalesReport($start_date, $end_date, $shop_id, $status);
        $this->data['summary'] = $this->model_reports->getSalesSummary($start_date, $end_date, $shop_id, $status);
        $this->data['all_shops'] = $this->model_reports->getAllShops();
        
        $this->load->view('orders_reports/sales_report', $this->data);
    }

    /**
     * Shop-wise reports
     */
    public function shop_report() {
        $this->data['page_title'] = 'Shop Report';
        
        $shop_id = $this->input->get('shop_id');
        $start_date = $this->input->get('start_date') ?: date('Y-m-01');
        $end_date = $this->input->get('end_date') ?: date('Y-m-t');
        
        $this->data['filters'] = array(
            'shop_id' => $shop_id,
            'start_date' => $start_date,
            'end_date' => $end_date
        );
        
        if ($shop_id) {
            $this->data['shop_info'] = $this->model_reports->getShopInfo($shop_id);
            $this->data['shop_orders'] = $this->model_reports->getShopOrders($shop_id, $start_date, $end_date);
            $this->data['shop_summary'] = $this->model_reports->getShopSummary($shop_id, $start_date, $end_date);
            $this->data['shop_ledger'] = $this->model_reports->getShopLedger($shop_id, $start_date, $end_date);
        }
        
        $this->data['all_shops'] = $this->model_reports->getAllShops();
        $this->load->view('orders_reports/shop_report', $this->data);
    }

    /**
     * Item performance reports
     */
    public function item_report() {
        $this->data['page_title'] = 'Item Performance Report';
        
        $item_id = $this->input->get('item_id');
        $start_date = $this->input->get('start_date') ?: date('Y-m-01');
        $end_date = $this->input->get('end_date') ?: date('Y-m-t');
        $category_id = $this->input->get('category_id');
        
        $this->data['filters'] = array(
            'item_id' => $item_id,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'category_id' => $category_id
        );
        
        if ($item_id) {
            $this->data['item_info'] = $this->model_reports->getItemInfo($item_id);
            $this->data['item_sales'] = $this->model_reports->getItemSales($item_id, $start_date, $end_date);
            $this->data['item_summary'] = $this->model_reports->getItemSummary($item_id, $start_date, $end_date);
        }
        
        $this->data['all_items'] = $this->model_reports->getAllItems();
        $this->data['all_categories'] = $this->model_reports->getAllCategories();
        $this->data['top_items'] = $this->model_reports->getTopSellingItems(10, $start_date, $end_date);
        
        $this->load->view('orders_reports/item_report', $this->data);
    }

    /**
     * Date range reports
     */
    public function date_range_report() {
        $this->data['page_title'] = 'Date Range Report';
        
        $start_date = $this->input->get('start_date') ?: date('Y-m-01');
        $end_date = $this->input->get('end_date') ?: date('Y-m-t');
        $group_by = $this->input->get('group_by') ?: 'day';
        
        $this->data['filters'] = array(
            'start_date' => $start_date,
            'end_date' => $end_date,
            'group_by' => $group_by
        );
        
        $this->data['date_range_data'] = $this->model_reports->getDateRangeReport($start_date, $end_date, $group_by);
        $this->data['summary'] = $this->model_reports->getDateRangeSummary($start_date, $end_date);
        
        $this->load->view('orders_reports/date_range_report', $this->data);
    }

    /**
     * Payment reports
     */
    public function payment_report() {
        $this->data['page_title'] = 'Payment Report';
        
        $start_date = $this->input->get('start_date') ?: date('Y-m-01');
        $end_date = $this->input->get('end_date') ?: date('Y-m-t');
        $payment_method = $this->input->get('payment_method');
        $shop_id = $this->input->get('shop_id');
        
        $this->data['filters'] = array(
            'start_date' => $start_date,
            'end_date' => $end_date,
            'payment_method' => $payment_method,
            'shop_id' => $shop_id
        );
        
        $this->data['payment_data'] = $this->model_reports->getPaymentReport($start_date, $end_date, $payment_method, $shop_id);
        $this->data['payment_summary'] = $this->model_reports->getPaymentSummary($start_date, $end_date, $payment_method, $shop_id);
        $this->data['payment_methods'] = $this->model_reports->getPaymentMethods();
        $this->data['all_shops'] = $this->model_reports->getAllShops();
        
        $this->load->view('orders_reports/payment_report', $this->data);
    }

    /**
     * Export reports to CSV/Excel
     */
    public function export_report() {
        $report_type = $this->input->get('type');
        $start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');
        $shop_id = $this->input->get('shop_id');
        
        switch ($report_type) {
            case 'sales':
                $data = $this->model_reports->getSalesReport($start_date, $end_date, $shop_id);
                $filename = 'sales_report_' . date('Y-m-d') . '.csv';
                break;
            case 'shop':
                $data = $this->model_reports->getShopOrders($shop_id, $start_date, $end_date);
                $filename = 'shop_report_' . date('Y-m-d') . '.csv';
                break;
            case 'item':
                $item_id = $this->input->get('item_id');
                $data = $this->model_reports->getItemSales($item_id, $start_date, $end_date);
                $filename = 'item_report_' . date('Y-m-d') . '.csv';
                break;
            default:
                redirect('orders_reports');
                return;
        }
        
        $this->export_to_csv($data, $filename);
    }

    /**
     * Generate PDF reports
     */
    public function pdf_report() {
        $report_type = $this->input->get('type');
        $start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');
        $shop_id = $this->input->get('shop_id');
        
        // Load PDF library
        $this->load->library('pdf');
        
        try {
            switch ($report_type) {
                case 'sales':
                    $this->data['sales_data'] = $this->model_reports->getSalesReport($start_date, $end_date, $shop_id);
                    $this->data['summary'] = $this->model_reports->getSalesSummary($start_date, $end_date, $shop_id);
                    $html = $this->load->view('orders_reports/pdf_sales_report', $this->data, true);
                    $filename = 'sales_report_' . date('Y-m-d') . '.pdf';
                    break;
                case 'shop':
                    if (!$shop_id) {
                        throw new Exception('Shop ID is required for shop reports');
                    }
                    $this->data['shop_info'] = $this->model_reports->getShopInfo($shop_id);
                    $this->data['shop_orders'] = $this->model_reports->getShopOrders($shop_id, $start_date, $end_date);
                    $this->data['shop_summary'] = $this->model_reports->getShopSummary($shop_id, $start_date, $end_date);
                    $this->data['shop_ledger'] = $this->model_reports->getShopLedger($shop_id, $start_date, $end_date);
                    $html = $this->load->view('orders_reports/pdf_shop_report', $this->data, true);
                    $filename = 'shop_report_' . $shop_id . '_' . date('Y-m-d') . '.pdf';
                    break;
                default:
                    redirect('orders_reports');
                    return;
            }
            
            // Generate PDF
            $this->pdf->createPDF($html, $filename, true);
            
        } catch (Exception $e) {
            // Log the error
            log_message('error', 'PDF generation failed: ' . $e->getMessage());
            
            // Show user-friendly error message
            $this->session->set_flashdata('error', 'PDF generation failed. Please try again or contact support.');
            redirect('orders_reports/' . $report_type . '_report');
        }
    }

    /**
     * Analytics and insights
     */
    public function analytics() {
        $this->data['page_title'] = 'Analytics & Insights';
        
        // Get analytics data
        $this->data['sales_trend'] = $this->model_reports->getSalesTrend();
        $this->data['top_shops'] = $this->model_reports->getTopShops();
        $this->data['top_items'] = $this->model_reports->getTopSellingItems(10);
        $this->data['monthly_comparison'] = $this->model_reports->getMonthlyComparison();
        $this->data['payment_analytics'] = $this->model_reports->getPaymentAnalytics();
        
        $this->load->view('orders_reports/analytics', $this->data);
    }

    /**
     * Helper function to export data to CSV
     */
    private function export_to_csv($data, $filename) {
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        
        $output = fopen('php://output', 'w');
        
        if (!empty($data)) {
            // Write headers
            fputcsv($output, array_keys($data[0]));
            
            // Write data
            foreach ($data as $row) {
                fputcsv($output, $row);
            }
        }
        
        fclose($output);
        exit;
    }
} 