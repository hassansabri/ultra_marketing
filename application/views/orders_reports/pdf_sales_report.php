<?php
// PDF Sales Report View
?>
<div class="summary">
    <h2>Sales Report Summary</h2>
    <?php if (!empty($summary)): ?>
    <table style="width:100%; margin-bottom:20px; border-collapse:collapse;">
        <tr>
            <th style="background:#337ab7;color:#fff;padding:8px; text-align:center;">Total Orders</th>
            <th style="background:#5cb85c;color:#fff;padding:8px; text-align:center;">Total Sales</th>
            <th style="background:#f0ad4e;color:#fff;padding:8px; text-align:center;">Total Quantity</th>
            <th style="background:#d9534f;color:#fff;padding:8px; text-align:center;">Avg Order Value</th>
        </tr>
        <tr>
            <td style="padding:8px; text-align:center; font-weight:bold;"><?php echo number_format($summary['total_orders']); ?></td>
            <td style="padding:8px; text-align:center; font-weight:bold;" class="currency">PKR <?php echo number_format($summary['total_sales'], 2); ?></td>
            <td style="padding:8px; text-align:center; font-weight:bold;"><?php echo number_format($summary['total_quantity']); ?></td>
            <td style="padding:8px; text-align:center; font-weight:bold;" class="currency">PKR <?php echo number_format($summary['avg_order_value'], 2); ?></td>
        </tr>
    </table>
    <?php endif; ?>
</div>

<h3>Sales Data Details</h3>
<?php if (!empty($sales_data)): ?>
<table border="1" cellpadding="5" cellspacing="0" style="width:100%; border-collapse:collapse; font-size:11px;">
    <thead>
        <tr style="background:#f5f5f5;">
            <th style="border:1px solid #ddd; padding:6px; text-align:left; font-weight:bold;">Order #</th>
            <th style="border:1px solid #ddd; padding:6px; text-align:left; font-weight:bold;">Item Name</th>
            <th style="border:1px solid #ddd; padding:6px; text-align:left; font-weight:bold;">Item Code</th>
            <th style="border:1px solid #ddd; padding:6px; text-align:left; font-weight:bold;">Shop</th>
            <th style="border:1px solid #ddd; padding:6px; text-align:center; font-weight:bold;">Quantity</th>
            <th style="border:1px solid #ddd; padding:6px; text-align:right; font-weight:bold;">Price</th>
            <th style="border:1px solid #ddd; padding:6px; text-align:right; font-weight:bold;">Total</th>
            <th style="border:1px solid #ddd; padding:6px; text-align:center; font-weight:bold;">Status</th>
            <th style="border:1px solid #ddd; padding:6px; text-align:left; font-weight:bold;">Created By</th>
            <th style="border:1px solid #ddd; padding:6px; text-align:center; font-weight:bold;">Date</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($sales_data as $sale): ?>
        <tr>
            <td style="border:1px solid #ddd; padding:6px; text-align:left;"><?php echo $sale['order_number']; ?></td>
            <td style="border:1px solid #ddd; padding:6px; text-align:left;"><?php echo $sale['item_name']; ?></td>
            <td style="border:1px solid #ddd; padding:6px; text-align:left;"><?php echo $sale['item_code']; ?></td>
            <td style="border:1px solid #ddd; padding:6px; text-align:left;"><?php echo $sale['shop_name']; ?></td>
            <td style="border:1px solid #ddd; padding:6px; text-align:center;"><?php echo $sale['order_quantity']; ?></td>
            <td style="border:1px solid #ddd; padding:6px; text-align:right;" class="currency">PKR <?php echo number_format($sale['order_price'], 2); ?></td>
            <td style="border:1px solid #ddd; padding:6px; text-align:right; font-weight:bold;" class="currency">PKR <?php echo number_format($sale['order_price'] * $sale['order_quantity'], 2); ?></td>
            <td style="border:1px solid #ddd; padding:6px; text-align:center;"><?php echo ucfirst($sale['order_status']); ?></td>
            <td style="border:1px solid #ddd; padding:6px; text-align:left;"><?php echo $sale['created_by_name']; ?></td>
            <td style="border:1px solid #ddd; padding:6px; text-align:center;"><?php echo date('Y-m-d H:i', strtotime($sale['created_date'])); ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php else: ?>
<p style="text-align:center; color:#666; font-style:italic;">No sales data found for the selected filters.</p>
<?php endif; ?> 