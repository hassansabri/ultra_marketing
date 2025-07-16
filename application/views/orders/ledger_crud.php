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
                        <form method="post" action="<?php echo isset($entry) ? site_url('orders/edit_ledger_entry/'.$entry['ledger_id']) : site_url('orders/add_ledger_entry'); ?>">
                            <div class="form-group">
                                <label for="shop_id">Shop</label>
                                <select class="form-control" name="shop_id" id="shop_id">
                                    <option value="">Select Shop</option>
                                    <?php if(isset($all_shops) && is_array($all_shops)) { ?>
                                        <?php foreach($all_shops as $shop) { ?>
                                            <option value="<?php echo $shop['shop_id']; ?>"
                                                <?php 
                                                // Try to pre-select shop if editing
                                                $selected = '';
                                                if(isset($entry)) {
                                                    // Try to get shop_id from order_number
                                                    if(isset($entry['order_number'])) {
                                                        $CI =& get_instance();
                                                        $CI->load->model('orders/m_orders');
                                                        $order_info = $CI->m_orders->getOrder($entry['order_number']);
                                                        if(isset($order_info[0]['shop_id']) && $order_info[0]['shop_id'] == $shop['shop_id']) {
                                                            $selected = 'selected';
                                                        }
                                                    }
                                                }
                                                echo $selected;
                                                ?>>
                                                <?php echo htmlspecialchars($shop['shop_name']); ?>
                                            </option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="order_number">Order Number</label>
                                <input type="text" class="form-control" name="order_number" id="order_number" value="<?php echo isset($entry) ? htmlspecialchars($entry['order_number']) : ''; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="date">Date</label>
                                <input type="datetime-local" class="form-control" name="date" id="date" value="<?php echo isset($entry) ? date('Y-m-d\TH:i', strtotime($entry['date'])) : ''; ?>">
                            </div>
                            <div class="form-group">
                                <label for="amount">Amount</label>
                                <input type="number" step="0.01" class="form-control" name="amount" id="amount" value="<?php echo isset($entry) ? htmlspecialchars($entry['amount']) : ''; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="payment_method">Payment Method</label>
                                <select class="form-control" name="payment_method" id="payment_method" required>
                                    <option value="">Select Payment Method</option>
                                    <?php
                                    $payment_options = array('Cash', 'Bank Transfer', 'Credit Card', 'Cheque', 'Other');
                                    $selected_method = isset($entry) ? $entry['payment_method'] : '';
                                    foreach($payment_options as $option) {
                                        $selected = ($selected_method == $option) ? 'selected' : '';
                                        echo "<option value=\"$option\" $selected>$option</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="type">Type</label>
                                <select class="form-control" name="type" id="type" required>
                                    <option value="credit" <?php echo (isset($entry) && $entry['type'] == 'credit') ? 'selected' : ''; ?>>Credit</option>
                                    <option value="debit" <?php echo (isset($entry) && $entry['type'] == 'debit') ? 'selected' : ''; ?>>Debit</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="remarks">Remarks</label>
                                <input type="text" class="form-control" name="remarks" id="remarks" value="<?php echo isset($entry) ? htmlspecialchars($entry['remarks']) : ''; ?>">
                            </div>
                            <button type="submit" class="btn btn-success"><?php echo isset($entry) ? 'Update' : 'Add'; ?> Entry</button>
                            <?php if(isset($entry)): ?>
                                <a href="<?php echo site_url('orders/ledger'); ?>" class="btn btn-default">Cancel</a>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>
                <!-- Ledger Entries Table -->
                <div class="panel panel-primary">
                    <div class="panel-heading">All Ledger Entries</div>
                    <div class="panel-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Order Number</th>
                                    <th>Shop</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Payment Method</th>
                                    <th>Type</th>
                                    <th>Remarks</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(isset($ledger_entries) && count($ledger_entries) > 0): ?>
                                    <?php foreach($ledger_entries as $row): ?>
                                        <tr>
                                            <td><?php echo $row['ledger_id']; ?></td>
                                            <td><?php echo htmlspecialchars($row['order_number']); ?></td>
                                            <?php 
                                            // Fetch shop name for this order
                                            $shop_name = '';
                                            if (isset($row['order_number'])) {
                                                $CI =& get_instance();
                                                $CI->load->model('orders/m_orders', 'model_order');
                                                $order_info = $CI->model_order->getOrder($row['order_number']);
                                                if (isset($order_info[0]['shop_id']) && $order_info[0]['shop_id']) {
                                                    $CI->load->model('shops/m_shop', 'model_shop');
                                                    $shop = $CI->model_shop->getshopdetail($order_info[0]['shop_id']);
                                                    if ($shop && isset($shop[0]['shop_name'])) {
                                                        $shop_name = $shop[0]['shop_name'];
                                                    }
                                                }
                                            }
                                            ?>
                                            <td><?php echo htmlspecialchars($shop_name); ?></td>
                                            <td><?php echo htmlspecialchars($row['date']); ?></td>
                                            <td><?php echo htmlspecialchars($row['amount']); ?></td>
                                            <td><?php echo htmlspecialchars($row['payment_method']); ?></td>
                                            <td><?php echo htmlspecialchars($row['type']); ?></td>
                                            <td><?php echo htmlspecialchars($row['remarks']); ?></td>
                                            <td>
                                                <a href="<?php echo site_url('orders/edit_ledger_entry/'.$row['ledger_id']); ?>" class="btn btn-xs btn-info">Edit</a>
                                                <a href="<?php echo site_url('orders/delete_ledger_entry/'.$row['ledger_id']); ?>" class="btn btn-xs btn-danger" onclick="return confirm('Delete this entry?');">Delete</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr><td colspan="7" class="text-center">No ledger entries found.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('common/footer'); ?> 