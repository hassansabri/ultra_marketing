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
                            <span class="widget-icon"> <i class="fa fa-store"></i> </span>
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
                                                <form method="GET" action="<?php echo site_url('orders_reports/shop_report'); ?>" class="form-horizontal">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="control-label">Select Shop:</label>
                                                                <select name="shop_id" class="form-control" required>
                                                                    <option value="">Please select a shop</option>
                                                                    <?php foreach ($all_shops as $shop): ?>
                                                                        <option value="<?php echo $shop['shop_id']; ?>" 
                                                                                <?php echo ($filters['shop_id'] == $shop['shop_id']) ? 'selected' : ''; ?>>
                                                                            <?php echo $shop['shop_name']; ?>
                                                                        </option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="control-label">Start Date:</label>
                                                                <input type="date" name="start_date" class="form-control" 
                                                                       value="<?php echo $filters['start_date']; ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
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
                                                            <a href="<?php echo site_url('orders_reports/shop_report'); ?>" class="btn btn-default">
                                                                <i class="fa fa-refresh"></i> Reset
                                                            </a>
                                                            <?php if (!empty($filters['shop_id'])): ?>
                                                            <a href="<?php echo site_url('orders_reports/export_report?type=shop&shop_id=' . $filters['shop_id'] . '&start_date=' . $filters['start_date'] . '&end_date=' . $filters['end_date']); ?>" 
                                                               class="btn btn-success">
                                                                <i class="fa fa-download"></i> Export CSV
                                                            </a>
                                                            <a href="<?php echo site_url('orders_reports/pdf_report?type=shop&shop_id=' . $filters['shop_id'] . '&start_date=' . $filters['start_date'] . '&end_date=' . $filters['end_date']); ?>" 
                                                               class="btn btn-danger">
                                                                <i class="fa fa-file-pdf"></i> Export PDF
                                                            </a>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php if (!empty($shop_info)): ?>
                                <!-- Shop Information -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="panel panel-info">
                                            <div class="panel-heading">
                                                <h3 class="panel-title"><i class="fa fa-info-circle"></i> Shop Information</h3>
                                            </div>
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <table class="table table-borderless">
                                                            <tr>
                                                                <td><strong>Shop Name:</strong></td>
                                                                <td><?php echo $shop_info['shop_name']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Address:</strong></td>
                                                                <td><?php echo $shop_info['shop_address']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Phone:</strong></td>
                                                                <td><?php echo $shop_info['shop_number']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Email:</strong></td>
                                                                <td><?php echo $shop_info['shop_email']; ?></td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <table class="table table-borderless">
                                                            <tr>
                                                                <td><strong>Status:</strong></td>
                                                                <td>
                                                                    <span class="label label-<?php echo $shop_info['shop_status'] == 1 ? 'success' : 'danger'; ?>">
                                                                        <?php echo $shop_info['shop_status'] == 1 ? 'Active' : 'Inactive'; ?>
                                                                    </span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Created Date:</strong></td>
                                                                <td><?php echo date('Y-m-d', strtotime($shop_info['created_date'])); ?></td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Summary Cards -->
                                <?php if (!empty($shop_summary)): ?>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="panel panel-primary">
                                            <div class="panel-heading">
                                                <div class="row">
                                                    <div class="col-xs-3">
                                                        <i class="fa fa-shopping-cart fa-3x"></i>
                                                    </div>
                                                    <div class="col-xs-9 text-right">
                                                        <div class="huge"><?php echo number_format($shop_summary['total_orders']); ?></div>
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
                                                        <div class="huge">PKR <?php echo number_format($shop_summary['total_sales'], 2); ?></div>
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
                                                        <div class="huge"><?php echo number_format($shop_summary['total_quantity']); ?></div>
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
                                                        <div class="huge">PKR <?php echo number_format($shop_summary['avg_order_value'], 2); ?></div>
                                                        <div>Avg Order Value</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>

                                <!-- Shop Orders Table -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h3 class="panel-title"><i class="fa fa-table"></i> Shop Orders</h3>
                                            </div>
                                            <div class="panel-body">
                                                <?php if (!empty($shop_orders)): ?>
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-hover" id="shopOrdersTable">
                                                            <thead>
                                                                <tr>
                                                                    <th>Order #</th>
                                                                    <th>Item Name</th>
                                                                    <th>Item Code</th>
                                                                    <th>Quantity</th>
                                                                    <th>Price</th>
                                                                    <th>Total</th>
                                                                    <th>Status</th>
                                                                    <th>Date</th>
                                                                    <th>Actions</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php foreach ($shop_orders as $order): ?>
                                                                    <tr>
                                                                        <td>
                                                                            <a href="<?php echo site_url('orders/show_invoice/' . $order['order_number']); ?>" 
                                                                               class="btn btn-xs btn-info">
                                                                                <?php echo $order['order_number']; ?>
                                                                            </a>
                                                                        </td>
                                                                        <td><?php echo $order['item_name']; ?></td>
                                                                        <td><?php echo $order['item_code']; ?></td>
                                                                        <td><?php echo $order['order_quantity']; ?></td>
                                                                        <td>PKR <?php echo number_format($order['order_price'], 2); ?></td>
                                                                        <td><strong>PKR <?php echo number_format($order['order_price'] * $order['order_quantity'], 2); ?></strong></td>
                                                                        <td>
                                                                            <span class="label label-<?php echo $order['order_status'] == 'confirm' ? 'success' : 'warning'; ?>">
                                                                                <?php echo ucfirst($order['order_status']); ?>
                                                                            </span>
                                                                        </td>
                                                                        <td><?php echo date('Y-m-d H:i', strtotime($order['created_date'])); ?></td>
                                                                        <td>
                                                                            <div class="btn-group">
                                                                                <a href="<?php echo site_url('orders/show_invoice/' . $order['order_number']); ?>" 
                                                                                   class="btn btn-xs btn-primary" title="View Invoice">
                                                                                    <i class="fa fa-eye"></i>
                                                                                </a>
                                                                                <a href="<?php echo site_url('orders/editorder/' . $order['order_number']); ?>" 
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
                                                        <i class="fa fa-info-circle"></i> No orders found for this shop in the selected date range.
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Shop Ledger Table -->
                                <?php if (!empty($shop_ledger)): ?>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h3 class="panel-title"><i class="fa fa-book"></i> Shop Ledger</h3>
                                            </div>
                                            <div class="panel-body">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-hover" id="shopLedgerTable">
                                                        <thead>
                                                            <tr>
                                                                <th>Date</th>
                                                                <th>Order #</th>
                                                                <th>Type</th>
                                                                <th>Amount</th>
                                                                <th>Payment Method</th>
                                                                <th>Remarks</th>
                                                                <th>Actions</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php 
                                                            $balance = 0;
                                                            foreach ($shop_ledger as $entry): 
                                                                if ($entry['type'] == 'credit') {
                                                                    $balance += $entry['amount'];
                                                                } else {
                                                                    $balance -= $entry['amount'];
                                                                }
                                                            ?>
                                                                <tr>
                                                                    <td><?php echo date('Y-m-d H:i', strtotime($entry['date'])); ?></td>
                                                                    <td>
                                                                        <a href="<?php echo site_url('orders/show_invoice/' . $entry['order_number']); ?>" 
                                                                           class="btn btn-xs btn-info">
                                                                            <?php echo $entry['order_number']; ?>
                                                                        </a>
                                                                    </td>
                                                                    <td>
                                                                        <span class="label label-<?php echo $entry['type'] == 'credit' ? 'success' : 'danger'; ?>">
                                                                            <?php echo ucfirst($entry['type']); ?>
                                                                        </span>
                                                                    </td>
                                                                    <td class="text-right">
                                                                        <strong>PKR <?php echo number_format($entry['amount'], 2); ?></strong>
                                                                    </td>
                                                                    <td><?php echo $entry['payment_options_title']; ?></td>
                                                                    <td><?php echo $entry['remarks']; ?></td>
                                                                    <td>
                                                                        <span class="badge badge-info">Balance: PKR <?php echo number_format($balance, 2); ?></span>
                                                                    </td>
                                                                </tr>
                                                            <?php endforeach; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <?php endif; ?>
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

#shopOrdersTable th, #shopLedgerTable th {
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

.label-danger {
    background-color: #d9534f;
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
    $('#shopOrdersTable').DataTable({
        "pageLength": 25,
        "order": [[7, "desc"]], // Sort by date column
        "responsive": true
    });
    
    $('#shopLedgerTable').DataTable({
        "pageLength": 25,
        "order": [[0, "desc"]], // Sort by date column
        "responsive": true
    });
});
</script>

<?php $this->load->view('common/footer'); ?> 