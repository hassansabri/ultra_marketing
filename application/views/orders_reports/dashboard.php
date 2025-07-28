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
                                <!-- Summary Cards Row -->
                                <div class="row">
                                    <div class="col-sm-6 col-md-3">
                                        <div class="panel panel-primary">
                                            <div class="panel-heading">
                                                <div class="row">
                                                    <div class="col-xs-3">
                                                        <i class="fa fa-shopping-cart fa-5x"></i>
                                                    </div>
                                                    <div class="col-xs-9 text-right">
                                                        <div class="huge"><?php echo number_format($total_orders); ?></div>
                                                        <div>Total Orders</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <a href="<?php echo site_url('orders_reports/sales_report'); ?>">
                                                <div class="panel-footer">
                                                    <span class="pull-left">View Details</span>
                                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                    <div class="clearfix"></div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <div class="panel panel-green">
                                            <div class="panel-heading">
                                                <div class="row">
                                                    <div class="col-xs-3">
                                                        <i class="fa fa-money-bill-wave fa-5x"></i>
                                                    </div>
                                                    <div class="col-xs-9 text-right">
                                                        <div class="huge">PKR <?php echo number_format($total_sales, 2); ?></div>
                                                        <div>Total Sales</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <a href="<?php echo site_url('orders_reports/sales_report'); ?>">
                                                <div class="panel-footer">
                                                    <span class="pull-left">View Details</span>
                                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                    <div class="clearfix"></div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <div class="panel panel-yellow">
                                            <div class="panel-heading">
                                                <div class="row">
                                                    <div class="col-xs-3">
                                                        <i class="fa fa-store fa-5x"></i>
                                                    </div>
                                                    <div class="col-xs-9 text-right">
                                                        <div class="huge"><?php echo number_format($total_shops); ?></div>
                                                        <div>Active Shops</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <a href="<?php echo site_url('orders_reports/shop_report'); ?>">
                                                <div class="panel-footer">
                                                    <span class="pull-left">View Details</span>
                                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                    <div class="clearfix"></div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <div class="panel panel-red">
                                            <div class="panel-heading">
                                                <div class="row">
                                                    <div class="col-xs-3">
                                                        <i class="fa fa-chart-line fa-5x"></i>
                                                    </div>
                                                    <div class="col-xs-9 text-right">
                                                        <div class="huge"><?php echo count($recent_orders); ?></div>
                                                        <div>Recent Orders</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <a href="<?php echo site_url('orders_reports/sales_report'); ?>">
                                                <div class="panel-footer">
                                                    <span class="pull-left">View Details</span>
                                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                    <div class="clearfix"></div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Quick Access Buttons -->
                                <div class="row" style="margin-bottom: 20px;">
                                    <div class="col-md-12">
                                        <div class="btn-group btn-group-justified">
                                            <a href="<?php echo site_url('orders_reports/sales_report'); ?>" class="btn btn-primary">
                                                <i class="fa fa-chart-bar"></i> Sales Report
                                            </a>
                                            <a href="<?php echo site_url('orders_reports/shop_report'); ?>" class="btn btn-success">
                                                <i class="fa fa-store"></i> Shop Report
                                            </a>
                                            <a href="<?php echo site_url('orders_reports/item_report'); ?>" class="btn btn-info">
                                                <i class="fa fa-box"></i> Item Report
                                            </a>
                                            <a href="<?php echo site_url('orders_reports/payment_report'); ?>" class="btn btn-warning">
                                                <i class="fa fa-credit-card"></i> Payment Report
                                            </a>
                                            <a href="<?php echo site_url('orders_reports/analytics'); ?>" class="btn btn-danger">
                                                <i class="fa fa-chart-pie"></i> Analytics
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Charts and Data Row -->
                                <div class="row">
                                    <!-- Monthly Sales Chart -->
                                    <div class="col-md-8">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h3 class="panel-title"><i class="fa fa-chart-line"></i> Monthly Sales Trend</h3>
                                            </div>
                                            <div class="panel-body">
                                                <canvas id="monthlySalesChart" width="400" height="200"></canvas>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Top Items -->
                                    <div class="col-md-4">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h3 class="panel-title"><i class="fa fa-star"></i> Top Selling Items</h3>
                                            </div>
                                            <div class="panel-body">
                                                <?php if (!empty($top_items)): ?>
                                                    <div class="list-group">
                                                        <?php foreach ($top_items as $index => $item): ?>
                                                            <div class="list-group-item">
                                                                <div class="row">
                                                                    <div class="col-xs-8">
                                                                        <h5 class="list-group-item-heading"><?php echo $item['item_name']; ?></h5>
                                                                        <p class="list-group-item-text">
                                                                            <small>Code: <?php echo $item['item_code']; ?></small>
                                                                        </p>
                                                                    </div>
                                                                    <div class="col-xs-4 text-right">
                                                                        <span class="badge badge-primary"><?php echo $item['total_quantity']; ?></span>
                                                                        <br>
                                                                        <small>PKR <?php echo number_format($item['total_sales'], 2); ?></small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                <?php else: ?>
                                                    <p class="text-muted">No data available</p>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Recent Orders Table -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h3 class="panel-title"><i class="fa fa-clock"></i> Recent Orders</h3>
                                            </div>
                                            <div class="panel-body">
                                                <?php if (!empty($recent_orders)): ?>
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th>Order #</th>
                                                                    <th>Item</th>
                                                                    <th>Shop</th>
                                                                    <th>Quantity</th>
                                                                    <th>Price</th>
                                                                    <th>Status</th>
                                                                    <th>Date</th>
                                                                    <th>Actions</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php foreach ($recent_orders as $order): ?>
                                                                    <tr>
                                                                        <td>
                                                                            <a href="<?php echo site_url('orders/show_invoice/' . $order['order_number']); ?>" 
                                                                               class="btn btn-xs btn-info">
                                                                                <?php echo $order['order_number']; ?>
                                                                            </a>
                                                                        </td>
                                                                        <td><?php echo $order['item_name']; ?></td>
                                                                        <td><?php echo $order['shop_name']; ?></td>
                                                                        <td><?php echo $order['order_quantity']; ?></td>
                                                                        <td>PKR <?php echo number_format($order['order_price'], 2); ?></td>
                                                                        <td>
                                                                            <span class="label label-<?php echo $order['order_status'] == 'confirm' ? 'success' : 'warning'; ?>">
                                                                                <?php echo ucfirst($order['order_status']); ?>
                                                                            </span>
                                                                        </td>
                                                                        <td><?php echo date('Y-m-d H:i', strtotime($order['created_date'])); ?></td>
                                                                        <td>
                                                                            <a href="<?php echo site_url('orders/show_invoice/' . $order['order_number']); ?>" 
                                                                               class="btn btn-xs btn-primary" title="View Invoice">
                                                                                <i class="fa fa-eye"></i>
                                                                            </a>
                                                                        </td>
                                                                    </tr>
                                                                <?php endforeach; ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                <?php else: ?>
                                                    <p class="text-muted">No recent orders found</p>
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
    font-size: 40px;
}

