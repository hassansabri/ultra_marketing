<?php $this->load->view("common/header"); ?>

<div id="main" role="main">
    <!-- RIBBON -->
    <div id="ribbon">
        <!-- breadcrumb -->
        <ol class="breadcrumb">
            <li><?php echo $this->lang->line("home"); ?></li>
            <li>Orders</li>
            <li>Invoice</li>
        </ol>
        <!-- end breadcrumb -->
    </div>
    <!-- END RIBBON -->
    
    <!-- MAIN CONTENT -->
    <div id="content">
        <!-- widget grid -->
        <section id="widget-grid" class="">
            <!-- row -->
            <div class="row">
                <div id="wrapper">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="well">
                            <div class="widget-body">
                                <div class="invoice-box">
                                    <table cellpadding="0" cellspacing="0" class="table table-bordered">
                                        <tr class="top">
                                            <td colspan="2">
                                                <table class="table table-borderless">
                                                    <tr>
                                                        <td class="title">
                                                            <img src="<?php echo base_url(); ?>images/<?php echo $profile[0]['logo']; ?>" style="width: 100%; max-width: 300px" />
                                                        </td>
                                                        <td class="text-right">
                                                            <h3>INVOICE</h3>
                                                            <p><strong>Invoice #:</strong> <?php echo $order_number; ?></p>
                                                            <p><strong>Created:</strong> <?php echo date('l, F j, Y'); ?></p>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>

                                        <tr class="information">
                                            <td colspan="2">
                                                <table class="table table-borderless">
                                                    <tr>
                                                        <td>
                                                            <h5><strong>From:</strong></h5>
                                                            <?php if(isset($profile[0])): ?>
                                                                <p><strong><?php echo $profile[0]['shop_name']; ?></strong></p>
                                                                <p><?php echo $profile[0]['adress']; ?></p>
                                                                <p>Phone: <?php echo $profile[0]['phone']; ?></p>
                                                                <p>Email: <?php echo $profile[0]['email']; ?></p>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td class="text-right">
                                                            <h5><strong>To:</strong></h5>
                                                            <?php if(isset($shop_info) && $shop_info): ?>
                                                                <p><strong><?php echo $shop_info['shop_name']; ?></strong></p>
                                                                <p><?php echo $shop_info['shop_address']; ?></p>
                                                                <p>Phone: <?php echo $shop_info['shop_number']; ?></p>
                                                                <p>Email: <?php echo $shop_info['shop_email']; ?></p>
                                                            <?php else: ?>
                                                                <p><strong>Customer</strong></p>
                                                                <p>Customer Address</p>
                                                                <p>Phone: Customer Phone</p>
                                                                <p>Email: customer@email.com</p>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>

                                        <tr class="heading">
                                            <td colspan="4">
                                                <h4><i class="fa fa-shopping-cart"></i> Order Items</h4>
                                            </td>
                                        </tr>
                                        <tr class="heading">
                                            <th>Item</th>
                                            <th class="text-right">Price</th>
                                            <th class="text-right">Quantity</th>
                                            <th class="text-right">Subtotal</th>
                                        </tr>
                                        <?php 
                                        $total_price = 0;
                                        $currency = 'PKR'; // Change to your preferred currency symbol
                                        if(isset($order_details) && count($order_details) > 0): ?>
                                            <?php foreach($order_details as $item_id => $item_data): 
                                                $item_price = 0;
                                                $item_qty = 0;
                                                if(isset($order_info)) {
                                                    foreach($order_info as $oi) {
                                                        if($oi['item_id'] == $item_id) {
                                                            $item_price = $oi['order_price'];
                                                            $item_qty = $oi['order_quantity'];
                                                            break;
                                                        }
                                                    }
                                                }
                                                $item_subtotal = $item_price * $item_qty;
                                                $total_price += $item_subtotal;
                                            ?>
                                                <tr class="item">
                                                    <td>
                                                        <div class="item-header">
                                                            <strong><?php echo $item_data['item_detail']['item_name']; ?></strong><br>
                                                            <small><strong>Code:</strong> <?php echo $item_data['item_detail']['item_code']; ?></small><br>
                                                            <small><strong>Description:</strong> <?php echo $item_data['item_detail']['item_description']; ?></small>
                                                            <div style="margin-top: 8px;">
                                                                <span style="display:inline-block; margin-right:12px;"><strong>Price:</strong> <?php echo $currency . number_format($item_price, 2); ?></span>
                                                                <span style="display:inline-block; margin-right:12px;"><strong>Quantity:</strong> <?php echo $item_qty; ?></span>
                                                                <span style="display:inline-block;"><strong>Subtotal:</strong> <?php echo $currency . number_format($item_subtotal, 2); ?></span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-right">
                                                        <?php echo $currency . number_format($item_price, 2); ?>
                                                    </td>
                                                    <td class="text-right">
                                                        <?php echo $item_qty; ?>
                                                    </td>
                                                    <td class="text-right">
                                                        <strong><?php echo $currency . number_format($item_subtotal, 2); ?></strong>
                                                    </td>
                                                </tr>
                                                <tr class="item">
                                                    <td colspan="4">
                                                        <?php if(isset($item_data['attributes']) && count($item_data['attributes']) > 0): ?>
                                                            <div class="attributes-section" style="margin-top: 15px;">
                                                                <h6 style="color: #34495e; border-bottom: 1px solid #ecf0f1; padding-bottom: 5px;">
                                                                    <i class="fa fa-tags"></i> Attributes & Quantities
                                                                </h6>
                                                                
                                                                <div class="row">
                                                                    <?php 
                                                                    $attribute_types = array(
                                                                        'grade' => array('icon' => 'fa-star', 'title' => 'Grades'),
                                                                        'model' => array('icon' => 'fa-car', 'title' => 'Models'),
                                                                        'size' => array('icon' => 'fa-expand', 'title' => 'Sizes'),
                                                                        'type' => array('icon' => 'fa-tag', 'title' => 'Types'),
                                                                        'colour' => array('icon' => 'fa-palette', 'title' => 'Colours'),
                                                                        'unit' => array('icon' => 'fa-cubes', 'title' => 'Units')
                                                                    );
                                                                    
                                                                    foreach($attribute_types as $type => $type_info):
                                                                        if(isset($item_data['attributes'][$type]) && count($item_data['attributes'][$type]) > 0):
                                                                    ?>
                                                                        <div class="col-md-6 col-sm-12">
                                                                            <div class="attribute-group" style="margin-bottom: 15px;">
                                                                                <h6 style="color: #7f8c8d; margin-bottom: 8px;">
                                                                                    <i class="<?php echo $type_info['icon']; ?>"></i> <?php echo $type_info['title']; ?>
                                                                                </h6>
                                                                                <div class="table-responsive">
                                                                                    <table class="table table-striped table-bordered table-hover" style="margin-bottom: 0; font-size: 12px;">
                                                                                        <thead>
                                                                                            <tr>
                                                                                                <th>Name</th>
                                                                                                <th>Value</th>
                                                                                                <th>Quantity</th>
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                            <?php foreach($item_data['attributes'][$type] as $attr): ?>
                                                                                                <tr>
                                                                                                    <td>
                                                                                                        <?php 
                                                                                                        $name_field = $type . '_title';
                                                                                                        echo isset($attr['detail'][$name_field]) ? $attr['detail'][$name_field] : 'N/A';
                                                                                                        ?>
                                                                                                    </td>
                                                                                                    <td>
                                                                                                        <?php 
                                                                                                        // Display additional value if available
                                                                                                        $value_field = $type . '_description';
                                                                                                        if(isset($attr['detail'][$value_field]) && !empty($attr['detail'][$value_field])):
                                                                                                            echo $attr['detail'][$value_field];
                                                                                                        else:
                                                                                                            echo '-';
                                                                                                        endif;
                                                                                                        ?>
                                                                                                    </td>
                                                                                                    <td>
                                                                                                        <span class="badge badge-primary" style="font-size: 12px;">
                                                                                                            <?php echo $attr['quantity']; ?>
                                                                                                        </span>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            <?php endforeach; ?>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    <?php 
                                                                        endif;
                                                                    endforeach; 
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        <?php else: ?>
                                                            <div class="alert alert-info" style="margin-top: 15px;">
                                                                <i class="fa fa-info-circle"></i> No attributes found for this item.
                                                            </div>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr class="item">
                                                <td colspan="2">
                                                    <div class="alert alert-warning">
                                                        <i class="fa fa-exclamation-triangle"></i> No order details found.
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endif; ?>

                                        <tr class="total" style="background: #f6f8fa; border-top: 3px solid #bbb;">
                                            <td colspan="3" class="text-right" style="font-size: 1.2em; font-weight: bold;">Total Price:</td>
                                            <td class="text-right" style="font-size: 1.3em; font-weight: bold; color: #27ae60;">
                                                <?php echo $currency . number_format($total_price, 2); ?>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                
                                <!-- Action Buttons -->
                                <div class="row" style="margin-top: 30px;">
                                    <div class="col-md-12 text-center">
                                        <div class="btn-group">
                                            <button onclick="window.print()" class="btn btn-primary">
                                                <i class="fa fa-print"></i> Print Invoice
                                            </button>
                                            <a href="<?php echo site_url(); ?>/orders/review/<?php echo $order_number; ?>" class="btn btn-info">
                                                <i class="fa fa-eye"></i> Review Order
                                            </a>
                                            <a href="<?php echo site_url(); ?>/orders/editorder/<?php echo $order_number; ?>" class="btn btn-warning">
                                                <i class="fa fa-edit"></i> Edit Order
                                            </a>
                                            <a href="<?php echo site_url(); ?>/orders/draftorders" class="btn btn-default">
                                                <i class="fa fa-arrow-left"></i> Back to Orders
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end widget grid -->
    </div>
    <!-- END MAIN CONTENT -->
