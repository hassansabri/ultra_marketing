<?php $this->load->view('common/header'); ?>
<div id="main" role="main">
    <div id="content">
        <div class="row">
            <div class="col-md-12">
                <h2>Ledger for Shop: <?php echo isset($shop_detail[0]['shop_name']) ? $shop_detail[0]['shop_name'] : 'Shop'; ?></h2>
                <hr>
                <div class="panel panel-default">
                    <div class="panel-heading">Ledger Entries</div>
                    <div class="panel-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Order #</th>
                                    <th class="text-right">Debit</th>
                                    <th class="text-right">Credit</th>
                                    <th class="text-right">Balance</th>
                                    <th>Payment Method</th>
                                    <th>Remarks</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $balance = 0;
                                $total_debit = 0;
                                $total_credit = 0;
                                if(isset($shop_ledger) && count($shop_ledger) > 0):
                                    foreach($shop_ledger as $entry):
                                        $debit = $entry['type'] == 'debit' ? $entry['amount'] : 0;
                                        $credit = $entry['type'] == 'credit' ? $entry['amount'] : 0;
                                        $total_debit += $debit;
                                        $total_credit += $credit;
                                        $balance += ($credit - $debit);
                                ?>
                                    <tr>
                                        <td><?php echo date('Y-m-d H:i', strtotime($entry['date'])); ?></td>
                                        <td><?php echo htmlspecialchars($entry['order_number']); ?></td>
                                        <td class="text-right"><?php echo $debit ? number_format($debit, 2) : '-'; ?></td>
                                        <td class="text-right"><?php echo $credit ? number_format($credit, 2) : '-'; ?></td>
                                        <td class="text-right"><?php echo number_format($balance, 2); ?></td>
                                        <td><?php echo htmlspecialchars($entry['payment_method']); ?></td>
                                        <td><?php echo htmlspecialchars($entry['remarks']); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                <?php else: ?>
                                    <tr><td colspan="7" class="text-center">No ledger entries found for this shop.</td></tr>
                                <?php endif; ?>
                            </tbody>
                            <tfoot>
                                <tr style="background: #f6f8fa; font-weight: bold;">
                                    <td colspan="2" class="text-right">Totals:</td>
                                    <td class="text-right"><?php echo number_format($total_debit, 2); ?></td>
                                    <td class="text-right"><?php echo number_format($total_credit, 2); ?></td>
                                    <td class="text-right"><?php echo number_format($balance, 2); ?></td>
                                    <td colspan="2"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('common/footer'); ?> 