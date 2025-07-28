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
                            <span class="widget-icon"> <i class="fa fa-credit-card"></i> </span>
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
                                                <form method="GET" action="<?php echo site_url('orders_reports/payment_report'); ?>" class="form-horizontal">
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
                                                                <label class="control-label">Payment Method:</label>
                                                                <select name="payment_method" class="form-control">
                                                                    <option value="">All Methods</option>
                                                                    <?php foreach ($payment_methods as $method): ?>
                                                                        <option value="<?php echo $method['payment_option_id']; ?>" 
                                                                                <?php echo ($filters['payment_method'] == $method['payment_option_id']) ? 'selected' : ''; ?>>
                                                                            <?php echo $method['payment_options_title']; ?>
                                                                        </option>
                                                                    <?php endforeach; ?>
                                                                </select>
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
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <button type="submit" class="btn btn-primary">
                                                                <i class="fa fa-search"></i> Generate Report
                                                            </button>
                                                            <a href="<?php echo site_url('orders_reports/payment_report'); ?>" class="btn btn-default">
                                                                <i class="fa fa-refresh"></i> Reset
                                                            </a>
                                                            <a href="<?php echo site_url('orders_reports/export_report?type=payment&start_date=' . $filters['start_date'] . '&end_date=' . $filters['end_date'] . '&payment_method=' . $filters['payment_method'] . '&shop_id=' . $filters['shop_id']); ?>" 
                                                               class="btn btn-success">
                                                                <i class="fa fa-download"></i> Export CSV
                                                            </a>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Payment Summary Cards -->
                                <?php if (!empty($payment_summary)): ?>
                                <div class="row">
                                    <?php 
                                    $total_credit = 0;
                                    $total_debit = 0;
                                    $total_transactions = 0;
                                    
                                    foreach ($payment_summary as $summary) {
                                        $total_credit += $summary['total_credit'];
                                        $total_debit += $summary['total_debit'];
                                        $total_transactions += $summary['transaction_count'];
                                    }
                                    ?>
                                    <div class="col-md-3">
                                        <div class="panel panel-primary">
                                            <div class="panel-heading">
                                                <div class="row">
                                                    <div class="col-xs-3">
                                                        <i class="fa fa-exchange-alt fa-3x"></i>
                                                    </div>
                                                    <div class="col-xs-9 text-right">
                                                        <div class="huge"><?php echo number_format($total_transactions); ?></div>
                                                        <div>Total Transactions</div>
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
                                                        <i class="fa fa-plus-circle fa-3x"></i>
                                                    </div>
                                                    <div class="col-xs-9 text-right">
                                                        <div class="huge">PKR <?php echo number_format($total_credit, 2); ?></div>
                                                        <div>Total Credit</div>
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
                                                        <i class="fa fa-minus-circle fa-3x"></i>
                                                    </div>
                                                    <div class="col-xs-9 text-right">
                                                        <div class="huge">PKR <?php echo number_format($total_debit, 2); ?></div>
                                                        <div>Total Debit</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="panel panel-info">
                                            <div class="panel-heading">
                                                <div class="row">
                                                    <div class="col-xs-3">
                                                        <i class="fa fa-balance-scale fa-3x"></i>
                                                    </div>
                                                    <div class="col-xs-9 text-right">
                                                        <div class="huge">PKR <?php echo number_format($total_credit - $total_debit, 2); ?></div>
                                                        <div>Net Balance</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>

                                <!-- Payment Method Summary -->
                                <?php if (!empty($payment_summary)): ?>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h3 class="panel-title"><i class="fa fa-chart-pie"></i> Payment Method Summary</h3>
                                            </div>
                                            <div class="panel-body">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-hover" id="paymentSummaryTable">
                                                        <thead>
                                                            <tr>
                                                                <th>Payment Method</th>
                                                                <th>Transaction Count</th>
                                                                <th>Total Credit</th>
                                                                <th>Total Debit</th>
                                                                <th>Net Amount</th>
                                                                <th>Percentage</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php 
                                                            $total_amount = 0;
                                                            foreach ($payment_summary as $summary) {
                                                                $total_amount += ($summary['total_credit'] + $summary['total_debit']);
                                                            }
                                                            
                                                            foreach ($payment_summary as $summary): 
                                                                $net_amount = $summary['total_credit'] - $summary['total_debit'];
                                                                $percentage = $total_amount > 0 ? (($summary['total_credit'] + $summary['total_debit']) / $total_amount) * 100 : 0;
                                                            ?>
                                                                <tr>
                                                                    <td>
                                                                        <strong><?php echo $summary['payment_options_title']; ?></strong>
                                                                    </td>
                                                                    <td><?php echo number_format($summary['transaction_count']); ?></td>
                                                                    <td class="text-success">PKR <?php echo number_format($summary['total_credit'], 2); ?></td>
                                                                    <td class="text-danger">PKR <?php echo number_format($summary['total_debit'], 2); ?></td>
                                                                    <td class="<?php echo $net_amount >= 0 ? 'text-success' : 'text-danger'; ?>">
                                                                        <strong>PKR <?php echo number_format($net_amount, 2); ?></strong>
                                                                    </td>
                                                                    <td>
                                                                        <div class="progress" style="margin-bottom: 0;">
                                                                            <div class="progress-bar" role="progressbar" 
                                                                                 style="width: <?php echo $percentage; ?>%;" 
                                                                                 aria-valuenow="<?php echo $percentage; ?>" 
                                                                                 aria-valuemin="0" aria-valuemax="100">
                                                                                <?php echo number_format($percentage, 1); ?>%
                                                                            </div>
                                                                        </div>
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

                                <!-- Payment Transactions Table -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h3 class="panel-title"><i class="fa fa-table"></i> Payment Transactions</h3>
                                            </div>
                                            <div class="panel-body">
                                                <?php if (!empty($payment_data)): ?>
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-hover" id="paymentDataTable">
                                                            <thead>
                                                                <tr>
                                                                    <th>Date</th>
                                                                    <th>Order #</th>
                                                                    <th>Shop</th>
                                                                    <th>Type</th>
                                                                    <th>Amount</th>
                                                                    <th>Payment Method</th>
                                                                    <th>Remarks</th>
                                                                    <th>Actions</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php 
                                                                $running_balance = 0;
                                                                foreach ($payment_data as $payment): 
                                                                    if ($payment['type'] == 'credit') {
                                                                        $running_balance += $payment['amount'];
                                                                    } else {
                                                                        $running_balance -= $payment['amount'];
                                                                    }
                                                                ?>
                                                                    <tr>
                                                                        <td><?php echo date('Y-m-d H:i', strtotime($payment['date'])); ?></td>
                                                                        <td>
                                                                            <a href="<?php echo site_url('orders/show_invoice/' . $payment['order_number']); ?>" 
                                                                               class="btn btn-xs btn-info">
                                                                                <?php echo $payment['order_number']; ?>
                                                                            </a>
                                                                        </td>
                                                                        <td><?php echo $payment['shop_name']; ?></td>
                                                                        <td>
                                                                            <span class="label label-<?php echo $payment['type'] == 'credit' ? 'success' : 'danger'; ?>">
                                                                                <?php echo ucfirst($payment['type']); ?>
                                                                            </span>
                                                                        </td>
                                                                        <td class="text-right">
                                                                            <strong class="<?php echo $payment['type'] == 'credit' ? 'text-success' : 'text-danger'; ?>">
                                                                                PKR <?php echo number_format($payment['amount'], 2); ?>
                                                                            </strong>
                                                                        </td>
                                                                        <td><?php echo $payment['payment_options_title']; ?></td>
                                                                        <td><?php echo $payment['remarks']; ?></td>
                                                                        <td>
                                                                            <span class="badge badge-info">
                                                                                Balance: PKR <?php echo number_format($running_balance, 2); ?>
                                                                            </span>
                                                                        </td>
                                                                    </tr>
                                                                <?php endforeach; ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                <?php else: ?>
                                                    <div class="alert alert-info">
                                                        <i class="fa fa-info-circle"></i> No payment transactions found for the selected filters.
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

#paymentSummaryTable th, #paymentDataTable th {
    background-color: #f5f5f5;
    font-weight: bold;
}

.label-success {
    background-color: #5cb85c;
}

.label-danger {
    background-color: #d9534f;
}

.badge-info {
    background-color: #5bc0de;
}

.text-success {
    color: #5cb85c;
}

.text-danger {
    color: #d9534f;
}

.progress {
    height: 20px;
    margin-bottom: 0;
}

.progress-bar {
    line-height: 20px;
    font-size: 12px;
}
</style>

<script>
$(document).ready(function() {
    // Initialize DataTables
    $('#paymentSummaryTable').DataTable({
        "pageLength": 10,
        "order": [[4, "desc"]], // Sort by net amount
        "responsive": true
    });
    
    $('#paymentDataTable').DataTable({
        "pageLength": 25,
        "order": [[0, "desc"]], // Sort by date
        "responsive": true
    });
});
</script>

<?php $this->load->view('common/footer'); ?> 