<?php
/**
 * Orders Reports Model
 * 
 * Handles all data retrieval and calculations for orders reports
 */

class m_orders_reports extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Get total orders count
     */
    public function getTotalOrders($status = null) {
        if ($status) {
            $this->db->where('order_status', $status);
        }
        $this->db->from('orders');
        return $this->db->count_all_results();
    }

    /**
     * Get total sales amount
     */
    public function getTotalSales($status = 'confirm') {
        $this->db->select_sum('order_price');
        $this->db->where('order_status', $status);
        $query = $this->db->get('orders');
        $result = $query->row();
        return $result->order_price ?: 0;
    }

    /**
     * Get total shops count
     */
    public function getTotalShops() {
        $this->db->where('shop_status', 1);
        $this->db->from('shops');
        return $this->db->count_all_results();
    }

    /**
     * Get monthly sales data
     */
    public function getMonthlySales($year = null) {
        if (!$year) {
            $year = date('Y');
        }
        
        $this->db->select('MONTH(created_date) as month, SUM(order_price) as total_sales, COUNT(*) as order_count');
        $this->db->where('order_status', 'confirm');
        $this->db->where('YEAR(created_date)', $year);
        $this->db->group_by('MONTH(created_date)');
        $this->db->order_by('month', 'ASC');
        
        $query = $this->db->get('orders');
        return $query->result_array();
    }

    /**
     * Get top selling items
     */
    public function getTopSellingItems($limit = 10, $start_date = null, $end_date = null) {
        $this->db->select('i.item_name, i.item_code, SUM(o.order_quantity) as total_quantity, SUM(o.order_price) as total_sales, COUNT(*) as order_count');
        $this->db->from('orders o');
        $this->db->join('items i', 'i.item_id = o.item_fk', 'left');
        $this->db->where('o.order_status', 'confirm');
        
        if ($start_date && $end_date) {
            $this->db->where('o.created_date >=', $start_date);
            $this->db->where('o.created_date <=', $end_date . ' 23:59:59');
        }
        
        $this->db->group_by('o.item_fk');
        $this->db->order_by('total_quantity', 'DESC');
        $this->db->limit($limit);
        
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * Get recent orders
     */
    public function getRecentOrders($limit = 10) {
        $this->db->select('o.*, i.item_name, s.shop_name');
        $this->db->from('orders o');
        $this->db->join('items i', 'i.item_id = o.item_fk', 'left');
        $this->db->join('shops s', 's.shop_id = o.shop_id', 'left');
        $this->db->order_by('o.created_date', 'DESC');
        $this->db->limit($limit);
        
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * Get sales report with filters
     */
    public function getSalesReport($start_date = null, $end_date = null, $shop_id = null, $status = null) {
        $this->db->select('o.*, i.item_name, i.item_code, s.shop_name, u.name as created_by_name');
        $this->db->from('orders o');
        $this->db->join('items i', 'i.item_id = o.item_fk', 'left');
        $this->db->join('shops s', 's.shop_id = o.shop_id', 'left');
        $this->db->join('users u', 'u.users_id = o.created_by', 'left');
        
        if ($start_date && $end_date) {
            $this->db->where('o.created_date >=', $start_date);
            $this->db->where('o.created_date <=', $end_date . ' 23:59:59');
        }
        
        if ($shop_id) {
            $this->db->where('o.shop_id', $shop_id);
        }
        
        if ($status) {
            $this->db->where('o.order_status', $status);
        }
        
        $this->db->order_by('o.created_date', 'DESC');
        
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * Get sales summary
     */
    public function getSalesSummary($start_date = null, $end_date = null, $shop_id = null, $status = null) {
        $this->db->select('COUNT(*) as total_orders, SUM(order_price) as total_sales, SUM(order_quantity) as total_quantity, AVG(order_price) as avg_order_value');
        $this->db->from('orders');
        
        if ($start_date && $end_date) {
            $this->db->where('created_date >=', $start_date);
            $this->db->where('created_date <=', $end_date . ' 23:59:59');
        }
        
        if ($shop_id) {
            $this->db->where('shop_id', $shop_id);
        }
        
        if ($status) {
            $this->db->where('order_status', $status);
        }
        
        $query = $this->db->get();
        return $query->row_array();
    }

    /**
     * Get all shops
     */
    public function getAllShops() {
        $this->db->where('shop_status', 1);
        $this->db->order_by('shop_name', 'ASC');
        $query = $this->db->get('shops');
        return $query->result_array();
    }

    /**
     * Get shop information
     */
    public function getShopInfo($shop_id) {
        $this->db->where('shop_id', $shop_id);
        $query = $this->db->get('shops');
        return $query->row_array();
    }

    /**
     * Get shop orders
     */
    public function getShopOrders($shop_id, $start_date = null, $end_date = null) {
        $this->db->select('o.*, i.item_name, i.item_code');
        $this->db->from('orders o');
        $this->db->join('items i', 'i.item_id = o.item_fk', 'left');
        $this->db->where('o.shop_id', $shop_id);
        
        if ($start_date && $end_date) {
            $this->db->where('o.created_date >=', $start_date);
            $this->db->where('o.created_date <=', $end_date . ' 23:59:59');
        }
        
        $this->db->order_by('o.created_date', 'DESC');
        
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * Get shop summary
     */
    public function getShopSummary($shop_id, $start_date = null, $end_date = null) {
        $this->db->select('COUNT(*) as total_orders, SUM(order_price) as total_sales, SUM(order_quantity) as total_quantity, AVG(order_price) as avg_order_value');
        $this->db->from('orders');
        $this->db->where('shop_id', $shop_id);
        $this->db->where('order_status', 'confirm');
        
        if ($start_date && $end_date) {
            $this->db->where('created_date >=', $start_date);
            $this->db->where('created_date <=', $end_date . ' 23:59:59');
        }
        
        $query = $this->db->get();
        return $query->row_array();
    }

    /**
     * Get shop ledger
     */
    public function getShopLedger($shop_id, $start_date = null, $end_date = null) {
        $this->db->select('ol.*, po.payment_options_title');
        $this->db->from('order_ledger ol');
        $this->db->join('payment_options po', 'po.payment_option_id = ol.payment_method', 'left');
        $this->db->where('ol.order_number IN (SELECT DISTINCT order_number FROM orders WHERE shop_id = ' . $shop_id . ')');
        
        if ($start_date && $end_date) {
            $this->db->where('ol.date >=', $start_date);
            $this->db->where('ol.date <=', $end_date . ' 23:59:59');
        }
        
        $this->db->order_by('ol.date', 'DESC');
        
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * Get item information
     */
    public function getItemInfo($item_id) {
        $this->db->select('i.*, c.category_name');
        $this->db->from('items i');
        $this->db->join('categories c', 'c.category_id = i.item_cat_fk', 'left');
        $this->db->where('i.item_id', $item_id);
        $query = $this->db->get();
        return $query->row_array();
    }

    /**
     * Get item sales
     */
    public function getItemSales($item_id, $start_date = null, $end_date = null) {
        $this->db->select('o.*, s.shop_name, u.name as created_by_name');
        $this->db->from('orders o');
        $this->db->join('shops s', 's.shop_id = o.shop_id', 'left');
        $this->db->join('users u', 'u.users_id = o.created_by', 'left');
        $this->db->where('o.item_fk', $item_id);
        $this->db->where('o.order_status', 'confirm');
        
        if ($start_date && $end_date) {
            $this->db->where('o.created_date >=', $start_date);
            $this->db->where('o.created_date <=', $end_date . ' 23:59:59');
        }
        
        $this->db->order_by('o.created_date', 'DESC');
        
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * Get item summary
     */
    public function getItemSummary($item_id, $start_date = null, $end_date = null) {
        $this->db->select('COUNT(*) as total_orders, SUM(order_price) as total_sales, SUM(order_quantity) as total_quantity, AVG(order_price) as avg_price');
        $this->db->from('orders');
        $this->db->where('item_fk', $item_id);
        $this->db->where('order_status', 'confirm');
        
        if ($start_date && $end_date) {
            $this->db->where('created_date >=', $start_date);
            $this->db->where('created_date <=', $end_date . ' 23:59:59');
        }
        
        $query = $this->db->get();
        return $query->row_array();
    }

    /**
     * Get all items
     */
    public function getAllItems() {
        $this->db->where('item_status', 1);
        $this->db->order_by('item_name', 'ASC');
        $query = $this->db->get('items');
        return $query->result_array();
    }

    /**
     * Get all categories
     */
    public function getAllCategories() {
        $this->db->where('category_status', 1);
        $this->db->order_by('category_name', 'ASC');
        $query = $this->db->get('categories');
        return $query->result_array();
    }

    /**
     * Get date range report
     */
    public function getDateRangeReport($start_date, $end_date, $group_by = 'day') {
        switch ($group_by) {
            case 'day':
                $this->db->select('DATE(created_date) as date_group, COUNT(*) as order_count, SUM(order_price) as total_sales, SUM(order_quantity) as total_quantity');
                $this->db->group_by('DATE(created_date)');
                break;
            case 'week':
                $this->db->select('YEARWEEK(created_date) as date_group, COUNT(*) as order_count, SUM(order_price) as total_sales, SUM(order_quantity) as total_quantity');
                $this->db->group_by('YEARWEEK(created_date)');
                break;
            case 'month':
                $this->db->select('DATE_FORMAT(created_date, "%Y-%m") as date_group, COUNT(*) as order_count, SUM(order_price) as total_sales, SUM(order_quantity) as total_quantity');
                $this->db->group_by('DATE_FORMAT(created_date, "%Y-%m")');
                break;
        }
        
        $this->db->from('orders');
        $this->db->where('order_status', 'confirm');
        $this->db->where('created_date >=', $start_date);
        $this->db->where('created_date <=', $end_date . ' 23:59:59');
        $this->db->order_by('date_group', 'ASC');
        
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * Get date range summary
     */
    public function getDateRangeSummary($start_date, $end_date) {
        $this->db->select('COUNT(*) as total_orders, SUM(order_price) as total_sales, SUM(order_quantity) as total_quantity, AVG(order_price) as avg_order_value');
        $this->db->from('orders');
        $this->db->where('order_status', 'confirm');
        $this->db->where('created_date >=', $start_date);
        $this->db->where('created_date <=', $end_date . ' 23:59:59');
        
        $query = $this->db->get();
        return $query->row_array();
    }

    /**
     * Get payment report
     */
    public function getPaymentReport($start_date = null, $end_date = null, $payment_method = null, $shop_id = null) {
        $this->db->select('ol.*, po.payment_options_title, o.order_number, s.shop_name');
        $this->db->from('order_ledger ol');
        $this->db->join('payment_options po', 'po.payment_option_id = ol.payment_method', 'left');
        $this->db->join('orders o', 'o.order_number = ol.order_number', 'left');
        $this->db->join('shops s', 's.shop_id = o.shop_id', 'left');
        
        if ($start_date && $end_date) {
            $this->db->where('ol.date >=', $start_date);
            $this->db->where('ol.date <=', $end_date . ' 23:59:59');
        }
        
        if ($payment_method) {
            $this->db->where('ol.payment_method', $payment_method);
        }
        
        if ($shop_id) {
            $this->db->where('o.shop_id', $shop_id);
        }
        
        $this->db->order_by('ol.date', 'DESC');
        
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * Get payment summary
     */
    public function getPaymentSummary($start_date = null, $end_date = null, $payment_method = null, $shop_id = null) {
        $this->db->select('ol.payment_method, po.payment_options_title, COUNT(*) as transaction_count, SUM(CASE WHEN ol.type = "credit" THEN ol.amount ELSE 0 END) as total_credit, SUM(CASE WHEN ol.type = "debit" THEN ol.amount ELSE 0 END) as total_debit');
        $this->db->from('order_ledger ol');
        $this->db->join('payment_options po', 'po.payment_option_id = ol.payment_method', 'left');
        $this->db->join('orders o', 'o.order_number = ol.order_number', 'left');
        
        if ($start_date && $end_date) {
            $this->db->where('ol.date >=', $start_date);
            $this->db->where('ol.date <=', $end_date . ' 23:59:59');
        }
        
        if ($payment_method) {
            $this->db->where('ol.payment_method', $payment_method);
        }
        
        if ($shop_id) {
            $this->db->where('o.shop_id', $shop_id);
        }
        
        $this->db->group_by('ol.payment_method');
        
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * Get payment methods
     */
    public function getPaymentMethods() {
        $this->db->where('status', 1);
        $this->db->order_by('payment_options_title', 'ASC');
        $query = $this->db->get('payment_options');
        return $query->result_array();
    }

    /**
     * Get sales trend
     */
    public function getSalesTrend($months = 12) {
        $this->db->select('DATE_FORMAT(created_date, "%Y-%m") as month, SUM(order_price) as total_sales, COUNT(*) as order_count');
        $this->db->from('orders');
        $this->db->where('order_status', 'confirm');
        $this->db->where('created_date >=', date('Y-m-01', strtotime('-' . ($months - 1) . ' months')));
        $this->db->group_by('DATE_FORMAT(created_date, "%Y-%m")');
        $this->db->order_by('month', 'ASC');
        
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * Get top shops
     */
    public function getTopShops($limit = 10) {
        $this->db->select('s.shop_name, COUNT(o.order_id) as order_count, SUM(o.order_price) as total_sales');
        $this->db->from('orders o');
        $this->db->join('shops s', 's.shop_id = o.shop_id', 'left');
        $this->db->where('o.order_status', 'confirm');
        $this->db->group_by('o.shop_id');
        $this->db->order_by('total_sales', 'DESC');
        $this->db->limit($limit);
        
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * Get monthly comparison
     */
    public function getMonthlyComparison() {
        $current_month = date('Y-m');
        $previous_month = date('Y-m', strtotime('-1 month'));
        
        $this->db->select('DATE_FORMAT(created_date, "%Y-%m") as month, SUM(order_price) as total_sales, COUNT(*) as order_count');
        $this->db->from('orders');
        $this->db->where('order_status', 'confirm');
        $this->db->where_in('DATE_FORMAT(created_date, "%Y-%m")', array($current_month, $previous_month));
        $this->db->group_by('DATE_FORMAT(created_date, "%Y-%m")');
        
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * Get payment analytics
     */
    public function getPaymentAnalytics() {
        $this->db->select('po.payment_options_title, COUNT(ol.ledger_id) as transaction_count, SUM(ol.amount) as total_amount');
        $this->db->from('order_ledger ol');
        $this->db->join('payment_options po', 'po.payment_option_id = ol.payment_method', 'left');
        $this->db->where('ol.type', 'credit');
        $this->db->group_by('ol.payment_method');
        $this->db->order_by('total_amount', 'DESC');
        
        $query = $this->db->get();
        return $query->result_array();
    }
} 