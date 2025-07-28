<?php $this->load->view('common/header'); ?>

<div id="main" role="main">
    <!-- MAIN CONTENT -->
    <div id="content">
        <!-- widget grid -->
        <section id="widget-grid" class="">
            <!-- row -->
            <div class="row">
                <!-- NEW WIDGET START -->
                <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <!-- Widget ID (each widget will need unique ID)-->
                    <div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-0" data-widget-editbutton="false">
                        <header>
                            <span class="widget-icon"> <i class="fa fa-box"></i> </span>
                            <h2><?php echo $page_title; ?></h2>
                        </header>

                        <!-- widget div-->
                        <div>
                            <!-- widget edit box -->
                            <div class="jarviswidget-editbox">
                                <!-- This area used as dropdown edit box -->
                            </div>
                            <!-- end widget edit box -->

                            <!-- widget content -->
                            <div class="widget-body">
                                <!-- Filters Section -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h3 class="panel-title"><i class="fa fa-filter"></i> Filters</h3>
                                            </div>
                                            <div class="panel-body">
                                                <form method="GET" action="<?php echo site_url('orders_reports/item_report'); ?>" class="form-horizontal">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label class="control-label">Select Item:</label>
                                                                <select name="item_id" class="form-control">
                                                                    <option value="">All Items</option>
                                                                    <?php foreach ($all_items as $item): ?>
                                                                        <option value="<?php echo $item['item_id']; ?>" 
                                                                                <?php echo ($filters['item_id'] == $item['item_id']) ? 'selected' : ''; ?>>
                                                                            <?php echo $item['item_name']; ?> (<?php echo $item['item_code']; ?>)
                                                                        </option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label class="control-label">Category:</label>
                                                                <select name="category_id" class="form-control">
                                                                    <option value="">All Categories</option>
                                                                    <?php foreach ($all_categories as $category): ?>
                                                                        <option value="<?php echo $category['category_id']; ?>" 
                                                                                <?php echo ($filters['category_id'] == $category['category_id']) ? 'selected' : ''; ?>>
                                                                            <?php echo $category['category_name']; ?>
                                                                        </option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label class="control-label">Start Date:</label>
                                                                <input type="date" name="start_date" class="form-control" 
                                                                       value="<?php echo $filters['start_date']; ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label class="control-label">End Date:</label>
                                                                <input type="date" name="end_date" class="form-control" 
                                                                       value="<?php echo $filters['end_date']; ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <button type="submit" class="btn btn-primary">
                                                                <i class="fa fa-search"></i> Generate Report
                                                            </button>
                                                            <a href="<?php echo site_url('orders_reports/item_report'); ?>" class="btn btn-default">
                                                                <i class="fa fa-refresh"></i> Reset
                                                            </a>
                                                            <?php if (!empty($filters['item_id'])): ?>
                                                            <a href="<?php echo site_url('orders_reports/export_report?type=item&item_id=' . $filters['item_id'] . '&start_date=' . $filters['start_date'] . '&end_date=' . $filters['end_date']); ?>" 
                                                               class="btn btn-success">
                                                                <i class="fa fa-download"></i> Export CSV
                                                            </a>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php if (!empty($item_info)): ?>
                                <!-- Item Information -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="panel panel-info">
                                            <div class="panel-heading">
                                                <h3 class="panel-title"><i class="fa fa-info-circle"></i> Item Information</h3>
                                            </div>
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <table class="table table-borderless">
                                                            <tr>
                                                                <td><strong>Item Name:</strong></td>
                                                                <td><?php echo $item_info['item_name']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Item Code:</strong></td>
                                                                <td><?php echo $item_info['item_code']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Category:</strong></td>
                                                                <td><?php echo $item_info['category_name']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Base Price:</strong></td>
                                                                <td>PKR <?php echo number_format($item_info['item_price'], 2); ?></td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <table class="table table-borderless">
                                                            <tr>
                                                                <td><strong>Status:</strong></td>
                                                                <td>
                                                                    <span class="label label-<?php echo $item_info['item_status'] == 1 ? 'success' : 'danger'; ?>">
                                                                        <?php echo $item_info['item_status'] == 1 ? 'Active' : 'Inactive'; ?>
                                                                    </span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Description:</strong></td>
                                                                <td><?php echo $item_info['item_description'] ?: 'N/A'; ?></td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Item Summary Cards -->
                                <?php if (!empty($item_summary)): ?>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="panel panel-primary">
                                            <div class="panel-heading">
                                                <div class="row">
                                                    <div class="col-xs-3">
                                                        <i class="fa fa-shopping-cart fa-3x"></i>
                                                    </div>
                                                    <div class="col-xs-9 text-right">
                                                        <div class="huge"><?php echo number_format($item_summary['total_orders']); ?></div>
                                                        <div>Total Orders</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="panel panel-green">
                                            <div class="panel-heading">
                                                <div class="row">
                                                    <div class="col-xs-3">
                                                        <i class="fa fa-money-bill-wave fa-3x"></i>
                                                    </div>
                                                    <div class="col-xs-9 text-right">
                                                        <div class="huge">PKR <?php echo number_format($item_summary['total_sales'], 2); ?></div>
                                                        <div>Total Sales</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="panel panel-yellow">
                                            <div class="panel-heading">
                                                <div class="row">
                                                    <div class="col-xs-3">
                                                        <i class="fa fa-cubes fa-3x"></i>
                                                    </div>
                                                    <div class="col-xs-9 text-right">
                                                        <div class="huge"><?php echo number_format($item_summary['total_quantity']); ?></div>
                                                        <div>Total Quantity</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="panel panel-red">
                                            <div class="panel-heading">
                                                <div class="row">
                                                    <div class="col-xs-3">
                                                        <i class="fa fa-chart-line fa-3x"></i>
                                                    </div>
                                                    <div class="col-xs-9 text-right">
                                                        <div class="huge">PKR <?php echo number_format($item_summary['avg_price'], 2); ?></div>
                                                        <div>Avg Price</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>

                                <!-- Item Sales Table -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h3 class="panel-title"><i class="fa fa-table"></i> Item Sales History</h3>
                                            </div>
                                            <div class="panel-body">
                                                <?php if (!empty($item_sales)): ?>
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-hover" id="itemSalesTable">
                                                            <thead>
                                                                <tr>
                                                                    <th>Order #</th>
                                                                    <th>Shop</th>
                                                                    <th>Quantity</th>
                                                                    <th>Price</th>
                                                                    <th>Total</th>
                                                                    <th>Status</th>
                                                                    <th>Created By</th>
                                                                    <th>Date</th>
                                                                    <th>Actions</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php foreach ($item_sales as $sale): ?>
                                                                    <tr>
                                                                        <td>
                                                                            <a href="<?php echo site_url('orders/show_invoice/' . $sale['order_number']); ?>" 
                                                                               class="btn btn-xs btn-info">
                                                                                <?php echo $sale['order_number']; ?>
                                                                            </a>
                                                                        </td>
                                                                        <td><?php echo $sale['shop_name']; ?></td>
                                                                        <td><?php echo $sale['order_quantity']; ?></td>
                                                                        <td>PKR <?php echo number_format($sale['order_price'], 2); ?></td>
                                                                        <td><strong>PKR <?php echo number_format($sale['order_price'] * $sale['order_quantity'], 2); ?></strong></td>
                                                                        <td>
                                                                            <span class="label label-<?php echo $sale['order_status'] == 'confirm' ? 'success' : 'warning'; ?>">
                                                                                <?php echo ucfirst($sale['order_status']); ?>
                                                                            </span>
                                                                        </td>
                                                                        <td><?php echo $sale['created_by_name']; ?></td>
                                                                        <td><?php echo date('Y-m-d H:i', strtotime($sale['created_date'])); ?></td>
                                                                        <td>
                                                                            <div class="btn-group">
                                                                                <a href="<?php echo site_url('orders/show_invoice/' . $sale['order_number']); ?>" 
                                                                                   class="btn btn-xs btn-primary" title="View Invoice">
                                                                                    <i class="fa fa-eye"></i>
                                                                                </a>
                                                                                <a href="<?php echo site_url('orders/editorder/' . $sale['order_number']); ?>" 
                                                                                   class="btn btn-xs btn-warning" title="Edit Order">
                                                                                    <i class="fa fa-edit"></i>
                                                                                </a>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                <?php endforeach; ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                <?php else: ?>
                                                    <div class="alert alert-info">
                                                        <i class="fa fa-info-circle"></i> No sales data found for this item in the selected date range.
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>

                                <!-- Top Selling Items -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h3 class="panel-title"><i class="fa fa-star"></i> Top Selling Items</h3>
                                            </div>
                                            <div class="panel-body">
                                                <?php if (!empty($top_items)): ?>
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-hover" id="topItemsTable">
                                                            <thead>
                                                                <tr>
                                                                    <th>Rank</th>
                                                                    <th>Item Name</th>
                                                                    <th>Item Code</th>
                                                                    <th>Total Quantity</th>
                                                                    <th>Total Sales</th>
                                                                    <th>Order Count</th>
                                                                    <th>Avg Price</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php foreach ($top_items as $index => $item): ?>
                                                                    <tr>
                                                                        <td>
                                                                            <span class="badge badge-<?php echo $index < 3 ? 'warning' : 'info'; ?>">
                                                                                #<?php echo $index + 1; ?>
                                                                            </span>
                                                                        </td>
                                                                        <td><?php echo $item['item_name']; ?></td>
                                                                        <td><?php echo $item['item_code']; ?></td>
                                                                        <td><?php echo number_format($item['total_quantity']); ?></td>
                                                                        <td><strong>PKR <?php echo number_format($item['total_sales'], 2); ?></strong></td>
                                                                        <td><?php echo number_format($item['order_count']); ?></td>
                                                                        <td>PKR <?php echo number_format($item['total_sales'] / $item['total_quantity'], 2); ?></td>
                                                                    </tr>
                                                                <?php endforeach; ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                <?php else: ?>
                                                    <div class="alert alert-info">
                                                        <i class="fa fa-info-circle"></i> No top selling items data available.
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end widget content -->
                        </div>
                        <!-- end widget div -->
                    </div>
                    <!-- end widget -->
                </article>
                <!-- WIDGET END -->
            </div>
            <!-- end row -->
        </section>
        <!-- end widget grid -->
    </div>
    <!-- END MAIN CONTENT -->
