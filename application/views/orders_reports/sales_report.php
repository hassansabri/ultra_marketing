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
                            <span class="widget-icon"> <i class="fa fa-chart-bar"></i> </span>
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
                                                <form method="GET" action="<?php echo site_url('orders_reports/sales_report'); ?>" class="form-horizontal">
                                                    <div class="row">
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
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label class="control-label">Shop:</label>
                                                                <select name="shop_id" class="form-control">
                                                                    <option value="">All Shops</option>
                                                                    <?php foreach ($all_shops as $shop): ?>
                                                                        <option value="<?php echo $shop['shop_id']; ?>" 
                                                                                <?php echo ($filters['shop_id'] == $shop['shop_id']) ? 'selected' : ''; ?>>
                                                                            <?php echo $shop['shop_name']; ?>
                                                                        </option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label class="control-label">Status:</label>
                                                                <select name="status" class="form-control">
                                                                    <option value="">All Status</option>
                                                                    <option value="draft" <?php echo ($filters['status'] == 'draft') ? 'selected' : ''; ?>>Draft</option>
                                                                    <option value="confirm" <?php echo ($filters['status'] == 'confirm') ? 'selected' : ''; ?>>Confirmed</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <button type="submit" class="btn btn-primary">
                                                                <i class="fa fa-search"></i> Apply Filters
                                                            </button>
                                                            <a href="<?php echo site_url('orders_reports/sales_report'); ?>" class="btn btn-default">
                                                                <i class="fa fa-refresh"></i> Reset
                                                            </a>
                                                            <a href="<?php echo site_url('orders_reports/export_report?type=sales&start_date=' . $filters['start_date'] . '&end_date=' . $filters['end_date'] . '&shop_id=' . $filters['shop_id']); ?>" 
                                                               class="btn btn-success">
                                                                <i class="fa fa-download"></i> Export CSV
                                                            </a>
                                                            <a href="<?php echo site_url('orders_reports/pdf_report?type=sales&start_date=' . $filters['start_date'] . '&end_date=' . $filters['end_date'] . '&shop_id=' . $filters['shop_id']); ?>" 
                                                               class="btn btn-danger">
                                                                <i class="fa fa-file-pdf"></i> Export PDF
                                                            </a>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Summary Cards -->
                                <?php if (!empty($summary)): ?>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="panel panel-primary">
                                            <div class="panel-heading">
                                                <div class="row">
                                                    <div class="col-xs-3">
                                                        <i class="fa fa-shopping-cart fa-3x"></i>
                                                    </div>
                                                    <div class="col-xs-9 text-right">
                                                        <div class="huge"><?php echo number_format($summary['total_orders']); ?></div>
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
                                                        <div class="huge">PKR <?php echo number_format($summary['total_sales'], 2); ?></div>
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
                                                        <div class="huge"><?php echo number_format($summary['total_quantity']); ?></div>
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
                                                        <div class="huge">PKR <?php echo number_format($summary['avg_order_value'], 2); ?></div>
                                                        <div>Avg Order Value</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>

                                <!-- Sales Data Table -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h3 class="panel-title"><i class="fa fa-table"></i> Sales Data</h3>
                                            </div>
                                            <div class="panel-body">
                                                <?php if (!empty($sales_data)): ?>
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-hover" id="salesTable">
                                                            <thead>
                                                                <tr>
                                                                    <th>Order #</th>
                                                                    <th>Item Name</th>
                                                                    <th>Item Code</th>
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
                                                                <?php foreach ($sales_data as $sale): ?>
                                                                    <tr>
                                                                        <td>
                                                                            <a href="<?php echo site_url('orders/show_invoice/' . $sale['order_number']); ?>" 
                                                                               class="btn btn-xs btn-info">
                                                                                <?php echo $sale['order_number']; ?>
                                                                            </a>
                                                                        </td>
                                                                        <td><?php echo $sale['item_name']; ?></td>
                                                                        <td><?php echo $sale['item_code']; ?></td>
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
                                                        <i class="fa fa-info-circle"></i> No sales data found for the selected filters.
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

.huge {
    font-size: 30px;
}

#salesTable th {
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
</style>

<script>
$(document).ready(function() {
    // Initialize DataTable
    $('#salesTable').DataTable({
        "pageLength": 25,
        "order": [[9, "desc"]], // Sort by date column
        "responsive": true,
        "language": {
            "search": "Search:",
            "lengthMenu": "Show _MENU_ entries per page",
            "info": "Showing _START_ to _END_ of _TOTAL_ entries",
            "infoEmpty": "Showing 0 to 0 of 0 entries",
            "infoFiltered": "(filtered from _MAX_ total entries)"
        }
    });
});
</script>

<?php $this->load->view('common/footer'); ?> 