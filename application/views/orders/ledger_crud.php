<?php $this->load->view('common/header'); ?>
<div id="main" role="main">
    <div id="content">
        <div class="row">
            <div class="col-md-12">
                <h2>Order Ledger Management</h2>
                <hr>
                <!-- Add/Edit Form -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <?php echo isset($entry) ? 'Edit Ledger Entry' : 'Add Ledger Entry'; ?>
                    </div>
                    <div class="panel-body">
                        <form id="lf" method="post" action="<?php echo isset($entry) ? site_url('orders/edit_ledger_entry/'.$entry['ledger_id']) : site_url('orders/add_ledger_entry'); ?>">
                            <div class="form-group">
                                <label for="shop_id">Select supplier</label>
                                <select class="form-control shopinvoice" name="shop_id" id="shop_id" required>
                                    <option value="">Select Shop</option>
                                    <?php
                                    if (isset($all_shops) && is_array($all_shops)) {
                                        $selected_shop = isset($entry) ? $entry['shop_id'] : '';
                                        foreach($all_shops as $shop) {
                                            $selected = ($selected_shop == $shop['shop_id']) ? 'selected' : '';
                                            echo "<option value=\"{$shop['shop_id']}\" $selected>{$shop['shop_name']}</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="order_number">Invoice Number</label>
                                <select class="form-control inv" name="order_number" id="order_number" required>
                            <option value="<?php echo isset($entry) ? htmlspecialchars($entry['order_number']) : ''; ?>"><?php echo isset($entry) ? htmlspecialchars($entry['order_number']) : ''; ?></option>  
                            </select>
                            </div>
                            <div class="form-group">
                                <label for="date">Date</label>
                                <input type="datetime-local" class="form-control" name="date" id="date" value="<?php echo isset($entry) ? date('Y-m-d\TH:i', strtotime($entry['date'])) : date("Y-m-d\TH:i"); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="amount">Amount</label>
                                <input type="number" step="0.01" class="form-control" name="amount" id="amount" value="<?php echo isset($entry) ? htmlspecialchars($entry['amount']) : ''; ?>" required>
                            </div>
                            <div class="form-group col-md-3 pm">
                                <label for="payment_method">Payment Method</label>
                                <select class="form-control" name="payment_method" id="payment_method" required>
                                    <option value="">Select Payment Method</option>
                                    <?php
                                    if (isset($payment_options) && is_array($payment_options)) {
                                        $selected_method = isset($entry) ? $entry['payment_method'] : '';
                                        foreach($payment_options as $option) {
                                            $value = $option['payment_options_title'];
                                            $selected = ($selected_method == $value) ? 'selected' : '';
                                            echo "<option value=\"$value\" $selected>$value</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div style="clear:both"></div>
                            <div class="form-group">
                                <label for="type">Type</label>
                                <select class="form-control" name="type" id="type" required>
                                    <!-- <option value="">Select Type</option> -->
                                    <option value="credit" <?php echo (isset($entry) && $entry['type'] == 'credit') ? 'selected' : ''; ?>>Credit</option>
                                    <!-- <option value="debit" <?php echo (isset($entry) && $entry['type'] == 'debit') ? 'selected' : ''; ?>>Debit</option> -->
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="remarks">Remarks</label>
                                <input type="text" class="form-control" name="remarks" id="remarks" value="<?php echo isset($entry) ? htmlspecialchars($entry['remarks']) : ''; ?>">
                            </div>
                            <button type="submit" class="btn btn-success"><?php echo isset($entry) ? 'Update' : 'Add'; ?> Entry</button>
                        </form>
                    </div>
                </div>
                <!-- Ledger Entries Table -->
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        All Ledger Entries
                        <div class="pull-right">
                            <select id="shop-filter" class="form-control input-sm" style="width: 200px;">
                                <option value="">Filter by Shop</option>
                                <?php foreach($all_shops as $shop): ?>
                                    <option value="<?php echo $shop['shop_name']; ?>"><?php echo $shop['shop_name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Shop</th>
                                    <th>Invoice Number</th>
                                    <th>Date</th>
                                    <th>Type</th>
                                    <th>Amount</th>
                                    <th>Payment Method</th>
                                    <th>Remarks</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(isset($ledger_entries) && count($ledger_entries) > 0): ?>
                                    <?php foreach($ledger_entries as $row): ?>
                                        <tr>
                                            <td><?php echo $row['ledger_id']; ?></td>
                                            <td>
                                                <div class="shop-display">
                                                    <?php if(isset($row['shop_name']) && $row['shop_name']): ?>
                                                        <span class="badge badge-primary"><?php echo htmlspecialchars($row['shop_name']); ?></span>
                                                    <?php else: ?>
                                                        <span class="text-muted">N/A</span>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="shop-update" style="display: none;">
                                                    <select class="form-control input-sm shop-select" data-order="<?php echo $row['order_number']; ?>">
                                                        <option value="">Select Shop</option>
                                                        <?php foreach($all_shops as $shop): ?>
                                                            <option value="<?php echo $shop['shop_id']; ?>" <?php echo (isset($row['shop_id']) && $row['shop_id'] == $shop['shop_id']) ? 'selected' : ''; ?>>
                                                                <?php echo $shop['shop_name']; ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <button type="button" class="btn btn-xs btn-warning toggle-shop-edit" data-ledger-id="<?php echo $row['ledger_id']; ?>">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                            </td>
                                            <td>
                                                <a href="<?php echo site_url('orders/show_invoice/'.$row['order_number']); ?>" class="btn btn-xs btn-info" title="View Invoice">
                                                    <?php echo htmlspecialchars($row['order_number']); ?>
                                                </a>
                                            </td>
                                            <td><?php echo date('Y-m-d H:i', strtotime($row['date'])); ?></td>
                                            <td>
                                                <span class="badge badge-<?php echo ($row['type'] == 'credit') ? 'success' : 'danger'; ?>">
                                                    <?php echo ucfirst(htmlspecialchars($row['type'])); ?>
                                                </span>
                                            </td>
                                            <td class="text-right">
                                                <strong><?php echo number_format($row['amount'], 2); ?></strong>
                                            </td>
                                            <td><?php echo htmlspecialchars($row['payment_method']); ?></td>
                                            <td><?php echo htmlspecialchars($row['remarks']); ?></td>
                                            <td>
                                                <a href="<?php echo site_url('orders/edit_ledger_entry/'.$row['ledger_id']); ?>" class="btn btn-xs btn-info">Edit</a>
                                                <a href="<?php echo site_url('orders/delete_ledger_entry/'.$row['ledger_id']); ?>" class="btn btn-xs btn-danger" onclick="return confirm('Delete this entry?');">Delete</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr><td colspan="9" class="text-center">No ledger entries found.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
.badge {
    font-size: 11px;
    padding: 4px 8px;
}

.badge-primary {
    background-color: #3498db;
}

.badge-success {
    background-color: #27ae60;
}

.badge-danger {
    background-color: #e74c3c;
}

.table th {
    background-color: #f8f9fa;
    font-weight: 600;
    border-bottom: 2px solid #dee2e6;
}

.table td {
    vertical-align: middle;
}

.btn-xs {
    padding: 2px 6px;
    font-size: 11px;
}

.text-right {
    text-align: right;
}

.panel-heading {
    background-color: #f8f9fa;
    border-bottom: 1px solid #dee2e6;
}

.form-group label {
    font-weight: 600;
    color: #495057;
}

@media (max-width: 768px) {
    .table-responsive {
        font-size: 12px;
    }
    
    .btn-xs {
        padding: 1px 4px;
        font-size: 10px;
    }
    
    .badge {
        font-size: 10px;
        padding: 2px 6px;
    }
}

/* Shop update specific styles */
.shop-update {
    margin-bottom: 5px;
}

.shop-select {
    font-size: 11px;
    padding: 2px 4px;
    height: 24px;
}

.toggle-shop-edit {
    margin-top: 2px;
}

.panel-heading .pull-right {
    margin-top: -5px;
}

#shop-filter {
    border: 1px solid #ddd;
    border-radius: 3px;
}

.alert {
    margin-top: 15px;
    margin-bottom: 15px;
}
</style>

<script type="text/javascript">
    orders.init();
$(document).ready(function() {
    // Toggle shop edit mode
    $('.toggle-shop-edit').click(function() {
        var ledgerId = $(this).data('ledger-id');
        var row = $(this).closest('td');
        var displayDiv = row.find('.shop-display');
        var updateDiv = row.find('.shop-update');
        var button = $(this);
        
        if (updateDiv.is(':visible')) {
            // Save the shop update
            var shopSelect = updateDiv.find('.shop-select');
            var orderNumber = shopSelect.data('order');
            var shopId = shopSelect.val();
            
            if (shopId) {
                $.ajax({
                    url: '<?php echo site_url("orders/update_shop_ajax"); ?>',
                    type: 'POST',
                    data: {
                        order_number: orderNumber,
                        shop_id: shopId
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            // Update the display
                            var shopName = shopSelect.find('option:selected').text();
                            displayDiv.html('<span class="badge badge-primary">' + shopName + '</span>');
                            
                            // Hide update div and show display
                            updateDiv.hide();
                            displayDiv.show();
                            button.html('<i class="fa fa-edit"></i>');
                            
                            // Show success message
                            showAlert('Shop updated successfully!', 'success');
                        } else {
                            showAlert('Failed to update shop: ' + response.message, 'danger');
                        }
                    },
                    error: function() {
                        showAlert('Error updating shop. Please try again.', 'danger');
                    }
                });
            } else {
                showAlert('Please select a shop.', 'warning');
            }
        } else {
            // Show edit mode
            displayDiv.hide();
            updateDiv.show();
            button.html('<i class="fa fa-save"></i>');
        }
    });
    
    // Function to show alerts
    function showAlert(message, type) {
        var alertHtml = '<div class="alert alert-' + type + ' alert-dismissible" role="alert">' +
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
            '<span aria-hidden="true">&times;</span></button>' +
            message +
            '</div>';
        
        // Remove existing alerts
        $('.alert').remove();
        
        // Add new alert at the top
        $('.col-md-12 h2').after(alertHtml);
        
        // Auto-dismiss after 5 seconds
        setTimeout(function() {
            $('.alert').fadeOut();
        }, 5000);
    }
    
    // Add shop filter functionality
    $('#shop-filter').change(function() {
        var selectedShop = $(this).val();
        if (selectedShop) {
            $('tbody tr').each(function() {
                var shopName = $(this).find('.shop-display .badge').text();
                if (shopName && shopName.trim() !== selectedShop) {
                    $(this).hide();
                } else {
                    $(this).show();
                }
            });
        } else {
            $('tbody tr').show();
        }
    });
});
</script>

<?php $this->load->view('common/footer'); ?> 