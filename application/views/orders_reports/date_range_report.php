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
                            <span class="widget-icon"> <i class="fa fa-calendar"></i> </span>
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
                                                <form method="GET" action="<?php echo site_url('orders_reports/date_range_report'); ?>" class="form-horizontal">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label class="control-label">Start Date:</label>
                                                                <input type="date" name="start_date" class="form-control" 
                                                                       value="<?php echo $filters['start_date']; ?>" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label class="control-label">End Date:</label>
                                                                <input type="date" name="end_date" class="form-control" 
                                                                       value="<?php echo $filters['end_date']; ?>" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label class="control-label">Group By:</label>
                                                                <select name="group_by" class="form-control">
                                                                    <option value="day" <?php echo ($filters['group_by'] == 'day') ? 'selected' : ''; ?>>Day</option>
                                                                    <option value="week" <?php echo ($filters['group_by'] == 'week') ? 'selected' : ''; ?>>Week</option>
                                                                    <option value="month" <?php echo ($filters['group_by'] == 'month') ? 'selected' : ''; ?>>Month</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label class="control-label">&nbsp;</label>
                                                                <div>
                                                                    <button type="submit" class="btn btn-primary">
                                                                        <i class="fa fa-search"></i> Generate Report
                                                                    </button>
                                                                    <a href="<?php echo site_url('orders_reports/date_range_report'); ?>" class="btn btn-default">
                                                                        <i class="fa fa-refresh"></i> Reset
                                                                    </a>
                                                                </div>
                                                            </div>
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

                                <!-- Date Range Chart -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h3 class="panel-title">
                                                    <i class="fa fa-chart-bar"></i> 
                                                    Sales Trend (<?php echo ucfirst($filters['group_by']); ?>ly)
                                                </h3>
                                            </div>
                                            <div class="panel-body">
                                                <canvas id="dateRangeChart" width="400" height="200"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Date Range Data Table -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h3 class="panel-title">
                                                    <i class="fa fa-table"></i> 
                                                    <?php echo ucfirst($filters['group_by']); ?>ly Breakdown
                                                </h3>
                                            </div>
                                            <div class="panel-body">
                                                <?php if (!empty($date_range_data)): ?>
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-hover" id="dateRangeTable">
                                                            <thead>
                                                                <tr>
                                                                    <th><?php echo ucfirst($filters['group_by']); ?></th>
                                                                    <th>Orders</th>
                                                                    <th>Sales</th>
                                                                    <th>Quantity</th>
                                                                    <th>Avg Order Value</th>
                                                                    <th>Growth</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php 
                                                                $previous_sales = 0;
                                                                foreach ($date_range_data as $data): 
                                                                    $growth = $previous_sales > 0 ? (($data['total_sales'] - $previous_sales) / $previous_sales) * 100 : 0;
                                                                    $avg_order_value = $data['order_count'] > 0 ? $data['total_sales'] / $data['order_count'] : 0;
                                                                    $previous_sales = $data['total_sales'];
                                                                ?>
                                                                    <tr>
                                                                        <td>
                                                                            <strong>
                                                                                <?php 
                                                                                if ($filters['group_by'] == 'day') {
                                                                                    echo date('M d, Y', strtotime($data['date_group']));
                                                                                } elseif ($filters['group_by'] == 'week') {
                                                                                    echo 'Week ' . $data['date_group'];
                                                                                } else {
                                                                                    echo date('M Y', strtotime($data['date_group'] . '-01'));
                                                                                }
                                                                                ?>
                                                                            </strong>
                                                                        </td>
                                                                        <td><?php echo number_format($data['order_count']); ?></td>
                                                                        <td><strong>PKR <?php echo number_format($data['total_sales'], 2); ?></strong></td>
                                                                        <td><?php echo number_format($data['total_quantity']); ?></td>
                                                                        <td>PKR <?php echo number_format($avg_order_value, 2); ?></td>
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
                                                    <div class="alert alert-info">
                                                        <i class="fa fa-info-circle"></i> No data found for the selected date range.
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Quick Date Presets -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h3 class="panel-title"><i class="fa fa-clock"></i> Quick Date Presets</h3>
                                            </div>
                                            <div class="panel-body">
                                                <div class="btn-group">
                                                    <a href="<?php echo site_url('orders_reports/date_range_report?start_date=' . date('Y-m-01') . '&end_date=' . date('Y-m-t') . '&group_by=' . $filters['group_by']); ?>" 
                                                       class="btn btn-default">This Month</a>
                                                    <a href="<?php echo site_url('orders_reports/date_range_report?start_date=' . date('Y-m-01', strtotime('-1 month')) . '&end_date=' . date('Y-m-t', strtotime('-1 month')) . '&group_by=' . $filters['group_by']); ?>" 
                                                       class="btn btn-default">Last Month</a>
                                                    <a href="<?php echo site_url('orders_reports/date_range_report?start_date=' . date('Y-01-01') . '&end_date=' . date('Y-12-31') . '&group_by=' . $filters['group_by']); ?>" 
                                                       class="btn btn-default">This Year</a>
                                                    <a href="<?php echo site_url('orders_reports/date_range_report?start_date=' . date('Y-m-d', strtotime('-7 days')) . '&end_date=' . date('Y-m-d') . '&group_by=' . $filters['group_by']); ?>" 
                                                       class="btn btn-default">Last 7 Days</a>
                                                    <a href="<?php echo site_url('orders_reports/date_range_report?start_date=' . date('Y-m-d', strtotime('-30 days')) . '&end_date=' . date('Y-m-d') . '&group_by=' . $filters['group_by']); ?>" 
                                                       class="btn btn-default">Last 30 Days</a>
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

#dateRangeTable th {
    background-color: #f5f5f5;
    font-weight: bold;
}

.label-success {
    background-color: #5cb85c;
}

.label-danger {
    background-color: #d9534f;
}

.btn-group .btn {
    margin-right: 5px;
}
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
<?php if (!empty($date_range_data)): ?>
// Date Range Chart
var dateRangeData = <?php echo json_encode($date_range_data); ?>;
var ctx = document.getElementById('dateRangeChart').getContext('2d');

var labels = [];
var salesData = [];
var orderData = [];

dateRangeData.forEach(function(item) {
    var label = '';
    if ('<?php echo $filters['group_by']; ?>' == 'day') {
        label = new Date(item.date_group).toLocaleDateString('en-US', { month: 'short', day: 'numeric' });
    } else if ('<?php echo $filters['group_by']; ?>' == 'week') {
        label = 'Week ' + item.date_group;
    } else {
        label = new Date(item.date_group + '-01').toLocaleDateString('en-US', { month: 'short', year: 'numeric' });
    }
    labels.push(label);
    salesData.push(parseFloat(item.total_sales));
    orderData.push(parseInt(item.order_count));
});

var dateRangeChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: 'Sales (PKR)',
            data: salesData,
            backgroundColor: 'rgba(75, 192, 192, 0.6)',
            borderColor: 'rgb(75, 192, 192)',
            borderWidth: 1,
            yAxisID: 'y'
        }, {
            label: 'Orders Count',
            data: orderData,
            backgroundColor: 'rgba(255, 99, 132, 0.6)',
            borderColor: 'rgb(255, 99, 132)',
            borderWidth: 1,
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
<?php endif; ?>

$(document).ready(function() {
    // Initialize DataTable
    $('#dateRangeTable').DataTable({
        "pageLength": 25,
        "order": [[0, "asc"]], // Sort by date
        "responsive": true
    });
});
</script>

<?php $this->load->view('common/footer'); ?> 