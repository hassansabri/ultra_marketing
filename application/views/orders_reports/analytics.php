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
                            <span class="widget-icon"> <i class="fa fa-chart-pie"></i> </span>
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
                                <!-- Sales Trend Chart -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h3 class="panel-title"><i class="fa fa-chart-line"></i> Sales Trend (Last 12 Months)</h3>
                                            </div>
                                            <div class="panel-body">
                                                <canvas id="salesTrendChart" width="400" height="200"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Top Shops and Items Row -->
                                <div class="row">
                                    <!-- Top Shops -->
                                    <div class="col-md-6">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h3 class="panel-title"><i class="fa fa-store"></i> Top Performing Shops</h3>
                                            </div>
                                            <div class="panel-body">
                                                <?php if (!empty($top_shops)): ?>
                                                    <div class="list-group">
                                                        <?php foreach ($top_shops as $index => $shop): ?>
                                                            <div class="list-group-item">
                                                                <div class="row">
                                                                    <div class="col-xs-8">
                                                                        <h5 class="list-group-item-heading">
                                                                            <span class="badge badge-<?php echo $index < 3 ? 'warning' : 'info'; ?>">
                                                                                #<?php echo $index + 1; ?>
                                                                            </span>
                                                                            <?php echo $shop['shop_name']; ?>
                                                                        </h5>
                                                                        <p class="list-group-item-text">
                                                                            <small>Orders: <?php echo number_format($shop['order_count']); ?></small>
                                                                        </p>
                                                                    </div>
                                                                    <div class="col-xs-4 text-right">
                                                                        <strong>PKR <?php echo number_format($shop['total_sales'], 2); ?></strong>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                <?php else: ?>
                                                    <p class="text-muted">No shop data available</p>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Top Items -->
                                    <div class="col-md-6">
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
                                                                        <h5 class="list-group-item-heading">
                                                                            <span class="badge badge-<?php echo $index < 3 ? 'warning' : 'info'; ?>">
                                                                                #<?php echo $index + 1; ?>
                                                                            </span>
                                                                            <?php echo $item['item_name']; ?>
                                                                        </h5>
                                                                        <p class="list-group-item-text">
                                                                            <small>Code: <?php echo $item['item_code']; ?></small>
                                                                        </p>
                                                                    </div>
                                                                    <div class="col-xs-4 text-right">
                                                                        <strong><?php echo number_format($item['total_quantity']); ?></strong>
                                                                        <br>
                                                                        <small>PKR <?php echo number_format($item['total_sales'], 2); ?></small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                <?php else: ?>
                                                    <p class="text-muted">No item data available</p>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Monthly Comparison -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h3 class="panel-title"><i class="fa fa-chart-bar"></i> Monthly Comparison</h3>
                                            </div>
                                            <div class="panel-body">
                                                <?php if (!empty($monthly_comparison)): ?>
                                                    <div class="table-responsive">
                                                        <table class="table table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th>Month</th>
                                                                    <th>Orders</th>
                                                                    <th>Sales</th>
                                                                    <th>Growth</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php 
                                                                $previous_sales = 0;
                                                                foreach ($monthly_comparison as $month): 
                                                                    $growth = $previous_sales > 0 ? (($month['total_sales'] - $previous_sales) / $previous_sales) * 100 : 0;
                                                                    $previous_sales = $month['total_sales'];
                                                                ?>
                                                                    <tr>
                                                                        <td><strong><?php echo $month['month']; ?></strong></td>
                                                                        <td><?php echo number_format($month['order_count']); ?></td>
                                                                        <td><strong>PKR <?php echo number_format($month['total_sales'], 2); ?></strong></td>
                                                                        <td>
                                                                            <span class="label label-<?php echo $growth >= 0 ? 'success' : 'danger'; ?>">
                                                                                <?php echo $growth >= 0 ? '+' : ''; ?><?php echo number_format($growth, 1); ?>%
                                                                            </span>
                                                                        </td>
                                                                    </tr>
                                                                <?php endforeach; ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                <?php else: ?>
                                                    <p class="text-muted">No monthly comparison data available</p>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Payment Analytics -->
                                    <div class="col-md-6">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h3 class="panel-title"><i class="fa fa-credit-card"></i> Payment Method Analytics</h3>
                                            </div>
                                            <div class="panel-body">
                                                <?php if (!empty($payment_analytics)): ?>
                                                    <canvas id="paymentChart" width="400" height="200"></canvas>
                                                    <div class="table-responsive" style="margin-top: 20px;">
                                                        <table class="table table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th>Method</th>
                                                                    <th>Transactions</th>
                                                                    <th>Amount</th>
                                                                    <th>Percentage</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php 
                                                                $total_payment_amount = 0;
                                                                foreach ($payment_analytics as $payment) {
                                                                    $total_payment_amount += $payment['total_amount'];
                                                                }
                                                                
                                                                foreach ($payment_analytics as $payment): 
                                                                    $percentage = $total_payment_amount > 0 ? ($payment['total_amount'] / $total_payment_amount) * 100 : 0;
                                                                ?>
                                                                    <tr>
                                                                        <td><strong><?php echo $payment['payment_options_title']; ?></strong></td>
                                                                        <td><?php echo number_format($payment['transaction_count']); ?></td>
                                                                        <td><strong>PKR <?php echo number_format($payment['total_amount'], 2); ?></strong></td>
                                                                        <td><?php echo number_format($percentage, 1); ?>%</td>
                                                                    </tr>
                                                                <?php endforeach; ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                <?php else: ?>
                                                    <p class="text-muted">No payment analytics data available</p>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Quick Actions -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h3 class="panel-title"><i class="fa fa-rocket"></i> Quick Actions</h3>
                                            </div>
                                            <div class="panel-body">
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
                                                    <a href="<?php echo site_url('orders_reports/date_range_report'); ?>" class="btn btn-danger">
                                                        <i class="fa fa-calendar"></i> Date Range Report
                                                    </a>
                                                </div>
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
.badge-warning {
    background-color: #f0ad4e;
}