</div>

<style>
.panel-primary .panel-heading {
    background-color: #337ab7;
    border-color: #337ab7;
    color: white;
}

.panel-green .panel-heading {
    background-color: #5cb85c;
    border-color: #5cb85c;
    color: white;
}

.panel-yellow .panel-heading {
    background-color: #f0ad4e;
    border-color: #f0ad4e;
    color: white;
}

.panel-red .panel-heading {
    background-color: #d9534f;
    border-color: #d9534f;
    color: white;
}

.panel-info .panel-heading {
    background-color: #5bc0de;
    border-color: #5bc0de;
    color: white;
}

.huge {
    font-size: 30px;
}

#itemSalesTable th, #topItemsTable th {
    background-color: #f5f5f5;
    font-weight: bold;
}

.btn-group .btn {
    margin-right: 2px;
}

.label-success {
    background-color: #5cb85c;
}

.label-warning {
    background-color: #f0ad4e;
}

.badge-warning {
    background-color: #f0ad4e;
}

.badge-info {
    background-color: #5bc0de;
}

.table-borderless td {
    border: none;
}
</style>

<script>
$(document).ready(function() {
    // Initialize DataTables
    $('#itemSalesTable').DataTable({
        "pageLength": 25,
        "order": [[7, "desc"]], // Sort by date column
        "responsive": true
    });
    
    $('#topItemsTable').DataTable({
        "pageLength": 10,
        "order": [[3, "desc"]], // Sort by total quantity
        "responsive": true
    });
});
</script>

<?php $this->load->view('common/footer'); ?> 