<?php
// PDF Shop Report View
?>
<div class="summary">
    <h2>Shop Report</h2>
    <?php if (!empty($shop_info)): ?>
    <table style="width:100%; margin-bottom:20px; border-collapse:collapse;">
        <tr><th colspan="2" style="background:#5bc0de;color:#fff;padding:8px; text-align:center;">Shop Information</th></tr>
        <tr><td style="border:1px solid #ddd; padding:6px; font-weight:bold;">Shop Name:</td><td style="border:1px solid #ddd; padding:6px;"><?php echo $shop_info['shop_name']; ?></td></tr>
        <tr><td style="border:1px solid #ddd; padding:6px; font-weight:bold;">Address:</td><td style="border:1px solid #ddd; padding:6px;"><?php echo $shop_info['shop_address']; ?></td></tr>
        <tr><td style="border:1px solid #ddd; padding:6px; font-weight:bold;">Phone:</td><td style="border:1px solid #ddd; padding:6px;"><?php echo $shop_info['shop_number']; ?></td></tr>
        <tr><td style="border:1px solid #ddd; padding:6px; font-weight:bold;">Email:</td><td style="border:1px solid #ddd; padding:6px;"><?php echo $shop_info['shop_email']; ?></td></tr>
        <tr><td style="border:1px solid #ddd; padding:6px; font-weight:bold;">Status:</td><td style="border:1px solid #ddd; padding:6px;"><?php echo $shop_info['shop_status'] == 1 ? 'Active' : 'Inactive'; ?></td></tr>
        <tr><td style="border:1px solid #ddd; padding:6px; font-weight:bold;">Created Date:</td><td style="border:1px solid #ddd; padding:6px;"><?php echo date('Y-m-d', strtotime($shop_info['created_date'])); ?></td></tr>
    </table>
    <?php endif; ?>

    <?php if (!empty($shop_summary)): ?>
    <table style="width:100%; margin-bottom:20px; border-collapse:collapse;">
        <tr>
            <th style="background:#337ab7;color:#fff;padding:8px; text-align:center;">Total Orders</th>
            <th style="background:#5cb85c;color:#fff;padding:8px; text-align:center;">Total Sales</th>
            <th style="background:#f0ad4e;color:#fff;padding:8px; text-align:center;">Total Quantity</th>
            <th style="background:#d9534f;color:#fff;padding:8px; text-align:center;">Avg Order Value</th>
        </tr>
        <tr>
            <td style="padding:8px; text-align:center; font-weight:bold;"><?php echo number_format($shop_summary['total_orders']); ?></td>
            <td style="padding:8px; text-align:center; font-weight:bold;" class="currency">PKR <?php echo number_format($shop_summary['total_sales'], 2); ?></td>
            <td style="padding:8px; text-align:center; font-weight:bold;"><?php echo number_format($shop_summary['total_quantity']); ?></td>
            <td style="padding:8px; text-align:center; font-weight:bold;" class="currency">PKR <?php echo number_format($shop_summary['avg_order_value'], 2); ?></td>
        </tr>
    </table>
    <?php endif; ?>
</div>

<h3>Shop Orders</h3>
<?php if (!empty($shop_orders)): ?>
<table border="1" cellpadding="5" cellspacing="0" style="width:100%; border-collapse:collapse; font-size:11px;">
    <thead>
        <tr style="background:#f5f5f5;">
            <th style="border:1px solid #ddd; padding:6px; text-align:left; font-weight:bold;">Order #</th>
            <th style="border:1px solid #ddd; padding:6px; text-align:left; font-weight:bold;">Item Name</th>
            <th style="border:1px solid #ddd; padding:6px; text-align:left; font-weight:bold;">Item Code</th>
            <th style="border:1px solid #ddd; padding:6px; text-align:center; font-weight:bold;">Quantity</th>
            <th style="border:1px solid #ddd; padding:6px; text-align:right; font-weight:bold;">Price</th>
            <th style="border:1px solid #ddd; padding:6px; text-align:right; font-weight:bold;">Total</th>
            <th style="border:1px solid #ddd; padding:6px; text-align:center; font-weight:bold;">Status</th>
            <th style="border:1px solid #ddd; padding:6px; text-align:center; font-weight:bold;">Date</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($shop_orders as $order): ?>
        <tr>
            <td style="border:1px solid #ddd; padding:6px; text-align:left;"><?php echo $order['order_number']; ?></td>
            <td style="border:1px solid #ddd; padding:6px; text-align:left;"><?php echo $order['item_name']; ?></td>
            <td style="border:1px solid #ddd; padding:6px; text-align:left;"><?php echo $order['item_code']; ?></td>
            <td style="border:1px solid #ddd; padding:6px; text-align:center;"><?php echo $order['order_quantity']; ?></td>
            <td style="border:1px solid #ddd; padding:6px; text-align:right;" class="currency">PKR <?php echo number_format($order['order_price'], 2); ?></td>
            <td style="border:1px solid #ddd; padding:6px; text-align:right; font-weight:bold;" class="currency">PKR <?php echo number_format($order['order_price'] * $order['order_quantity'], 2); ?></td>
            <td style="border:1px solid #ddd; padding:6px; text-align:center;"><?php echo ucfirst($order['order_status']); ?></td>
            <td style="border:1px solid #ddd; padding:6px; text-align:center;"><?php echo date('Y-m-d H:i', strtotime($order['created_date'])); ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php else: ?>
<p style="text-align:center; color:#666; font-style:italic;">No orders found for this shop in the selected date range.</p>
<?php endif; ?>

<?php if (!empty($shop_ledger)): ?>
<h3>Shop Ledger</h3>
<table border="1" cellpadding="5" cellspacing="0" style="width:100%; border-collapse:collapse; font-size:11px;">
    <thead>
        <tr style="background:#f5f5f5;">
            <th style="border:1px solid #ddd; padding:6px; text-align:center; font-weight:bold;">Date</th>
            <th style="border:1px solid #ddd; padding:6px; text-align:left; font-weight:bold;">Order #</th>
            <th style="border:1px solid #ddd; padding:6px; text-align:center; font-weight:bold;">Type</th>
            <th style="border:1px solid #ddd; padding:6px; text-align:right; font-weight:bold;">Amount</th>
            <th style="border:1px solid #ddd; padding:6px; text-align:left; font-weight:bold;">Payment Method</th>
            <th style="border:1px solid #ddd; padding:6px; text-align:left; font-weight:bold;">Remarks</th>
            <th style="border:1px solid #ddd; padding:6px; text-align:right; font-weight:bold;">Balance</th>
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
            <td style="border:1px solid #ddd; padding:6px; text-align:center;"><?php echo date('Y-m-d H:i', strtotime($entry['date'])); ?></td>
            <td style="border:1px solid #ddd; padding:6px; text-align:left;"><?php echo $entry['order_number']; ?></td>
            <td style="border:1px solid #ddd; padding:6px; text-align:center;"><?php echo ucfirst($entry['type']); ?></td>
            <td style="border:1px solid #ddd; padding:6px; text-align:right;" class="currency">PKR <?php echo number_format($entry['amount'], 2); ?></td>
            <td style="border:1px solid #ddd; padding:6px; text-align:left;"><?php echo $entry['payment_options_title']; ?></td>
            <td style="border:1px solid #ddd; padding:6px; text-align:left;"><?php echo $entry['remarks']; ?></td>
            <td style="border:1px solid #ddd; padding:6px; text-align:right; font-weight:bold;" class="currency">PKR <?php echo number_format($balance, 2); ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php endif; ?> 