</div>

<style>
.invoice-box {
    max-width: 800px;
    margin: auto;
    padding: 30px;
    border: 1px solid #eee;
    box-shadow: 0 0 10px rgba(0, 0, 0, .15);
    font-size: 16px;
    line-height: 24px;
    font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    color: #555;
}

.invoice-box table {
    width: 100%;
    line-height: inherit;
    text-align: left;
}

.invoice-box table td {
    padding: 5px;
    vertical-align: top;
}

.invoice-box table tr.top table td {
    padding-bottom: 20px;
}

.invoice-box table tr.top table td.title {
    font-size: 45px;
    line-height: 45px;
    color: #333;
}

.invoice-box table tr.information table td {
    padding-bottom: 40px;
}

.invoice-box table tr.heading td {
    background: #eee;
    border-bottom: 1px solid #ddd;
    font-weight: bold;
}

.invoice-box table tr.details td {
    padding-bottom: 20px;
}

.invoice-box table tr.item td {
    border-bottom: 1px solid #eee;
}

.invoice-box table tr.total td:nth-child(2) {
    border-top: 2px solid #eee;
    font-weight: bold;
}

.item-header {
    background-color: #f8f9fa;
    padding: 10px;
    border-radius: 5px;
    margin-bottom: 10px;
}

.attribute-group table {
    font-size: 11px;
}

.attribute-group th {
    background-color: #f1f2f6;
    font-weight: 600;
    font-size: 10px;
    text-transform: uppercase;
}

.badge-primary {
    background-color: #3498db;
}

.btn-group .btn {
    margin: 0 5px;
}

@media print {
    .btn-group, #ribbon, #header, #left-panel {
        display: none !important;
    }
    
    .invoice-box {
        box-shadow: none;
        border: none;
    }
}

@media (max-width: 768px) {
    .btn-group .btn {
        margin: 5px;
        display: block;
        width: 100%;
    }
    
    .invoice-box {
        padding: 15px;
    }
}
.invoice-box table th, .invoice-box table td {
    vertical-align: middle;
}
.invoice-box table th.text-right, .invoice-box table td.text-right {
    text-align: right;
}
@media (max-width: 768px) {
    .invoice-box table th, .invoice-box table td {
        font-size: 13px;
        padding: 4px;
    }
}
</style>

<script type="text/javascript">
$(document).ready(function() {
    console.log('Invoice page loaded for order: <?php echo $order_number; ?>');
});
</script>

<?php $this->load->view("common/footer"); ?>