.badge-info {
    background-color: #5bc0de;
}

.label-success {
    background-color: #5cb85c;
}

.label-danger {
    background-color: #d9534f;
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

.btn-group-justified .btn {
    margin: 0 2px;
}
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Sales Trend Chart
var salesTrendData = <?php echo json_encode($sales_trend); ?>;
var ctx1 = document.getElementById('salesTrendChart').getContext('2d');

var labels = [];
var salesData = [];
var orderData = [];

salesTrendData.forEach(function(item) {
    labels.push(item.month);
    salesData.push(parseFloat(item.total_sales));
    orderData.push(parseInt(item.order_count));
});

var salesTrendChart = new Chart(ctx1, {
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

<?php if (!empty($payment_analytics)): ?>
// Payment Method Chart
var paymentData = <?php echo json_encode($payment_analytics); ?>;
var ctx2 = document.getElementById('paymentChart').getContext('2d');

var paymentLabels = [];
var paymentAmounts = [];
var paymentColors = [
    '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF',
    '#FF9F40', '#FF6384', '#C9CBCF', '#4BC0C0', '#FF6384'
];

paymentData.forEach(function(payment, index) {
    paymentLabels.push(payment.payment_options_title);
    paymentAmounts.push(parseFloat(payment.total_amount));
});

var paymentChart = new Chart(ctx2, {
    type: 'doughnut',
    data: {
        labels: paymentLabels,
        datasets: [{
            data: paymentAmounts,
            backgroundColor: paymentColors.slice(0, paymentLabels.length),
            borderWidth: 2,
            borderColor: '#fff'
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'bottom',
            },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        var label = context.label || '';
                        var value = context.parsed || 0;
                        var total = context.dataset.data.reduce((a, b) => a + b, 0);
                        var percentage = ((value / total) * 100).toFixed(1);
                        return label + ': PKR ' + value.toLocaleString() + ' (' + percentage + '%)';
                    }
                }
            }
        }
    }
});
<?php endif; ?>
</script>

<?php $this->load->view('common/footer'); ?> 