.panel-footer {
    background-color: #f5f5f5;
    border-top: 1px solid #ddd;
    padding: 10px 15px;
}

.panel-footer:hover {
    background-color: #e5e5e5;
}

.btn-group-justified .btn {
    margin: 0 2px;
}

.list-group-item {
    border-left: none;
    border-right: none;
}

.list-group-item:first-child {
    border-top: none;
}

.list-group-item:last-child {
    border-bottom: none;
}

.badge-primary {
    background-color: #337ab7;
}
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Monthly Sales Chart
var ctx = document.getElementById('monthlySalesChart').getContext('2d');
var monthlyData = <?php echo json_encode($monthly_sales); ?>;

var labels = [];
var salesData = [];
var orderData = [];

monthlyData.forEach(function(item) {
    var monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    labels.push(monthNames[item.month - 1]);
    salesData.push(parseFloat(item.total_sales));
    orderData.push(parseInt(item.order_count));
});

var chart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: labels,
        datasets: [{
            label: 'Sales (PKR)',
            data: salesData,
            borderColor: 'rgb(75, 192, 192)',
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            tension: 0.1,
            yAxisID: 'y'
        }, {
            label: 'Orders Count',
            data: orderData,
            borderColor: 'rgb(255, 99, 132)',
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            tension: 0.1,
            yAxisID: 'y1'
        }]
    },
    options: {
        responsive: true,
        interaction: {
            mode: 'index',
            intersect: false,
        },
        scales: {
            y: {
                type: 'linear',
                display: true,
                position: 'left',
                title: {
                    display: true,
                    text: 'Sales (PKR)'
                }
            },
            y1: {
                type: 'linear',
                display: true,
                position: 'right',
                title: {
                    display: true,
                    text: 'Orders Count'
                },
                grid: {
                    drawOnChartArea: false,
                },
            }
        }
    }
});
</script>

<?php $this->load->view('common/footer'); ?> 